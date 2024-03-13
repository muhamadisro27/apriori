@section('title', isset($item->id) ? 'Edit Item' : 'Create Item')

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

        <div class="mb-4 card">
            <div class="card-body">
                <form id="form" action="{{ route('admin.item.save', $item->uuid) }}" method="post">
                    <input type="hidden" id="type" value="{{ isset($item->id) ? 'edit' : 'create' }}">
                    <div class="row">
                        <div class="mb-3 col-md-6 col-sm-12">
                            <x-input-label id="item_name" value="Item Name" />
                            <input type="text" class="form-control item_name" id="item_name"
                                value="{{ old('item_name', isset($item->id) ? $item->item_name : null) }}" placeholder="Fill your item name">
                            <x-error-message id="item_name" />
                        </div>
                        <div class="mb-3 col-md-6 col-sm-12">
                            <x-input-label id="item_code" value="Item Code" />
                            <input type="text" class="form-control item_code" id="item_code"
                                value="{{ old('item_code', isset($item->id) ? $item->item_code : null) }}" placeholder="Fill your item code">
                            <x-error-message id="item_code" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6 col-sm-12">
                            <x-input-label id="quantity" value="Quantity" />
                            <input type="number" class="form-control quantity" id="quantity"
                                value="{{ old('quantity', isset($item->id) ? $item->quantity : null) }}" placeholder="Fill your quantity">
                            <x-error-message id="quantity" />
                        </div>
                    </div>

                    <div class="mt-3 row">
                        <div class="flex-row-reverse gap-1 col-md-12 d-flex">
                            <button type="submit"
                                class="text-white btn btn-primary">{{ isset($item->id)
                                    ? 'Save
                                                                                                                    Changes'
                                    : 'Submit' }}</button>
                            <a href="{{ route('admin.item.') }}" class=" btn btn-secondary">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        @push('script-processing')
            <script defer>
                $(document).ready(function() {

                    const form = $('#form');
                    const type = $('#type').val();


                    const submitBtn = $('#submit-button');
                    const backBtn = $('#back-button');

                    const forms = {
                        item_name: {
                            attribute: $('#item_name'),
                            field: 'item_name',
                            label: 'Item Name',
                            validationRules: {
                                required: true,
                                min: 3,
                                max: 50
                            },
                            value: $('#item_name').val()
                        },
                        item_code: {
                            attribute: $('#item_code'),
                            field: 'item_code',
                            label: 'Item Code',
                            validationRules: {
                                required: true,
                                min: 3,
                                max: 50
                            },
                            value: $('#item_code').val()
                        },
                        quantity: {
                            attribute: $('#quantity'),
                            field: 'quantity',
                            label: 'Quantity',
                            validationRules: {
                                required: true,
                                min: 3,
                                max: 50
                            },
                            value: $('#quantity').val()
                        },
                    }

                    // Onchange forms
                    fetchingValueOnChanges(forms)

                    form.submit((e) => {

                        e.preventDefault();

                        removeButtons()

                        const error_msg = [];

                        // Validation
                        // validateJS(forms, error_msg)

                        // if (showErrorMessages(error_msg)) {
                        //     setForms(forms, false);
                        //     showButtons();
                        //     return;
                        // }

                        const formData = new FormData();

                        // set form data
                        Object.keys(forms).forEach((form) => {
                            formData.append(form, forms[form].value)
                        });
                        formData.append('type', type);

                        save(forms, form, formData, '{{ route('admin.item.') }}');
                    })
                })
            </script>
        @endpush
</x-app-layout>
