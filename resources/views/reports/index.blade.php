@extends('layouts.app')

@section('content')
 

<div class="p-6 space-y-6">

    <!-- HEADER -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Generate Laporan Harian</h1>
        <p class="text-sm text-gray-500">Buat laporan pemeriksaan harian</p>
    </div>

    <!-- FORM CARD -->
    <div class="bg-white p-6 rounded-xl shadow-sm border max-w-3xl">

        <form method="POST" action="{{ route('reports.generate') }}" target="_blank" class="space-y-6">
            @csrf

            <!-- TANGGAL -->
            <div>
                <label class="block text-sm text-gray-600 mb-1">Tanggal</label>
                <input type="date" name="tanggal"
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]" required>
            </div>

            <!-- KETUA TIM -->
            <div class="bg-gray-50 p-4 rounded-lg space-y-3">
                <h2 class="text-sm font-semibold text-gray-700 uppercase">Ketua Tim</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

                    <input type="text" name="ketua_nama"
                        placeholder="Nama"
                        class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]" required>

                    <input type="text" name="ketua_jabatan"
                        placeholder="Jabatan"
                        class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]" required>

                    <select name="ketua_identity_type"
                        class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]"
                        required>

                        <option value="NIP">NIP</option>
                        <option value="NRP">NRP</option>

                    </select>

                    <input type="text" name="ketua_identity_number"
                        placeholder="Nomor Identitas"
                        class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]"
                        required>

                </div>
            </div>

            <!-- ANGGOTA -->
            <div class="space-y-3">

                <div class="flex justify-between items-center">
                    <h2 class="text-sm font-semibold text-gray-700 uppercase">Anggota Tim</h2>

                    <button type="button" onclick="addAnggota()"
                        class="text-sm bg-[#1F7A4D] hover:bg-[#16603c] text-white px-3 py-1 rounded-lg">
                        + Tambah
                    </button>
                </div>

                <div id="anggotaWrapper" class="space-y-3">

                    <div class="grid grid-cols-1 md:grid-cols-5 gap-2 anggota-item">

                        <input type="text" name="anggota_nama[]"
                            placeholder="Nama"
                            class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]" required>

                        <!-- <input type="text" name="anggota_jabatan[]"
                            placeholder="Jabatan"
                            class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]"> -->

                        <select name="anggota_identity_type[]"
                            class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]" required>

                            <option value="NIP">NIP</option>
                            <option value="NRP">NRP</option>

                        </select>

                        <input type="text" name="anggota_identity_number[]"
                            placeholder="Nomor"
                            class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]" required>

                        <button type="button" onclick="removeAnggota(this)"
                            class="text-red-500 hover:text-red-600 text-sm">
                            Hapus
                        </button>

                    </div>

                </div>

            </div>

            <!-- ACTION -->
            <div class="flex justify-end">
                <button class="bg-[#1F7A4D] hover:bg-[#16603c] text-white px-5 py-2 rounded-lg">
                    Generate PDF
                </button>
            </div>

        </form>

    </div>

</div>


<div class="p-6 space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Generate Laporan Bulanan</h1>
        <p class="text-sm text-gray-500">Buat laporan pemeriksaan bulanan</p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm border max-w-3xl">

        <h2 class="text-sm font-semibold text-gray-700 mb-2">
            Laporan Bulanan
        </h2>

        <form method="POST" action="{{ route('reports.monthly') }}" target="_blank" class="space-y-6">
            @csrf

            <input type="month" name="month"
                class="border rounded px-3 py-2"
                required>

            <!-- <div class="bg-gray-50 p-4 rounded-lg space-y-3">
                <h2 class="text-sm font-semibold text-gray-700 uppercase">Ketua Tim</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

                    <input type="text" name="ketua_nama"
                        placeholder="Nama"
                        class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]" required>

                    <input type="text" name="ketua_jabatan"
                        placeholder="Jabatan"
                        class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]" required>

                    <input type="text" name="ketua_nip"
                        placeholder="NIP"
                        class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]" required>

                </div>
            </div> -->

            <!-- ANGGOTA -->
            <!-- <div class="space-y-3">

                <div class="flex justify-between items-center">
                    <h2 class="text-sm font-semibold text-gray-700 uppercase">Anggota Tim</h2>

                    <button type="button" onclick="addAnggota()"
                        class="text-sm bg-[#1F7A4D] hover:bg-[#16603c] text-white px-3 py-1 rounded-lg">
                        + Tambah
                    </button>
                </div>

                <div id="anggotaWrapper" class="space-y-3">

                    <div class="flex gap-2 anggota-item">

                        <input type="text" name="anggota_nama[]"
                            placeholder="Nama"
                            class="w-1/2 border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">

                        <input type="text" name="anggota_jabatan[]"
                            placeholder="Jabatan"
                            class="w-1/2 border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">

                        <button type="button" onclick="removeAnggota(this)"
                            class="text-red-500 hover:text-red-600 text-sm">
                            Hapus
                        </button>

                    </div>

                </div>

            </div> -->

            <button class="bg-[#1F7A4D] text-white px-4 py-2 rounded">
                Generate
            </button>
        </form>

    </div>
</div>


<script>
function addAnggota() {
    let wrapper = document.getElementById('anggotaWrapper');

    let html = `
    <div class="grid grid-cols-1 md:grid-cols-5 gap-2 anggota-item">

        <input type="text" name="anggota_nama[]"
            placeholder="Nama"
            class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">

        <input type="text" name="anggota_jabatan[]"
            placeholder="Jabatan"
            class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">

        <select name="anggota_identity_type[]"
            class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">

            <option value="NIP">NIP</option>
            <option value="NRP">NRP</option>

        </select>

        <input type="text" name="anggota_identity_number[]"
            placeholder="Nomor"
            class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">

        <button type="button" onclick="removeAnggota(this)"
            class="text-red-500 hover:text-red-600 text-sm">
            Hapus
        </button>

    </div>
`;

    wrapper.insertAdjacentHTML('beforeend', html);
}

function removeAnggota(btn) {
    btn.parentElement.remove();
}
</script>

@endsection