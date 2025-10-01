@extends('layout.utamadashboard')

@section('kontendashboard')
{{-- Dashboard content start --}}
<div class="container mx-auto px-4">
    <h1 class="text-center text-3xl font-bold text-gray-800 my-8">Tambah Distribusi Baru</h1>

    <form action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data"
        class="bg-white p-8 rounded-lg shadow-lg space-y-6">
        @csrf

        <!-- Tentang Kami -->
        <div>
            <label for="namabrand" class="block text-lg font-semibold text-gray-700">Nama Brand</label>
            <input type="text" name="namabrand"
                class="mt-2 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-3 @error('namabrand') @enderror"
                value="{{ old('namabrand') }}" placeholder="Masukkan Nama Brand" />
            @error('namabrand')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Foto Tentang -->
        <div>
            <label for="fotobrand" class="block text-lg font-semibold text-gray-700">Logo Brand</label>
            <input type="file" name="fotobrand"
                class="mt-2 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-3 @error('fotobrand') @enderror" />
            @error('fotobrand')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="descsingkatbrand" class="block text-lg font-semibold text-gray-700">Deskripsi Singkat
                Brand</label>
            <input type="text" name="descsingkatbrand"
                class="mt-2 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-3 @error('descsingkatbrand') @enderror"
                value="{{ old('descsingkatbrand') }}" placeholder="Masukkan Deskripsi Singkat Brand " />
            @error('descsingkatbrand')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="deskripsibrand" class="block text-lg font-semibold text-gray-700">Deskripsi Brand</label>
            <textarea name="deskripsibrand"
                class="mt-2 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-3 @error('deskripsibrand') @enderror"
                placeholder="Masukkan Deskripsi Brand">{{ old('deskripsibrand') }}</textarea>
            @error('deskripsibrand')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        <div>
            <label for="media" class="block text-lg font-semibold text-gray-700">Media Halaman Brand (Foto atau
                Video)</label>
            <input type="file" name="media"
                class="mt-2 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-3 @error('media') @enderror" />
            @error('media')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="linktree" class="block text-lg font-semibold text-gray-700">Linktree Brand
                Brand</label>
            <input type="text" name="linktree"
                class="mt-2 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-3 @error('linktree') @enderror"
                value="{{ old('linktree') }}" placeholder="Masukkan Linktree Brand (Kosongkan Jika Belum Ada)" />
            @error('linktree')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>


        <!-- Buttons -->
        <div class="flex items-center justify-end space-x-4 pt-4">
            <button type="submit" name="submit" value="save"
                class="px-6 py-3 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-500 transition duration-300">
                Simpan
            </button>
            <a href="{{ url('/dashboard/brand') }}"
                class="px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg shadow-md hover:bg-gray-500 transition duration-300">
                Batal
            </a>
        </div>
    </form>
</div>
{{-- Dashboard content ends --}}
@endsection