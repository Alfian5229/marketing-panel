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
                    <table class="table table-flush" id="myTable">
                        <thead class="thead-light text-center">
                            <tr>
                                <th>mbr code</th>
                                <th>full name</th>
                                <th>phone</th>
                                {{-- @for ($i = 1; $i < $max_tanggal+1; $i++)
                                    <th colspan="2">tanggal {{$i}}</th>
                                @endfor --}}
                            </tr>
                            {{-- <tr>
                                @for ($i = 1; $i < $max_tanggal+1; $i++)
                                    <th>Sum</th>
                                    <th>Count</th>
                                @endfor
                            </tr> --}}
                        </thead>
                        <tbody>
                            @foreach ($data as $key)
                                <tr>
                                    <td>{{$key->mbr_code}}</td>
                                    <td>{{$key->full_name}}</td>
                                    <td>{{$key->phone}}</td>
                                    @for ($i = 1; $i < $max_tanggal+1; $i++)
                                        @php
                                            $sum = 'sum_' . $i;
                                            $count = 'count_' . $i;
                                        @endphp
                                        <td class="text-right">{{$key->$sum}}</td>
                                        <td class="text-right">{{$key->$count}}</td>
                                    @endfor
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
        //     $('#myTable').DataTable({
        //         processing: true,
        //         serverSide: true,
        //         ajax: '/datatrx/json/1',
        //         // "ajax": {
        //         //     "url": "/datatrx/json/1",
        //         //     "dataType": "json"
        //         //     "type": 'POST',
        //         //     "data": {"_token": "<?= csrf_token() ?>"},
        //         // }
        //         columns: [
        //             { data: 'mbr_code', name: 'mbr_code'},
        //             { data: 'full_name', name: 'full_name'},
        //             { data: 'phone', name: 'phone'}
        //         ]
        //     });
        // });

        $(document).ready( function () {
            $('#myTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url" : "/datatrx/json/1",
                    "dataType": "json",
                    "type": "POST",
                    "data": {"_token": "<?= csrf_token()?>" }
                },
                "columns" : [
                    {"data": "mbr_code"},
                    {"data": "full_name"},
                    {"data": "phone"}
                ]
            });
        });
    </script>
@endpush