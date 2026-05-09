<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KirimApaBae — Ada File Nih</title>
    <meta property="og:title" content="KirimApaBae — Ada File Buat Lu!" />
    <meta property="og:description" content="Seseorang ngirim file ({{ $file->original_name }}) ke lu. Buka link ini buat download sekarang!" />
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
                    colors: { 
                        dark: '#111111',
                        spink: '#FF99AC',
                        sorange: '#FFBD98',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background: linear-gradient(135deg, #CF9FFF 0%, #FFB6C1 100%);
            color: #111111;
            min-height: 100vh;
        }

        .smooth-hover {
            transition: all 0.3s ease;
        }

        /* Custom Scrollbar for Card */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
            margin: 10px 0;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: rgba(17, 17, 17, 0.2);
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: rgba(17, 17, 17, 0.4);
        }
    </style>
</head>

<body
    class="min-h-screen flex flex-col items-center justify-center font-sans selection:bg-dark selection:text-white px-4 py-8 text-center">

    <section class="w-full max-w-xl z-10 flex flex-col items-center">
        <h1 class="font-caveat text-4xl lg:text-5xl text-dark mb-4 drop-shadow-sm">
            Ada kiriman file nih!
        </h1>

        <div class="mb-6 flex flex-col items-center w-full">
            <p class="text-xs font-black text-dark/50 uppercase tracking-widest mb-2">Nama File</p>
            <div class="bg-white/40 backdrop-blur-sm border-4 border-white/50 rounded-[2rem] p-6 shadow-xl w-full overflow-x-auto custom-scrollbar">
                <h2 class="text-xl lg:text-2xl font-black text-dark whitespace-nowrap px-2">
                    {{ $file->original_name }}
                </h2>
            </div>
        </div>

        @if($file->description)
            <div class="mb-10 w-full max-w-md relative group">
                <!-- Aesthetic Note Card -->
                <div class="absolute -inset-1 bg-gradient-to-r from-spink/20 to-sorange/20 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                <div class="relative bg-white/60 backdrop-blur-md border-2 border-white/80 rounded-3xl p-6 shadow-lg transform rotate-1 hover:rotate-0 transition-transform duration-300">
                    <div class="absolute top-0 right-0 w-12 h-12 bg-dark/5 -rotate-45 translate-x-6 -translate-y-6"></div>
                    <p class="text-[10px] font-black text-dark/40 uppercase tracking-widest mb-3 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Catatan Pengirim
                    </p>
                    <div class="text-dark/90 text-sm font-semibold leading-relaxed text-left whitespace-pre-wrap italic font-sans">
                        "{{ $file->description }}"
                    </div>
                </div>
            </div>
        @endif

        <div
            class="flex flex-wrap items-center justify-center gap-6 mb-12 bg-white/30 backdrop-blur-sm px-8 py-4 rounded-full border border-white/40 shadow-sm">
            <div class="text-center">
                <p class="text-[10px] font-black text-dark/50 uppercase tracking-widest mb-1">Status</p>
                <p class="text-xl font-bold text-dark">Udah diunduh <span
                        class="font-caveat text-3xl ml-1">{{ $file->download_count }}x</span></p>
            </div>

            @if($file->expires_at)
                <div class="w-px h-10 bg-dark/10 hidden sm:block"></div>
                <div class="text-center">
                    <p class="text-[10px] font-black text-dark/50 uppercase tracking-widest mb-1">Batas Waktu</p>
                    <p class="text-xl font-bold text-dark">Sampai <span
                            class="font-caveat text-3xl ml-1 text-[#D80073]">{{ $file->expires_at->format('d M Y, H:i') }}</span>
                    </p>
                </div>
            @endif
        </div>

        <div>
            <a href="{{ route('file.download', $file->token) }}"
                class="inline-flex items-center justify-center bg-dark text-white rounded-full px-10 py-4 text-xl font-black overflow-hidden smooth-hover hover:-translate-y-1 hover:shadow-[0_15px_30px_-10px_rgba(0,0,0,0.4)] active:scale-95">
                Download Sekarang
            </a>
        </div>
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