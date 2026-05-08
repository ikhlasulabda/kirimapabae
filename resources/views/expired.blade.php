<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KirimApaBae — File Basi</title>
    <meta property="og:title" content="KirimApaBae — File Kadaluarsa" />
    <meta property="og:description"
        content="Maaf, file ini sudah tidak tersedia atau telah dihapus oleh pengirimnya." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
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
            background: linear-gradient(135deg, #D7D2CC 0%, #304352 100%);
            color: #111111;
            min-height: 100vh;
        }

        .smooth-hover {
            transition: all 0.3s ease;
        }
    </style>
</head>

<body
    class="min-h-screen flex flex-col items-center justify-center font-sans selection:bg-dark selection:text-white px-4 py-8 text-center">

    <section class="w-full max-w-xl z-10 flex flex-col items-center">
        <h1 class="font-caveat text-6xl lg:text-7xl text-white/50 mb-2 drop-shadow-sm leading-none">
            Yahh...
        </h1>
        <div class="bg-white/40 backdrop-blur-md border-4 border-white/50 rounded-[2rem] p-8 shadow-xl w-full my-6">
            <p class="text-3xl lg:text-4xl font-black text-dark mb-4 tracking-tight">
                Filenya udah basi.
            </p>
            <p class="text-base font-bold text-dark/80">
                Udah di takedown sama server karena kelewat batas waktu. Coba minta re-upload sama yang ngirim.
            </p>
        </div>

        <a href="/"
            class="inline-flex items-center justify-center bg-dark text-white rounded-full px-10 py-4 text-xl font-black smooth-hover hover:-translate-y-1 hover:shadow-[0_15px_30px_-10px_rgba(0,0,0,0.4)] active:scale-95">
            Balik ke Beranda
        </a>
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