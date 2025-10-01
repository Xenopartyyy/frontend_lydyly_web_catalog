@extends('layout.utamadashboard')

@section('kontendashboard')

<div class="container mx-auto px-6 py-8 text-center bg-pink-100">
  <!-- Header -->
  <div class="text-center mb-10">
    <h1 class="text-4xl font-bold text-gray-800">Dashboard Web Katalog Lydyly</h1>
    <p class="text-gray-500 mt-2">Pantau statistik dan data katalog Anda di sini!</p>
  </div>

  <!-- Statistik Utama -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Semua Produk -->
    <div class="bg-white border-2 border-blue-200 shadow-lg rounded-lg p-6 transition hover:scale-105">
      <div class="flex justify-center items-center mb-4">
        <div class="bg-blue-100 p-3 rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
          </svg>
        </div>
      </div>
      <h3 class="text-lg font-semibold text-gray-700">Total Semua Produk</h3>
      <p class="text-4xl font-bold text-blue-600 mt-2">{{ $produk }}</p>
      <p class="text-sm text-gray-500 mt-2">Semua produk yang terdaftar</p>
    </div>

    <!-- Produk Aktif -->
    <div class="bg-white border-2 border-green-200 shadow-lg rounded-lg p-6 transition hover:scale-105">
      <div class="flex justify-center items-center mb-4">
        <div class="bg-green-100 p-3 rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
        </div>
      </div>
      <h3 class="text-lg font-semibold text-gray-700">Produk Aktif</h3>
      <p class="text-4xl font-bold text-green-600 mt-2">{{ $produkaktif }}</p>
      <p class="text-sm text-gray-500 mt-2">Produk yang tersedia untuk dijual</p>
    </div>

    <!-- Produk Non Aktif -->
    <div class="bg-white border-2 border-red-200 shadow-lg rounded-lg p-6 transition hover:scale-105">
      <div class="flex justify-center items-center mb-4">
        <div class="bg-red-100 p-3 rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </div>
      </div>
      <h3 class="text-lg font-semibold text-gray-700">Produk Non Aktif</h3>
      <p class="text-4xl font-bold text-red-600 mt-2">{{ $produknonaktif }}</p>
      <p class="text-sm text-gray-500 mt-2">Produk yang tidak tersedia</p>
    </div>
  </div>

  <!-- Kategori -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <!-- Total Kategori -->
    <div class="bg-white border-2 border-purple-200 shadow-lg rounded-lg p-6 transition hover:scale-[1.01]">
      <div class="flex justify-center items-center mb-4">
        <div class="bg-purple-100 p-3 rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
          </svg>
        </div>
      </div>
      <h3 class="text-lg font-semibold text-gray-700">Total Jenis Produk</h3>
      <p class="text-4xl font-bold text-purple-600 mt-2">{{ $categories ? count($categories) : 0 }}</p>
      <p class="text-sm text-gray-500 mt-2">Jumlah jenis produk yang berbeda</p>
    </div>

    <!-- Daftar Kategori dengan Jumlah Produk -->
    <div class="bg-white border-2 border-yellow-200 shadow-lg rounded-lg p-6 transition hover:scale-[1.01]">
      <div class="flex justify-center items-center mb-4">
        <div class="bg-yellow-100 p-3 rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-600" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
          </svg>
        </div>
      </div>
      <h3 class="text-lg font-semibold text-gray-700 mb-4">Produk per Jenis</h3>

      <div class="max-h-64 overflow-y-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50 sticky top-0">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Produk
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @forelse($categories as $category)
            <tr>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $category['Jenis'] }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $category['total'] }}</td>
            </tr>
            @empty
            <tr>
              <td colspan="2" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada produk</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection