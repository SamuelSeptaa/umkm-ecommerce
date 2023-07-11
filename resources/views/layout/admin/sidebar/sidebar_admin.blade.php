<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('coreui') }}/assets/brand/coreui.svg#full"></use>
        </svg>
        <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('coreui') }}/assets/brand/coreui.svg#signet"></use>
        </svg>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <div class="mx-2">
                    <i class="fa-solid fa-gauge"></i>
                </div>
                <div>Dashboard</div>
            </a>
        </li>
        <li class="nav-title">Data</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('shop-list') }}">
                <div class="mx-2">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>Daftar Toko</div>
            </a>
            <a class="nav-link" href="{{ route('transaction') }}">
                <div class="mx-2">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>Daftar Member</div>
            </a>
            <a class="nav-link" href="{{ route('voucher-log') }}">
                <div class="mx-2">
                    <i class="fa-solid fa-tags"></i>
                </div>
                <div>Daftar Voucher</div>
            </a>
        </li>
        <li class="nav-title">Laporan</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('laporan-penjualan') }}">
                <div class="mx-2">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                </div>
                <div>Laporan Penjualan</div>
            </a>
        </li>
        <li class="nav-title">Admin</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('detail-merchant') }}">
                <div class="mx-2">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
                <div>Profil Admin</div>
            </a>
        </li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
