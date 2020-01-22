@extends('layouts.app', [ 'activepage' => 'dashboard', 'title' => 'Dashboard'])

@section('content')

    <div class="container-fluid mt-6">
        <div class="card">
            <div class="card-header bg-transparent">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-uppercase text-muted ls-1 mb-1">Bulan {{$bulan}}</h6>
                        <h5 class="h3 mb-0">Code Vendor : {{$vendor}}</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable-basic">
                        <thead class="thead-light">
                            <tr>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Total Terjual</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key)
                                <tr>
                                    <td>{{$key->product_kode}}</td>
                                    <td>{{$key->product_name}}</td>
                                    <td>{{$key->total_terjual}}</td>
                                    <td>{{$key->transaksi_status}}</td>
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
        //     $('#datatable-basic').DataTable(
        //         {
        //             processing: true,
        //             serverSide: true,
        //             ajax: '/datatrx/json/januari',
        //             columns: [
        //                 { data: 'product_kode', name: 'product_kode' },
        //                 { data: 'total_terjual', name: 'total_terjual' }
        //             ]
        //         }
        //     );
        // });
    </script>
@endpush