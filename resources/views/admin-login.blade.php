<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KirimApaBae — Markas Atmin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat+Brush&family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
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
            background: linear-gradient(135deg, #0a0a0a 0%, #1f1f1f 100%);
            color: #ffffff;
            min-height: 100vh;
        }
        .smooth-hover { transition: all 0.3s ease; }
        .soft-focus:focus-within {
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.1);
            border-color: #ffffff;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center justify-center font-sans selection:bg-white selection:text-dark px-4 py-8 text-center">

    <section class="w-full max-w-xl z-10 flex flex-col items-center">
        <div class="mb-6 flex flex-col items-center justify-center gap-1">
            <span class="font-sans font-black text-sm tracking-widest text-white/50 uppercase mb-2">atmin nya</span>
            <div class="flex flex-wrap items-center justify-center gap-1 font-caveat text-5xl lg:text-6xl tracking-tight drop-shadow-sm">
                <span class="text-white">Kirim</span>
                <span class="inline-block -rotate-6 bg-[#FFE700] text-dark px-3 py-1 rounded-2xl border-4 border-dark shadow-[4px_4px_0_#111]">Apa</span>
                <span class="inline-block rotate-3 bg-[#00E5FF] text-dark px-3 py-1 rounded-2xl border-4 border-dark shadow-[4px_4px_0_#111]">Bae</span>
            </div>
        </div>

        <p class="text-base font-bold text-white/50 mb-10">
            Yang bukan atmin mending skip.
        </p>

        @if($errors->any())
            <div class="mb-8 w-full bg-red-500/10 backdrop-blur border-l-8 border-red-500 rounded-2xl p-5 text-white font-medium shadow-xl text-left">
                <p class="font-caveat text-2xl mb-1 text-red-400">Gabisa masuk!</p>
                <p class="text-sm font-bold text-white/80">{{ $errors->first() }}</p>
            </div>
        @endif

        @if($errors->first() !== 'terlalu banyak percobaan, tunggu setelah 7 menit')
            <form action="{{ route('admin.logs') }}" method="POST" class="flex flex-col gap-8 w-full max-w-md items-center text-center">
                @csrf
                <div class="flex flex-col gap-2 w-full items-center">
                    <label class="font-caveat text-3xl tracking-wide text-white/80">Secret Password</label>
                    <div class="w-full bg-white/5 backdrop-blur-sm border-2 border-transparent rounded-[1.5rem] p-1.5 soft-focus smooth-hover hover:bg-white/10 shadow-md">
                        <input type="password" name="password" required autofocus placeholder="Ketik sandi rahasia..."
                            class="w-full bg-transparent p-3 text-base font-bold outline-none text-white placeholder:text-white/30 text-center">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="bg-white text-dark px-10 py-4 rounded-full font-black text-xl smooth-hover hover:-translate-y-1 hover:shadow-[0_15px_30px_-10px_rgba(255,255,255,0.2)] active:scale-95">
                        Masuk Bang
                    </button>
                </div>
            </form>
        @endif
    </section>

    <script>
        sessionStorage.removeItem('admin_tab_active');
    </script>
</body>

</html>