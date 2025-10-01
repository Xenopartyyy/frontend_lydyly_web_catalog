@extends('layout.utamadashboard')

@section('kontendashboard')
<div id="customLoading" class="fixed inset-0 bg-white/90 backdrop-blur-sm flex items-center justify-center z-50"
    style="display: none;">
    <div class="flex flex-col items-center justify-center py-8">
        <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-pink-500 border-solid mb-3"></div>
        <p class="text-pink-600 font-semibold text-sm">Sedang memuat data...</p>
    </div>
</div>

<div class="container mx-auto px-4">

    <h1 class="text-center text-3xl font-bold text-gray-800 my-8">Edit Foto Produk</h1>

    <form method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-lg space-y-6" id="form">


        <!-- Informasi Produk (Hanya tampilan, tidak editable) -->
        <div class="space-y-6 p-4 bg-gray-50 rounded-lg">
            <h2 class="text-lg font-semibold text-gray-700">Informasi Produk</h2>

            <div>
                <label class="block text-sm font-medium text-gray-500">Artikel Barang</label>
                <input type="text" disabled class="mt-1 w-full rounded-lg bg-gray-100 p-2 text-gray-600"
                    value="{{ (string) $produk['ArtNo'] }}">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">Nama Barang</label>
                <input type="text" disabled class="mt-1 w-full rounded-lg bg-gray-100 p-2 text-gray-600"
                    value="{{ (string) $produk['NamaStock'] }}">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500">Deskripsi Barang</label>
                <textarea disabled
                    class="mt-1 w-full rounded-lg bg-gray-100 p-2 text-gray-600">{{ (string) $produk['deskbrg'] }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500">Harga Jual</label>
                    <input type="text" disabled class="mt-1 w-full rounded-lg bg-gray-100 p-2 text-gray-600"
                        value="Rp. {{ number_format((float) $produk['HargaJual5'], 0, ',', '.') }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Harga Yuan</label>
                    <input type="text" disabled class="mt-1 w-full rounded-lg bg-gray-100 p-2 text-gray-600"
                        value="¥. {{ number_format((float) $produk['YUAN'], 0, ',', '.') }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Harga Beli</label>
                    <input type="text" disabled class="mt-1 w-full rounded-lg bg-gray-100 p-2 text-gray-600"
                        value="Rp. {{ number_format((float) $produk['HargaBeli'], 0, ',', '.') }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Stok Barang</label>
                    <input type="text" disabled class="mt-1 w-full rounded-lg bg-gray-100 p-2 text-gray-600"
                        value="{{ (string) $produk['StockAkhir'] }}">
                </div>
            </div>
        </div>

        <!-- Upload Foto Baru -->
        <div class="space-y-4 p-4 bg-white rounded-lg border border-blue-100">
            <h2 class="text-lg font-semibold text-blue-700">Foto Produk</h2>
            <p class="text-sm text-gray-500">Anda hanya dapat mengubah foto produk</p>

            <!-- Gambar Saat Ini -->
            @php
            $fotobrg = [];
            if (!empty($produk['fotobrg'])) {
            $decoded = json_decode($produk['fotobrg'], true);
            if (json_last_error() === JSON_ERROR_NONE) {
            $fotobrg = $decoded;
            }
            }
            @endphp

            @if (!empty($images))
            @foreach ($images as $index => $foto)
            <div class="flex items-center space-x-4">
                <img src="https://api.allorigins.win/raw?url=http:\\139.255.116.18:8813\storage\{{ $foto }}" alt="Gambar {{ $index + 1 }}"
                    class="w-24 h-24 object-cover border rounded-lg"
                    onerror="this.onerror=null; this.src='{{ asset('public/images/no-image.png') }}'; console.log('Image failed:', '{{ $foto }}')">
                <input type="hidden" name="existing_images[]" value="{{ $foto }}">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="deleted_images[]" value="{{ $foto }}"
                        class="form-checkbox h-5 w-5 text-red-600">
                    <span class="text-sm font-medium text-gray-700">Hapus</span>
                </label>
            </div>
            @endforeach
            @endif

            <!-- Upload Baru -->
            <div id="image-upload-container" class="space-y-4 mt-4">
                <label class="block text-sm font-medium text-gray-700">Tambah Foto Baru</label>
                <div class="image-upload-item flex items-center space-x-4">
                    <input type="file" name="fotobrg[]"
                        class="w-full rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-2 text-sm">
                    <button type="button"
                        class="remove-image bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-400 transition text-sm">Hapus</button>
                </div>
                @error('fotobrg.*')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="button" id="add-image"
                class="mt-2 bg-green-500 text-white px-3 py-1 rounded-lg shadow-md hover:bg-green-400 transition duration-300 text-sm">
                + Tambah Gambar Lain
            </button>
        </div>

        <!-- Tombol -->
        <div class="flex items-center justify-end space-x-4 pt-4">
            <button type="submit" name="submit"
                class="px-6 py-2 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-400 transition duration-300 text-sm">
                Simpan Perubahan Foto
            </button>
            <a href="{{ url('/dashboard/produk') }}"
                class="px-6 py-2 bg-gray-500 text-white font-semibold rounded-lg shadow-md hover:bg-gray-400 transition duration-300 text-sm">
                Batal
            </a>
        </div>
    </form>
</div>
@push('script')
<script>
    $(document).ready(function() {
            
                function showCustomLoading() {
                $('#customLoading').fadeIn(200);
                }
                
                function hideCustomLoading() {
                $('#customLoading').fadeOut(200);
                }
                $('#form').on('submit', function(e) {
                    
                    e.preventDefault();
               
                    const url =
                        'http://139.255.116.18:8813/api/dashboard/produk/{{ $produk['id'] }}';

                    console.log('URL yang dipanggil:', url); // Debug URL

                    $.ajax({
                        url: url,
                        method: 'POST',
                        headers: { // ✅ pakai "headers"
                            "Authorization": "Bearer " + token
                        },
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        xhrFields: {
                            withCredentials: true
                        },
                        beforeSend : function(xhr){
                            showCustomLoading()
                        },
                        success: function(response) {
                            console.log('Success:', response);
                            window.location.href = "{{ route('produk.index') }}";
                           
                        },
                        error: function(xhr, status, error) {
                            console.log('Error URL:', xhr.responseURL);
                            console.log('Error Response:', xhr.responseJSON);
                            console.log(error)
                        }
                    });
                });
            });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
                const addImageButton = document.getElementById('add-image');
                const imageUploadContainer = document.getElementById('image-upload-container');

                addImageButton.addEventListener('click', () => {
                    const newImageField = document.createElement('div');
                    newImageField.classList.add('image-upload-item', 'flex', 'items-center', 'space-x-4',
                        'mt-2');
                    newImageField.innerHTML = `
                <input type="file" name="fotobrg[]"
                    class="w-full rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-2 text-sm">
                <button type="button"
                    class="remove-image bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-400 transition text-sm">Hapus</button>
            `;
                    imageUploadContainer.appendChild(newImageField);
                    const removeButton = newImageField.querySelector('.remove-image');
                    removeButton.addEventListener('click', () => {
                        imageUploadContainer.removeChild(newImageField);
                    });
                });
            });
</script>

@endpush

<style>
    #customLoading {
        transition: opacity 0.2s ease-in-out;
    }

    /* Ensure loading overlay doesn't create extra height */
    #customLoading {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100vw;
        height: 100vh;
        transition: opacity 0.2s ease-in-out;
    }
</style>


@endsection