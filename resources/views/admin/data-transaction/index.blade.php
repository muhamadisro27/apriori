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
            <div class="car"></div>
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
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Kode Transaksi</th>
                                            <th scope="col">Nama Barang</th>
                                            <th scope="col">Qty</th>
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

        table = $('#datatable').DataTable({
            dom: 'Blfrtip',
            buttons: [{
                    extend: 'pageLength'
                },
                {
                    extend: 'excel',
                    text: "Download Excel",
                    title: `Data Transaction - ${moment().format('YYYY-MM-DD')}`,
                    action: newexportaction,
                    fieldBoundary: '',
                    fieldSeparator: ';',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
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
                }
            },
            order: [
                [0, 'desc']
            ],
            columnDefs: [{
                    targets: [0],
                    className: 'dt-center'
                },
                {
                    targets: [0],
                    width: "15%"
                }
            ],
            columns: [{
                    data: "Date",
                    name: 'date',
                    searchable: false
                },
                {
                    data: "TC",
                    name: "transaction_code"
                },
                {
                    data: "IN",
                    name: "items"
                },
                {
                    data: "QTY",
                    name: "total_quantity"
                },
            ]
        })
    })
</script>
