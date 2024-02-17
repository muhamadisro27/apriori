@section('title', 'Hasil Apriori')

<x-app-layout>

    <x-slot name="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="mb-4 breadcrumb">
                <li class="breadcrumb-item">
                    <!-- if breadcrumb is single--><span>
                        <a href="{{ route('admin.') }}">Home</a>
                    </span>
                </li>
                <li class="breadcrumb-item active"><span>Hasil Apriori</span></li>
            </ol>
        </nav>
        @if (session()->has('message'))
            <div class="alert alert-info" role="alert">
                {{ session()->get('message') }}
            </div>
        @endif
        <x-filter-wrapper title="Apriori">

            <form id="form" method="post" action="{{ route('admin.apriori-process.') }}">
                @csrf
                <input type="hidden" class="form-control" name="k-itemset" value="{{ session()->get('k-itemset') }}"
                id="k-itemset">
                <div class="row">
                    <div class="mb-3 col-sm-6 col-md-6 col-lg-3">
                        <label for="date-start">Date Start :</label>
                        <div class="mb-1 input-group">
                            <span class="input-group-text"><i class='cil-calendar'></i></span>
                            <input type="text" class="form-control" name="date-start" value="{{ $date_start }}"
                                id="date-start">
                        </div>
                        <x-input-error :messages="$errors->get('date-start')" class="mt-2" />
                    </div>
                    <div class="mb-3 col-sm-6 col-md-6 col-lg-3">
                        <label for="date-end">Date End :</label>
                        <div class="mb-1 input-group">
                            <span class="input-group-text"><i class='cil-calendar'></i></span>
                            <input type="text" class="form-control" name="date-end" value="{{ $date_end }}"
                                id="date-end">
                        </div>
                        <x-input-error :messages="$errors->get('date-end')" class="mt-2" />
                    </div>

                    <div class="mb-3 col-sm-6 col-md-6 col-lg-3">
                        <label for="support">Minimum Support :</label>
                        <div class="mb-1 input-group">
                            <input type="text" class="form-control" name="support"
                                placeholder="masukkan angka support.." onkeypress="validate_keypress(event)"
                                id="support" value="{{ old('support', isset($support) ? $support : null) }}">
                            <span class="input-group-text">%</span>
                        </div>
                        <x-input-error :messages="$errors->get('support')" class="mt-2" />
                    </div>
                    <div class="mb-3 col-sm-6 col-md-6 col-lg-3">
                        <label for="confidence">Minimum Confidence :</label>
                        <div class="mb-1 input-group">
                            <input type="text" class="form-control" name="confidence"
                                placeholder="masukkan angka confidence.." onkeypress="validate_keypress(event)"
                                id="confidence"
                                value="{{ old('confidence', isset($confidence) ? $confidence : null) }}">
                            <span class="input-group-text">%</span>
                        </div>
                        <x-input-error :messages="$errors->get('confidence')" class="mt-2" />
                    </div>
                </div>


                <div class="mt-3 row">
                    <div class="flex-row-reverse gap-1 col-md-12 d-flex">
                        <button type="submit" class="btn btn-primary">Proses</button>
                    </div>
                </div>
            </form>

        </x-filter-wrapper>

        <x-filter-wrapper
            title="Hasil Apriori - Kombinasi ke-{{ $title }}, Jumlah Transaksi : {{ $total_transaction }}">
            <x-slot name="button">
                <form id="form" method="post" action="{{ route('admin.apriori-process.') }}">
                    @csrf
                    <div class="row">
                        <input type="hidden" class="form-control" name="date-start" value="{{ $date_start }}"
                            id="date-start">
                        <input type="hidden" class="form-control" name="date-end" value="{{ $date_end }}"
                            id="date-end">
                        <input type="hidden" class="form-control" name="k-itemset" value="{{ session()->get('k-itemset') }}"
                            id="k-itemset">
                        <input type="hidden" class="form-control" name="support" placeholder="masukkan angka support.."
                            onkeypress="validate_keypress(event)" id="support"
                            value="{{ old('support', isset($support) ? $support : null) }}">
                        <input type="hidden" class="form-control" name="confidence"
                            placeholder="masukkan angka confidence.." onkeypress="validate_keypress(event)"
                            id="confidence" value="{{ old('confidence', isset($confidence) ? $confidence : null) }}">
                    </div>
                    <div class="flex-row-reverse gap-1 col-md-12 d-flex">
                        <button type="submit" class="btn btn-primary">Itemset {{ $title + 1 }} >></button>
                    </div>
                    </div>
                </form>


                <div class="card-body">
                    <div class="example">
                        <div class="tab-content rounded-bottom">
                            <div class="p-3 tab-pane active preview" role="tabpanel" id="preview-1002">
                                <table id="datatable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kode Barang</th>
                                            <th scope="col">Nama Barang</th>
                                            <th scope="col">Frekuensi</th>
                                            <th scope="col">Support Count</th>
                                            <th scope="col">Min Support</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </x-slot>

        </x-filter-wrapper>
    </x-slot>


</x-app-layout>

<script defer>
    $(document).ready(function() {
        datePicker($('#date-start'), $('#date-end'), false);

        table = $('#datatable').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'pageLength'
                },
                {
                    extend: 'excel',
                    text: "Download Excel",
                    title: `Hasil Apriori itemset ke-{{ $title }} - Periode {{ $date_start }} - {{ $date_end }}`,
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
                url: "{{ route('admin.apriori-process.get-data') }}",
                type: 'get',
                data: function(data) {
                    const urlParams = new URLSearchParams(window.location.search);
                    data.date_start = $('#date-start').val() ?? null;
                    data.date_end = $('#date-end').val() ?? null;
                    data.minimal_confidence = $('#confidence').val() ?? null;
                    data.minimal_support = $('#support').val() ?? null;
                    data.k = $('#k').val() ?? null;
                }
            },
            order: [
                [1, 'asc']
            ],
            columnDefs: [{
                    targets: [0, 3, 4, 5],
                    className: 'dt-center'
                },
                {
                    targets: [0],
                    width: "6%"
                }
            ],
            createdRow: function( row, data, dataIndex){
                if(data.support_count >= data.minimal_support) {
                    $(row).addClass('greenClass');
                } else {
                    $(row).addClass('redClass');
                }
            },
            columns: [{
                    data: 'No',
                    searchable: false,
                    orderable: false
                },
                {
                    data: "Item Code",
                    name: 'item_code',
                    searchable: false
                },
                {
                    data: "Item Name",
                    name: "item_name"
                },
                {
                    data: "Frequently",
                    name: "frequently"
                },
                {
                    data: "Support Count",
                    name: "support_count",
                    searchable: false
                },
                {
                    data: "Minimal Support",
                    name: 'minimal_support',
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
