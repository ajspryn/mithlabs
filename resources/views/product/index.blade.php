@extends('layouts.main')

@section('title', 'Product')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Statistics -->
        <div class="row">
            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="card-title mb-0">
                            <h5 class="mb-0 me-2">86%</h5>
                            <small>CPU Usage</small>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-primary rounded-pill p-2">
                                <i class="ti ti-cpu ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="card-title mb-0">
                            <h5 class="mb-0 me-2">1.24gb</h5>
                            <small>Memory Usage</small>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-success rounded-pill p-2">
                                <i class="ti ti-server ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="card-title mb-0">
                            <h5 class="mb-0 me-2">0.2%</h5>
                            <small>Downtime Ratio</small>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-danger rounded-pill p-2">
                                <i class="ti ti-chart-pie-2 ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="card-title mb-0">
                            <h5 class="mb-0 me-2">128</h5>
                            <small>Issues Found</small>
                        </div>
                        <div class="card-icon">
                            <span class="badge bg-label-warning rounded-pill p-2">
                                <i class="ti ti-alert-octagon ti-sm"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                <table class="datatables-basic table" style="width:100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th style="text-align: center">SKU</th>
                            <th style="text-align: center width:70%">Nama</th>
                            <th style="text-align: center">Warna</th>
                            <th style="text-align: center">Kategori</th>
                            <th style="text-align: center">SKU Config</th>
                            <th style="text-align: center">Active At</th>
                            <th style="text-align: center">COGM</th>
                            <th style="text-align: center">COGS</th>
                            <th style="text-align: center">Harga Marketplace</th>
                            <th style="text-align: center">Harga Jual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td></td>
                                <td style="text-align: center">{{ $product->sku }}</td>
                                <td>
                                    <a href="/warehouse/product/{{ $product->uuid }}">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar">
                                                    <img src="{{ asset('storage/' . $product->foto_product) }}" alt class="h-auto rounded-circle" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <span class="fw-semibold d-block">{{ $product->nama }}</span>
                                                <small class="text-muted">{{ $product->namabrand[0]->nama }}</small>
                                            </div>
                                        </div>
                                    </a>
                                </td>
                                <td style="text-align: center">{{ $product->warna }}</td>
                                <td style="text-align: center">{{ $product->kategori }}</td>
                                <td style="text-align: center">{{ $product->sku_config }}</td>
                                <td style="text-align: center">{{ $product->active_at }}</td>
                                <td style="text-align: center">@rupiah($product->cogm)</td>
                                <td style="text-align: center">@rupiah($product->cogs)</td>
                                <td style="text-align: center">@rupiah($product->harga_marketplace)</td>
                                <td style="text-align: center">@rupiah($product->harga_jual)</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal to add new record -->
        <div class="offcanvas offcanvas-end" id="add-new-record">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title" id="exampleModalLabel">Form Tambah Produk</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body flex-grow-1">
                @if (Auth::user()->role_id == 5)
                    <form class="needs-validation pt-0 row g-2" novalidate id="form-add-new-record" method="post" action="/warehouse/product"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-12">
                            <label class="form-label" for="formInput">Nama Produk</label>
                            <input type="text" id="formInput" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                placeholder="Masukan Nama Produk" required autofocus />
                            <div class="valid-feedback">Ok!</div>
                            <div class="invalid-feedback">Harus Diisi.</div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="namasingkatproduk">Nama Singkat Produk</label>
                            <input type="text" id="namasingkatproduk" class="form-control @error('nama_singkat') is-invalid @enderror"
                                name="nama_singkat" placeholder="Masukan Inisial Produk" required />
                            <div class="valid-feedback">Ok!</div>
                            <div class="invalid-feedback">Harus Diisi.</div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="brand">Brand</label>
                            <select class="form-select @error('brand') is-invalid @enderror" name="brand" id="brand" required>
                                <option value="">Pilih Brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->kode }}">{{ $brand->nama }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">Ok!</div>
                            <div class="invalid-feedback">Harus Diisi.</div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="warna">Warna</label>
                            <select class="form-select @error('warna') is-invalid @enderror" name="warna" id="warna" required>
                                <option value="">Pilih Warna</option>
                                @foreach ($warnas as $warna)
                                    <option value="{{ $warna->nama }}">{{ $warna->nama }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">Ok!</div>
                            <div class="invalid-feedback">Harus Diisi.</div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="kategori">Kategori</label>
                            <select class="form-select @error('kategori') is-invalid @enderror" name="kategori" id="kategori" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->nama }}">{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">Ok!</div>
                            <div class="invalid-feedback">Harus Diisi.</div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="sku_config">SKU Config</label>
                            <input type="text" id="sku_config" class="form-control @error('sku_config') is-invalid @enderror" name="sku_config"
                                placeholder="Masukan SKU Config" required />
                            <div class="valid-feedback">Ok!</div>
                            <div class="invalid-feedback">Harus Diisi.</div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="active_at">Active At</label>
                            <input type="text" id="active_at" class="form-control @error('active_at') is-invalid @enderror flatpickr-validation"
                                name="active_at" placeholder="Active At" required />
                            <div class="valid-feedback">Ok!</div>
                            <div class="invalid-feedback">Harus Diisi.</div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="cogm">COGM</label>
                            <input type="number" id="cogm" class="form-control @error('cogm') is-invalid @enderror" name="cogm"
                                placeholder="Masukan COGM" required />
                            <div class="valid-feedback">Ok!</div>
                            <div class="invalid-feedback">Harus Diisi.</div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="cogs">COGS</label>
                            <input type="number" id="cogs" class="form-control @error('cogs') is-invalid @enderror" name="cogs"
                                placeholder="Masukan COGS" required />
                            <div class="valid-feedback">Ok!</div>
                            <div class="invalid-feedback">Harus Diisi.</div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="harga_zalora">Harga Zalora</label>
                            <input type="number" id="harga_zalora" class="form-control @error('harga_zalora') is-invalid @enderror"
                                name="harga_marketplace" placeholder="Masukan Harga Zalora" required />
                            <div class="valid-feedback">Ok!</div>
                            <div class="invalid-feedback">Harus Diisi.</div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="harga_jual">Harga Jual</label>
                            <input type="number" id="harga_jual" class="form-control @error('harga_jual') is-invalid @enderror" name="harga_jual"
                                placeholder="Masukan Harga Jual" required />
                            <div class="valid-feedback">Ok!</div>
                            <div class="invalid-feedback">Harus Diisi.</div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="desain_product">Desain Produk</label>
                            <input type="file" class="form-control @error('desain_product') is-invalid @enderror" id="desain_product"
                                name="desain_product" />
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label" for="upload-file">Foto Produk</label>
                            <input type="file" class="form-control @error('foto_product') is-invalid @enderror" id="upload-file"
                                name="foto_product" required />
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
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
        <!--/ DataTable with Buttons -->
    </div>
    <!--/ Content -->
@endsection
