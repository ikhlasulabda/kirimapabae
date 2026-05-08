<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KirimApaBae — Upload File Lu</title>
    <meta property="og:title" content="KirimApaBae — Upload File Lu" />
    <meta property="og:description" content="Asli inimah gak ribet. Tinggal drop, upload, share linknya, kelar dah." />
    <meta property="og:image" content="{{ asset('og-image.png') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Caveat+Brush&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        caveat: ['"Caveat Brush"', 'cursive'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        dark: '#111111',
                        spink: '#FF99AC',
                        sorange: '#FFBD98',
                        sblue: '#A2D2FF',
                    }
                }
            }
        }
    </script>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        body {
            background: linear-gradient(135deg, #FF99AC 0%, #FFBD98 100%);
            color: #111111;
            min-height: 100vh;
        }

        .smooth-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .soft-focus:focus-within {
            box-shadow: 0 0 0 4px rgba(17, 17, 17, 0.1);
            border-color: #111111;
        }
    </style>
</head>

<body
    class="min-h-screen flex flex-col items-center justify-center font-sans selection:bg-white selection:text-dark px-4 py-8">

    <section class="w-full max-w-xl text-center flex-shrink-0 mb-8 pt-4">

        <div class="mb-4 flex flex-col items-center justify-center gap-2">
            <div
                class="flex flex-wrap items-center justify-center gap-1 font-caveat text-6xl lg:text-7xl tracking-tight drop-shadow-sm">
                <span class="text-dark">Kirim</span>
                <span
                    class="inline-block -rotate-6 bg-[#FFE700] text-dark px-3 py-1 rounded-2xl border-4 border-dark shadow-[4px_4px_0_#111]">Apa</span>
                <span
                    class="inline-block rotate-3 bg-[#00E5FF] text-dark px-3 py-1 rounded-2xl border-4 border-dark shadow-[4px_4px_0_#111]">Bae</span>
            </div>
            <span class="font-sans font-black text-sm tracking-widest text-dark/70">
                by Abda
            </span>
        </div>

        <p class="font-sans text-base text-dark/80 mb-6">
            Asli inimah gak ribet. Tinggal drop, upload, share linknya, kelar dah.
        </p>

        <h1 class="font-caveat text-5xl lg:text-6xl tracking-tight text-dark mb-4">
            Kirim file lu <span class="underline decoration-wavy decoration-white/60">di sini.</span>
        </h1>
    </section>

    <section class="w-full max-w-xl z-10 pb-12">
        @if($errors->any())
            <div
                class="mb-8 bg-white/90 backdrop-blur border-l-8 border-red-500 rounded-2xl p-5 text-dark font-medium shadow-xl text-left">
                <p class="font-caveat text-2xl mb-2 text-red-600">Eh, bentaran...</p>
                <ul class="list-disc list-inside opacity-80 text-sm">
                    @foreach($errors->all() as $error)
                        @if(str_contains($error, 'password field must be at least 4 characters'))
                            <li>password minimal 4 karakter yaaa</li>
                        @else
                            <li>{{ $error }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('file.upload') }}" method="POST" enctype="multipart/form-data"
            class="flex flex-col gap-8 text-center">
            @csrf

            <div class="flex flex-col gap-2 items-center">
                <label class="font-caveat text-3xl tracking-wide text-dark">Pilih filenya</label>
                <div id="dropZone"
                    class="relative w-full bg-white/40 backdrop-blur-sm border-4 border-dashed border-dark/30 rounded-[2rem] p-10 text-center smooth-hover hover:bg-white/60 hover:border-dark hover:scale-[1.02] cursor-pointer group shadow-lg">
                    <input type="file" name="file" required id="fileInput"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">
                    <div class="pointer-events-none flex flex-col items-center justify-center text-dark">
                        <span id="dropText" class="font-caveat text-3xl group-hover:scale-105 smooth-hover">Klik
                            atau Drop di mari</span>
                        <span id="dropSub" class="font-bold text-sm mt-2 opacity-60">Maksimal 50MB ye mpruy!</span>
                        <span id="fileName"
                            class="font-black text-lg mt-3 hidden bg-dark text-white py-1.5 px-5 rounded-full shadow-lg break-all max-w-[90%]"></span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-2 items-center">
                <label class="font-caveat text-3xl tracking-wide text-dark">Kasih password gak? (Biar aman)</label>
                <div
                    class="w-full bg-white/40 backdrop-blur-sm border-2 border-transparent rounded-[1.5rem] p-1.5 soft-focus smooth-hover hover:bg-white/60 shadow-md">
                    <input type="password" name="password" placeholder="Kosongin kalo gak mau ribet..."
                        class="w-full bg-transparent p-3 text-base font-bold outline-none placeholder:text-dark/40 text-dark text-center">
                </div>
            </div>

            <div class="flex flex-col gap-2 items-center">
                <label class="font-caveat text-3xl tracking-wide text-dark">Kapan expired nya enih?</label>
                <div
                    class="w-full bg-white/40 backdrop-blur-sm border-2 border-transparent rounded-[1.5rem] p-1.5 soft-focus smooth-hover hover:bg-white/60 shadow-md">
                    <input type="datetime-local" name="expires_at"
                        class="w-full bg-transparent p-3 text-base font-bold outline-none text-dark text-center">
                </div>
                <p class="text-xs font-bold text-dark/60 mt-1">Kalo kosong berarti file lu abadi nan jaya (selama disk
                    gak penuh).</p>
            </div>

            <div class="pt-4">
                <button type="submit"
                    class="group relative inline-flex items-center justify-center bg-dark text-white rounded-full px-10 py-4 text-xl font-black overflow-hidden smooth-hover hover:shadow-[0_15px_30px_-10px_rgba(0,0,0,0.4)] hover:-translate-y-1 active:scale-95">
                    <span class="relative z-10 flex items-center gap-2">
                        UPLOAD FILE
                    </span>
                </button>
            </div>
        </form>
    </section>

    <script>
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('fileInput');
        const fileName = document.getElementById('fileName');
        const dropText = document.getElementById('dropText');
        const dropSub = document.getElementById('dropSub');

        function showCustomError(msg) {
            const existingError = document.getElementById('js-error-box');
            if (existingError) existingError.remove();

            const errorHtml = `
                <div id="js-error-box" class="mb-8 bg-white/90 backdrop-blur border-l-8 border-red-500 rounded-2xl p-5 text-dark font-medium shadow-xl text-left">
                    <p class="font-caveat text-2xl mb-2 text-red-600">Eh, bentaran...</p>
                    <ul class="list-disc list-inside opacity-80 text-sm">
                        <li>${msg}</li>
                    </ul>
                </div>
            `;
            const form = document.querySelector('form');
            form.insertAdjacentHTML('beforebegin', errorHtml);
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function showFileName(name) {
            fileName.textContent = name;
            fileName.classList.remove('hidden');
            dropText.textContent = 'Gokil, file siap terbang!';
            dropSub.textContent = 'Klik lagi buat ganti file.';
            dropZone.classList.add('bg-white/80', 'border-solid');
            dropZone.classList.remove('border-dashed', 'border-dark/30');
            dropZone.classList.add('border-dark');

            const existingError = document.getElementById('js-error-box');
            if (existingError) existingError.remove();
        }

        fileInput.addEventListener('change', function () {
            if (this.files.length > 0) showFileName(this.files[0].name);
        });

        ['dragover', 'dragenter'].forEach(evt => {
            dropZone.addEventListener(evt, e => {
                e.preventDefault(); e.stopPropagation();
                dropZone.classList.add('scale-[1.02]', 'bg-white/80', 'border-solid', 'border-dark');
                dropZone.classList.remove('border-dashed', 'border-dark/30');
            });
        });

        dropZone.addEventListener('dragleave', e => {
            e.preventDefault(); e.stopPropagation();
            dropZone.classList.remove('scale-[1.02]');
            if (!fileInput.files.length) {
                dropZone.classList.remove('bg-white/80', 'border-solid', 'border-dark');
                dropZone.classList.add('border-dashed', 'border-dark/30');
            }
        });

        dropZone.addEventListener('drop', function (e) {
            e.preventDefault(); e.stopPropagation();
            dropZone.classList.remove('scale-[1.02]');

            if (e.dataTransfer.items && e.dataTransfer.items.length > 0) {
                const item = e.dataTransfer.items[0].webkitGetAsEntry();
                if (item && item.isDirectory) {
                    showCustomError('Kalo lu mau upload folder, dijadiin .zip dulu ya ngab! Jangan mentahan folder gitu.');
                    if (!fileInput.files.length) {
                        dropZone.classList.remove('bg-white/80', 'border-solid', 'border-dark');
                        dropZone.classList.add('border-dashed', 'border-dark/30');
                    }
                    return;
                }
            }

            if (e.dataTransfer.files.length > 0) {
                fileInput.files = e.dataTransfer.files;
                showFileName(e.dataTransfer.files[0].name);
            } else if (!fileInput.files.length) {
                dropZone.classList.remove('bg-white/80', 'border-solid', 'border-dark');
                dropZone.classList.add('border-dashed', 'border-dark/30');
            }
        });

        document.querySelector('form').addEventListener('submit', function (e) {
            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                if (!file.name.includes('.')) {
                    e.preventDefault();
                    showCustomError('Kalo lu mau upload folder, dijadiin .zip dulu ya ngab! Jangan mentahan folder gitu.');
                    return;
                }

                const ext = file.name.split('.').pop().toLowerCase();
                const exploitExts = ['php', 'sh', 'bat', 'ps1'];
                if (exploitExts.includes(ext)) {
                    e.preventDefault();
                    showCustomError(`Waduh, si bro dengan file .${ext} mau mencoba exploit lohh ya 😹😱 .`);
                    return;
                }
            }
        });
    </script>
</body>

</html>