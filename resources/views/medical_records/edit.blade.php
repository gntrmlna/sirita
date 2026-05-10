@extends('layouts.app')

@section('content')

<div class="p-6 space-y-6">

    <!-- HEADER -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Edit Rekam Medis
        </h1>
        <p class="text-sm text-gray-500">
            Pasien: {{ $record->patient->name }}
        </p>
    </div>

    <!-- FORM CARD -->
    <div class="bg-white p-6 rounded-xl shadow-sm border max-w-3xl">

        <form id="medicalForm" method="POST" action="{{ route('medical-records.update', $record->id) }}" class="space-y-6" enctype="multipart/form-data">>
            @csrf
            @method('PUT')

            @include('medical_records._form', ['record' => $record])

            <!-- ACTION -->
            <div class="flex justify-between items-center">

                <a href="{{ route('patients.show', $record->patient->id) }}"
                   class="text-sm text-gray-500 hover:underline">
                    ← Kembali
                </a>

                <div class="flex gap-2">

                    <button type="button" onclick="showPreview()"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                        Preview
                    </button>

                    <button class="bg-[#1F7A4D] hover:bg-[#16603c] text-white px-5 py-2 rounded-lg">
                        Update
                    </button>

                </div>

            </div>

        </form>

    </div>

    <!-- MODAL PREVIEW -->
    <div id="previewModal"
        class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

        <div class="bg-white rounded-xl shadow-lg w-full max-w-xl p-6">

            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                Preview Rekam Medis
            </h2>

            <div id="previewContent" class="text-sm space-y-2 max-h-[400px] overflow-y-auto"></div>

            <div class="mt-6 flex justify-end gap-2">
                <button onclick="closePreview()"
                    class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg">
                    Kembali
                </button>

                <button onclick="submitForm()"
                    class="px-4 py-2 bg-[#1F7A4D] hover:bg-[#16603c] text-white rounded-lg">
                    Simpan
                </button>
            </div>

        </div>

    </div>

</div>

@push('scripts')
<script>
function showPreview() {

    let form = document.getElementById('medicalForm');
    let content = '';

    let fields = form.querySelectorAll('input, textarea, select');

    fields.forEach(field => {

        let name = field.name;

        if (!name || name === '_token' || name === '_method') return;

        let label = field.closest('div')?.querySelector('label')?.innerText || name;

        let value = '';

        if (field.tagName === 'SELECT') {
            let selectedOption = field.options[field.selectedIndex];
            value = selectedOption ? selectedOption.text : '-';
        } else {
            value = field.value || '-';
            value = value.replace(/\n/g, '<br>');
        }

        content += `
            <div class="flex justify-between items-start border-b py-2">
                <span class="text-gray-500">${label}</span>
                <span class="font-medium text-gray-800 text-right max-w-[60%]">${value}</span>
            </div>
        `;
    });

    document.getElementById('previewContent').innerHTML = content;

    let modal = document.getElementById('previewModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closePreview() {
    let modal = document.getElementById('previewModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function submitForm() {
    document.getElementById('medicalForm').submit();
}
</script>
@endpush

@endsection