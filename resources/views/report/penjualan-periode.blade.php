@extends('layout.utamadashboard')

@section('title', 'Penjualan Per Periode')

@section('kontendashboard')
<div class="p-6">
    <h1 class="text-2xl font-bold text-pink-600 mb-6 text-center">Data Penjualan Per Periode</h1>

    {{-- Filter Form --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="flex flex-wrap gap-4 items-end">

            {{-- Dropdown Gudang --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gudang</label>
                <select id="filterGudang" class="border border-gray-300 rounded px-3 py-2 text-sm min-w-[180px]">
                    <option value="">-- Pilih Gudang --</option>
                    @foreach($gudang as $g)
                    <option value="{{ $g['kodegdg'] }}">{{ $g['namagdg'] }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Input Tahun --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                <input type="number" id="filterYear" value="{{ date('Y') }}" min="2000" max="2099"
                    class="border border-gray-300 rounded px-3 py-2 text-sm w-[100px]">
            </div>

            {{-- Tombol Perbarui --}}
            <div>
                <button id="btnPerbarui"
                    class="bg-pink-600 hover:bg-pink-700 text-white px-5 py-2 rounded text-sm font-medium transition">
                    Perbarui
                </button>
            </div>

            {{-- Tombol Export --}}
            <div>
                <button id="btnExport"
                    class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded text-sm font-medium transition">
                    Export Excel
                </button>
            </div>
        </div>
    </div>

    {{-- Loading Indicator --}}
    <div id="loadingIndicator" class="hidden py-12">
        <div class="flex flex-col items-center justify-center">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-pink-600"></div>
            <p class="mt-4 text-gray-500 font-medium animate-pulse">Menyiapkan data penjualan...</p>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table id="tablePenjualan" class="w-full text-sm text-left" style="display:none">
            <thead class="bg-pink-600 text-white">
                <tr>
                    <th class="px-3 py-3 whitespace-nowrap">No</th>
                    <th class="px-3 py-3 whitespace-nowrap cursor-pointer select-none" onclick="sortTable('barcode')">
                        Barcode <span id="sort-barcode"></span></th>
                    <th class="px-3 py-3 whitespace-nowrap cursor-pointer select-none" onclick="sortTable('ArtNo')">
                        Artikel <span id="sort-ArtNo"></span></th>
                    <th class="px-3 py-3 whitespace-nowrap cursor-pointer select-none" onclick="sortTable('Pemasok')">
                        Pemasok <span id="sort-Pemasok"></span></th>
                    <th class="px-3 py-3 whitespace-nowrap cursor-pointer select-none" onclick="sortTable('Satuan')">
                        Satuan <span id="sort-Satuan"></span></th>
                    <th class="px-3 py-3 whitespace-nowrap text-right cursor-pointer select-none"
                        onclick="sortTable('Januari')">Jan
                        <span id="sort-Januari"></span>
                    </th>
                    <th class="px-3 py-3 whitespace-nowrap text-right cursor-pointer select-none"
                        onclick="sortTable('Februari')">
                        Feb <span id="sort-Februari"></span></th>
                    <th class="px-3 py-3 whitespace-nowrap text-right cursor-pointer select-none"
                        onclick="sortTable('Maret')">Mar
                        <span id="sort-Maret"></span>
                    </th>
                    <th class="px-3 py-3 whitespace-nowrap text-right cursor-pointer select-none"
                        onclick="sortTable('April')">Apr
                        <span id="sort-April"></span>
                    </th>
                    <th class="px-3 py-3 whitespace-nowrap text-right cursor-pointer select-none"
                        onclick="sortTable('Mei')">Mei
                        <span id="sort-Mei"></span>
                    </th>
                    <th class="px-3 py-3 whitespace-nowrap text-right cursor-pointer select-none"
                        onclick="sortTable('Juni')">Jun
                        <span id="sort-Juni"></span>
                    </th>
                    <th class="px-3 py-3 whitespace-nowrap text-right cursor-pointer select-none"
                        onclick="sortTable('Juli')">Jul
                        <span id="sort-Juli"></span>
                    </th>
                    <th class="px-3 py-3 whitespace-nowrap text-right cursor-pointer select-none"
                        onclick="sortTable('Agustus')">Agt
                        <span id="sort-Agustus"></span>
                    </th>
                    <th class="px-3 py-3 whitespace-nowrap text-right cursor-pointer select-none"
                        onclick="sortTable('September')">
                        Sep <span id="sort-September"></span></th>
                    <th class="px-3 py-3 whitespace-nowrap text-right cursor-pointer select-none"
                        onclick="sortTable('Oktober')">Okt
                        <span id="sort-Oktober"></span>
                    </th>
                    <th class="px-3 py-3 whitespace-nowrap text-right cursor-pointer select-none"
                        onclick="sortTable('November')">
                        Nov <span id="sort-November"></span></th>
                    <th class="px-3 py-3 whitespace-nowrap text-right cursor-pointer select-none"
                        onclick="sortTable('Desember')">
                        Des <span id="sort-Desember"></span></th>
                    <th class="px-3 py-3 whitespace-nowrap text-right cursor-pointer select-none"
                        onclick="sortTable('TotalPenjualan')">Total Jual <span id="sort-TotalPenjualan"></span></th>
                    <th class="px-3 py-3 whitespace-nowrap text-right cursor-pointer select-none"
                        onclick="sortTable('RataJual')">
                        Rata Jual <span id="sort-RataJual"></span></th>
                    <th class="px-3 py-3 whitespace-nowrap text-right cursor-pointer select-none"
                        onclick="sortTable('Stock Akhir')">Stok Akhir <span id="sort-Stock Akhir"></span></th>
                </tr>
            </thead>
            <tbody id="tableBody" class="divide-y divide-gray-200">
                {{-- diisi via JavaScript --}}
            </tbody>
        </table>

        <div id="emptyState" class="text-center py-12 text-gray-400 text-sm">
            Pilih gudang dan tahun, lalu klik <strong>Perbarui</strong> untuk menampilkan data.
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
    let tableData = [];
    let sortColumn = null;
    let sortAsc = true;
    
    function sortTable(column) {
    // Kalau klik kolom yang sama, balik arah sort
    if (sortColumn === column) {
    sortAsc = !sortAsc;
    } else {
    sortColumn = column;
    sortAsc = true;
    }
    
    // Reset semua indikator
    document.querySelectorAll('[id^="sort-"]').forEach(el => el.textContent = '');
    
    // Tampilkan indikator di kolom yang aktif
    const indicator = document.getElementById('sort-' + column);
    if (indicator) indicator.textContent = sortAsc ? ' ▲' : ' ▼';
    
    // Sort data
    const sorted = [...tableData].sort((a, b) => {
    let valA = a[column] ?? 0;
    let valB = b[column] ?? 0;
    
    // Cek apakah angka atau string
    const isNumeric = !isNaN(parseFloat(valA)) && !isNaN(parseFloat(valB));
    
    if (isNumeric) {
    valA = parseFloat(valA);
    valB = parseFloat(valB);
    } else {
    valA = String(valA).toLowerCase();
    valB = String(valB).toLowerCase();
    }
    
    if (valA < valB) return sortAsc ? -1 : 1; if (valA> valB) return sortAsc ? 1 : -1;
        return 0;
        });
    
        renderTable(sorted);
    }

    function formatNumber(val) {
        if (val === null || val === undefined) return '0';
        return parseFloat(val).toLocaleString('id-ID');
    }

    function loadData() {
        const warehouse = document.getElementById('filterGudang').value;
        const year      = document.getElementById('filterYear').value;

        if (!warehouse) {
            alert('Pilih gudang terlebih dahulu.');
            return;
        }

        document.getElementById('loadingIndicator').classList.remove('hidden');
        document.getElementById('tablePenjualan').style.display = 'none';
        document.getElementById('emptyState').style.display = 'none';
        document.getElementById('tableBody').innerHTML = '';

        fetch(`{{ route('report.penjualan-periode.data') }}?warehouse=${warehouse}&year=${year}`)
            .then(res => res.json())
            .then(result => {
                document.getElementById('loadingIndicator').classList.add('hidden');

                if (!result.success || !result.data.length) {
                    document.getElementById('emptyState').style.display = 'block';
                    document.getElementById('emptyState').textContent = 'Data tidak ditemukan.';
                    return;
                }

                tableData = result.data;
                renderTable(tableData);
            })
            .catch(err => {
                document.getElementById('loadingIndicator').classList.add('hidden');
                document.getElementById('emptyState').style.display = 'block';
                document.getElementById('emptyState').textContent = 'Terjadi kesalahan saat mengambil data.';
                console.error(err);
            });
    }

    function renderTable(data) {
        const tbody = document.getElementById('tableBody');
        tbody.innerHTML = '';

        data.forEach((row, index) => {
            const tr = document.createElement('tr');
            tr.className = index % 2 === 0 ? 'bg-white' : 'bg-pink-50';
            tr.innerHTML = `
                <td class="px-3 py-2">${index + 1}</td>
                <td class="px-3 py-2 whitespace-nowrap">${row.barcode ?? '-'}</td>
                <td class="px-3 py-2 whitespace-nowrap">${row.ArtNo ?? '-'}</td>
                <td class="px-3 py-2 whitespace-nowrap">${row.Pemasok ?? '-'}</td>
                <td class="px-3 py-2">${row.Satuan ?? '-'}</td>
                <td class="px-3 py-2 text-right">${formatNumber(row.Januari)}</td>
                <td class="px-3 py-2 text-right">${formatNumber(row.Februari)}</td>
                <td class="px-3 py-2 text-right">${formatNumber(row.Maret)}</td>
                <td class="px-3 py-2 text-right">${formatNumber(row.April)}</td>
                <td class="px-3 py-2 text-right">${formatNumber(row.Mei)}</td>
                <td class="px-3 py-2 text-right">${formatNumber(row.Juni)}</td>
                <td class="px-3 py-2 text-right">${formatNumber(row.Juli)}</td>
                <td class="px-3 py-2 text-right">${formatNumber(row.Agustus)}</td>
                <td class="px-3 py-2 text-right">${formatNumber(row.September)}</td>
                <td class="px-3 py-2 text-right">${formatNumber(row.Oktober)}</td>
                <td class="px-3 py-2 text-right">${formatNumber(row.November)}</td>
                <td class="px-3 py-2 text-right">${formatNumber(row.Desember)}</td>
                <td class="px-3 py-2 text-right font-semibold text-pink-700">${formatNumber(row.TotalPenjualan)}</td>
                <td class="px-3 py-2 text-right text-blue-600">${formatNumber(row.RataJual)}</td>
                <td class="px-3 py-2 text-right font-semibold text-yellow-600">${formatNumber(row['Stock Akhir'])}</td>
            `;
            tbody.appendChild(tr);
        });

        document.getElementById('tablePenjualan').style.display = 'table';
    }
    

    function exportExcel() {
        if (!tableData.length) {
            alert('Tidak ada data untuk diekspor.');
            return;
        }

        const ws_data = [
            ['No','Barcode','Artikel','Pemasok','Satuan','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des','Total Jual','Rata Jual','Stok Akhir']
        ];

        tableData.forEach((row, i) => {
            ws_data.push([
                i + 1, row.barcode, row.ArtNo, row.Pemasok, row.Satuan,
                row.Januari, row.Februari, row.Maret, row.April, row.Mei,
                row.Juni, row.Juli, row.Agustus, row.September, row.Oktober,
                row.November, row.Desember, row.TotalPenjualan, row.RataJual,
                row['Stock Akhir']
            ]);
        });

        const ws  = XLSX.utils.aoa_to_sheet(ws_data);
        const wb  = XLSX.utils.book_new();
        const gudang = document.getElementById('filterGudang').value;
        const year   = document.getElementById('filterYear').value;

        XLSX.utils.book_append_sheet(wb, ws, 'Penjualan Per Periode');
        XLSX.writeFile(wb, `Penjualan_Periode_${gudang}_${year}.xlsx`);
    }

    document.getElementById('btnPerbarui').addEventListener('click', loadData);
    document.getElementById('btnExport').addEventListener('click', exportExcel);
</script>
@endpush