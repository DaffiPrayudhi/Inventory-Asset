@extends('layouts.app')

@section('header')
    <h2 class="text-3xl font-semibold text-gray-800 dark:text-gray-200">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Monitoring Aset</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Monitoring Aset</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
            <div class="col-xl-6 col-md-8">
                <div class="card card-h-100 card-with-opacity">
                    <div class="card-body text-center"> 
                        <div class="d-flex align-items-center justify-content-center"> 
                            <div class="flex-grow-1">
                                <span class="text-primary mb-3 lh-1 d-block text-truncate" style="font-size: 24px;"><b>Quantity Sistem</b></span> 
                                <h4 class="mb-3" style="font-size: 36px;"> 
                                    <span class="counter-value" data-target="{{ $assetBaan }}">0</span> Unit
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-8">
                <div class="card card-h-100 card-with-opacity">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center justify-content-center"> 
                            <div class="flex-grow-1">
                                <span class="text-primary mb-3 lh-1 d-block text-truncate" style="font-size: 24px;"><b>Quantity Aktual</b></span> 
                                <h4 class="mb-3" style="font-size: 36px;"> 
                                    <span class="counter-value" data-target="{{ $assetActual }}">0</span> Unit
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-8">
                <div class="card card-rs">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Kondisi Aset</h4>
                    </div>
                    <div class="card-body">
                        <div id="line_chart_datalabels" data-colors='["--bs-primary", "--bs-success"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Perbandingan Kondisi Aset</h4>
                    </div>
                    <div class="card-body">
                        <select id="conditionSelect" class="form-control mb-3">
                            <option value="Baik">Baik</option>
                            <option value="Dijual">Dijual</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Discontinue">Discontinue</option>
                            <option value="Tidak ditemukan">Tidak ditemukan</option>
                        </select>
                        <div id="doughnut-chart" data-colors='["--bs-primary", "--bs-danger", "--bs-info","--bs-warning","--bs-success"]' class="e-charts"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card card-rs">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Aset Departemen</h4>
                    </div>
                    <div class="card-body">
                        <div id="line_chart_datalabels1" data-colors='["--bs-primary", "--bs-success"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Perbandingan Aset Departemen</h4>
                    </div>
                    <div class="card-body">
                        <select id="conditionSelect1" class="form-control mb-3">
                            <option value="Engineering SMT">Engineering SMT</option>
                            <option value="PPIC">PPIC</option>
                            <option value="GA & EHS">GA & EHS</option>
                            <option value="Finance & Accounting">Finance & Accounting</option>
                            <option value="RnD">RnD</option>
                            <option value="Maintenance & IT">Maintenance & IT</option>
                            <option value="Purchasing">Purchasing</option>
                        </select>
                        <div id="doughnut-chart1" data-colors='["--bs-primary", "--bs-danger", "--bs-info","--bs-warning","--bs-success"]' class="e-charts"></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Filter</h4>
                </div>
                <div class="card-body">
                    <form id="filter-form" class="form-inline">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="row">
                                    <!-- Filter Fields -->
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group mr-3">
                                            <label for="start-date-filter" class="mr-2">Start Date</label>
                                            <input type="date" id="start-date-filter" class="form-control">
                                        </div>
                                        <div class="form-group mr-3">
                                            <label for="end-date-filter" class="mr-2">End Date</label>
                                            <input type="date" id="end-date-filter" class="form-control">
                                        </div>
                                        <div class="form-group mr-3">
                                            <label for="asset_desc-filter" class="mr-2">Item Desc</label>
                                            <select id="asset_desc-filter" class="form-control">
                                                <option value="">All Item</option>
                                                @foreach($assetDescOptions as $assetDesc)
                                                    <option value="{{ $assetDesc }}">{{ $assetDesc }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group mr-3">
                                            <label for="departement-filter" class="mr-2">Departement</label>
                                            <select id="departement-filter" class="form-control">
                                                <option value="">All Departement</option>
                                                @foreach($departementOptions as $departement)
                                                    <option value="{{ $departement }}">{{ $departement }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mr-3">
                                            <label for="lokasi-filter" class="mr-2">Lokasi</label>
                                            <select id="lokasi-filter" class="form-control">
                                                <option value="">All Lokasi</option>
                                                @foreach($lokasiOptions as $lokasi)
                                                    <option value="{{ $lokasi }}">{{ $lokasi }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mr-3">
                                            <label for="asset_condition-filter" class="mr-2">Kondisi Aset</label>
                                            <select id="asset_condition-filter" class="form-control">
                                                <option value="">All Kondisi</option>
                                                @foreach($assetConditionOptions as $assetCondition)
                                                    <option value="{{ $assetCondition }}">{{ $assetCondition }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="button" id="reset-button" class="btn btn-secondary">Reset</button>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card-rs">
                <div class="table-responsive">
                    <table id="spareparts-table" class="table table-hover table-bordered">
                        <thead class="table-header">
                            <tr>
                                <th>Item Desc</th>
                                <th>Qty Sistem</th>
                                <th>Qty Actual</th>
                                <th>Asset Group</th>
                                <th>Departemen</th>
                                <th>Nama User</th>
                                <th>Lokasi</th>
                                <th>Kondisi Aset</th>
                                <th>Confirm Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    <!-- container-fluid -->
</div>
@endsection

@section('style')
<style>
    .card-rs {
    height: 503px;
    max-height: 600px;
    overflow: hidden; /* Sembunyikan overflow pada card */
    }
    .form-inline .form-group {
        margin-bottom: 1rem; 
    }
    .form-inline .form-control {
        width: 100%;
    }
    .d-flex {
        display: flex;
        justify-content: space-between; 
    }
    .table-responsive {
    max-height: 480px; /* Atur tinggi maksimum untuk div ini */
    overflow-y: hidden; /* Aktifkan scroll vertikal */
    }
    .table-responsive:hover {
        overflow-y: auto;
    }
    .table-header th {
        color: #fff; 
        background-color: #2088ef;
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        function fetchTableData() {
            $.ajax({
                url: '{{ route('spareparts.data') }}',
                method: 'GET',
                data: {
                    asset_desc: $('#asset_desc-filter').val(),
                    departement: $('#departement-filter').val(),
                    lokasi: $('#lokasi-filter').val(),
                    asset_condition: $('#asset_condition-filter').val(),
                    start_date: $('#start-date-filter').val(),
                    end_date: $('#end-date-filter').val(),
                },
                success: function(data) {
                    populateTable(data);
                },
                error: function(xhr) {
                    console.error(xhr);
                }
            });
        }

        function populateTable(data) {
            const tbody = $('#spareparts-table tbody');
            tbody.empty(); // Clear existing data
            data.forEach(row => {
                tbody.append(`
                    <tr>
                        <td>${row.asset_desc}</td>
                        <td>${row.qty_baan}</td>
                        <td>${row.qty_actual}</td>
                        <td>${row.asset_group}</td>
                        <td>${row.departement}</td>
                        <td>${row.nama_user}</td>
                        <td>${row.lokasi}</td>
                        <td>${row.asset_condition}</td>
                        <td>${row.confirm_date}</td>
                    </tr>
                `);
            });
        }

        $('#filter-form').on('submit', function(e) {
            e.preventDefault();
            fetchTableData();
        });

        $('#reset-button').on('click', function() {
            $('#filter-form')[0].reset();
            $('#asset_desc-filter').val('').trigger('change');
            $('#departement-filter').val('').trigger('change');
            $('#lokasi-filter').val('').trigger('change');
            $('#asset_condition-filter').val('').trigger('change');
            
            fetchTableData();
        });

        // Initial fetch
        fetchTableData();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var options = {
            series: [
                {
                    name: 'Asset Sistem',
                    data: @json(array_values(array_column($data, 'baan')))
                },
                {
                    name: 'Asset Actual',
                    data: @json(array_values(array_column($data, 'actual')))
                }
            ],
            chart: {
                type: 'line',
                height: 350
            },
            xaxis: {
                categories: @json(array_keys($data)),
                title: {
                    text: 'Asset Condition',
                }
            },
            yaxis: {
                title: {
                    text: 'Quantity'
                }
            },
            legend: {
                position: 'top', 
                horizontalAlign: 'center', 
                floating: true, 
                labels: {
                    style: {
                        fontSize: '14px',
                        fontWeight: 'bold'
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            }
        };

        var chart = new ApexCharts(document.querySelector("#line_chart_datalabels"), options);
        chart.render();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var chartElement = document.getElementById('doughnut-chart');
        var conditionSelect = document.getElementById('conditionSelect');

        var data = @json($data);

        function renderChart(condition) {
            var myChart = echarts.init(chartElement);

            var option = {
                title: {
                    text: 'Aset : ' + condition,
                    left: 'center'
                },
                tooltip: {
                    trigger: 'item'
                },
                legend: {
                    top: 'bottom'
                },
                series: [
                    {
                        name: 'Kondisi Aset',
                        type: 'pie',
                        radius: '50%',
                        data: [
                            { value: data[condition].baan, name: 'Sistem', itemStyle: { color: '#3faafc' } },
                            { value: data[condition].actual, name: 'Actual', itemStyle: { color: '#0ad8a7' } }
                        ],
                        emphasis: {
                            itemStyle: {
                                borderColor: '#fff',
                                borderWidth: 1
                            }
                        }
                    }
                ]
            };

            myChart.setOption(option);
        }

        renderChart(conditionSelect.value);
        conditionSelect.addEventListener('change', function () {
            renderChart(this.value);
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var options = {
            series: [
                {
                    name: 'Asset Sistem',
                    data: @json(array_values(array_column($data1, 'baan')))
                },
                {
                    name: 'Asset Actual',
                    data: @json(array_values(array_column($data1, 'actual')))
                }
            ],
            chart: {
                type: 'line',
                height: 350
            },
            xaxis: {
                categories: @json(array_keys($data1)),
                tickAmount: @json(count(array_keys($data1))),
                title: {
                    text: 'Department'
                },
                labels: {
                    rotate: -45, 
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                title: {
                    text: 'Quantity'
                }
            },
            legend: {
                position: 'top', 
                horizontalAlign: 'center',
                floating: true, 
                labels: {
                    style: {
                        fontSize: '14px',
                        fontWeight: 'bold'
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            }
        };

        var chart = new ApexCharts(document.querySelector("#line_chart_datalabels1"), options);
        chart.render();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var chartElement = document.getElementById('doughnut-chart1');
        var conditionSelect = document.getElementById('conditionSelect1');

        var data = @json($data1);

        function renderChart(condition) {
            var myChart = echarts.init(chartElement);

            var option = {
                title: {
                    text: 'Aset : ' 
                    + condition,
                    left: 'center'
                },
                tooltip: {
                    trigger: 'item'
                },
                legend: {
                    top: 'bottom'
                },
                series: [
                    {
                        name: 'Kondisi Aset',
                        type: 'pie',
                        radius: '50%',
                        data: [
                            { value: data[condition].baan, name: 'Sistem', itemStyle: { color: '#3faafc' } },
                            { value: data[condition].actual, name: 'Actual', itemStyle: { color: '#0ad8a7' } }
                        ],
                        emphasis: {
                            itemStyle: {
                                borderColor: '#fff',
                                borderWidth: 1
                            }
                        }
                    }
                ]
            };

            myChart.setOption(option);
        }

        renderChart(conditionSelect.value);
        conditionSelect.addEventListener('change', function () {
            renderChart(this.value);
        });
    });
</script>
@endsection
