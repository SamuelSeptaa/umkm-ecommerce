<header class="header header-sticky mb-4">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button"
            onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <svg class="icon icon-lg">
                <use xlink:href="{{ asset('coreui') }}/vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
            </svg>
        </button><a class="header-brand d-md-none" href="{{ asset('coreui') }}/#">
            <svg width="118" height="46" alt="CoreUI Logo">
                <use xlink:href="{{ asset('coreui') }}/assets/brand/coreui.svg#full"></use>
            </svg></a>
        <ul class="header-nav ms-3">
            <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown"
                    href="{{ asset('coreui') }}/#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-md"><i class="fa-solid fa-circle-user fa-xl"></i></div>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <div class="dropdown-header bg-light py-2">
                        <div class="fw-semibold">Pengaturan</div>
                    </div>
                    @role('admin')
                        <a class="dropdown-item" href="{{ route('admin-profil') }}">
                            <svg class="icon me-2">
                                <use xlink:href="{{ asset('coreui') }}/vendors/@coreui/icons/svg/free.svg#cil-user">
                                </use>
                            </svg> Profil Akun
                        </a>
                        @elserole('merchant')
                        <a class="dropdown-item" href="{{ route('detail-merchant') }}">
                            <svg class="icon me-2">
                                <use xlink:href="{{ asset('coreui') }}/vendors/@coreui/icons/svg/free.svg#cil-user">
                                </use>
                            </svg> Profil Toko
                        </a>
                    @endrole
                    <a class="dropdown-item" href="{{ route('logout') }}">
                        <svg class="icon me-2">
                            <use
                                xlink:href="{{ asset('coreui') }}/vendors/@coreui/icons/svg/free.svg#cil-account-logout">
                            </use>
                        </svg> Logout
                    </a>
                </div>
            </li>
        </ul>
    </div>
</header>
