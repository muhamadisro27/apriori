<x-app-layout>

    <x-slot name="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-4">
                {{-- <li class="breadcrumb-item">
                    <!-- if breadcrumb is single--><span>Home</span>
                </li> --}}
                <li class="breadcrumb-item active"><span>Home</span></li>
            </ol>
        </nav>
    </x-slot>


    <div class="px-3 body flex-grow-1">
        <div class="container-lg text-center">
            <h3>Selamat datang di APLIKASI APRIORI</h3>
            <h5 class="mt-5">Angga Jaya Store</h5>
            <img width="450" class="mt-5" src="{{ asset('images/default/91773395-e778-4294-a29f-3ed9c4d54ad2 1.png') }}" alt="logo">
        </div>
    </div>



</x-app-layout>
