@extends('layouts.main')

@section('title', 'Produksi')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- User Profile Content -->
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-5">
                <!-- Profile Overview -->
                <div class="card mb-4">
                    <div class="user-profile-header-banner">
                        <img src="{{ asset('storage/' . $produksi->product->foto_product) }}" alt="Banner image"
                            class="rounded-top">
                    </div>
                    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center">
                        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                            <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($produksi->product->sku, 'QRCODE', 15, 15) }}"
                                alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img"
                                style="background-color: white">
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-uppercase">{{ $produksi->product->sku }}</p>
                        <ul class="list-unstyled mb-3">
                            <li class="d-flex align-items-center mb-3"><span class="fw-bold mx-2">Produk:</span>
                                <span>{{ $produksi->product->nama }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3"></i><span class="fw-bold mx-2">Warna:</span>
                                <span>{{ $produksi->product->warna }}</span>
                            </li>
                            <li class="d-flex align-items-center"><span class="fw-bold mx-2">Brand:</span>
                                <span>{{ $produksi->product->brand->nama }}</span>
                            </li>
                        </ul>
                        <div>
                            @if (Auth::user()->role_id == 6)
                                <a class="btn btn-primary d-grid w-100 mb-2" href="/@role/verifikasi-product/{{ Illuminate\Support\Facades\Crypt::encryptString($orders->first()->kode) }}">
                                    <span class="d-flex align-items-center justify-content-center text-nowrap">
                                        <i class="ti ti-discount-check-filled ti-xs me-1"></i>Verifikasi
                                    </span>
                                </a>
                            @endif
                            <button class="btn btn-secondary d-grid w-100" data-bs-toggle="offcanvas" data-bs-target="#addPaymentOffcanvas">
                                <span class="d-flex align-items-center justify-content-center text-nowrap">
                                    <i class="ti ti-printer ti-xs me-1"></i>Print Bacode
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <!--/ Profile Overview -->
            </div>
            <div class="col-xl-8 col-lg-7 col-md-7">
                <!-- Activity Timeline -->
                <div class="card card-action mb-4">
                    <div class="card invoice-preview-card">
                        <div class="card-body">
                            <div
                                class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
                                <div class="mb-xl-0 mb-4">
                                    <h4 class="fw-semibold mb-2">Kode Produksi : {{ $produksi->kode }}</h4>
                                    <div class="mb-2 pt-1">
                                        <span>Tgl Mulai :</span>
                                        <span class="fw-semibold"> {{ $produksi->created_at->format('d-m-Y') }}</span>
                                    </div>
                                    <div class="pt-1">
                                        <span>Pengrajin :</span>
                                        <span class="fw-semibold"> {{ $produksi->pengrajin->nama }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr class="my-0" />
                        <div class="card-body">
                            <div class="row p-sm-3 p-0">
                                <div class="col-xl-6 col-md-12 col-sm-7 col-12">
                                    <h6 class="mb-4">Detail Produksi:</h6>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="pe-4">Jumlah</td>
                                                <td>: {{ $produksi->jumlah }} PCS</td>
                                            </tr>
                                            <tr>
                                                <td class="pe-4">Batch</td>
                                                <td>: {{ $produksi->batch }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive border-top">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>SKU Bahan Baku</th>
                                        <th>Bahan Baku</th>
                                        <th>Kebutuhan</th>
                                        <th>Stok</th>
                                        <th>Kekurangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assemblies as $assembly)
                                        <tr>
                                            <td class="text-nowrap">{{ $assembly->bahanbaku->sku }}</td>
                                            <td class="text-nowrap">{{ $assembly->bahanbaku->nama }}</td>
                                            <td>{{ $assembly->jumlah * $produksi->jumlah }}</td>
                                            <td>{{ $assembly->stok_bahanbaku->stok }}</td>
                                            <td>{{ $assembly->jumlah * $produksi->jumlah - $assembly->stok_bahanbaku->stok }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body mx-3">
                            <div class="row">
                                <div class="col-12">
                                    @if ($produksi->order->count() > 0)
                                        <a href="/@role/order-bahan-baku/{{ $produksi->order->first()->kode }}">
                                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                                <span class="alert-icon text-success me-2">
                                                    <i class="ti ti-check ti-xs"></i>
                                                </span>
                                                Bahan Baku Telah Di Order dengan Kode : {{ $produksi->order->first()->kode }}
                                            </div>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Invoice -->
                <!--/ Activity Timeline -->
                <div class="row">
                    <!-- Teams -->
                    <div class="col-lg-12 col-xl-12">
                        @if ($produksi->order->count() == 0)
                            <div class="card card-action mb-4">
                                <div class="card-header align-items-center">
                                    <h5 class="card-action-title mb-0">Form Order Bahan Baku</h5>
                                </div>
                                <div class="card-body">
                                    <form id="form" class="form-repeater" action="/@role/order-bahan-baku" method="POST">
                                    @csrf
                                    <div data-repeater-list="order_bahan_baku">
                                        @foreach ($assemblies as $assembly)
                                            @if ($assembly->jumlah * $produksi->jumlah - $assembly->stok_bahanbaku->stok > 0)
                                                <div data-repeater-item>
                                                    <div class="row">
                                                        <div class="mb-3 col-lg-12 col-xl-4 col-12 mb-0">
                                                            <label class="form-label" for="form-repeater-1-1">Bahan
                                                                Baku</label>
                                                            <select id="form-repeater-1-1"
                                                                class="form-select @error('sku_bahan_baku') is-invalid @enderror"
                                                                name="sku_bahan_baku" required readonly>
                                                                <option value="">Pilih Bahan Baku</option>
                                                                <option value="{{ $assembly->bahanbaku->sku }}" selected>
                                                                    {{ $assembly->bahanbaku->nama }} -
                                                                    ({{ $assembly->bahanbaku->warna }})
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3 col-lg-12 col-xl-4 col-12 mb-0">
                                                            <label class="form-label" for="form-repeater-1-2">Vendor</label>
                                                            <select id="form-repeater-1-2"
                                                                class="form-select @error('kode_vendor') is-invalid @enderror"
                                                                name="kode_vendor" required>
                                                                <option value="">Pilih Vendor</option>
                                                                @foreach ($vendors as $vendor)
                                                                    <option value="{{ $vendor->kode }}">
                                                                        {{ $vendor->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3 col-lg-12 col-xl-2 col-12 mb-0">
                                                            <label class="form-label" for="form-repeater-1-3">Jumlah</label>
                                                            <input type="number" id="form-repeater-1-3" name="jumlah"
                                                                class="form-control @error('jumlah') is-invalid @enderror"
                                                                placeholder="Masukan Jumlah" required
                                                                value="{{ $assembly->jumlah * $produksi->jumlah - $assembly->stok_bahanbaku->stok }}" />
                                                        </div>
                                                        <input type="hidden" id="form-repeater-1-4" name="kode_produksi"
                                                                class="form-control @error('kode_produksi') is-invalid @enderror" required
                                                                value="{{ $produksi->kode }}" />
                                                        <div
                                                            class="mb-3 col-lg-12 col-xl-2 col-12 d-flex align-items-center mb-0">
                                                            <button class="btn btn-label-danger mt-4" data-repeater-delete>
                                                                <i class="ti ti-x ti-xs me-1"></i>
                                                                {{-- <span class="align-middle">Delete</span> --}}
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="mb-3 col-lg-6 col-xl-12 col-12 mb-0">
                                        <button class="btn btn-outline-primary" data-repeater-create>
                                            <i class="ti ti-plus me-1"></i>
                                            <span class="align-middle">Add</span>
                                        </button>
                                        <button class="btn btn-primary"
                                            onclick="event.preventDefault(); document.getElementById('form').submit();">
                                            Order
                                        </button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!--/ Teams -->
                </div>
            </div>
        </div>
        <!--/ User Profile Content -->



    </div>
    <!--/ Content -->
@endsection
