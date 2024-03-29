@section('title', 'Data Transaksi')

<x-app-layout>

    <x-slot name="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="mb-4 breadcrumb">
                <li class="breadcrumb-item">
                    <!-- if breadcrumb is single--><span>
                        <a href="{{ route('admin.') }}">Home</a>
                    </span>
                </li>
                <li class="breadcrumb-item active"><span>Data Transaction</span></li>
            </ol>
        </nav>
    </x-slot>

    <div class="px-3 body flex-grow-1">
        <div class="container-lg">
            @if (session()->has('response'))
                @if (session()->get('response')['status'] == 200)
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('response')['message'] }}
                    </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('response')['message'] }}
                    </div>
                @endif
            @endif

            <x-filter-wrapper>
                <form id="submit-filter">
                    <input type="hidden" id="count" value="2">
                    <div class="row">
                        <div class="mb-3 col-sm-6 col-md-6 col-lg-3">
                            <label for="date-start">Date Start :</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='cil-calendar'></i></span>
                                <input type="text" class="form-control" name="date-start" value="{{ $date_start }}"
                                    id="date-start">
                            </div>
                        </div>
                        <div class="mb-3 col-sm-6 col-md-6 col-lg-3">
                            <label for="date-end">Date End :</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='cil-calendar'></i></span>
                                <input type="text" class="form-control" name="date-end" value="{{ $date_end }}"
                                    id="date-end">
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 row">
                        <div class="flex-row-reverse gap-1 col-md-12 d-flex">
                            <button type="submit" class="btn btn-primary">Apply</button>
                            <a id="reset-filter" href="javascript:void(0)" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>
            </x-filter-wrapper>

            <div class="mb-4 card">
                <div class="flex-row card-header d-flex justify-content-between">
                    <strong>Data</strong>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-coreui-toggle="modal"
                        data-coreui-target="#modal">
                        <i class='cil-note-add'></i> Import Data
                    </button>
                </div>
                <div class="card-body">
                    <div class="example">
                        <div class="tab-content rounded-bottom">
                            <div class="p-3 tab-pane active preview" role="tabpanel" id="preview-1002">
                                <table id="datatable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Tanggal Transaksi</th>
                                            <th scope="col">Kode Transaksi</th>
                                            <th scope="col">Nama Barang</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Tanggal Dibuat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.data-transaction.import') }}" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Import Data Transaction</h5>
                        <button type="button" class="btn-close" data-coreui-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}

                        <div class="mb-3">
                            <label for="file" class="form-label">Pilih file excel</label>
                            <input class="form-control" type="file" id="file" name="file" accept=".xlsx">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>


<script defer>
    var table;

    $(document).ready(function() {

        datePicker($('#date-start'), $('#date-end'));

        table = $('#datatable').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'pageLength'
                },
                {
                    extend: 'excel',
                    text: "Download Excel",
                    title: `Data Transaksi - Periode {{ $date_start }} - {{ $date_end }}`,
                    action: newexportaction,
                    fieldBoundary: '',
                    fieldSeparator: ';',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5]
                    }
                }
            ],
            processing: true,
            pageLength: 10,
            lengthMenu: [
                [10, 50, 100, 500],
                [10, 50, 100, 500]
            ],
            serverSide: true,
            paging: true,
            deferRender: true,
            scrollX: true,
            scrollCollapse: true,
            info: true,
            language: {
                "processing": '<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>'
            },
            ajax: {
                url: "{{ route('admin.data-transaction.get_data') }}",
                type: 'get',
                data: function(data) {
                    const urlParams = new URLSearchParams(window.location.search);
                    data.date_start = urlParams.get('date-start') ?? null;
                    data.date_end = urlParams.get('date-end') ?? null;
                }
            },
            order: [
                [1, 'desc'],
            ],
            columnDefs: [{
                    targets: [0, 4],
                    className: 'dt-center'
                },
                {
                    targets: [0],
                    width: "6%"
                }
            ],
            columns: [{
                    data: 'No',
                    searchable: false,
                    orderable: false
                },
                {
                    data: "DT",
                    name: 'date',
                    searchable: false
                },
                {
                    data: "TC",
                    name: "transaction_code"
                },
                {
                    data: "IN",
                    name: "detail_transaction.item_name"
                },
                {
                    data: "QTY",
                    name: "detail_transaction.quantity",
                    searchable: false
                },
                {
                    data: "Date Created",
                    name: 'created_at',
                    searchable: false
                },
            ]
        })

        table.on('draw.dt', function() {
            var info = table.page.info();
            table.column(0, {
                search: 'applied',
                order: 'applied',
                page: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1 + info.start;
            });
        });
    })
</script>
