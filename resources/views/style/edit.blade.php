@extends('layout.utamadashboard')

@section('kontendashboard')
{{-- Dashboard content start --}}
<div class="container mx-auto px-4">
    <h1 class="text-center text-3xl font-bold text-gray-800 my-8">Edit Style</h1>

    <form action="{{ url('/dashboard/style/' . $style->id) }}" method="POST" enctype="multipart/form-data"
        class="bg-white p-8 rounded-lg shadow-lg space-y-6">
        @method('put')
        @csrf

        <div>
            <label for="namastyle" class="block text-lg font-semibold text-gray-700">Nama Style</label>
            <input type="text" name="namastyle"
                class="mt-2 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-3 @error('namastyle') @enderror"
                value="{{ old('namastyle', $style->namastyle) }}" placeholder="Masukkan Nama Style" />
            @error('namastyle')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="fotostyle" class="block text-lg font-semibold text-gray-700">Foto Style</label>
            @if ($style->fotostyle)
            <img src="{{ $style->fotostyle }}" alt="Foto Style" class="mb-2 h-32 w-32 object-cover">
            @endif
            <input type="file" name="fotostyle"
                class="mt-2 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-3 @error('fotostyle') @enderror"
                value="{{ old('fotostyle') }}" />
            @error('fotostyle')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>


        <!-- Buttons -->
        <div class="flex items-center justify-end space-x-4 pt-4">
            <button type="submit" name="submit" value="save"
                class="px-6 py-3 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-500 transition duration-300">
                Simpan
            </button>
            <a href="{{ url('/dashboard/style') }}"
                class="px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg shadow-md hover:bg-gray-500 transition duration-300">
                Batal
            </a>
        </div>
    </form>
</div>
{{-- Dashboard content ends --}}
@endsection