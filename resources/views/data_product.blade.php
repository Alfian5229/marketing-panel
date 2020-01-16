@extends('layouts.app', [ 'activepage' => 'dashboard', 'title' => 'Dashboard'])

@section('content')

    <div class="container-fluid mt-6">
        <div class="card">
            <div class="card-header bg-transparent">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-uppercase text-muted ls-1 mb-1">Bulan {{$bulan}}</h6>
                        <h5 class="h3 mb-0">Product Terlaris Berdasarkan Vendor</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable-basic">
                        <thead class="thead-light">
                            <tr>
                                <th rowspan="2">Product Code</th>
                                <th rowspan="2">Vendor ID</th>
                                <th rowspan="2">Total Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key)
                                <tr>
                                    <td>{{$key->product_kode}}</td>
                                    <td>{{$key->supliyer_id}}</td>
                                    <td>{{$key->total_terjual}}</td>
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
        // $(document).ready( function () {
        //     $('#myTable').DataTable(
        //         {
        //             processing: true,
        //             serverSide: true,
        //             ajax: '/datatrx/json/januari',
        //             columns: [
        //                 { data: 'mbr_code', name: 'mbr_code' },
        //                 { data: 'full_name', name: 'full_name' },
        //                 { data: 'phone', name: 'phone' }
        //             ]
        //         }
        //     );
        // });
    </script>
@endpush