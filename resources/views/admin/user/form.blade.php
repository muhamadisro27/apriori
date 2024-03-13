@section('title', isset($user->id) ? 'Edit User' : 'Create User')

<x-app-layout>
    <x-slot name="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="mb-4 breadcrumb">
                <li class="breadcrumb-item">
                    <!-- if breadcrumb is single--><span>
                        <a href="{{ route('admin.') }}">Home</a>
                    </span>
                </li>
                <li class="breadcrumb-item active"><span>User</span></li>
            </ol>
        </nav>

    <div class="mb-4 card">
        <div class="flex-row card-header d-flex justify-content-between">
            <strong>Notes</strong>
        </div>
        <div class="card-body">
            <ul>
                <li>Password must contain at least 8 characters</li>
                <li>Password must contain at least 1 number</li>
                <li>Password must contain at least 1 unique character</li>
            </ul>
        </div>
    </div>

    <div class="mb-4 card">
        <div class="card-body">
            <form id="form" action="{{ route('admin.user.save', $user->uuid) }}" method="post">
                <input type="hidden" id="type" value="{{ isset($user->id) ? 'edit' : 'create' }}">
                <div class="row">
                    <div class="mb-3 col-md-6 col-sm-12">
                        <x-input-label id="name" value="Name" />
                        <input type="text" class="form-control name" id="name"
                            value="{{ old('name', isset($user->id) ? $user->name : null) }}" placeholder="john doe">
                        <x-error-message id="name" />
                    </div>
                    <div class="mb-3 col-md-6 col-sm-12">
                        <x-input-label id="email" value="Email Address" />
                        <input type="email" class="form-control name" id="email"
                            value="{{ old('email', isset($user->id) ? $user->email : null) }}"
                            placeholder="john@example.com">
                        <x-error-message id="email" />
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6 col-sm-12">
                        <x-input-label id="phone_number" value="Phone Number" />
                        <input type="text" class="form-control phone_number" id="phone_number"
                            value="{{ old('phone_number', isset($user->id) ? $user->phone_number : null) }}" placeholder="x888">
                        <x-error-message id="phone_number" />
                    </div>
                    @if (!isset($user->id))
                        <div class="mb-3 col-md-6 col-sm-12">
                            <x-input-label id="password" value="Password" />
                            <input type="password" class="form-control" id="password"
                                value="{{ old('password', isset($user->id) ? $user->password : null) }}"
                                placeholder="fill the password">
                            <x-error-message id="password" />
                        </div>
                    @endif
                </div>

                <div class="mt-3 row">
                    <div class="flex-row-reverse gap-1 col-md-12 d-flex">
                        <button type="submit"
                            class="text-white btn btn-primary">{{ isset($user->id)
                                ? 'Save
                                                                                    Changes'
                                : 'Submit' }}</button>
                        <a href="{{ route('admin.user.') }}"
                            class=" btn btn-secondary">Back</a>
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
                    name: {
                        attribute: $('#name'),
                        field: 'name',
                        label: 'Name',
                        validationRules: {
                            required: true,
                            min: 3,
                            max: 50
                        },
                        value: $('#name').val()
                    },
                    email: {
                        attribute: $('#email'),
                        field: 'email',
                        label: 'Email',
                        validationRules: {
                            required: true,
                            min: 3,
                            max: 50
                        },
                        value: $('#email').val()
                    },
                    phone_number: {
                        attribute: $('#phone_number'),
                        field: 'phone_number',
                        label: 'Phone Number',
                        validationRules: {
                            required: true,
                            min: 3,
                            max: 50
                        },
                        value: $('#phone_number').val()
                    },
                }

                if (type == 'create') {
                    Object.assign(forms, {
                        password: {
                            attribute: $('#password'),
                            field: 'password',
                            label: 'Password',
                            validationRules: {
                                required: true,
                                min: 3,
                                max: 50
                            },
                            value: $('#password').val()
                        },
                    })
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

                    save(forms, form, formData, '{{ route('admin.user.') }}');
                })
            })
        </script>
    @endpush
</x-app-layout>
