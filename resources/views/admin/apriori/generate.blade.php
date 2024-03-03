@section('title', 'Hasil Generate Apriori')

<x-app-layout>

    <x-slot name="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="mb-4 breadcrumb">
                <li class="breadcrumb-item">
                    <!-- if breadcrumb is single--><span>
                        <a href="{{ route('admin.') }}">Home</a>
                    </span>
                </li>
                <li class="breadcrumb-item active"><span>Hasil Generate Apriori</span></li>
            </ol>
        </nav>
        @if (session()->has('message'))
            <div class="alert alert-info" role="alert">
                {{ session()->get('message') }}
            </div>
        @endif

        <input type="hidden" name="date_start" id="date-start" value="{{ $date_start }}">
        <input type="hidden" name="date_end" id="date-end" value="{{ $date_end }}">
        <input type="hidden" name="k" id="k" value="{{ $k }}">
        <input type="hidden" name="current_apriori_id" id="current_apriori_id" value="{{ $current_apriori_id }}">
        <input type="hidden" name="confidence" id="confidence" value="{{ $confidence }}">

        <x-filter-wrapper title="Hasil generate rule itemset ke {{ $k }}">

                <div class="example">
                    <div class="tab-content rounded-bottom">
                        <div class="p-3 tab-pane active preview" role="tabpanel" id="preview-1002">
                            <table id="datatable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Association Rule</th>
                                        <th scope="col">Confidence</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

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
                    title: `Hasil Generate Rule - Periode {{ $date_start }} - {{ $date_end }}`,
                    action: newexportaction,
                    fieldBoundary: '',
                    fieldSeparator: ';',
                    exportOptions: {
                        columns: [0, 1, 2]
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
                url: "{{ route('admin.apriori-process.get-generate-data') }}",
                type: 'get',
                data: function(data) {
                    const urlParams = new URLSearchParams(window.location.search);
                    data.date_start = $('#date-start').val() ?? null;
                    data.date_end = $('#date-end').val() ?? null;
                    data.k = $('#k').val() ?? null;
                    data.current_apriori_id = $('#current_apriori_id').val() ?? null;
                    data.confidence = $('#confidence').val() ?? null;
                }
            },
            order: [
                [2, 'desc']
            ],
            columnDefs: [{
                    targets: [0, 1, 2],
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
                    data: "Association Rule",
                    searchable: false
                },
                {
                    data: "Confidence",
                    name: "confidence",
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
