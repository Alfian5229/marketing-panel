@extends('layouts.app', [ 'activepage' => 'dashboard', 'title' => 'Dashboard'])

@section('content')

    <div class="container-fluid mt-6">
        <div class="card">
            <div class="card-header bg-transparent">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="text-uppercase text-muted ls-1 mb-1">Bulan {{$bulan}}</h6>
                        <h5 class="h3 mb-0">Product Terlaris Perhari</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Type Product</th>
                                @for ($i = 1; $i < $max_tanggal+1; $i++)
                                    <th>Day {{$i}}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key)
                                <tr>
                                    <td>{{$key->product_kode}}</td>
                                    <td>{{$key->product_name}}</td>
                                    <td>{{$key->type_product}}</td>
                                    @for ($i = 1; $i < $max_tanggal+1; $i++)
                                        @php
                                            $day = 'day_' . $i;
                                        @endphp
                                        @if($key->$day === 0)
                                            <td class="text-center" style="color: red"><?php echo $key->$day ?></td>
                                        @else
                                            <td class="text-center"><?php echo $key->$day ?></td>
                                        @endif
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
            "order": [[ 2, "asc" ]]
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