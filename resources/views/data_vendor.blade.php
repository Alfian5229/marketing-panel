@extends('layouts.app', [ 'activepage' => 'dashboard', 'title' => 'Dashboard'])

@section('content')

    <div class="container-fluid mt-6">
        <div class="card">
            <div class="card-header bg-transparent">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-uppercase text-muted ls-1 mb-1">Bulan {{$bulan}}</h6>
                        <h5 class="h3 mb-0">Vendor</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable-basic">
                        <thead class="thead-light">
                            <tr>
                                <th rowspan="2">ID Vendor</th>
                                <th rowspan="2">Total Product Terjual</th>
                            </tr>
                            <tr>
                                <th>Status Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key)
                                <tr>
                                    <td><a href="/dataproductvendor/{{$bulan}}/{{$key->supliyer_id}}/{{$key->transaksi_status}}">{{$key->supliyer_id}}</a></td>
                                    <td>{{$key->total_product_terjual}}</td>
                                    @if($key->transaksi_status === 'Active')
                                        <td style="color: green">{{$key->transaksi_status}}</td>
                                    @endif
                                    @if($key->transaksi_status === 'Gagal')
                                        <td style="color: red">{{$key->transaksi_status}}</td>
                                    @endif
                                    @if($key->transaksi_status === 'Refund')
                                        <td>{{$key->transaksi_status}}</td>
                                    @endif
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