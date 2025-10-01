@extends('layout.utamadashboard')

@section('kontendashboard')
{{-- Dashboard content start --}}
<div class="container mx-auto px-4">
    <h1 class="text-center text-3xl font-bold text-gray-800 my-8">Edit Kategori Brand</h1>

    <form action="{{ url('/dashboard/brandcategory/'. $brand_category->id) }}" method="POST"
        enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-lg space-y-6">
        @method('put')
        @csrf

        <!-- Pilih Kategori -->
        <div>
            <label for="kategori_id" class="block text-lg font-semibold text-gray-700">Pilih Kategori</label>
            <select name="kategori_id"
                class="mt-2 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-3 @error('kategori_id') @enderror">
                <option value="">Pilih Kategori</option>
                @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}" {{ old('kategori_id', $brand_category->kategori_id) == $kategori->id
                    ? 'selected' : '' }}>
                    {{ $kategori->nmkategori }}
                </option>
                @endforeach
            </select>
            @error('kategori_id')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Pilih Brand -->
        <div>
            <label for="brands_id" class="block text-lg font-semibold text-gray-700">Pilih Brand</label>
            <select name="brands_id"
                class="mt-2 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-3 @error('brands_id') @enderror">
                <option value="">Pilih Brand</option>
                @foreach($brands as $brand)
                <option value="{{ $brand->id }}" {{ old('brands_id', $brand_category->brands_id) == $brand->id ?
                    'selected' : '' }}>
                    {{ $brand->namabrand }}
                </option>
                @endforeach
            </select>
            @error('brands_id')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Foto Kategori Brand -->
        <div>
            <label for="fotocatbrands" class="block text-lg font-semibold text-gray-700">Foto Kategori Brand</label>
            @if ($brand_category->fotocatbrands)
            <img src="{{ $brand_category->fotocatbrands }}" alt="Foto Kategori Brand"
                class="mb-2 h-32 w-32 object-cover">
            @endif
            <input type="file" name="fotocatbrands"
                class="mt-2 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-3 @error('fotocatbrands') @enderror" />
            @error('fotocatbrands')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Deskripsi Kategori Brand -->
        <div>
            <label for="descatbrands" class="block text-lg font-semibold text-gray-700">Deskripsi Kategori Brand</label>
            <textarea name="descatbrands" rows="4"
                class="mt-2 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-3 @error('descatbrands') @enderror"
                placeholder="Masukkan Deskripsi Kategori Brand">{{ old('descatbrands', $brand_category->descatbrands) }}</textarea>
            @error('descatbrands')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex items-center justify-end space-x-4 pt-4">
            <button type="submit" name="submit" value="save"
                class="px-6 py-3 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-500 transition duration-300">
                Simpan
            </button>
            <a href="{{ url('/dashboard/brandcategory') }}"
                class="px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg shadow-md hover:bg-gray-500 transition duration-300">
                Batal
            </a>
        </div>
    </form>
</div>
{{-- Dashboard content ends --}}
@endsection