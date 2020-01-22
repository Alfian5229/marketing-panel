@extends('layouts.app', [ 'activepage' => 'dashboard', 'title' => 'Dashboard'])

@section('content')

    <div class="container-fluid mt-6">
        <div class="card">
            <div class="card-header bg-transparent">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="text-uppercase text-muted ls-1 mb-1">Data Transaksi Bulan {{$bulan}}</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="example">
                        <thead class="thead-light text-center">
                            <tr>
                                <th rowspan="2">mbr code</th>
                                <th rowspan="2">full name</th>
                                <th rowspan="2">phone</th>
                                <th rowspan="2">super_active</th>
                                @for ($i = 1; $i < $max_tanggal+1; $i++)
                                    <th colspan="2">tanggal {{$i}}</th>
                                @endfor
                            </tr>
                            <tr>
                                @for ($i = 1; $i < $max_tanggal+1; $i++)
                                    <th>Sum</th>
                                    <th>Count</th>
                                @endfor
                            </tr>
                        </thead>
                        <tfoot class="text-right">
                            <th colspan="3">Total/Jumlah Semua Data Bulan {{$bulan}}</th>
                            <th>Active User = {{$total_super_active->active_user}}, Inactive User = {{$total_super_active->inactive_user}}</th>
                            @for ($i = 1; $i < 1+$max_tanggal; $i++)
                                @php
                                    $sum = 'sum_' . $i;
                                    $count = 'count_' . $i;
                                @endphp
                                <th>Rp {{number_format($total->$sum,2,',','.')}}</th>
                                <th>{{$total->$count}}</th>
                            @endfor
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url" : "/datatrx/json/" + {{$bulan}} + "/" + {{$tahun}},
                "dataType": "json",
                "type": "POST",
                "data": {"_token": "<?= csrf_token()?>" }
            },
            "columns" : [
                {"data": "mbr_code"},
                {"data": "full_name"},
                {"data": "phone"},
                {"data": "super_active",
                    render: function (data, type, row) {
                        if (data >= 15)
                            return '<span class="badge badge-success">Active</span>';
                        return '<span class="badge badge-warning">Inactive</span>';
                    }
                },
                @for ($i = 1; $i < $max_tanggal+1; $i++)
                    {"data": "sum_{{$i}}"},
                    {"data": "count_{{$i}}"},
                @endfor
            ],
            select: {
                style: "multi"
            },
            language: {
                paginate: {
                    previous: "<i class='fas fa-angle-left'>",
                    next: "<i class='fas fa-angle-right'>"
                }
            },
        });
    </script>
@endpush