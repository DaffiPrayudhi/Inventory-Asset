@extends('layouts.app')

@section('header')
    <h2 class="text-3xl font-semibold text-gray-800">
        {{ __('Import') }}
    </h2>
@endsection

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <h1>Import Excel Sistem</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('spareparts.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file">Select Excel File</label>
                                <input type="file" name="file" id="file" class="form-control">
                                @error('file')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-rs">Import</button>
                        </form>
                        @if (session('success'))
                            <div class="alert alert-success mt-2">{{ session('success') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card-rs">
                <div class="card-body">
                    <div class="card-header">
                        <h4 class="card-title">Tabel Aset Sistem</h4>
                        <input type="text" id="search-input" class="form-control mb-3" placeholder="Search..." style="width: 30%;">
                    </div>
                    <div class="table-responsive">
                        <table id="spareparts-table" class="table table-hover table-bordered">
                            <thead class="table-header">
                                <tr>
                                    <th>Kode Aset</th>
                                    <th>Item Deskripsi</th>
                                    <th>Group</th>
                                    <th>Departemen</th>
                                    <th>Nama User</th>
                                    <th>Lokasi</th>
                                    <th>Kondisi Aset</th>
                                    <th>Tanggal Konfirmasi</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="spareparts-tbody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<style>
    .btn-rs {
        margin-top: 10px;
    }

    .table-header th {
        color: #fff; 
        background-color: #2088ef;
        position: sticky;
        top: 0;
        z-index: 2; 
        box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1); 
    }

    .card-rs {
        height: 503px;
        max-height: 600px;
        overflow: hidden;
    }

    .table-responsive {
        max-height: 480px;
        overflow-y: hidden; 
    }

    .table-responsive:hover {
        overflow-y: auto;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchSparepartsData();

        function fetchSparepartsData() {
            fetch('{{ route('spareparts.table') }}')
                .then(response => response.json())
                .then(data => {
                    populateTable(data.data); 
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        function populateTable(spareparts) {
            const tbody = document.getElementById('spareparts-tbody');
            tbody.innerHTML = '';

            spareparts.forEach(sparepart => {
                const row = document.createElement('tr');

                row.innerHTML = `
                    <td>${sparepart.asset_number}</td>
                    <td>${sparepart.asset_desc}</td>
                    <td>${sparepart.asset_group}</td>
                    <td>${sparepart.departement}</td>
                    <td>${sparepart.nama_user}</td>
                    <td>${sparepart.lokasi}</td>
                    <td>${sparepart.asset_condition}</td>
                    <td>${sparepart.confirm_date}</td>
                    <td>${sparepart.status}</td>
                `;

                tbody.appendChild(row);
            });

            addSearchFunctionality(); 
        }

        function addSearchFunctionality() {
            const searchInput = document.getElementById('search-input');
            searchInput.addEventListener('keyup', function() {
                const searchTerm = searchInput.value.toLowerCase();
                const tableRows = document.querySelectorAll('#spareparts-tbody tr');

                tableRows.forEach(row => {
                    const rowText = row.innerText.toLowerCase();
                    if (rowText.includes(searchTerm)) {
                        row.style.display = ''; 
                    } else {
                        row.style.display = 'none';  
                    }
                });
            });
        }
    });
</script>
@endsection

