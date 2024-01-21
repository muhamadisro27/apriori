<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card-group d-block d-md-flex row justify-content-center">
                <div style="background-color: #EDDE58 !important;" class="p-4 mb-0 card col-md-7">
                    <div class="card-body text-center">
                        <h1 class="text-center">{{ config('app.name', 'Laravel') }} </h1>
                        <img class="my-5" src="{{ asset('images/default/91773395-e778-4294-a29f-3ed9c4d54ad2 1.png') }}" alt="Logo" width="100" height="100">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="mb-3 input-group">
                                <span class="input-group-text">
                                    <i class="icon cil-user"></i>
                                </span>
                                <input class="form-control" autofocus autocomplete type="text" name="email"
                                    placeholder="Enter your an email">
                            </div>
                            <div class="mb-4 input-group">
                                <span class="input-group-text">
                                    <i class="icon cil-lock-locked"></i>
                                </span>
                                <input class="form-control" type="password" name="password"
                                    placeholder="Enter your an password">
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button style="width:100%;background: #1E1ABB !important;"
                                        class="px-4 btn btn-primary" type="submit">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
