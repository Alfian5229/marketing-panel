@extends('layouts.app', [ 'activepage' => 'datatotaluser', 'title' => 'Dashboard'])

@section('content')

    <div class="container-fluid mt-6">
        <div class="card">
            <div class="card-header bg-transparent">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="h3 mb-0">Total User By Asal Kota Tahun 2019</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>Asal Kota</th>
                                <th>Total User</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key)
                                <tr>
                                    <td>{{$key->asal_kota}}</td>
                                    <td>{{$key->total_user}}</td>
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
                "order": [[ 1, "desc" ]]
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