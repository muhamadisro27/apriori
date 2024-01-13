<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card-group d-block d-md-flex row justify-content-center">
                <div class="p-4 mb-0 card col-md-7">
                    <div class="card-body">
                        <h1>Login</h1>
                        <p class="text-medium-emphasis">Sign In to your account</p>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="mb-3 input-group">
                                <span class="input-group-text">
                                    <i class="icon cil-user"></i>
                                </span>
                                <input class="form-control" autofocus autocomplete type="text" name="email" placeholder="Enter your an email">
                            </div>
                            <div class="mb-4 input-group">
                                <span class="input-group-text">
                                    <i class="icon cil-lock-locked"></i>
                                </span>
                                <input class="form-control" type="password" name="password" placeholder="Enter your an password">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    {{-- <a href="{{ route('password.request') }}" class="px-0 btn btn-link">Forgot password?</a> --}}
                                </div>
                                <div class="col-6 text-end">
                                    <button class="px-4 btn btn-primary" type="submit">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
