@extends('layout.utamadashboard')

@section('kontendashboard')
<div class="container mx-auto px-4 bg-pink-100">
  <h1 class="text-center text-2xl font-semibold my-5">Data Brand</h1>
  <div class="flex justify-end mb-4">
    <a href="{{ url('dashboard/brand/create') }}"
      class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">Tambah Brand</a>
  </div>
  <div class="overflow-x-auto mt-6">
    <table id="brandTable" class="min-w-full bg-white border border-gray-300">
      <thead class="border-b border-gray-300">
        <tr>
          <th class="py-2 px-4 border border-gray-300">No</th>
          <th class="py-2 px-4 border border-gray-300">Aksi</th>
          <th class="py-2 px-4 border border-gray-300">Nama Brand</th>
          <th class="py-2 px-4 border border-gray-300">Logo Brand</th>
          <th class="py-2 px-4 border border-gray-300">Deskripsi Singkat Brand</th>
          <th class="py-2 px-4 border border-gray-300">Deskripsi Brand</th>
          <th class="py-2 px-4 border border-gray-300">Foto / Video Brand</th>
          <th class="py-2 px-4 border border-gray-300">Linktree Brand</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($brand as $index => $brnd)
        <tr class="text-center hover:bg-gray-100 border-b border-gray-300">
          <td class="py-2 px-4 border border-gray-300">{{ $index + 1 }}</td>
          <td class="py-2 px-4 border border-gray-300">
            <div class="flex justify-center space-x-2">
              <a href="{{ url('dashboard/brand/' . $brnd->id . '/edit') }}"
                class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-1 px-2 rounded" title="Edit">
                <i class="fa-regular fa-pen-to-square"></i>
              </a>
              <form action="{{ url('dashboard/brand/' . $brnd->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="button" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-2 rounded"
                  onclick="openModal('{{ url('/dashboard/brand/' . $brnd->id) }}')">
                  <i class="fa-regular fa-trash-can"></i>
                </button>
              </form>
            </div>
          </td>
          <td class="py-2 px-4 border border-gray-300">{{ $brnd->namabrand }}</td>
          <td class="py-2 px-4 border border-gray-300">
            <img src="{{ $brnd->fotobrand }}" class="w-12 h-12 object-cover rounded" alt="fotobrand">
          </td>
          <td class="py-2 px-4 border border-gray-300">{{ $brnd->descsingkatbrand }}</td>
          <td class="py-2 px-4 border border-gray-300">{{ $brnd->deskripsibrand }}</td>
          <td class="py-2 px-4 border border-gray-300">
            @php
            $media = $brnd->media; // Menyimpan URL atau Data URI media
            @endphp

            @if (strpos($media, 'data:video') === 0)
            <!-- Cek jika tipe media adalah video -->
            <video src="{{ $media }}" class="w-12 h-12 object-cover rounded" alt="media" autoplay muted loop
              playsinline>
              Your browser does not support the video tag.
            </video>
            @elseif (strpos($media, 'data:image') === 0)
            <!-- Cek jika tipe media adalah gambar -->
            <img src="{{ $media }}" class="w-12 h-12 object-cover rounded" alt="media">
            @else
            <!-- Jika tipe media tidak dikenal -->
            <p class="text-gray-500">Media tidak dikenali</p>
            @endif
          </td>
          <td class="py-2 px-4 border border-gray-300"> @if ($brnd->linktree) ✔️ @else ❌ @endif </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- DataTable scripts and styling -->
<link rel="stylesheet" href={{ asset('css/datatables.min.css') }}>
<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('js/datatables.min.js') }}"></script>

<script>
  $(document).ready(function() {
      $('#brandTable').DataTable({
          columnDefs: [{
              targets: '_all', // Mengatur seluruh kolom
              className: 'dt-head-center dt-body-center' // Menyelaraskan seluruh kolom di tengah
          }],
          "language": {
              "search": "Cari:",
              "lengthMenu": "Tampilkan _MENU_ data per halaman",
              "zeroRecords": "Tidak ada data yang ditemukan",
              "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
              "infoEmpty": "Tidak ada data tersedia",
              "infoFiltered": "(disaring dari _MAX_ total data)"
          },
      });
  });
</script>
@endsection