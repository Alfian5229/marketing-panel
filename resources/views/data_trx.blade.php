@extends('layouts.app', [ 'activepage' => 'dashboard', 'title' => 'Dashboard'])

@section('content')

    <div class="container-fluid mt-6">
        <div class="card">
            <div class="card-header bg-transparent">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-uppercase text-muted ls-1 mb-1">ini judul</h6>
                        <h5 class="h3 mb-0">ini juga</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable-basic">
                        <thead class="thead-light text-center">
                            <tr>
                                <th rowspan="2">mbr code</th>
                                <th rowspan="2">full name</th>
                                <th rowspan="2">phone</th>
                                <th colspan="2">tanggal 1</th>
                                <th colspan="2">tanggal 2</th>
                            </tr>
                            <tr>
                                <th>Count</th>
                                <th>Sum</th>
                                <th>Count</th>
                                <th>Sum</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key)
                                <tr>
                                    <td>{{$key->mbr_code}}</td>
                                    <td>{{$key->full_name}}</td>
                                    <td>{{$key->phone}}</td>
                                    <td class="text-right">{{$key->count_1}}</td>
                                    <td class="text-right">{{$key->sum_1}}</td>
                                    <td class="text-right">{{$key->count_2}}</td>
                                    <td class="text-right">{{$key->sum_2}}</td>
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
            $('#myTable').DataTable();
        });
    </script>
@endpush