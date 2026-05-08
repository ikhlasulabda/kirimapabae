<?php

namespace App\Console\Commands;

use App\Models\File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteExpiredFiles extends Command
{
    protected $signature   = 'files:delete-expired';
    protected $description = 'Hapus semua file yang sudah expired dari storage dan database';

    public function handle()
    {
        $expiredFiles = File::where('expires_at', '<', now())->get();

        $count = 0;

        foreach ($expiredFiles as $file) {
            Storage::delete('private/files/' . $file->stored_name);
            $file->delete();
            $count++;
        }

        $this->info("Berhasil hapus {$count} file expired.");
    }
}