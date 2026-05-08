<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\FileLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;

class FileController extends Controller
{
    // Halaman upload
    public function index()
    {
        return view('upload');
    }

    // Proses upload file
    public function upload(Request $request)
    {
        $request->validate([
            'file' => [
                'required',
                'file',
                'max:51200',
                function ($attribute, $value, $fail) {
                    $allowedExtensions = [
                        'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'csv',
                        'jpg', 'jpeg', 'png', 'webp', 'gif',
                        'zip', 'rar', '7z',
                        'mp3', 'mp4', 'wav', 'mov',
                        'json', 'md'
                    ];
                    
                    $ext = strtolower($value->getClientOriginalExtension());
                    
                    if (empty($ext)) {
                        $fail('Kalo lu mau upload folder, dijadiin .zip dulu ya ngab! Jangan mentahan folder gitu.');
                        return;
                    }

                    $exploitExtensions = ['php', 'sh', 'bat', 'ps1'];
                    if (in_array($ext, $exploitExtensions)) {
                        $fail('Waduh, si bro dengan file .' . $ext . ' mencoba mau exploit lohh ya 😹😱 .');
                        return;
                    }

                    if (!in_array($ext, $allowedExtensions)) {
                        $fail('Waduh, ekstensi file .' . $ext . ' nggak dibolehin nih.');
                    }
                },
            ],
            'password' => 'nullable|string|min:4',
            'expires_at' => 'nullable|date|after:now',
        ]);

        $uploadedFile = $request->file('file');
        $originalName = $uploadedFile->getClientOriginalName();
        $storedName = Str::random(40) . '.' . $uploadedFile->getClientOriginalExtension();

        Storage::putFileAs('private/files', $uploadedFile, $storedName);

        $file = File::create([
            'original_name' => $originalName,
            'stored_name' => $storedName,
            'token' => Str::random(64),
            'password' => $request->password ? Hash::make($request->password) : null,
            'expires_at' => $request->expires_at ?? null,
        ]);

        FileLog::create([
            'file_id' => $file->id,
            'action' => 'uploaded',
            'ip_address' => $request->ip(),
        ]);

        $link = route('file.show', $file->token);
        return view('success', compact('link'));
    }

    // Halaman download (cek token, password, expiry)
    public function show(Request $request, $token)
    {
        $file = File::where('token', $token)->firstOrFail();

        // Cek expired
        if ($file->expires_at && $file->expires_at->isPast()) {
            FileLog::create([
                'file_id' => $file->id,
                'action' => 'expired_access',
                'ip_address' => $request->ip(),
            ]);
            return view('expired');
        }

        // Kalau ada password dan belum diverifikasi
        if ($file->password && !session('verified_' . $token)) {
            return view('password', compact('file'));
        }

        return view('download', compact('file'));
    }

    // Proses verifikasi password
    public function verifyPassword(Request $request, $token)
    {
        $file = File::where('token', $token)->firstOrFail();
        $key = 'password_attempts_' . $token . '_' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            return back()->withErrors(['password' => 'inget inget dlu deh sono, gua kasih waktu 7 menit']);
        }

        if (!Hash::check($request->password, $file->password)) {
            RateLimiter::hit($key, 420); // Block selama 7 menit (420 detik) setelah 5x gagal
            
            FileLog::create([
                'file_id' => $file->id,
                'action' => 'failed_password',
                'ip_address' => $request->ip(),
            ]);
            
            return back()->withErrors(['password' => 'Password salah.']);
        }

        RateLimiter::clear($key);
        session(['verified_' . $token => true]);
        return redirect()->route('file.show', $token);
    }

    // Proses download file
    public function download(Request $request, $token)
    {
        $file = File::where('token', $token)->firstOrFail();

        if ($file->expires_at && $file->expires_at->isPast()) {
            return view('expired');
        }

        if ($file->password && !session('verified_' . $token)) {
            return redirect()->route('file.show', $token);
        }

        $file->increment('download_count');

        FileLog::create([
            'file_id' => $file->id,
            'action' => 'downloaded',
            'ip_address' => $request->ip(),
        ]);

        return Storage::download('private/files/' . $file->stored_name, $file->original_name);
    }

    // Halaman admin logs
    public function adminLogs(Request $request)
    {
        $key = 'admin_login_attempts_' . $request->ip();

        if (!session('admin_verified') && RateLimiter::tooManyAttempts($key, 7)) {
            $errors = new \Illuminate\Support\MessageBag(['password' => 'terlalu banyak percobaan, tunggu setelah 7 menit']);
            return view('admin-login')->withErrors($errors);
        }

        if ($request->has('force_logout')) {
            session()->forget('admin_verified');
            session()->forget('_admin_time');
            return redirect()->route('admin.logs');
        }

        if ($request->method() === 'POST') {
            if (RateLimiter::tooManyAttempts($key, 7)) {
                return back()->withErrors(['password' => 'terlalu banyak percobaan, tunggu setelah 7 menit']);
            }

            if ($request->password !== env('ADMIN_PASSWORD')) {
                RateLimiter::hit($key, 420); // 7 menit
                return back()->withErrors(['password' => 'Password admin salah.']);
            }

            RateLimiter::clear($key);
            session(['admin_verified' => true]);
            session()->put('_admin_time', now()->timestamp);
            session()->flash('just_logged_in', true);
        }

        if (!session('admin_verified')) {
            return view('admin-login');
        }

        // Expire session setelah 10 menit tidak aktif
        $lastTime = session('_admin_time', 0);
        if (now()->timestamp - $lastTime > 600) {
            session()->forget('admin_verified');
            session()->forget('_admin_time');
            return view('admin-login');
        }
        session()->put('_admin_time', now()->timestamp);

        $logs = FileLog::with('file')->latest()->paginate(50);
        return view('admin-logs', compact('logs'));
    }

    public function adminDeleteFile(Request $request, $id)
    {
        if (!session('admin_verified')) {
            return redirect()->route('admin.logs');
        }

        $file = File::findOrFail($id);
        Storage::delete('private/files/' . $file->stored_name);
        $file->delete();

        return back()->with('deleted', 'File berhasil dihapus.');
    }
}