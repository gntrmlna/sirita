@extends('layouts.app')

@section('content')

<div class="p-6 space-y-6">

    <!-- HEADER -->
    <div>
        <h1 class="text-2xl font-semibold text-gray-800">Activity Log</h1>
        <p class="text-sm text-gray-500">Riwayat aktivitas pengguna</p>
    </div>

    <!-- FILTER -->
    <div class="bg-white p-4 rounded-xl border">
        <form method="GET" class="flex flex-col md:flex-row gap-2 w-full items-start md:items-center">

            <input type="date" name="date"
                value="{{ request('date') }}"
                class="border rounded-lg px-3 py-2 w-full md:w-auto">

            <input type="month" name="month"
                value="{{ request('month') }}"
                class="border rounded-lg px-3 py-2 w-full md:w-auto">

            <button class="bg-[#1F7A4D] text-white px-4 py-2 rounded-lg w-full md:w-auto">
                Filter
            </button>

        </form>
    </div>

    <!-- MOBILE: CARD VIEW -->
    <div class="space-y-3 md:hidden">

        @forelse($logs as $log)
        <div class="bg-white border rounded-xl p-4 shadow-sm hover:shadow-md transition space-y-2">

            <div class="flex justify-between items-start">
                <div>
                    <div class="text-sm font-medium text-gray-800">
                        {{ $log->user->name ?? '-' }}
                    </div>
                    <div class="text-xs text-gray-400">
                        {{ $log->created_at->format('d M Y H:i') }}
                    </div>
                </div>

                <span class="px-2 py-1 text-xs rounded text-white
                    {{ $log->action == 'create' ? 'bg-green-500' : '' }}
                    {{ $log->action == 'update' ? 'bg-yellow-500' : '' }}
                    {{ $log->action == 'delete' ? 'bg-red-500' : '' }}">
                    {{ strtoupper($log->action) }}
                </span>
            </div>

            <div class="text-sm text-gray-600">
                <span class="font-medium text-gray-700">Modul:</span>
                {{ ucfirst($log->module) }}
            </div>

            <div class="text-sm text-gray-600">
                {{ $log->description }}
            </div>

            <div class="text-xs text-gray-400">
                {{ $log->created_at->diffForHumans() }}
            </div>

        </div>

        @empty
        <div class="text-center py-6 text-gray-500">
            Tidak ada aktivitas
        </div>
        @endforelse

    </div>

    <!-- DESKTOP: TABLE -->
    <div class="bg-white rounded-xl border overflow-x-auto hidden md:block">

        <table class="w-full text-sm">

            <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide">
                <tr>
                    <th class="px-4 py-3 text-left">Waktu</th>
                    <th class="px-4 py-3 text-left">User</th>
                    <th class="px-4 py-3 text-left">Aksi</th>
                    <th class="px-4 py-3 text-left">Modul</th>
                    <th class="px-4 py-3 text-left">Deskripsi</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                @forelse($logs as $log)
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-4 py-3 text-gray-600">
                        {{ $log->created_at->format('d M Y H:i') }}
                        <div class="text-xs text-gray-400">
                            {{ $log->created_at->diffForHumans() }}
                        </div>
                    </td>

                    <td class="px-4 py-3">
                        {{ $log->user->name ?? '-' }}
                    </td>

                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-xs rounded text-white
                            {{ $log->action == 'create' ? 'bg-green-500' : '' }}
                            {{ $log->action == 'update' ? 'bg-yellow-500' : '' }}
                            {{ $log->action == 'delete' ? 'bg-red-500' : '' }}">
                            {{ strtoupper($log->action) }}
                        </span>
                    </td>

                    <td class="px-4 py-3">
                        {{ ucfirst($log->module) }}
                    </td>

                    <td class="px-4 py-3 text-gray-600">
                        {{ $log->description }}
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="5" class="text-center py-6 text-gray-500">
                        Tidak ada aktivitas
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->
    <div>
        {{ $logs->links() }}
    </div>

</div>

@endsection