@extends('layout.admin.index')
@section('content')
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $shops }}
                        </div>
                        <div>Jumlah Toko</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <svg class="icon">
                                <use xlink:href="{{ asset('coreui') }}/vendors/@coreui/icons/svg/free.svg#cil-options">
                                </use>
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item"
                                href="{{ route('product') }}">Lihat Toko</a>
                        </div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <i class="fa-solid fa-shop"></i>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $member }}</div>
                        <div>Jumlah Member</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <svg class="icon">
                                <use xlink:href="{{ asset('coreui') }}/vendors/@coreui/icons/svg/free.svg#cil-options">
                                </use>
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item"
                                href="{{ route('transaction') }}">Lihat Daftar Member</a>
                        </div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-warning">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $transaction }}
                            {{-- <span class="fs-6 fw-normal">(84.7%
                                <svg class="icon">
                                    <use
                                        xlink:href="{{ asset('coreui') }}/vendors/@coreui/icons/svg/free.svg#cil-arrow-top">
                                    </use>
                                </svg>)
                            </span> --}}
                        </div>
                        <div>Jumlah Transaksi Bulanan ({{ date('M') }})</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <svg class="icon">
                                <use xlink:href="{{ asset('coreui') }}/vendors/@coreui/icons/svg/free.svg#cil-options">
                                </use>
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item"
                                href="{{ route('laporan-penjualan') }}">Lihat Semua Transaksi</a>
                        </div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <i class="fa-solid fa-money-check-dollar"></i>
                </div>
            </div>
        </div>

    </div>
    <!-- /.row-->
@endsection
