@section('title', 'Item')

<x-app-layout>

    <x-slot name="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="mb-4 breadcrumb">
                <li class="breadcrumb-item">
                    <!-- if breadcrumb is single--><span>
                        <a href="{{ route('admin.') }}">Home</a>
                    </span>
                </li>
                <li class="breadcrumb-item active"><span>Item</span></li>
            </ol>
        </nav>
        @if (session()->has('message'))
            <div class="alert alert-info" role="alert">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="mb-4 card">
            <div class="flex-row card-header d-flex justify-content-between">
                <strong>Item</strong>
                <!-- Button trigger modal -->
                <a href="{{ route('admin.item.create') }}" class="btn btn-primary">Create Item</a>
            </div>

            <div class="card-body">
                <div class="example">
                    <div class="tab-content rounded-bottom">
                        <div class="p-3 tab-pane active preview" role="tabpanel" id="preview-1002">
                            <table id="datatable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Kode Barang</th>
                                        <th scope="col">Action</th>
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
    </x-slot>


</x-app-layout>

<script defer>
    $(document).ready(function() {


        deleteData()


        table = $('#datatable').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'pageLength'
                },
                {
                    extend: 'excel',
                    text: "Download Excel",
                    title: `Item Download Excel`,
                    action: newexportaction,
                    fieldBoundary: '',
                    fieldSeparator: ';',
                    exportOptions: {
                        columns: [0,1,2]
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
                url: "{{ route('admin.item.get-data') }}",
                type: 'get',
                data: function(data) {
                    const urlParams = new URLSearchParams(window.location.search);
                }
            },
            order: [
                [1, 'desc']
            ],
            columnDefs: [{
                    targets: [0],
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
                    data: "Item Name",
                    name: 'item_name'
                },
                {
                    data: "Item Code",
                    name: 'item_code'
                },
                {
                    data: "Action",
                    name: "action",
                    searchable: false,
                    orderable: false
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
