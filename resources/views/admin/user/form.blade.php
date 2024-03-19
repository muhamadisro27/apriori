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
                                value="{{ old('phone_number', isset($user->id) ? $user->phone_number : null) }}"
                                placeholder="x888">
                            <x-error-message id="phone_number" />
                        </div>
                        @if (!isset($user->id))
                            <div class="mb-3 col-md-6 col-sm-12">
                                <x-input-label id="password" value="Password" />
                                <div class="password-wrapper">
                                    <input type="password" id="password" class="password form-control"
                                        value="{{ old('password', isset($user->id) ? $user->password : null) }}"
                                        placeholder="fill the password" name="password" />
                                    <span class="hide-password">
                                        <svg style="width:30px; height:30px; padding-top:8px;"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </span>
                                    <span style="display: none;" class="show-password">
                                        <svg style="width:30px; height:30px; padding-top:8px;"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                        </svg>
                                    </span>
                                </div>
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
                            <a href="{{ route('admin.user.') }}" class=" btn btn-secondary">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        @push('script-processing')
            <script defer>
                $(document).ready(function() {

                    const hidePassword = document.querySelectorAll('.hide-password')
                    const showPassword = document.querySelectorAll('.show-password')
                    const form = $('#form');
                    const type = $('#type').val();

                    hidePassword.forEach((hide) => {
                        hide.addEventListener('click', () => {
                            hide.previousElementSibling.setAttribute('type', 'text')
                            hide.nextElementSibling.style.display = 'block'
                            hide.style.display = 'none'
                        })
                    })

                    showPassword.forEach((show) => {
                        show.addEventListener('click', () => {
                            show.previousElementSibling.previousElementSibling.setAttribute('type',
                                'password')
                            show.previousElementSibling.style.display = 'block'
                            show.style.display = 'none'
                        })
                    })

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
