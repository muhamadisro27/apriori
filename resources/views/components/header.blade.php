<header class="header header-light bg-primary header-sticky mb-4">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3 d-md-none" type="button"
            onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <i class="icon icon-lg cil-hamburger-menu
            "></i>
        </button><a class="header-brand d-md-none text-white" href="#">
            {{-- <svg width="118" height="46" alt="CoreUI Logo">
                <use xlink:href="assets/brand/coreui.svg#full"></use>
            </svg> --}}
        </a>

        <ul class="header-nav d-none d-sm-flex ms-auto me-3">
            <li class="nav-item dropdown d-flex align-items-center"><a class="nav-link py-0"
                    data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="avatar avatar-md">
                        <img class="avatar-img" src="{{ asset('images/default/user.png') }}"
                            alt="{{ auth()->user() ? auth()->user()->name : '' }}">
                        <span class="avatar-status bg-success"></span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <form method="post" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item">
                            <i class="icon me-2 cil-account-logout"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</header>
