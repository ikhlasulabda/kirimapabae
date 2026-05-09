<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KirimApaBae — Mantap Udah Masuk</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Caveat+Brush&family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/ushelp/EasyQRCodeJS@master/dist/easy.qrcode.min.js"></script>
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
            background: linear-gradient(135deg, #FF99AC 0%, #FFBD98 100%);
            color: #111111;
            min-height: 100vh;
        }

        .smooth-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Trik HD: Biarkan canvas full mengisi wadah tanpa melebihi batas, dan set sudut jadi kotak tajam */
        #qrcode canvas,
        #qrcode img {
            max-width: 100% !important;
            height: auto !important;
            border-radius: 0 !important;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col font-sans selection:bg-white selection:text-dark">

    <main
        class="flex-grow flex flex-col items-center justify-center w-full max-w-xl mx-auto px-6 pt-12 pb-4 text-center z-10">

        <!-- Header text -->
        <div class="mb-2 flex flex-col items-center justify-center">
            <h1 class="font-caveat text-7xl md:text-8xl tracking-tight text-dark drop-shadow-sm mb-2">
                MANTAPP!!
            </h1>
            <p class="font-sans text-base md:text-lg text-dark/80 font-medium">
                File lu udah aman di server. Tinggal bagiin dah tu linknya!
            </p>
        </div>

        <!-- Spacer -->
        <div class="h-10 md:h-12"></div>

        <p class="font-caveat text-3xl tracking-wide text-dark mb-4 opacity-90">Ini link nya:</p>

        <!-- Link Display: Aesthetic Glassmorphism -->
        <div
            class="w-full bg-white/30 backdrop-blur-md border border-white/50 rounded-full px-6 py-4 shadow-[0_8px_30px_rgb(0,0,0,0.04)] mb-2 group transition-all hover:bg-white/40">
            <div class="overflow-x-auto hide-scrollbar">
                <p class="font-black text-lg text-dark whitespace-nowrap" id="shareLink">
                    {{ $link }}
                </p>
            </div>
        </div>

        <p id="copiedMsg" class="h-6 text-sm font-bold text-green-700 opacity-0 transition-opacity duration-300 mb-6">
            ✔️ Link berhasil dicopy!
        </p>

        <!-- QR Code Section: Aesthetic Frame (Sudut Tajam / Kotak) -->
        <div class="mb-10 flex flex-col items-center">
            <!-- Glass Wrapper - Hapus rounded -->
            <div
                class="bg-white/30 backdrop-blur-md border border-white/50 p-4 shadow-[0_8px_30px_rgb(0,0,0,0.06)] group hover:bg-white/40 transition-all smooth-hover hover:-translate-y-1">
                <!-- Inner Solid White Wrapper - Hapus rounded -->
                <div class="bg-white p-3 shadow-sm">
                    <div id="qrcode" class="w-[140px] h-[140px] flex items-center justify-center">
                        <!-- QR Code will be rendered here -->
                    </div>
                </div>
            </div>
            <p class="font-caveat text-2xl text-dark/70 mt-4 tracking-wide">Scan buat download!</p>
        </div>

        <!-- Tombol Action (Cool & Sleek) -->
        <div class="flex flex-col sm:flex-row gap-4 w-full justify-center">
            <button onclick="copyLink()"
                class="flex-1 flex items-center justify-center gap-3 bg-dark text-white rounded-full px-8 py-4 text-sm font-black tracking-widest uppercase smooth-hover hover:-translate-y-1 hover:shadow-[0_15px_30px_-10px_rgba(17,17,17,0.5)] hover:bg-dark/90 active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                    </path>
                </svg>
                COPY LINK
            </button>

            <a href="https://wa.me/?text={{ urlencode('Akses file disini:' . "\n" . $link) }}" target="_blank"
                class="flex-1 flex items-center justify-center gap-3 bg-[#25D366] text-white rounded-full px-8 py-4 text-sm font-black tracking-widest uppercase smooth-hover hover:-translate-y-1 hover:shadow-[0_15px_30px_-10px_rgba(37,211,102,0.5)] hover:bg-[#20b858] active:scale-95">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.347-.272.273-1.04 1.015-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z" />
                </svg>
                SHARE KE WA
            </a>
        </div>

        <div class="mt-12">
            <a href="/"
                class="group inline-flex items-center gap-2 text-sm font-bold text-dark/50 hover:text-dark uppercase tracking-widest smooth-hover">
                <span class="transition-transform group-hover:-translate-x-2 text-lg leading-none">←</span>
                Upload File Lain
            </a>
        </div>
    </main>

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

    <script>
        // QR Code Generation
        const link = "{{ $link }}";
        const qrcodeContainer = document.getElementById("qrcode");

        new QRCode(qrcodeContainer, {
            text: link,
            width: 512,  // Set ke ukuran besar (HD) buat dapet resolusi tajam
            height: 512, // Tinggi dan lebar resolusi tinggi
            colorDark: "#111111",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.M,
            quietZone: 0,
            dotScale: 1
        });

        function copyLink() {
            const linkText = document.getElementById('shareLink').innerText.trim();
            navigator.clipboard.writeText(linkText).then(() => {
                const msg = document.getElementById('copiedMsg');
                msg.classList.remove('opacity-0');
                msg.classList.add('opacity-100');
                setTimeout(() => {
                    msg.classList.remove('opacity-100');
                    msg.classList.add('opacity-0');
                }, 3000);
            });
        }
    </script>
</body>

</html>