@extends('layouts.app', [ 'activepage' => 'dashboard', 'title' => 'Dashboard'])

@section('content')

    <div class="container-fluid mt-6">
        <div class="card">
            <div class="card-header bg-transparent">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-uppercase text-muted ls-1 mb-1"></h6>
                        @if ($awal === '65')
                            <h5 class="h3 mb-0">DATA Umur User {{$awal}} Tahun Keatas</h5>
                        @else
                            <h5 class="h3 mb-0">DATA Umur User {{$awal}} sampai {{$akhir}} Tahun</h5>
                        @endif
                        
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable-basic">
                        <thead class="thead-light">
                            <tr>
                                <th rowspan="2">MBR Code</th>
                                <th rowspan="2">MBR Sponsor</th>
                                <th rowspan="2">MBR Upline</th>
                                <th rowspan="2">MBR Type</th>
                                <th rowspan="2">MBR Nama</th>
                            </tr>
                            <tr>
                                <th>Umur</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key)
                                <tr>
                                    <td>{{$key->mbr_code}}</td>
                                    <td>{{$key->mbr_sponsor}}</td>
                                    <td>{{$key->mbr_upline}}</td>
                                    <td>{{$key->mbr_type}}</td>
                                    <td>{{$key->mbr_name}}</td>
                                    <td>{{$key->umur}}</td>
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
        $(document).ready( function () {
            $('#datatable-basic').DataTable(
                {
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "/datatrx/bulan/1",
                        "dataType": "json"
                        "type": "POST",
                        "data": {"_token": "<?= csrf_token() ?>"},
                    }
                    "columns": [
                        { "data": 'mbr_code'},
                        { "data": 'full_name'},
                        { "data": 'phone'}
                    ]
                }
            );
        });
    </script>
@endpush