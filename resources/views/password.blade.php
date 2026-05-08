<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KirimApaBae — File Dikunci</title>
    <meta property="og:title" content="KirimApaBae — File Terkunci!" />
    <meta property="og:description"
        content="File ({{ $file->original_name ?? 'ini' }}) dilindungi password. Buka link ini dan masukin password buat ngakses." />
    <meta property="og:image" content="{{ asset('og-image.png') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Caveat+Brush&family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { caveat: ['"Caveat Brush"', 'cursive'], sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: { dark: '#111111' }
                }
            }
        }
    </script>
    <style>
        body {
            background: linear-gradient(135deg, #FF9A9E 0%, #FECFEF 100%);
            color: #111111;
            min-height: 100vh;
        }

        .smooth-hover {
            transition: all 0.3s ease;
        }

        .soft-focus:focus-within {
            box-shadow: 0 0 0 4px rgba(17, 17, 17, 0.1);
            border-color: #111111;
        }
    </style>
</head>

<body
    class="min-h-screen flex flex-col items-center justify-center font-sans selection:bg-dark selection:text-white px-4 py-8 text-center">

    <section class="w-full max-w-xl z-10 flex flex-col items-center">
        <h1 class="font-caveat text-5xl lg:text-6xl text-dark mb-4 drop-shadow-sm">
            Eits, Password Dulu
        </h1>
        <p class="text-lg lg:text-xl font-bold text-dark/80 mb-10 leading-relaxed">
            File ini dipassword sama yang ngirim biar gak disalahgunain.
        </p>

        @if($errors->any())
            <div
                class="mb-8 w-full bg-white/90 backdrop-blur border-l-8 border-red-500 rounded-2xl p-5 text-dark font-medium shadow-xl text-left">
                <p class="font-caveat text-2xl mb-1 text-red-600">Salah bjir!</p>
                <p class="text-sm font-bold opacity-80">{{ $errors->first() }}</p>
            </div>
        @endif

        @if($errors->first() !== 'inget inget dlu deh sono, gua kasih waktu 7 menit')
            <form action="{{ route('file.password', $file->token) }}" method="POST"
                class="flex flex-col gap-8 w-full max-w-md items-center text-center">
                @csrf
                <div class="flex flex-col gap-2 w-full items-center">
                    <label class="font-caveat text-3xl tracking-wide text-dark">Passwordnya silahkan mas</label>
                    <div
                        class="w-full bg-white/40 backdrop-blur-sm border-2 border-transparent rounded-[1.5rem] p-1.5 soft-focus smooth-hover hover:bg-white/60 shadow-md">
                        <input type="password" name="password" required autofocus placeholder="Ketik di sini..."
                            class="w-full bg-transparent p-3 text-base font-bold outline-none text-dark placeholder:text-dark/40 text-center">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="bg-dark text-white px-10 py-4 rounded-full font-black text-xl smooth-hover hover:-translate-y-1 hover:shadow-[0_15px_30_px_-10px_rgba(0,0,0,0.4)] active:scale-95">
                        Buka Sekarang
                    </button>
                </div>
            </form>
        @endif
    </section>

    <!-- Footer / Credits -->
    <div class="mt-auto pt-10 pb-6 flex flex-col items-center justify-center w-full z-10">
        <div class="flex items-center justify-center gap-2 opacity-80 hover:opacity-100 transition-opacity">
            <div class="flex items-center gap-1 font-caveat text-xl tracking-tight drop-shadow-sm">
                <span class="text-dark">Kirim</span>
                <span
                    class="inline-block -rotate-6 bg-[#FFE700] text-dark px-1.5 py-0.5 rounded-md border-[1.5px] border-dark shadow-[1.5px_1.5px_0_#111]">Apa</span>
                <span
                    class="inline-block rotate-3 bg-[#00E5FF] text-dark px-1.5 py-0.5 rounded-md border-[1.5px] border-dark shadow-[1.5px_1.5px_0_#111]">Bae</span>
            </div>
            <span class="font-sans font-bold text-xs text-dark/50 mt-1">by Abda</span>
        </div>
    </div>

</body>

</html>