@extends('layouts.app', [ 'activepage' => 'rekap_mbr_reg_upline_2018' . $tahun, 'title' => 'Rekapitulasi Data Member Register ' . $tahun])

@section('content')

    <div class="container-fluid mt-6">
        <div class="card">
            <div class="card-header bg-transparent">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="h3 mb-0">Rekapitulasi Data Member Register By Mbr Sponsor/Upline Id Tahun {{$tahun}}</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th>Bulan</th>
                                <th>Total Member Mbr Sponsor Public</th>
                                <th>Total Member Mbr Sponsor Promosi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key)
                                <tr class="text-right">
                                    <td class="text-left">{{$key->bulan}}</td>
                                    <td>{{$key->total_public}}</td>
                                    <td>{{$key->total_sponsor}}</td>
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
                "order": [],
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