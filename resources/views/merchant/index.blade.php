@extends('layout.admin.index')
@section('content')
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $products }}
                        </div>
                        <div>Jumlah Produk</div>
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
                                href="{{ route('product') }}">Lihat Produk</a>
                        </div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <i class="fa-solid fa-box-open"></i>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $latest_order }}</div>
                        <div>Pesanan Terbaru</div>
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
                                href="{{ route('transaction') }}">Lihat Daftar Transaksi</a>
                        </div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                </div>
            </div>
        </div>
        <!-- /.col-->
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-warning">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ currencyIDR($monthly_income) }}
                            {{-- <span class="fs-6 fw-normal">(84.7%
                                <svg class="icon">
                                    <use
                                        xlink:href="{{ asset('coreui') }}/vendors/@coreui/icons/svg/free.svg#cil-arrow-top">
                                    </use>
                                </svg>)
                            </span> --}}
                        </div>
                        <div>Pendapatan Bulanan ({{ date('M') }})</div>
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
                                href="{{ route('laporan-penjualan') }}">Lihat Pendapatan</a>
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
