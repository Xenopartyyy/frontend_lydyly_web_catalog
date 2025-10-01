@extends('layout.utamadashboard')

@section('kontendashboard')
{{-- Dashboard content start --}}
<div class="container mx-auto px-4">
    <h1 class="text-center text-3xl font-bold text-gray-800 my-8">Tambah Produk Baru</h1>

    <!-- Import Section -->
    <div class="bg-white p-8 rounded-lg shadow-lg mb-4 text-gray-800">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-extrabold ">Import Data Produk</h2>
            <a href="{{ asset('public/template/Ketentuan_Impor.txt') }}" target="_blank"
                class="px-4 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 transition duration-300 text-sm">
                Lihat Ketentuan Import
            </a>
        </div>

        <div class="flex items-center justify-end mb-4">
            <a href="{{ asset('public/template/Format_Excel_Produk.xlsx') }}"
                class="px-4 py-3 bg-yellow-400 text-gray-800 font-semibold rounded-lg shadow-md hover:bg-yellow-500 transition duration-300 text-sm">
                Download Template Import
            </a>
        </div>

        <form action="{{ url('/dashboard/produk/import') }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            <div>
                <label for="file" class="block text-lg font-bold text-gray-700">File Excel</label>
                <div class="flex items-center space-x-4 mt-3">
                    <input type="file" name="file" accept=".xlsx, .xls"
                        class="flex-1 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-3 bg-white shadow-sm" />
                    <button type="submit"
                        class="px-6 py-3 bg-green-500 text-white font-bold rounded-lg shadow-md hover:bg-green-600 transition duration-300">
                        Import
                    </button>
                </div>
                @error('file')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </form>
    </div>

    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data"
        class="bg-white p-8 rounded-lg shadow-lg space-y-6">
        @csrf
        <h2 class="text-2xl font-extrabold text-blue-700">Input Data Produk</h2>
        <!-- Artikel Barang -->
        <div>
            <label for="noart" class="block text-lg font-semibold text-gray-700">Artikel Barang</label>
            <input type="text" name="noart"
                class="mt-2 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-3 @error('noart') is-invalid @enderror"
                value="{{ old('noart') }}" placeholder="Masukkan Artikel Barang" />
            @error('noart')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Nama Barang --}}
        <div>
            <label for="nmbrg" class="block text-lg font-semibold text-gray-700">Nama Barang</label>
            <input type="text" name="nmbrg"
                class="mt-2 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-3 @error('nmbrg') is-invalid @enderror"
                value="{{ old('nmbrg') }}" placeholder="Masukkan Nama Barang" />
            @error('nmbrg')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Kategori -->
        <div>
            <label for="kategori_id" class="block text-lg font-semibold text-gray-700">Kategori</label>
            <select name="kategori_id"
                class="mt-2 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-3">
                @foreach ($kategoris as $kategori)
                <option value="{{ $kategori->id }}" {{ old('kategori_id')==$kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nmkategori }}
                </option>
                @endforeach
            </select>
            @error('kategori_id')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Brand -->
        <div>
            <label for="brands_id" class="block text-lg font-semibold text-gray-700">Brand</label>
            <select name="brands_id"
                class="mt-2 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-3">
                @foreach ($brands as $brand)
                <option value="{{ $brand->id }}" {{ old('brands_id')==$brand->id ? 'selected' : '' }}>
                    {{ $brand->namabrand }}
                </option>
                @endforeach
            </select>
            @error('brands_id')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Ukuran Barang (Checkbox) -->
        <div>
            <label class="block text-lg font-semibold text-gray-700">Ukuran Barang</label>
            <div class="mt-2 space-y-2">
                @php
                $availableSizes = ['S', 'M', 'L', 'XL', 'XXL', '4L', '5L', '6L'];
                $selectedSizes = old('ukbrg', []); // Ambil ukuran yang sebelumnya dipilih jika validasi gagal
                @endphp
                @foreach ($availableSizes as $size)
                <label class="inline-flex items-center">
                    <input type="checkbox" name="ukbrg[]" value="{{ $size }}"
                        class="form-checkbox rounded border-gray-300 focus:ring-2 focus:ring-blue-400" {{
                        in_array($size, $selectedSizes) ? 'checked' : '' }}>
                    <span class="ml-2">{{ $size }}</span>
                </label>
                @endforeach
            </div>
            @error('ukbrg')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Deskripsi Barang -->
        <div>
            <label for="deskbrg" class="block text-lg font-semibold text-gray-700">Deskripsi Barang</label>
            <textarea name="deskbrg"
                class="mt-2 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-3 @error('deskbrg') is-invalid @enderror"
                placeholder="Masukkan Deskripsi Barang">{{ old('deskbrg') }}</textarea>
            @error('deskbrg')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Harga Barang -->
        <div>
            <label for="hrgbrg_display" class="block text-lg font-semibold text-gray-700">Harga Barang</label>
            <input type="text" name="hrgbrg_display" id="hrgbrg_display"
                class="mt-2 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-3 @error('hrgbrg') is-invalid @enderror"
                value="{{ old('hrgbrg_display') }}" placeholder="Masukkan Harga Barang" />
            <input type="hidden" name="hrgbrg" id="hrgbrg" value="{{ old('hrgbrg') }}">
            @error('hrgbrg')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Harga Yuan -->
        <div>
            <label for="hrgyuan_display" class="block text-lg font-semibold text-gray-700">Harga Yuan</label>
            <input type="text" name="hrgyuan_display" id="hrgyuan_display"
                class="mt-2 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-3 @error('hrgyuan') is-invalid @enderror"
                value="{{ old('hrgyuan_display') }}" placeholder="Masukkan Harga Barang Yuan" />
            <input type="hidden" name="hrgyuan" id="hrgyuan" value="{{ old('hrgyuan') }}">
            @error('hrgyuan')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Harga Modal -->
        <div>
            <label for="hrgmodal_display" class="block text-lg font-semibold text-gray-700">Harga Modal</label>
            <input type="text" name="hrgmodal_display" id="hrgmodal_display"
                class="mt-2 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-3 @error('hrgmodal') is-invalid @enderror"
                value="{{ old('hrgmodal_display') }}" placeholder="Masukkan Harga Barang Modal" />
            <input type="hidden" name="hrgmodal" id="hrgmodal" value="{{ old('hrgmodal') }}">
            @error('hrgmodal')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Stok Barang -->
        <div>
            <label for="stokbrg" class="block text-lg font-semibold text-gray-700">Status Barang</label>
            <select name="stokbrg"
                class="mt-2 w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-3">
                <option value="Ready" {{ old('status')=='Ready' ? 'selected' : '' }}>Ready</option>
                <option value="Kosong" {{ old('status')=='Kosong' ? 'selected' : '' }}>Kosong</option>
            </select>
        </div>


        <!-- Foto Barang -->
        <div>
            <label for="fotobrg" class="block text-lg font-semibold text-gray-700">Foto Barang</label>
            <div id="image-upload-container">
                <div class="image-upload-item flex items-center space-x-4 mb-4">
                    <div class="flex-1">
                        <input type="file" name="fotobrg[]"
                            class="w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-3 @error('fotobrg.*') is-invalid @enderror" />
                        @error('fotobrg.*')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="button"
                        class="remove-image bg-red-500 text-white px-3 py-2 rounded-md hover:bg-red-400 transition">
                        Hapus
                    </button>
                </div>
            </div>
            <button type="button" id="add-image"
                class="mt-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-green-400 transition duration-300">
                Tambah Gambar
            </button>
        </div>

        <!-- Buttons -->
        <div class="flex items-center justify-end space-x-4 pt-4">
            <button type="submit" name="submit" value="save"
                class="px-6 py-3 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-500 transition duration-300">
                Simpan
            </button>
            <a href="{{ url('/dashboard/produk') }}"
                class="px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg shadow-md hover:bg-gray-500 transition duration-300">
                Batal
            </a>
        </div>
    </form>
</div>
{{-- Dashboard content ends --}}

{{-- Script to manage dynamic image upload --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
            const imageContainer = document.getElementById('image-upload-container');
            const addImageButton = document.getElementById('add-image');

            addImageButton.addEventListener('click', () => {
                const newImageField = document.createElement('div');
                newImageField.classList.add('image-upload-item', 'flex', 'items-center', 'space-x-4', 'mb-4');

                newImageField.innerHTML = `
                    <input type="file" name="fotobrg[]" class="w-full rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition duration-200 p-3" />
                    <button type="button" class="remove-image bg-red-500 text-white px-3 py-2 rounded-md hover:bg-red-400 transition">
                        Hapus
                    </button>
                `;

                imageContainer.appendChild(newImageField);

                // Attach remove event
                const removeButton = newImageField.querySelector('.remove-image');
                removeButton.addEventListener('click', () => {
                    imageContainer.removeChild(newImageField);
                });
            });

            // Attach remove event to existing fields
            imageContainer.addEventListener('click', (e) => {
                if (e.target && e.target.classList.contains('remove-image')) {
                    e.target.closest('.image-upload-item').remove();
                }
            });
        });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const formatCurrency = (angka, prefix, isYuan = false) => {
            const numberString = angka.replace(/[^,\d]/g, '').toString();
            const split = numberString.split(',');
            let sisa = split[0].length % 3;
            let result = split[0].substr(0, sisa);
            const ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            
            if (ribuan) {
                const separator = sisa ? '.' : '';
                result += separator + ribuan.join('.');
            }
            
            result = split[1] !== undefined ? result + ',' + split[1] : result;
            
            if (prefix === undefined) return result;
            
            // Format khusus untuk Yuan
            if (isYuan) {
                return result ? '¥ ' + result : '';
            }
            // Format default Rupiah
            return result ? 'Rp. ' + result : '';
        };
        
        // Fungsi untuk mengatur format input
        const setupCurrencyFormat = (displayId, hiddenId, isYuan = false) => {
            const displayElement = document.getElementById(displayId);
            const hiddenInput = document.getElementById(hiddenId);
            
            if (displayElement && hiddenInput) {
                displayElement.addEventListener('input', function () {
                    // Format tampilan
                    const formattedValue = formatCurrency(this.value, true, isYuan);
                    this.value = formattedValue;
                    
                    // Simpan nilai numerik ke input hidden
                    hiddenInput.value = this.value.replace(/[^\d]/g, '');
                });
                
                // Set nilai awal jika ada old value
                if (hiddenInput.value) {
                    displayElement.value = formatCurrency(hiddenInput.value, true, isYuan);
                }
            }
        };
        
        // Setup untuk semua pasangan input
        setupCurrencyFormat('hrgbrg_display', 'hrgbrg'); // Format Rupiah
        setupCurrencyFormat('hrgyuan_display', 'hrgyuan', true); // Format Yuan
        setupCurrencyFormat('hrgmodal_display', 'hrgmodal'); // Format Rupiah
    });
</script>
@endsection