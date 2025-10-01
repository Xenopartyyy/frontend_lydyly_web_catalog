@extends('layout.utamadashboard')

@php
use App\Http\Controllers\AuthController;
$userIsAdmin = AuthController::userIsAdmin();
@endphp

@section('kontendashboard')
<div class="min-h-screen bg-pink-100 py-10">
  <div class="max-w-screen-2xl mx-auto bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold text-center text-pink-700 mb-6">Data Produk</h1>

    <div class="w-full md:w-auto flex justify-end mb-4">
      <span
        class="bg-gray-400 text-white font-semibold py-2 px-4 rounded-lg shadow whitespace-nowrap cursor-not-allowed opacity-50">
        Tambah Produk
      </span>
    </div>

    <!-- Table Container -->
    <div class="overflow-x-auto relative">
      <!-- Custom Loading Overlay -->
      <div id="customLoading"
        class="absolute inset-0 bg-white/90 backdrop-blur-sm flex items-center justify-center z-50 rounded-lg"
        style="display: none;">
        <div class="flex flex-col items-center justify-center py-8">
          <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-pink-500 border-solid mb-3"></div>
          <p class="text-pink-600 font-semibold text-sm">Sedang mengunggah data..</p>
        </div>
      </div>

      <table id="produkTable" class="min-w-full bg-white">
        <thead>
          <tr class="bg-pink-400 text-white">
            <th class="py-3 px-2 text-left w-12">No</th>
            <th class="py-3 px-2 text-center w-20">Aksi</th>
            <th class="py-3 px-2 text-center w-24">Artikel</th>
            <th class="py-3 px-2 text-center w-48">Nama Barang</th>
            <th class="py-3 px-2 text-center w-32">Kategori</th>
            <th class="py-3 px-2 text-center w-32">Brand</th>
            {{-- <th class="py-3 px-2 text-center w-64">Deskripsi</th> --}}
            <th class="py-3 px-2 text-center w-28">Foto</th>
            <th class="py-3 px-2 text-center w-20">Stok</th>
            @if($userIsAdmin)
            <th class="py-3 px-2 text-center w-28">Harga Yuan</th>
            <th class="py-3 px-2 text-center w-32 whitespace-nowrap">Harga Modal</th>
            @endif
            <th class="py-3 px-2 text-center w-32 whitespace-nowrap">Harga Jual</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>

{{-- Modal preview image --}}
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-70 hidden items-center justify-center z-50"
  onclick="handleModalBackgroundClick(event)">
  <div id="modalContent" class="relative bg-white rounded shadow-lg max-w-4xl max-h-[90vh] overflow-auto p-4">
    <button onclick="closeImageModal()"
      class="absolute top-2 right-2 text-gray-700 hover:text-red-600 text-2xl font-bold">&times;</button>
    <img id="modalImage" src="" alt="Gambar Produk" class="max-w-full max-h-[80vh] object-contain mx-auto">
  </div>
</div>

<link rel="stylesheet" href="{{ asset('public/css/datatables.min.css') }}">
<script src="{{ asset('public/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('public/js/datatables.min.js') }}"></script>

{{-- Inject variable Blade ke JS --}}
<script>
  var userIsAdmin = @json($userIsAdmin);
</script>

<script>
  $(document).ready(function () {
    try {
        var table = $('#produkTable').DataTable({
            processing: false,
            language: {
                processing: '',
                loadingRecords: '',
                zeroRecords: '<div class="text-center text-gray-500 py-8">Tidak ada data yang ditemukan</div>',
                emptyTable: '<div class="text-center text-gray-500 py-8">Tidak ada data tersedia</div>'
            },
            ajax: {
                url: "{{ url('dashboard/produk') }}",
                type: 'GET',
                beforeSend: showCustomLoading,
                complete: hideCustomLoading,
                error: function(xhr, status, error) {
                    hideCustomLoading();
                    console.error('DataTable Ajax Error:', error);
                    $('#produkTable tbody').html('<tr><td colspan="12" class="text-center text-red-500 py-4">Gagal memuat data: ' + error + '</td></tr>');
                }
            },
            columns: [
                { data: null, render: function(data, type, row, meta){ return meta.row + meta.settings._iDisplayStart + 1; }, orderable:false, className:'text-left' },
                { 
                    data: 'id', 
                    render: function(data) {
                        let showUrl = "{{ url('dashboard/produk') }}/" + data;
                        let editUrl = "{{ url('dashboard/produk') }}/" + data + "/edit";

                        return `
                        <div class="flex justify-center space-x-2">
                            <a href="${showUrl}" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-2 rounded" title="Lihat">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                            ${userIsAdmin ? `
                            <a href="${editUrl}" class="bg-yellow-400 hover:bg-yellow-500 text-white py-1 px-2 rounded" title="Edit">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>` : ''}
                        </div>`;
                    },
                    orderable: false,
                    className: 'text-center'
                },
                { data: 'ArtNo', name: 'ArtNo', className: 'text-center' },
                { data: 'NamaStock', name: 'NamaStock', className: 'text-center' },
                { data: 'Jenis', render: d => d || '-', className: 'text-center' },
                { data: 'Merek', render: d => d || '-', className: 'text-center' },
                // { data: 'deskbrg', render: d => d ? (d.length>50 ? d.substring(0,50)+'...' : d) : '-', className: 'text-center' },
                { 
                    data: 'fotobrg', 
                    orderable:false, 
                    render: function(data) {
                        if(!data) return '-';
                        let html = '';
                        if(typeof data === "string") {
                            try { data = JSON.parse(data); } catch(e){ console.error("Parse error fotobrg:", e, data); return '-'; }
                        }
                        if(Array.isArray(data)) {
                            data.forEach(url => {
                                if(url){
                                    url = url.replace(/\\\//g, "/").replace(/\/\//g, "/");
                                    html += `<img src="https://api.allorigins.win/raw?url=http://139.255.116.18:8813/storage/${url}" class="w-10 h-10 object-cover rounded shadow mr-1 mb-1 inline-block cursor-pointer hover:scale-105 transition-transform" onclick="showImageModal('https://api.allorigins.win/raw?url=http://139.255.116.18:8813/storage/${url}')">`;
                                }
                            });
                            return html || '-';
                        }
                        return '-';
                    }
                },
                { data: 'StockAkhir', render: function(d,type){ return type==='display' ? (d?parseFloat(d).toLocaleString('id-ID'):'-') : parseFloat(d)||0; }, className:'text-center' },
                // Kolom admin
                ...(userIsAdmin ? [
                    { data: 'YUAN', render: d => d ? "¥ " + parseFloat(d).toLocaleString('id-ID') : '-', className:'text-center' },
                    { data: 'HargaBeli', render: d => d ? "Rp. " + parseFloat(d).toLocaleString('id-ID') : '-', className:'text-center' }
                ] : []),
                { data: 'HargaJual5', render: d => d ? "Rp. " + parseFloat(d).toLocaleString('id-ID') : '-', className:'text-center' }
            ],
            createdRow: function(row, data, index){
                $(row).addClass(index%2===0 ? 'bg-pink-50':'bg-white').addClass('hover:bg-pink-100 text-center');
            },
            drawCallback: function(){
                $('#produkTable thead').addClass('bg-pink-400 text-white');
                $('.dataTables_length select, .dataTables_paginate .paginate_button').addClass('border border-pink-400 rounded-lg bg-pink-100 px-3 py-1 text-pink-800 hover:bg-pink-200');
                $('.dataTables_paginate .paginate_button.current').addClass('bg-pink-400 text-white font-bold');
                $('.dataTables_filter').addClass('hidden');
                $('.dataTables_processing').hide();
            }
        });

        $('#produkTable').on('preXhr.dt', showCustomLoading);
        $('#produkTable').on('xhr.dt', hideCustomLoading);

    } catch(e){
        console.error("Init DataTable error:", e);
        hideCustomLoading();
        $('#produkTable tbody').html('<tr><td colspan="12" class="text-center text-red-500 py-4">Gagal memuat data</td></tr>');
    }
});

// Loading functions
function showCustomLoading(){ $('#customLoading').fadeIn(200); }
function hideCustomLoading(){ $('#customLoading').fadeOut(200); }

// Modal functions
function showImageModal(src){ $('#modalImage').attr('src', src); $('#imageModal').removeClass('hidden').addClass('flex'); }
function closeImageModal(){ $('#imageModal').addClass('hidden').removeClass('flex'); $('#modalImage').attr('src',''); }
function handleModalBackgroundClick(e){ if(!$('#modalContent').get(0).contains(e.target)) closeImageModal(); }
</script>

<style>
  .dataTables_processing {
    display: none !important;
  }

  #customLoading {
    transition: opacity 0.2s ease-in-out;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    position: absolute;
  }

  .overflow-x-auto {
    overflow-y: hidden;
  }
</style>

@endsection