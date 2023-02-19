@extends('layouts.main')

@section('title', 'Detail Product')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Default -->
        <div class="row">
            <!-- Vertical Icons Wizard -->
            <div class="col-12 mb-4">
                <div class="bs-stepper vertical wizard-vertical-icons-example mt-2">
                    <div class="bs-stepper-header">
                        <div class="step" data-target="#detail-product">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-circle">
                                    <i class="ti ti-briefcase"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Details Product</span>
                                    <span class="bs-stepper-subtitle">Lihat Dan Edit Detail Produk</span>
                                </span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#assembly">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-circle">
                                    <i class="ti ti-assembly"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Assembly</span>
                                    <span class="bs-stepper-subtitle">Bahan Baku Produksi</span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <!-- Details -->
                        <div id="detail-product" class="content">
                            <div class="row">
                                <!-- detail -->
                                <div class="col-lg-12 col-sm-3 mb-4">
                                    <div class="col-md">
                                        <div class="card mb-3">
                                            <div class="row g-0">
                                                <div class="col-md-4">
                                                    <img class="card-img card-img-left" src="{{ asset('storage/' . $product->foto_product) }}"
                                                        alt="Card image" />
                                                    {{-- {!! DNS2D::getBarcodeHTML($product->sku, 'QRCODE') !!} --}}
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $product->nama }}</h5>
                                                        <p class="card-text">
                                                        <table>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="pe-4">SKU</td>
                                                                    <td>:
                                                                        <strong>{{ $product->sku }}</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="pe-4">SKU Config</td>
                                                                    <td>:
                                                                        <strong>{{ $product->sku_config }}</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="pe-4">Kategori</td>
                                                                    <td>:
                                                                        <strong>{{ $product->kategori }}</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="pe-4">Brand</td>
                                                                    <td>:
                                                                        <strong>{{ $product->brand->nama }}</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="pe-4">Warna</td>
                                                                    <td>:
                                                                        <strong>{{ $product->warna }}</strong>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        </p>
                                                        <p class="card-text"><small class="text-muted">Active At {{ $product->active_at }}</small></p>
                                                        <button type="button" class="btn btn-secondary" data-bs-toggle="offcanvas"
                                                            data-bs-target="#edit-product" aria-controls="offcanvasEnd">
                                                            <i class="ti ti-edit me-1"></i> <span class="d-none d-sm-inline-block">Edit</span>
                                                        </button>
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="offcanvas"
                                                            data-bs-target="#offcanvasEnd" aria-controls="offcanvasEnd">
                                                            <span class="ti ti ti-plus me-1"></span>Buat Plan
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="card-body">
                                                        <img class="card-img"
                                                            src="data:image/png;base64,{{ DNS2D::getBarcodePNG($product->sku, 'QRCODE') }}"
                                                            alt="Card image" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Edit -->
                                    <div class="offcanvas offcanvas-end" id="edit-product">
                                        <div class="offcanvas-header border-bottom">
                                            <h5 class="offcanvas-title" id="exampleModalLabel">Form Edit Produk</h5>
                                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body flex-grow-1">
                                            @if (Auth::user()->role_id == 5)
                                                <form class="needs-validation pt-0 row g-2" novalidate id="form-edit-product" method="post"
                                                    action="/warehouse/product/{{ $product->uuid }}" enctype="multipart/form-data">
                                                    @method('put')
                                                    @csrf
                                                    <div class="col-sm-12">
                                                        <label class="form-label" for="formInput">Nama Produk</label>
                                                        <input type="text" id="formInput" class="form-control @error('nama') is-invalid @enderror"
                                                            name="nama" value="{{ old('nama', $product->nama) }}" placeholder="Masukan Nama Produk"
                                                            required autofocus />
                                                        <div class="valid-feedback">Ok!</div>
                                                        <div class="invalid-feedback">Harus Diisi.</div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="namasingkatproduk">Nama Singkat Produk</label>
                                                        <input type="text" id="namasingkatproduk"
                                                            class="form-control @error('nama_singkat') is-invalid @enderror" name="nama_singkat"
                                                            value="{{ old('nama_singkat', $product->nama_singkat) }}"
                                                            placeholder="Masukan Inisial Produk" required />
                                                        <div class="valid-feedback">Ok!</div>
                                                        <div class="invalid-feedback">Harus Diisi.</div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="form-label" for="brand">Brand</label>
                                                        <select class="form-select @error('brand') is-invalid @enderror" name="brand" id="brand"
                                                            required>
                                                            <option value="">Pilih Brand</option>
                                                            @foreach ($brands as $brand)
                                                                <option value="{{ $brand->kode }}"
                                                                    {{ old('nama', $product->brand) == $brand->kode ? 'selected' : '' }}>
                                                                    {{ $brand->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="valid-feedback">Ok!</div>
                                                        <div class="invalid-feedback">Harus Diisi.</div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label class="form-label" for="warna">Warna</label>
                                                        <select class="form-select @error('warna') is-invalid @enderror" name="warna" id="warna"
                                                            required>
                                                            <option value="">Pilih Warna</option>
                                                            @foreach ($warnas as $warna)
                                                                <option value="{{ $warna->nama }}"
                                                                    {{ old('warna', $product->warna) == $warna->nama ? 'selected' : '' }}>
                                                                    {{ $warna->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="valid-feedback">Ok!</div>
                                                        <div class="invalid-feedback">Harus Diisi.</div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label class="form-label" for="kategori">Kategori</label>
                                                        <select class="form-select @error('kategori') is-invalid @enderror" name="kategori"
                                                            id="kategori" required>
                                                            <option value="">Pilih Kategori</option>
                                                            @foreach ($kategoris as $kategori)
                                                                <option value="{{ $kategori->nama }}"
                                                                    {{ old('kategori', $product->kategori) == $kategori->nama ? 'selected' : '' }}>
                                                                    {{ $kategori->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="valid-feedback">Ok!</div>
                                                        <div class="invalid-feedback">Harus Diisi.</div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label class="form-label" for="sku_config">SKU Config</label>
                                                        <input type="text" id="sku_config"
                                                            class="form-control @error('sku_config') is-invalid @enderror" name="sku_config"
                                                            value="{{ old('sku_config', $product->sku_config) }}" placeholder="Masukan SKU Config"
                                                            required />
                                                        <div class="valid-feedback">Ok!</div>
                                                        <div class="invalid-feedback">Harus Diisi.</div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label class="form-label" for="active_at">Active At</label>
                                                        <input type="text" id="active_at"
                                                            class="form-control @error('active_at') is-invalid @enderror flatpickr-validation"
                                                            name="active_at" value="{{ old('active_at', $product->active_at) }}"
                                                            placeholder="Active At" required />
                                                        <div class="valid-feedback">Ok!</div>
                                                        <div class="invalid-feedback">Harus Diisi.</div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label class="form-label" for="cogm">COGM</label>
                                                        <input type="number" id="cogm" class="form-control @error('cogm') is-invalid @enderror"
                                                            name="cogm" value="{{ old('cogm', $product->cogm) }}" placeholder="Masukan COGM"
                                                            required />
                                                        <div class="valid-feedback">Ok!</div>
                                                        <div class="invalid-feedback">Harus Diisi.</div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label class="form-label" for="cogs">COGS</label>
                                                        <input type="number" id="cogs" class="form-control @error('cogs') is-invalid @enderror"
                                                            name="cogs" value="{{ old('cogs', $product->cogs) }}" placeholder="Masukan COGS"
                                                            required />
                                                        <div class="valid-feedback">Ok!</div>
                                                        <div class="invalid-feedback">Harus Diisi.</div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label class="form-label" for="harga_marketplace">Harga Zalora</label>
                                                        <input type="number" id="harga_marketplace"
                                                            class="form-control @error('harga_marketplace') is-invalid @enderror"
                                                            name="harga_marketplace"
                                                            value="{{ old('harga_marketplace', $product->harga_marketplace) }}"
                                                            placeholder="Masukan Harga Zalora" required />
                                                        <div class="valid-feedback">Ok!</div>
                                                        <div class="invalid-feedback">Harus Diisi.</div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label class="form-label" for="harga_jual">Harga Jual</label>
                                                        <input type="number" id="harga_jual"
                                                            class="form-control @error('harga_jual') is-invalid @enderror" name="harga_jual"
                                                            value="{{ old('harga_jual', $product->harga_jual) }}" placeholder="Masukan Harga Jual"
                                                            required />
                                                        <div class="valid-feedback">Ok!</div>
                                                        <div class="invalid-feedback">Harus Diisi.</div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label class="form-label" for="desain_product">Desain Produk</label>
                                                        <input type="file" class="form-control @error('desain_product') is-invalid @enderror"
                                                            id="desain_product" name="desain_product" />
                                                        <input type="hidden" name="desain_product_lama" value="{{ $product->desain_product }}" />
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <label class="form-label" for="upload-file">Foto Produk</label>
                                                        <input type="file" class="form-control @error('foto_product') is-invalid @enderror"
                                                            id="upload-file" name="foto_product" />
                                                        <input type="hidden" name="foto_product_lama" value="{{ $product->foto_product }}" />
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
                                                        <button type="reset" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="offcanvas">Cancel</button>
                                                    </div>
                                                </form>
                                            @else
                                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                                    <span class="alert-icon text-danger me-2">
                                                        <i class="ti ti-ban ti-xs"></i>
                                                    </span>
                                                    Anda Tidak Bisa Menambahkan Data, Karena Role Anda Bukan Warehouse
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- /Modal Edit -->

                                    <!-- cost -->
                                    <div class="row g-3">
                                        <div class="col-lg-12 mb-3 col-md-12">
                                            <div class="card">
                                                <div class="card-header d-flex justify-content-between">
                                                    <h5 class="card-title mb-0">Cost</h5>
                                                    <small class="text-muted">Updated {{ $product->updated_at->diffForHumans() }}</small>
                                                </div>
                                                <div class="card-body pt-2">
                                                    <div class="row gy-3">
                                                        <div class="col-md-3 col-6">
                                                            <div class="d-flex align-items-center">
                                                                {{-- <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                                                <i class="ti ti-chart-pie-2 ti-sm"></i>
                                                            </div> --}}
                                                                <div class="card-info">
                                                                    <h5 class="mb-0">@rupiah($product->cogm)</h5>
                                                                    <small>COGM</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-6">
                                                            <div class="d-flex align-items-center">
                                                                {{-- <div class="badge rounded-pill bg-label-info me-3 p-2">
                                                                <i class="ti ti-users ti-sm"></i>
                                                            </div> --}}
                                                                <div class="card-info">
                                                                    <h5 class="mb-0">@rupiah($product->cogs)</h5>
                                                                    <small>COGS</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-6">
                                                            <div class="d-flex align-items-center">
                                                                {{-- <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                                                <i class="ti ti-shopping-cart ti-sm"></i>
                                                            </div> --}}
                                                                <div class="card-info">
                                                                    <h5 class="mb-0">@rupiah($product->harga_marketplace)</h5>
                                                                    <small>Harga Marketplace</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 col-6">
                                                            <div class="d-flex align-items-center">
                                                                {{-- <div class="badge rounded-pill bg-label-success me-3 p-2">
                                                                <i class="ti ti-currency-dollar ti-sm"></i>
                                                            </div> --}}
                                                                <div class="card-info">
                                                                    <h5 class="mb-0">@rupiah($product->harga_jual)</h5>
                                                                    <small>Harga Jual</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /cost -->

                                    <!-- Table -->
                                    <div class="col-md">
                                        <div class="card mb-3">
                                            <h5 class="card-header">Stock</h5>
                                            <div class="table-responsive text-nowrap">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center">Nama Gudang</th>
                                                            <th style="text-align: center">Stok</th>
                                                            <th style="text-align: center">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-border-bottom-0">
                                                        @if ($stoks->count() != 0)
                                                            @foreach ($stoks as $stok)
                                                                <tr>
                                                                    <td>
                                                                        <strong>{{ $stok->gudang->nama }}</strong>
                                                                    </td>
                                                                    <td style="text-align: center">{{ $stok->stok }}</td>
                                                                    <td style="text-align: center">
                                                                        <div class="dropdown">
                                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                                                data-bs-toggle="dropdown">
                                                                                <i class="ti ti-dots-vertical"></i>
                                                                            </button>
                                                                            <div class="dropdown-menu">
                                                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                                                        class="ti ti-pencil me-1"></i>
                                                                                    Edit</a>
                                                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                                                        class="ti ti-trash me-1"></i>
                                                                                    Delete</a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="3" style="text-align: center">Tidak Ada Data Stok</td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                    <tfoot class="table-border-bottom-0">
                                                        <tr>
                                                            <th style="text-align: end">Total :</th>
                                                            <th style="text-align: center">{{ $stoks->sum('stoks') }}</th>
                                                            <th></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ Table -->

                                    <!-- Project Cards -->
                                    {{-- <div class="row g-4">
                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="d-flex align-items-start">
                                                        <div class="d-flex align-items-start">
                                                            <div class="me-2 ms-1">
                                                                <h5 class="mb-0">
                                                                    <a href="javascript:;" class="stretched-link text-body">Admin Template</a>
                                                                </h5>
                                                                <div class="client-info">
                                                                    <strong>Client: </strong><span class="text-muted">Jeffrey Phillips</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="ms-auto">
                                                            <div class="dropdown zindex-2">
                                                                <button type="button" class="btn dropdown-toggle hide-arrow p-0"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ti ti-dots-vertical text-muted"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li><a class="dropdown-item" href="javascript:void(0);">Rename project</a></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);">View details</a></li>
                                                                    <li><a class="dropdown-item" href="javascript:void(0);">Add to favorites</a></li>
                                                                    <li>
                                                                        <hr class="dropdown-divider" />
                                                                    </li>
                                                                    <li><a class="dropdown-item text-danger" href="javascript:void(0);">Leave
                                                                            Project</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center flex-wrap">
                                                        <div class="bg-lighter px-3 py-2 rounded me-auto mb-3">
                                                            <h6 class="mb-0">$2.4k <span class="text-body fw-normal">/ 1.8k</span></h6>
                                                            <span>Total Budget</span>
                                                        </div>
                                                        <div class="text-end mb-3">
                                                            <h6 class="mb-0">Start Date: <span class="text-body fw-normal">18/8/21</span></h6>
                                                            <h6 class="mb-1">Deadline: <span class="text-body fw-normal">21/6/22</span></h6>
                                                        </div>
                                                    </div>
                                                    <p class="mb-0">
                                                        Time is our most valuable asset, that's why we want to help you save it by creating…
                                                    </p>
                                                </div>
                                                <div class="card-body border-top">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <h6 class="mb-1">All Hours: <span class="text-body fw-normal">98/135</span></h6>
                                                        <span class="badge bg-label-warning ms-auto">15 Days left</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center mb-2 pb-1">
                                                        <small>Task: 12/90</small>
                                                        <small>42% Completed</small>
                                                    </div>
                                                    <div class="progress mb-2" style="height: 8px">
                                                        <div class="progress-bar" role="progressbar" style="width: 42%" aria-valuenow="42"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div class="d-flex align-items-center pt-1">
                                                        <div class="d-flex align-items-center">
                                                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0 zindex-2">
                                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                                                    title="Kaith D'souza" class="avatar avatar-sm pull-up">
                                                                    <img class="rounded-circle" src="../../assets/img/avatars/5.png" alt="Avatar" />
                                                                </li>
                                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                                                    title="John Doe" class="avatar avatar-sm pull-up">
                                                                    <img class="rounded-circle" src="../../assets/img/avatars/1.png" alt="Avatar" />
                                                                </li>
                                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                                                    title="Alan Walker" class="avatar avatar-sm pull-up me-2">
                                                                    <img class="rounded-circle" src="../../assets/img/avatars/6.png" alt="Avatar" />
                                                                </li>
                                                                <li><small class="text-muted">1.1k Members</small></li>
                                                            </ul>
                                                        </div>
                                                        <div class="ms-auto">
                                                            <a href="javascript:void(0);" class="text-body"><i class="ti ti-message-dots ti-sm"></i>
                                                                236</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <!--/ Project Cards -->
                                </div>
                                <!-- assembly -->
                            </div>
                        </div>
                        <div id="assembly" class="content">
                            <div class="content-header mb-3">
                                <h6 class="mb-0">Assembly</h6>
                                <small>Form Assembly.</small>
                            </div>
                            <div class="row g-3">
                                @if ($assemblies->count() > 0)
                                    <form id="form" class="form-repeater" action="/warehouse/assembly" method="POST">
                                        @csrf
                                        <div data-repeater-list="assembly">
                                            @foreach ($assemblies as $assembly)
                                                <div data-repeater-item>
                                                    <div class="row">
                                                        <div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0">
                                                            <label class="form-label" for="form-repeater-{{ $loop->iteration }}-1">Bahan
                                                                Baku</label>
                                                            <select id="form-repeater-{{ $loop->iteration }}-1"
                                                                class="form-select @error('sku_bahan_baku') is-invalid @enderror"
                                                                name="sku_bahan_baku">
                                                                <option value="">Pilih Bahan Baku</option>
                                                                @foreach ($bahan_bakus as $bahan_baku)
                                                                    <option value="{{ $bahan_baku->sku }}"
                                                                        {{ $assembly->sku_bahan_baku == $bahan_baku->sku ? 'selected' : '' }}>
                                                                        {{ $bahan_baku->nama }} -
                                                                        ({{ $bahan_baku->warna }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                                                            <label class="form-label" for="form-repeater-{{ $loop->iteration }}-2">Jumlah</label>
                                                            <input type="number" id="form-repeater-{{ $loop->iteration }}-2" name="jumlah"
                                                                value="{{ $assembly->jumlah }}"
                                                                class="form-control @error('jumlah') is-invalid @enderror"
                                                                placeholder="Masukan Jumlah" />
                                                        </div>
                                                        <input type="hidden" name="sku_product" id="form-repeater-{{ $loop->iteration }}-3"
                                                            value="{{ $product->sku }}">
                                                        <div class="mb-3 col-lg-12 col-xl-2 col-12 d-flex align-items-center mb-0">
                                                            <button class="btn btn-label-danger mt-4" data-repeater-delete>
                                                                <i class="ti ti-x ti-xs me-1"></i>
                                                                <span class="align-middle">Delete</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="mb-3 col-lg-6 col-xl-12 col-12 mb-0">
                                            <button class="btn btn-outline-primary" data-repeater-create>
                                                <i class="ti ti-plus me-1"></i>
                                                <span class="align-middle">Add</span>
                                            </button>
                                            <button class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('form').submit();">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <form id="form" class="form-repeater" action="/warehouse/assembly" method="POST">
                                        @csrf
                                        <div data-repeater-list="assembly">
                                            <div data-repeater-item>
                                                <div class="row">
                                                    <div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0">
                                                        <label class="form-label" for="form-repeater-1-1">Bahan Baku</label>
                                                        <select id="form-repeater-1-1"
                                                            class="form-select @error('sku_bahan_baku') is-invalid @enderror" name="sku_bahan_baku">
                                                            <option value="">Pilih Bahan Baku</option>
                                                            @foreach ($bahan_bakus as $bahan_baku)
                                                                <option value="{{ $bahan_baku->sku }}">{{ $bahan_baku->nama }} -
                                                                    ({{ $bahan_baku->warna }})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                                                        <label class="form-label" for="form-repeater-1-2">Jumlah</label>
                                                        <input type="number" id="form-repeater-1-2" name="jumlah"
                                                            class="form-control @error('jumlah') is-invalid @enderror" placeholder="Masukan Jumlah" />
                                                    </div>
                                                    <input type="hidden" name="sku_product" id="form-repeater-1-3" value="{{ $product->sku }}">
                                                    <div class="mb-3 col-lg-12 col-xl-2 col-12 d-flex align-items-center mb-0">
                                                        <button class="btn btn-label-danger mt-4" data-repeater-delete>
                                                            <i class="ti ti-x ti-xs me-1"></i>
                                                            <span class="align-middle">Delete</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <hr />
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-xl-12 col-12 mb-0">
                                            <button class="btn btn-outline-primary" data-repeater-create>
                                                <i class="ti ti-plus me-1"></i>
                                                <span class="align-middle">Add</span>
                                            </button>
                                            <button class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('form').submit();">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /Vertical Icons Wizard -->
                </div>
            </div>
            <!--/ Content -->
        @endsection
