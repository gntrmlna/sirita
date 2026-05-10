<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SIRITA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/sirita.webp') }}">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <div id="sidebar"
        class="fixed md:static z-40 w-64 min-h-screen bg-[#0F2E1E] text-white p-4
        transform -translate-x-full md:translate-x-0 transition duration-200">

        <!-- LOGO -->
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('images/sirita.webp') }}" class="w-20 h-20">
            <span class="font-bold text-lg">SIRITA</span>
        </div>

        <!-- NAV -->
        <nav class="space-y-2 text-sm">

            <!-- Dashboard -->
            <a href="/dashboard" 
               class="flex items-center gap-2 px-3 py-2 rounded transition
               {{ request()->is('dashboard') ? 'bg-[#1F7A4D]' : 'hover:bg-[#1F7A4D]' }}">
                <i data-lucide="home" class="w-4 h-4"></i>
                Dashboard
            </a>

            @if(auth()->user()->role === 'super_user')
            <!-- Dokter -->
            <a href="{{ route('doctors.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded transition
               {{ request()->is('doctors*') ? 'bg-[#1F7A4D]' : 'hover:bg-[#1F7A4D]' }}">
                <i data-lucide="stethoscope" class="w-4 h-4"></i>
                Dokter
            </a>
            @endif

            <!-- Pasien -->
            <a href="/patients" 
               class="flex items-center gap-2 px-3 py-2 rounded transition
               {{ request()->is('patients*') ? 'bg-[#1F7A4D]' : 'hover:bg-[#1F7A4D]' }}">
                <i data-lucide="users" class="w-4 h-4"></i>
                Pasien
            </a>

            @if(auth()->user()->role === 'super_user')
            <!-- Laporan -->
            <a href="/reports" 
               class="flex items-center gap-2 px-3 py-2 rounded transition
               {{ request()->is('reports*') ? 'bg-[#1F7A4D]' : 'hover:bg-[#1F7A4D]' }}">
                <i data-lucide="bar-chart-3" class="w-4 h-4"></i>
                Laporan
            </a>
            @endif

             @if(auth()->user()->role === 'super_user')
            <a href="{{ route('activity.logs') }}"
            class="flex items-center gap-2 px-3 py-2 rounded transition
            {{ request()->is('activity-logs*') ? 'bg-[#1F7A4D]' : 'hover:bg-[#1F7A4D]' }}">
                <i data-lucide="history" class="w-4 h-4"></i>
                Activity Log
            </a>
            @endif

        </nav>

    </div>

    <!-- OVERLAY (MOBILE) -->
    <div id="overlay"
        class="fixed inset-0 bg-black/40 hidden z-30 md:hidden"
        onclick="toggleSidebar()"></div>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col">

        <!-- TOPBAR -->
        <div class="bg-white shadow p-4 flex justify-between items-center">

            <!-- HAMBURGER -->
            <button onclick="toggleSidebar()" class="md:hidden text-xl">
                ☰
            </button>

            <div></div>

            <!-- USER -->
            <div class="text-sm">
                {{ auth()->user()->name }}

                <form action="/logout" method="POST" class="inline">
                    @csrf
                    <button class="ml-2 text-red-500 hover:underline">
                        Logout
                    </button>
                </form>
            </div>

        </div>

        <!-- CONTENT -->
        <div class="p-4 md:p-6">
            @yield('content')
        </div>

    </div>

</div>

@stack('scripts')

<!-- ICON -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>

<!-- SIDEBAR TOGGLE -->
<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
}
</script>

</body>
</html>