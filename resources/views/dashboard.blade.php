@extends('layouts.app')

@section('content')

<div class="p-6">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-500 text-sm">
            Selamat datang, {{ auth()->user()->name }}
        </p>
    </div>

    <!-- STATS -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

        <!-- Total Pasien -->
        <div class="bg-white p-5 rounded-xl shadow-sm border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Pasien</p>
                    <h2 class="text-2xl font-bold text-gray-800">
                        {{ $totalPatients }}
                    </h2>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i data-lucide="users" class="w-5 h-5 text-green-600"></i>
                </div>
            </div>
        </div>

        <!-- Total Rekam Medis -->
        <div class="bg-white p-5 rounded-xl shadow-sm border">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Rekam Medis</p>
                    <h2 class="text-2xl font-bold text-gray-800">
                        {{ $totalRecords }}
                    </h2>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <i data-lucide="file-text" class="w-5 h-5 text-blue-600"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- FILTER -->
    <div class="bg-white p-5 rounded-xl shadow-sm border mb-6">

        <form method="GET" class="flex flex-wrap gap-4 items-end">

            <!-- BULAN -->
            <div>
                <label class="text-xs text-gray-500">Bulan</label>
                <input type="month" name="month"
                    value="{{ request('month') }}"
                    class="border rounded px-3 py-2 w-full">
            </div>

            <!-- DOKTER -->
            <div>
                <label class="text-xs text-gray-500">Dokter</label>
                <select name="doctor_id" class="border rounded px-3 py-2 pr-10">
                    <option value="">Semua</option>
                    @foreach($doctors as $doc)
                        <option value="{{ $doc->id }}"
                            {{ request('doctor_id') == $doc->id ? 'selected' : '' }}>
                            {{ $doc->user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="bg-[#1F7A4D] hover:bg-[#16603c] text-white px-4 py-2 rounded">
                Filter
            </button>

        </form>

        @if(request('month') || request('doctor_id'))
            <p class="text-xs text-gray-500 mt-3">
                Filter aktif:
                {{ request('month') ?? 'Semua Bulan' }} -
                {{ optional($doctors->find(request('doctor_id')))->user->name ?? 'Semua Dokter' }}
            </p>
        @endif

    </div>

    <!-- CHART -->
    <div class="bg-white p-6 rounded-xl shadow-sm border">

        <h2 class="text-lg font-semibold text-gray-700 mb-4">
            Distribusi Penyakit
        </h2>

        <div class="flex justify-center">
            <div class="w-64 h-64">
                <canvas id="diseaseChart"></canvas>
            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const labels = @json($diseaseStats->pluck('name'));
    const data = @json($diseaseStats->pluck('total'));

    const ctx = document.getElementById('diseaseChart');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: [
                    '#ef4444',
                    '#3b82f6'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

});
</script>

@endsection