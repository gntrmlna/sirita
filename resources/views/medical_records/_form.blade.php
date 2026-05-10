@if ($errors->any())
    <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm">
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- INFORMASI -->
<div class="bg-gray-50 p-4 rounded-lg space-y-4">
    <h2 class="text-sm font-semibold text-gray-700 uppercase">Informasi Pemeriksaan</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div>
            <label class="text-sm text-gray-600">Tanggal Periksa</label>
            <input type="date" name="tanggal_periksa"
                value="{{ old('tanggal_periksa', $record->tanggal_periksa ?? '') }}"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
        </div>

        <div>
            <label class="text-sm text-gray-600">Dokter</label>
            <select name="doctor_id"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
                @foreach($doctors as $doc)
                    <option value="{{ $doc->id }}"
                        {{ old('doctor_id', $record->doctor_id ?? '') == $doc->id ? 'selected' : '' }}>
                        {{ $doc->user->name }}
                    </option>
                @endforeach
            </select>
        </div>

    </div>
</div>

<!-- ANAMNESA -->
<div class="bg-white border rounded-lg p-4 space-y-3">
    <h2 class="text-sm font-semibold text-gray-700 uppercase">Anamnesa</h2>

    <textarea name="anamnesa"
        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]"
        rows="3">{{ old('anamnesa', $record->anamnesa ?? '') }}</textarea>
</div>

<!-- VITAL SIGN -->
<div class="bg-white border rounded-lg p-4 space-y-4">

    <h2 class="text-sm font-semibold text-gray-700 uppercase">Vital Sign</h2>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">

        <div>
            <label class="text-sm text-gray-600">Tekanan Darah</label>
            <input type="text" name="blood_pressure"
                value="{{ old('blood_pressure', $record->blood_pressure ?? '') }}"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
        </div>

        <div>
            <label class="text-sm text-gray-600">Nadi</label>
            <input type="text" name="pulse"
                value="{{ old('pulse', $record->pulse ?? '') }}"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
        </div>

        <div>
            <label class="text-sm text-gray-600">Suhu (°C)</label>
            <input type="text" name="temperature"
                value="{{ old('temperature', $record->temperature ?? '') }}"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
        </div>

        <div>
            <label class="text-sm text-gray-600">Respirasi</label>
            <input type="text" name="respiratory_rate"
                value="{{ old('respiratory_rate', $record->respiratory_rate ?? '') }}"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
        </div>

        <div>
            <label class="text-sm text-gray-600">SpO₂</label>
            <input type="text" name="spo2"
                value="{{ old('spo2', $record->spo2 ?? '') }}"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
        </div>

        <div>
            <label class="text-sm text-gray-600">Tinggi Badan</label>
            <input type="text" name="height"
                value="{{ old('height', $record->height ?? '') }}"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
        </div>

        <div>
            <label class="text-sm text-gray-600">Berat Badan</label>
            <input type="text" name="weight"
                value="{{ old('weight', $record->weight ?? '') }}"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
        </div>

    </div>

</div>

<!-- PEMERIKSAAN FISIK -->
<div class="bg-white border rounded-lg p-4 space-y-4">

    <h1 class="text-sm font-semibold text-gray-700 uppercase">
        Pemeriksaan Fisik
    </h1>

    <!-- <h2 class="text-sm font-semibold text-gray-700 uppercase">
        Kepala
    </h2>

    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 border rounded-lg p-4">

        
        <div>
            <label class="text-sm text-gray-600">Konjungtiva</label>

            <select name="conjunctiva_anemic"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">

                <option value="">-</option>

                <option value="1"
                    {{ old('conjunctiva_anemic', $record->conjunctiva_anemic ?? '') == '1' ? 'selected' : '' }}>
                    Anemis
                </option>

                <option value="0"
                    {{ old('conjunctiva_anemic', $record->conjunctiva_anemic ?? '') == '0' ? 'selected' : '' }}>
                    Ananemis
                </option>

            </select>
        </div>

        
        <div>
            <label class="text-sm text-gray-600">Sklera</label>

            <select name="sclera_icteric"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">

                <option value="">-</option>

                <option value="1"
                    {{ old('sclera_icteric', $record->sclera_icteric ?? '') == '1' ? 'selected' : '' }}>
                    Ikterik
                </option>

                <option value="0"
                    {{ old('sclera_icteric', $record->sclera_icteric ?? '') == '0' ? 'selected' : '' }}>
                    Tidak Ikterik
                </option>

            </select>
        </div>

        
        <div>

            <label class="text-sm text-gray-600">
                Pupil
            </label>

            <select
                name="pupil_type"
                id="pupil_type"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">

                <option value="">Pilih</option>

                <option value="Isokor"
                    {{ old('pupil_type', $record->pupil_type ?? '') == 'Isokor' ? 'selected' : '' }}>
                    Isokor
                </option>

                <option value="Anisokor"
                    {{ old('pupil_type', $record->pupil_type ?? '') == 'Anisokor' ? 'selected' : '' }}>
                    Anisokor
                </option>

            </select>

        </div>

        
        <div id="diameter-wrapper"
            style="{{ old('pupil_type', $record->pupil_type ?? '') ? '' : 'display:none;' }}">

            <label class="text-sm text-gray-600">
                Diameter Pupil
            </label>

            <input
                type="text"
                name="pupil_diameter"
                value="{{ old('pupil_diameter', $record->pupil_diameter ?? '') }}"
                placeholder="Contoh: 3 mm / 3 mm"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">

        </div>

        
        <div>
            <label class="text-sm text-gray-600">Rambut</label>

            <input type="text"
                name="hair"
                value="{{ old('hair', $record->hair ?? '') }}"
                placeholder="Kondisi rambut"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
        </div>

       
        <div>
            <label class="text-sm text-gray-600">Telinga</label>

            <input type="text"
                name="rhonchi"
                value="{{ old('rhonchi', $record->rhonchi ?? '') }}"
                placeholder="Telinga"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
        </div>


    </div> -->

    <!-- PEMERIKSAAN LANJUT -->
    <div class="grid grid-cols-1 gap-4 mt-4">

        <div>
            <label class="text-sm text-gray-600">Kepala</label>

            <textarea name="rhonchi"
                rows="2"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">{{ old('rhonchi', $record->rhonchi ?? '') }}</textarea>
        </div>

        <div>
            <label class="text-sm text-gray-600">Leher</label>

            <textarea name="neck"
                rows="2"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">{{ old('neck', $record->neck ?? '') }}</textarea>
        </div>

        <div>
            <label class="text-sm text-gray-600">Thorax</label>

            <textarea name="thorax"
                rows="2"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">{{ old('thorax', $record->thorax ?? '') }}</textarea>
        </div>

        <div>
            <label class="text-sm text-gray-600">Abdomen</label>

            <textarea name="abdomen"
                rows="2"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">{{ old('abdomen', $record->abdomen ?? '') }}</textarea>
        </div>

        <div>
            <label class="text-sm text-gray-600">Anogenital</label>

            <textarea name="anogenital"
                rows="2"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">{{ old('anogenital', $record->anogenital ?? '') }}</textarea>
        </div>

        <div>
            <label class="text-sm text-gray-600">Ekstremitas</label>

            <textarea name="extremities"
                rows="2"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">{{ old('extremities', $record->extremities ?? '') }}</textarea>
        </div>

        <div>
            <label class="text-sm text-gray-600">Kulit</label>

            <textarea name="skin"
                rows="2"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">{{ old('skin', $record->skin ?? '') }}</textarea>
        </div>

    </div>

</div>

<!-- PEMERIKSAAN PENUNJANG -->
<div class="bg-white border rounded-lg p-4 space-y-6">

    <h2 class="text-sm font-semibold text-gray-700 uppercase">
        Pemeriksaan Penunjang
    </h2>

    @foreach([
        'ekg' => 'EKG',
        'radiology' => 'Radiologi',
        'lab' => 'Laboratorium',
        'usg' => 'USG',
        'other' => 'Lain-lain'
    ] as $field => $label)

    <div class="border rounded-xl p-4">

        <h3 class="font-medium text-gray-700 mb-3">
            {{ $label }}
        </h3>

        <div class="space-y-3">

            <!-- HASIL -->
            <div>
                <label class="text-sm text-gray-600">
                    Hasil Pemeriksaan
                </label>

                <textarea
                    name="{{ $field }}_result"
                    rows="2"
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">{{ old($field . '_result', $record->{$field . '_result'} ?? '') }}</textarea>
            </div>

            <!-- FILE -->
            <div>
                <label class="text-sm text-gray-600">
                    Upload File
                </label>

                <input
                    type="file"
                    name="{{ $field }}_file"
                    class="w-full border rounded-lg px-3 py-2">

                @if(!empty($record->{$field . '_file'}))
                    <a
                        href="{{ asset('storage/' . $record->{$field . '_file'}) }}"
                        target="_blank"
                        class="text-sm text-blue-600 hover:underline mt-2 inline-block">
                        Lihat File
                    </a>
                @endif
            </div>

        </div>

    </div>

    @endforeach

</div>

<!-- DIAGNOSA -->
<div class="bg-gray-50 p-4 rounded-lg space-y-4">

    <h2 class="text-sm font-semibold text-gray-700 uppercase">Diagnosa</h2>

    <div>
        <label class="text-sm text-gray-600">Diagnosa</label>
        <textarea name="diagnosis"
            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">{{ old('diagnosis', $record->diagnosis ?? '') }}</textarea>
    </div>

    <div>
        <label class="text-sm text-gray-600">Tindakan</label>
        <textarea name="tindakan"
            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">{{ old('tindakan', $record->tindakan ?? '') }}</textarea>
    </div>

    <div>
        <label class="text-sm text-gray-600">Keterangan</label>
        <textarea name="keterangan"
            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">{{ old('keterangan', $record->keterangan ?? '') }}</textarea>
    </div>

    <div>
        <label class="text-sm text-gray-600">Klasifikasi Penyakit</label>
        <select name="disease_category_id"
            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#1F7A4D]">
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}"
                    {{ old('disease_category_id', $record->disease_category_id ?? '') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>

</div>

<script>

    const pupilType = document.getElementById('pupil_type');
    const diameterWrapper = document.getElementById('diameter-wrapper');

    pupilType.addEventListener('change', function () {

        if (this.value !== '') {
            diameterWrapper.style.display = 'block';
        } else {
            diameterWrapper.style.display = 'none';
        }

    });

</script>