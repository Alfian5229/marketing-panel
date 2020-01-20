@extends('layouts.app', [ 'activepage' => 'dashboard', 'title' => 'Dashboard'])

@section('content')

    <div class="container-fluid mt-6">
        <div class="card">
            <div class="card-header bg-transparent">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-uppercase text-muted ls-1 mb-1">Selamat Datang</h6>
                        <h5 class="h3 mb-0">Selamat Datang</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h4>Selamat Datang</h4>
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