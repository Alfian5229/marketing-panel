@extends('layouts.app', [ 'activepage' => 'rekapitulasi', 'title' => 'Rekapitulasi 2019'])

@section('content')

    <div class="container-fluid mt-6">
        <div class="card">
            <div class="card-header bg-transparent">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="h3 mb-0">Rekapitulasi 2019</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>id</th>
                                <th>Bulan</th>
                                <th>Total Transaksi Sukses</th>
                                <th>Jumlah Transaksi Sukses</th>
                                <th>Total Transaksi Gagal</th>
                                <th>Jumlah Transaksi Gagal</th>
                                <th>Total User Unik Transaksi Sukses</th>
                                <th>Jumlah User Unik Transaksi Gagal</th>
                                <th>Total Super Active Member</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key)
                                <tr class="text-right">
                                    <td>{{$key->id}}</td>
                                    <td class="text-center">{{$key->bulan}}</td>
                                    <td>{{$key->count_sukses}}</td>
                                    <td>Rp. {{number_format($key->sum_sukses,2,',','.')}}</td>
                                    <td>{{$key->count_gagal}}</td>
                                    <td>Rp. {{number_format($key->sum_gagal,2,',','.')}}</td>
                                    <td>{{$key->unique_user_sukses}}</td>
                                    <td>{{$key->unique_user_gagal}}</td>
                                    <td>{{$key->trx_two_days_each}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // Variables
        var $dtBasic = $('#datatable');

        // Methods
        function init($this) {
            var options = {
                keys: !0,
                select: {
                    style: "multi"
                },
                language: {
                    paginate: {
                        previous: "<i class='fas fa-angle-left'>",
                        next: "<i class='fas fa-angle-right'>"
                    }
                },
                "order": [[ 0, "asc" ]],
                "pageLength": 25
            };

            // Init the datatable
            var table = $this.on( 'init.dt', function () {
                $('div.dataTables_length select').removeClass('custom-select custom-select-sm');
            }).DataTable(options);
        }

        // Events
        if ($dtBasic.length) {
            init($dtBasic);
        }
    </script>
@endpush