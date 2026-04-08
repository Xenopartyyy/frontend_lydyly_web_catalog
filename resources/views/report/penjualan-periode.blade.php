@extends('layout.utamadashboard')

@section('title', 'Penjualan Per Periode')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css">
<style>
    /* ── Wrapper ── */
    #tablePenjualan_wrapper {
        font-size: 13px;
        font-family: inherit;
    }

    /* ── Controls atas ── */
    #tablePenjualan_wrapper .dataTables_length label,
    #tablePenjualan_wrapper .dataTables_filter label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: #4b5563;
        margin-bottom: 12px;
    }

    #tablePenjualan_wrapper .dataTables_length select {
        border: 1.5px solid #e5e7eb;
        border-radius: 8px;
        padding: 6px 28px 6px 10px;
        outline: none;
        background: white;
        cursor: pointer;
        font-size: 13px;
        color: #374151;
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%239ca3af' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 8px center;
    }

    #tablePenjualan_wrapper .dataTables_filter input {
        border: 1.5px solid #e5e7eb;
        border-radius: 8px;
        padding: 6px 12px 6px 34px;
        outline: none;
        min-width: 240px;
        font-size: 13px;
        color: #374151;
        background-color: white;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%239ca3af' stroke-width='2'%3E%3Ccircle cx='11' cy='11' r='8'/%3E%3Cpath d='m21 21-4.35-4.35'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: 10px center;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    #tablePenjualan_wrapper .dataTables_filter input:focus {
        border-color: #db2777;
        box-shadow: 0 0 0 3px rgba(219, 39, 119, 0.12);
        outline: none;
    }

    /* ── FIX: Header th selalu putih — override className yg bocor dari kolom ── */
    #tablePenjualan thead th {
        color: #ffffff !important;
        background-color: #db2777;
    }

    /* ── SORT ARROWS — paksa via JS, CSS hanya fallback ── */
    table.dataTable thead th.sorting,
    table.dataTable thead th.sorting_asc,
    table.dataTable thead th.sorting_desc {
        background-image: none !important;
        position: relative !important;
        padding-right: 28px !important;
        cursor: pointer;
    }

    table.dataTable thead th.sorting::before,
    table.dataTable thead th.sorting_asc::before,
    table.dataTable thead th.sorting_desc::before,
    table.dataTable thead th.sorting::after,
    table.dataTable thead th.sorting_asc::after,
    table.dataTable thead th.sorting_desc::after {
        display: none !important;
        content: none !important;
    }

    /* Hover header */
    table.dataTable thead th:hover {
        background-color: #be185d !important;
        transition: background-color 0.15s;
    }

    /* ── Pagination ── */
    #tablePenjualan_wrapper .dataTables_paginate {
        padding-top: 10px;
    }

    #tablePenjualan_wrapper .dataTables_paginate span {
        display: inline-flex !important;
        gap: 4px;
        align-items: center;
    }

    #tablePenjualan_wrapper .dataTables_paginate .paginate_button {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-width: 34px !important;
        height: 34px !important;
        padding: 0 10px !important;
        margin: 0 2px !important;
        border: 1.5px solid #e5e7eb !important;
        border-radius: 8px !important;
        cursor: pointer !important;
        color: #374151 !important;
        background: #ffffff !important;
        font-size: 13px;
        font-weight: 500;
        line-height: 1 !important;
        transition: all 0.15s ease;
        text-decoration: none !important;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    #tablePenjualan_wrapper .dataTables_paginate .paginate_button:hover:not(.current):not(.disabled) {
        background: #fce7f3 !important;
        border-color: #f9a8d4 !important;
        color: #db2777 !important;
        box-shadow: 0 2px 6px rgba(219, 39, 119, 0.15) !important;
        transform: translateY(-1px);
    }

    #tablePenjualan_wrapper .dataTables_paginate .paginate_button.current {
        background: linear-gradient(135deg, #db2777, #be185d) !important;
        border-color: #be185d !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        box-shadow: 0 2px 8px rgba(219, 39, 119, 0.35) !important;
    }

    #tablePenjualan_wrapper .dataTables_paginate .paginate_button.disabled,
    #tablePenjualan_wrapper .dataTables_paginate .paginate_button.disabled:hover {
        opacity: 0.35 !important;
        cursor: not-allowed !important;
        background: #f9fafb !important;
        border-color: #e5e7eb !important;
        color: #9ca3af !important;
        transform: none !important;
        box-shadow: none !important;
    }

    #tablePenjualan_wrapper .dataTables_info {
        color: #6b7280;
        padding-top: 14px;
        font-size: 12.5px;
    }

    /* ── Row hover ── */
    #tablePenjualan tbody tr:hover td {
        background-color: #fdf2f8 !important;
    }
</style>
@endpush

@section('kontendashboard')
<div class="p-6">
    <h1 class="text-2xl font-bold text-pink-600 mb-6 text-center">Data Penjualan Per Periode</h1>

    {{-- Filter Form --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="flex flex-wrap gap-4 items-end">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gudang</label>
                <select id="filterGudang"
                    class="border border-gray-300 rounded px-3 py-2 text-sm min-w-[180px] focus:outline-none focus:border-pink-500">
                    <option value="">-- Pilih Gudang --</option>
                    @foreach($gudang as $g)
                    <option value="{{ $g['kodegdg'] }}">{{ $g['namagdg'] }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                <input type="number" id="filterYear" value="{{ date('Y') }}" min="2000" max="2099"
                    class="border border-gray-300 rounded px-3 py-2 text-sm w-[100px] focus:outline-none focus:border-pink-500">
            </div>
            <div>
                <button id="btnPerbarui"
                    class="bg-pink-600 hover:bg-pink-700 text-white px-5 py-2 rounded text-sm font-medium transition">
                    Perbarui
                </button>
            </div>
            <div>
                <button id="btnExport"
                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded text-sm font-medium transition">
                    Export Excel
                </button>
            </div>
        </div>
    </div>

    {{-- Loading --}}
    <div id="loadingIndicator" class="hidden py-12">
        <div class="flex flex-col items-center justify-center">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-pink-600"></div>
            <p class="mt-4 text-gray-500 font-medium animate-pulse">Menyiapkan data penjualan...</p>
        </div>
    </div>

    {{-- Tabel --}}
    <div id="tableWrapper" class="bg-white rounded-lg shadow p-4" style="display:none">
        <table id="tablePenjualan" class="w-full text-sm" style="width:100%">
            <thead class="bg-pink-600 text-white">
                <tr>
                    <th class="px-3 py-3 text-left">No</th>
                    <th class="px-3 py-3 text-left">Barcode</th>
                    <th class="px-3 py-3 text-left">Artikel</th>
                    <th class="px-3 py-3 text-left">Pemasok</th>
                    <th class="px-3 py-3 text-left">Grup Supplier</th>
                    <th class="px-3 py-3 text-left">Satuan</th>
                    <th class="px-3 py-3 text-right">Jan</th>
                    <th class="px-3 py-3 text-right">Feb</th>
                    <th class="px-3 py-3 text-right">Mar</th>
                    <th class="px-3 py-3 text-right">Apr</th>
                    <th class="px-3 py-3 text-right">Mei</th>
                    <th class="px-3 py-3 text-right">Jun</th>
                    <th class="px-3 py-3 text-right">Jul</th>
                    <th class="px-3 py-3 text-right">Agt</th>
                    <th class="px-3 py-3 text-right">Sep</th>
                    <th class="px-3 py-3 text-right">Okt</th>
                    <th class="px-3 py-3 text-right">Nov</th>
                    <th class="px-3 py-3 text-right">Des</th>
                    <th class="px-3 py-3 text-right">Total Jual</th>
                    <th class="px-3 py-3 text-right">Rata Jual</th>
                    <th class="px-3 py-3 text-right">Stok Akhir</th>
                </tr>
            </thead>
            <tbody id="tableBody"></tbody>
        </table>
    </div>

    <div id="emptyState" class="text-center py-12 text-gray-400 text-sm bg-white rounded-lg shadow">
        Pilih gudang dan tahun, lalu klik <strong>Perbarui</strong> untuk menampilkan data.
    </div>
</div>
@endsection

@push('script')
{{-- XLSX untuk export — jangan dicomment! --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script>
    let tableData  = [];
    let dtInstance = null;

    function formatNumber(val) {
        if (val === null || val === undefined) return '0';
        return parseFloat(val).toLocaleString('id-ID');
    }

    /* ─────────────────────────────────────────
       FIX SORT ICONS via JS
       Kenapa JS? Karena local datatables.min.css
       di layout punya spesifisitas lebih tinggi
       dan tidak bisa dikalahkan CSS biasa.
    ───────────────────────────────────────── */
    function fixSortIcons() {
        $('#tablePenjualan thead th').each(function () {
            // Hapus background sprite bawaan
            $(this).css('background-image', 'none');

            // Hapus icon lama supaya tidak double
            $(this).find('.dt-sort-icon').remove();

            // Hanya tambah icon kalau kolom sortable
            if (!$(this).hasClass('sorting') &&
                !$(this).hasClass('sorting_asc') &&
                !$(this).hasClass('sorting_desc')) return;

            const $icon = $('<span class="dt-sort-icon"></span>').css({
                position:      'absolute',
                right:         '8px',
                top:           '50%',
                transform:     'translateY(-50%)',
                pointerEvents: 'none',
                lineHeight:    '1',
                fontStyle:     'normal',
            });

            if ($(this).hasClass('sorting_asc')) {
                // Aktif ASC → panah atas, putih
                $icon.text('▲').css({
                    fontSize:   '11px',
                    color:      '#ffffff',
                    textShadow: '0 0 6px rgba(255,255,255,0.8)',
                });
            } else if ($(this).hasClass('sorting_desc')) {
                // Aktif DESC → panah bawah, putih
                $icon.text('▼').css({
                    fontSize:   '11px',
                    color:      '#ffffff',
                    textShadow: '0 0 6px rgba(255,255,255,0.8)',
                });
            } else {
                // Default (belum disort) → ▲▼ kuning
                $icon.html('▲▼').css({
                    fontSize:      '8px',
                    color:         '#fde68a',
                    letterSpacing: '-1px',
                    opacity:       '0.85',
                });
            }

            $(this).css('position', 'relative').append($icon);
        });
    }

    function initDataTable() {
        if (dtInstance) {
            dtInstance.destroy();
            $('#tableBody').empty();
        }

        dtInstance = $('#tablePenjualan').DataTable({
            data: tableData,
            paging: true,
            pageLength: 50,
            lengthMenu: [25, 50, 100, 250, { label: 'Semua', value: -1 }],
            ordering: true,
            searching: true,
            autoWidth: false,
            language: {
                search: "Cari:",
                searchPlaceholder: "Ketik untuk mencari...",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ – _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data",
                zeroRecords: "Data tidak ditemukan",
                paginate: { first: "«", last: "»", next: "›", previous: "‹" }
            },
            columns: [
                {
                    data: null,
                    orderable: false,
                    render: (data, type, row, meta) => meta.row + 1,
                    className: 'px-3 py-2 text-center'
                },
                { data: 'barcode',  defaultContent: '-', className: 'px-3 py-2' },
                { data: 'ArtNo',    defaultContent: '-', className: 'px-3 py-2' },
                { data: 'Pemasok',  defaultContent: '-', className: 'px-3 py-2' },
                { data: 'GrupSupplier',  defaultContent: '-', className: 'px-3 py-2' },
                { data: 'Satuan',   defaultContent: '-', className: 'px-3 py-2' },
                { data: 'Januari',   defaultContent: 0, type: 'num', className: 'px-3 py-2 text-right', render: (v, t) => t === 'display' ? formatNumber(v) : parseFloat(v) || 0 },
                { data: 'Februari',  defaultContent: 0, type: 'num', className: 'px-3 py-2 text-right', render: (v, t) => t === 'display' ? formatNumber(v) : parseFloat(v) || 0 },
                { data: 'Maret',     defaultContent: 0, type: 'num', className: 'px-3 py-2 text-right', render: (v, t) => t === 'display' ? formatNumber(v) : parseFloat(v) || 0 },
                { data: 'April',     defaultContent: 0, type: 'num', className: 'px-3 py-2 text-right', render: (v, t) => t === 'display' ? formatNumber(v) : parseFloat(v) || 0 },
                { data: 'Mei',       defaultContent: 0, type: 'num', className: 'px-3 py-2 text-right', render: (v, t) => t === 'display' ? formatNumber(v) : parseFloat(v) || 0 },
                { data: 'Juni',      defaultContent: 0, type: 'num', className: 'px-3 py-2 text-right', render: (v, t) => t === 'display' ? formatNumber(v) : parseFloat(v) || 0 },
                { data: 'Juli',      defaultContent: 0, type: 'num', className: 'px-3 py-2 text-right', render: (v, t) => t === 'display' ? formatNumber(v) : parseFloat(v) || 0 },
                { data: 'Agustus',   defaultContent: 0, type: 'num', className: 'px-3 py-2 text-right', render: (v, t) => t === 'display' ? formatNumber(v) : parseFloat(v) || 0 },
                { data: 'September', defaultContent: 0, type: 'num', className: 'px-3 py-2 text-right', render: (v, t) => t === 'display' ? formatNumber(v) : parseFloat(v) || 0 },
                { data: 'Oktober',   defaultContent: 0, type: 'num', className: 'px-3 py-2 text-right', render: (v, t) => t === 'display' ? formatNumber(v) : parseFloat(v) || 0 },
                { data: 'November',  defaultContent: 0, type: 'num', className: 'px-3 py-2 text-right', render: (v, t) => t === 'display' ? formatNumber(v) : parseFloat(v) || 0 },
                { data: 'Desember',  defaultContent: 0, type: 'num', className: 'px-3 py-2 text-right', render: (v, t) => t === 'display' ? formatNumber(v) : parseFloat(v) || 0 },
                {
                    // PENTING: className hanya untuk <td>, warna header di-handle CSS/JS
                    // Tidak pakai text-pink-700 di sini supaya header tetap putih
                    data: 'TotalPenjualan', defaultContent: 0, type: 'num',
                    className: 'px-3 py-2 text-right',
                    render: (v, t, row) => {
                        if (t === 'display') return `<span style="color:#db2777;font-weight:600">${formatNumber(v)}</span>`;
                        return parseFloat(v) || 0;
                    }
                },
                {
                    data: 'RataJual', defaultContent: 0, type: 'num',
                    className: 'px-3 py-2 text-right',
                    render: (v, t) => {
                        if (t === 'display') return `<span style="color:#2563eb">${formatNumber(v)}</span>`;
                        return parseFloat(v) || 0;
                    }
                },
                {
                    data: 'Stock Akhir', defaultContent: 0, type: 'num',
                    className: 'px-3 py-2 text-right',
                    render: (v, t) => {
                        if (t === 'display') return `<span style="color:#d97706;font-weight:600">${formatNumber(v)}</span>`;
                        return parseFloat(v) || 0;
                    }
                },
            ],
            createdRow: (row, data, index) => {
                $(row).addClass(index % 2 === 0 ? 'bg-white' : 'bg-pink-50');
            },
            // Panggil fixSortIcons setiap kali draw & order berubah
            drawCallback: function () {
                fixSortIcons();
            }
        });

        // Panggil sekali setelah init
        fixSortIcons();

        // Panggil lagi setiap klik sort
        dtInstance.on('order.dt', function () {
            setTimeout(fixSortIcons, 0);
        });
    }

    function loadData() {
        const warehouse = document.getElementById('filterGudang').value;
        const year      = document.getElementById('filterYear').value;

        if (!warehouse) { alert('Pilih gudang terlebih dahulu.'); return; }

        document.getElementById('loadingIndicator').classList.remove('hidden');
        document.getElementById('tableWrapper').style.display = 'none';
        document.getElementById('emptyState').style.display   = 'none';

        fetch(`{{ route('report.penjualan-periode.data') }}?warehouse=${warehouse}&year=${year}`)
            .then(res => res.json())
            .then(result => {
                document.getElementById('loadingIndicator').classList.add('hidden');
                if (!result.success || !result.data.length) {
                    document.getElementById('emptyState').style.display = 'block';
                    document.getElementById('emptyState').textContent   = 'Data tidak ditemukan.';
                    return;
                }
                tableData = result.data;
                document.getElementById('tableWrapper').style.display = 'block';
                initDataTable();
            })
            .catch(err => {
                document.getElementById('loadingIndicator').classList.add('hidden');
                document.getElementById('emptyState').style.display = 'block';
                document.getElementById('emptyState').textContent   = 'Terjadi kesalahan saat mengambil data.';
                console.error(err);
            });
    }

    function exportExcel() {
        if (!tableData.length) { alert('Tidak ada data untuk diekspor.'); return; }

        const ws_data = [['No','Barcode','Artikel','Pemasok','GrupSupplier', 'Satuan',
            'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des',
            'Total Jual','Rata Jual','Stok Akhir']];

        tableData.forEach((row, i) => {
            ws_data.push([
                i + 1, row.barcode, row.ArtNo, row.Pemasok, row.GrupSupplier, row.Satuan,
                row.Januari, row.Februari, row.Maret, row.April, row.Mei,
                row.Juni, row.Juli, row.Agustus, row.September, row.Oktober,
                row.November, row.Desember, row.TotalPenjualan, row.RataJual,
                row['Stock Akhir']
            ]);
        });

        const ws     = XLSX.utils.aoa_to_sheet(ws_data);
        const wb     = XLSX.utils.book_new();
        const gudang = document.getElementById('filterGudang').value;
        const year   = document.getElementById('filterYear').value;

        XLSX.utils.book_append_sheet(wb, ws, 'Penjualan Per Periode');
        XLSX.writeFile(wb, `Penjualan_Periode_${gudang}_${year}.xlsx`);
    }

    document.getElementById('btnPerbarui').addEventListener('click', loadData);
    document.getElementById('btnExport').addEventListener('click', exportExcel);
</script>
@endpush