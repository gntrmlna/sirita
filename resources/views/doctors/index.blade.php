@extends('layouts.app')

@section('content')

<div class="p-6 max-w-4xl">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">Data Dokter</h1>
            <p class="text-sm text-gray-500">Kelola data dokter</p>
        </div>

        <a href="{{ route('doctors.create') }}"
           class="bg-[#1F7A4D] hover:bg-[#16603c] text-white px-4 py-2 rounded-lg flex items-center gap-2 text-sm">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah
        </a>
    </div>

    <!-- TABLE CARD -->
    <div class="bg-white rounded-xl shadow-sm border">

        <table class="w-full text-sm table-fixed">

            <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide">
                <tr>
                    <th class="text-left px-4 py-3 w-1/3">Nama</th>
                    <th class="text-left px-4 py-3 w-1/2">Email / Username</th>
                    <th class="text-center px-4 py-3 w-24">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($doctors as $doc)
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-4 py-3 font-medium text-gray-800">
                        {{ $doc->user->name }}
                    </td>

                    <td class="px-4 py-3 text-gray-600 truncate">
                        {{ $doc->user->email ?? '-' }}
                    </td>

                    <td class="px-4 py-3">
                        <div class="flex justify-center gap-3">

                            <a href="{{ route('doctors.edit', $doc->id) }}"
                               class="text-yellow-600 hover:text-yellow-700">
                                <i data-lucide="pencil" class="w-4 h-4"></i>
                            </a>

                            <form action="{{ route('doctors.destroy', $doc->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus dokter ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:text-red-700">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-6 text-gray-500">
                        Belum ada data dokter
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>

@endsection