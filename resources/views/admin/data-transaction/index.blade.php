@section('title', 'Data Transaction')

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
            <div class="car"></div>
            <div class="mb-4 card">
                <div class="flex-row card-header d-flex justify-content-between">
                    <strong>Data</strong>
                    <a href="javascript:void(0)" id="import-data" class="btn btn-sm btn-primary"><i
                        class='cil-note-add'></i> Import Data</a>
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
