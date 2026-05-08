<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KirimApaBae — Pantauan Atmin</title>
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
            background: linear-gradient(135deg, #0a0a0a 0%, #1f1f1f 100%);
            color: #ffffff;
            min-height: 100vh;
        }

        .smooth-hover {
            transition: all 0.3s ease;
        }

        .soft-card {
            box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.5);
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        th {
            background: rgba(255, 255, 255, 0.05);
            color: #9CA3AF;
            padding: 16px 24px;
            text-transform: uppercase;
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        td {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            font-weight: 600;
            font-size: 0.95rem;
            color: #D1D5DB;
        }

        tr:hover td {
            background-color: rgba(255, 255, 255, 0.02);
        }

        tr:last-child td {
            border-bottom: none;
        }

        .pagination-wrap nav div {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }

        .pagination-wrap p {
            font-size: 0.875rem;
            color: #9CA3AF;
            text-align: center;
            margin-top: 10px;
        }

        .pagination-wrap a,
        .pagination-wrap span[aria-current] {
            padding: 8px 16px;
            font-weight: 700;
            border-radius: 99px;
            text-decoration: none;
            color: #D1D5DB;
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.2s;
            font-size: 0.875rem;
        }

        .pagination-wrap a:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }

        .pagination-wrap span[aria-current] {
            background: #ffffff;
            color: #111111;
        }

        .pagination-wrap svg {
            width: 16px;
            height: 16px;
        }
    </style>
</head>

<body class="p-6 lg:p-12 font-sans selection:bg-white selection:text-dark">

    <div class="max-w-6xl mx-auto flex flex-col items-center">

        <div class="flex flex-col items-center mb-10 pb-8 border-b border-white/10 gap-6 w-full text-center">
            <div class="flex flex-col items-center justify-center gap-1">
                <span class="font-sans font-black text-sm tracking-widest text-white/50 uppercase mb-1">atmin nya</span>
                <div
                    class="flex flex-wrap items-center justify-center gap-1 font-caveat text-4xl lg:text-5xl tracking-tight drop-shadow-sm mb-3">
                    <span class="text-white">Kirim</span>
                    <span
                        class="inline-block -rotate-6 bg-[#FFE700] text-dark px-3 py-1 rounded-2xl border-4 border-dark shadow-[4px_4px_0_#111]">Apa</span>
                    <span
                        class="inline-block rotate-3 bg-[#00E5FF] text-dark px-3 py-1 rounded-2xl border-4 border-dark shadow-[4px_4px_0_#111]">Bae</span>
                </div>
                <p class="text-white/40 font-bold text-sm">Lagi ngecek siapa aja yang numpang server kita hari ini.</p>
            </div>

            <div class="flex gap-4 mt-2 flex-wrap justify-center">
                <a href="/"
                    class="text-sm font-bold bg-white/10 backdrop-blur-sm border border-white/20 px-6 py-3 rounded-full hover:bg-white/20 smooth-hover text-white">
                    Beranda
                </a>
                <form action="{{ route('admin.delete.all') }}" method="POST"
                    onsubmit="event.preventDefault(); showConfirmAll(this);">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="text-sm font-bold bg-orange-500/20 text-orange-400 border border-orange-500/30 px-6 py-3 rounded-full hover:bg-orange-500/40 smooth-hover">
                        🗑 Hapus Semua File
                    </button>
                </form>
                <a href="?force_logout=1"
                    class="text-sm font-bold bg-red-500/20 text-red-400 border border-red-500/30 px-6 py-3 rounded-full hover:bg-red-500/40 smooth-hover">
                    Logout Atmin
                </a>
            </div>
        </div>

        @if(session('deleted'))
            <div
                class="bg-emerald-500/20 border border-emerald-500/30 px-6 py-4 rounded-2xl font-bold text-emerald-400 mb-8 inline-block text-center shadow-sm">
                Beres! {{ session('deleted') }}
            </div>
        @endif

        <div
            class="bg-white/5 backdrop-blur-md rounded-[2rem] soft-card overflow-hidden mb-10 border border-white/10 w-full">
            <div class="overflow-x-auto">
                <table>
                    <thead>
                        <tr>
                            <th>Waktu (WIB)</th>
                            <th>Nama File</th>
                            <th>Status / Aksi</th>
                            <th>IP Addr</th>
                            <th>Eksekusi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td class="whitespace-nowrap text-white/50 text-sm">
                                    {{ $log->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="text-indigo-400 font-black break-all max-w-xs">
                                    {{ $log->file->original_name ?? '— (Udah ilang)' }}
                                </td>
                                <td>
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider {{ $log->action == 'uploaded' ? 'bg-emerald-500/20 text-emerald-400' : ($log->action == 'downloaded' ? 'bg-blue-500/20 text-blue-400' : 'bg-white/10 text-white/60') }}">
                                        {{ $log->action }}
                                    </span>
                                </td>
                                <td class="font-mono text-sm text-white/40 font-bold">{{ $log->ip_address }}</td>
                                <td>
                                    @if($log->file && $log->action == 'uploaded')
                                        <form action="{{ route('admin.delete', $log->file->id) }}" method="POST"
                                            onsubmit="event.preventDefault(); showConfirm(this);">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-400 hover:text-white font-bold text-sm bg-red-500/20 hover:bg-red-500/60 px-4 py-2 rounded-full smooth-hover transition-colors border border-red-500/30">
                                                Takedown
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-white/20 text-sm font-bold italic">N/A</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="pagination-wrap w-full flex justify-center flex-col items-center">
            {{ $logs->links() }}
        </div>

    </div>

    <!-- Modal Hapus Satu -->
    <div id="confirmModal"
        class="fixed inset-0 bg-black/80 backdrop-blur-sm hidden items-center justify-center z-50 transition-opacity duration-300 opacity-0">
        <div class="bg-[#1a1a1a] border border-white/10 rounded-[2rem] p-8 max-w-sm w-full mx-4 soft-card transform scale-95 transition-all duration-300 opacity-0"
            id="confirmModalContent">
            <div class="text-center">
                <div
                    class="w-16 h-16 bg-red-500/20 text-red-400 rounded-full flex items-center justify-center mx-auto mb-4 border border-red-500/30">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-white mb-2">Yakin nih ngapus?</h3>
                <p class="text-white/60 text-sm font-bold mb-6">File yang di-takedown bakal musnah dari server lho.</p>
                <div class="flex gap-3 justify-center">
                    <button type="button" onclick="closeModal('confirm')"
                        class="px-6 py-3 bg-white/10 hover:bg-white/20 text-white font-black text-sm rounded-full transition-colors border border-white/10">Batal</button>
                    <button type="button" id="confirmBtn"
                        class="px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-black text-sm rounded-full transition-colors soft-card shadow-lg shadow-red-500/20">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Semua -->
    <div id="confirmAllModal"
        class="fixed inset-0 bg-black/80 backdrop-blur-sm hidden items-center justify-center z-50 transition-opacity duration-300 opacity-0">
        <div class="bg-[#1a1a1a] border border-white/10 rounded-[2rem] p-8 max-w-sm w-full mx-4 soft-card transform scale-95 transition-all duration-300 opacity-0"
            id="confirmAllModalContent">
            <div class="text-center">
                <div
                    class="w-16 h-16 bg-orange-500/20 text-orange-400 rounded-full flex items-center justify-center mx-auto mb-4 border border-orange-500/30">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                </div>
                <h3 class="text-2xl font-black text-white mb-2">Hapus SEMUA file?</h3>
                <p class="text-white/60 text-sm font-bold mb-6">Semua file di server bakal lenyap selamanya. Ga bisa
                    di-undo.</p>
                <div class="flex gap-3 justify-center">
                    <button type="button" onclick="closeModal('all')"
                        class="px-6 py-3 bg-white/10 hover:bg-white/20 text-white font-black text-sm rounded-full transition-colors border border-white/10">Batal</button>
                    <button type="button" id="confirmAllBtn"
                        class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-black text-sm rounded-full transition-colors soft-card shadow-lg shadow-orange-500/20">Hapus
                        Semua</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        @if(session('just_logged_in'))
            sessionStorage.setItem('admin_tab_active', 'true');
        @endif

        if (!sessionStorage.getItem('admin_tab_active')) {
            window.location.href = '?force_logout=1';
        }

        let formToSubmit = null;
        let formAllToSubmit = null;

        function showConfirm(form) {
            formToSubmit = form;
            openModal('confirm');
        }

        function showConfirmAll(form) {
            formAllToSubmit = form;
            openModal('all');
        }

        function openModal(type) {
            const modal = document.getElementById(type === 'all' ? 'confirmAllModal' : 'confirmModal');
            const content = document.getElementById(type === 'all' ? 'confirmAllModalContent' : 'confirmModalContent');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            void modal.offsetWidth;
            modal.classList.remove('opacity-0');
            modal.classList.add('opacity-100');
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }

        function closeModal(type) {
            const modal = document.getElementById(type === 'all' ? 'confirmAllModal' : 'confirmModal');
            const content = document.getElementById(type === 'all' ? 'confirmAllModalContent' : 'confirmModalContent');
            modal.classList.remove('opacity-100');
            modal.classList.add('opacity-0');
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }, 300);
        }

        document.getElementById('confirmBtn').addEventListener('click', function () {
            if (formToSubmit) formToSubmit.submit();
        });

        document.getElementById('confirmAllBtn').addEventListener('click', function () {
            if (formAllToSubmit) formAllToSubmit.submit();
        });
    </script>
</body>

</html>