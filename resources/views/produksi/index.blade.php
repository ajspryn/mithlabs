@extends('layouts.main')

@section('title', 'Produksi')

@section('content')

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row my-4">
            <div class="col">
                <div class="accordion" id="collapsibleSection">
                    <div class="card accordion-item">
                        <h2 class="accordion-header" id="headingDeliveryAddress">
                            <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                data-bs-target="#collapseDeliveryAddress" aria-expanded="true"
                                aria-controls="collapseDeliveryAddress"> Tambah Produksi </button>
                        </h2>
                        <div id="collapseDeliveryAddress" class="accordion-collapse collapse"
                            data-bs-parent="#collapsibleSection">
                            <div class="accordion-body">
                                <div class="row g-3">
                                    <form class="needs-validation pt-0 row g-2" novalidate id="form-edit-product"
                                        method="post"
                                        action="/@role/produksi" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-sm-5">
                                            <label class="form-label" for="pengrajin">Pengrajin</label>
                                            <select class="form-select @error('kode_pengrajin') is-invalid @enderror"
                                                name="kode_pengrajin" id="pengrajin" required>
                                                <option value="">Pilih Pengrajin</option>
                                                @foreach ($pengrajins as $pengrajin)
                                                    <option value="{{ $pengrajin->kode }}"
                                                        {{ old('kode_pengrajin') == $pengrajin->kode ? 'selected' : '' }}>
                                                        {{ $pengrajin->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="valid-feedback">Ok!</div>
                                            <div class="invalid-feedback">Harus Diisi.</div>
                                        </div>
                                        <div class="col-sm-5">
                                            <label class="form-label" for="product">Product</label>
                                            <select class="form-select @error('sku_product') is-invalid @enderror"
                                                name="sku_product" id="product" required>
                                                <option value="">Pilih Product</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->sku }}"
                                                        {{ old('sku_product') == $product->sku ? 'selected' : '' }}>
                                                        {{ $product->nama }} ({{ $product->warna }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="valid-feedback">Ok!</div>
                                            <div class="invalid-feedback">Harus Diisi.</div>
                                        </div>
                                        <div class="col-sm-2">
                                            <label class="form-label" for="jumlah">Jumlah</label>
                                            <input type="text" id="jumlah"
                                                class="form-control @error('jumlah') is-invalid @enderror" name="jumlah"
                                                value="{{ old('jumlah') }}" placeholder="Masukan Jumlah" required />
                                            <div class="valid-feedback">Ok!</div>
                                            <div class="invalid-feedback">Harus Diisi.</div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label class="form-label" for="catatan">Catatan</label>
                                            <textarea type="text" id="catatan"
                                                class="form-control @error('catatan') is-invalid @enderror" name="catatan"
                                                value="{{ old('catatan') }}" placeholder="Masukan catatan"> </textarea>
                                        </div>
                                        <div class="col-sm-12">
                                            <button type="submit"
                                                class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
                                            <button type="reset" class="btn btn-outline-secondary"
                                                data-bs-dismiss="offcanvas">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Examples -->
        <div class="row mb-5">
            <div class="col-md-12 col-lg-3 mb-3">
                <div class="card h-100">
                    <h5 class="card-header">Filter</h5>
                    <div class="card-body">
                        <form class="needs-validation" action="/@role/produksi" novalidate>
                            <div class="mb-3">
                                <label class="form-label" for="product">Product</label>
                                <select class="form-select @error('sku_product') is-invalid @enderror" name="sku_product"
                                    id="product" required>
                                    <option value="">Pilih Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->sku }}"
                                            {{ request('sku_product') == $product->sku ? 'selected' : '' }}>
                                            {{ $product->nama }} ({{ $product->warna }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">Ok!</div>
                                <div class="invalid-feedback">Harus Diisi.</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="tahun">Tahun</label>
                                <input type="number" min="1900" max="2099" step="1" id="tahun"
                                    class="form-control @error('tahun') is-invalid @enderror" name="tahun"
                                    value="{{ request('tahun') }}" placeholder="Masukan tahun" required />
                                <div class="valid-feedback">Ok!</div>
                                <div class="invalid-feedback">Harus Diisi.</div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-9 mb-3">
                <!-- Project Cards -->
                <div class="row g-4">
                    @foreach ($produksis as $produksi)
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-start">
                                        <div class="d-flex align-items-start">
                                            <div class="avatar avatar-md me-2">
                                                <img src="{{ asset('storage/' . $produksi->product->foto_product) }}"
                                                    alt="Avatar" class="rounded-circle">
                                            </div>
                                            <div class="me-2 ms-1">
                                                <h5 class="mb-0"><a href="javascript:;"
                                                        class="stretched-link text-body">{{ $produksi->product->nama }}</a></h5>
                                                <div class="client-info"><strong>Pengrajin: </strong><span
                                                        class="text-muted">{{ $produksi->pengrajin->nama }}</span></div>
                                            </div>
                                        </div>
                                        <div class="ms-auto">
                                            <div class="dropdown zindex-2">
                                                <button type="button" class="btn dropdown-toggle hide-arrow p-0"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                                        class="ti ti-dots-vertical text-muted"></i></button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="/@role/produksi/{{ $produksi->kode }}">Detail</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center flex-wrap">
                                        <div class="bg-lighter px-3 py-2 rounded me-auto mb-3">
                                            <div>{!! DNS2D::getBarcodeHTML($produksi->kode, 'QRCODE', 3, 3) !!}</div>
                                            {{-- <span>{{ $produksi->kode }}</span> --}}
                                        </div>
                                        <div class="text-end mb-3">
                                            <h6 class="mb-0">Tgl: <span
                                                    class="text-body fw-normal">{{ $produksi->created_at->format('d-m-Y') }}</span>
                                            </h6>
                                            <h6 class="mb-1">Batch: <span class="text-body fw-normal">{{ $produksi->batch }}</span>
                                            </h6>
                                        </div>
                                    </div>
                                    <p class="mb-0">Warna : {{ $produksi->product->warna }}</p>
                                    <p class="mb-0">Catatan : {{ $produksi->catatan }}</p>
                                </div>
                                <div class="card-body border-top">
                                    <div class="d-flex align-items-center mb-3">
                                        <h6 class="mb-1">Target Produksi: <span class="text-body fw-normal">{{ $produksi->jumlah }} PCS</span>
                                        </h6>
                                        @if ($produksi->qc == null)
                                        <span class="badge bg-label-info ms-auto">{{ $produksi->created_at->diffForhumans() }}</span>
                                        @elseif ($produksi->qc->count() == $produksi->jumlah)
                                        <span class="badge bg-label-success ms-auto">Selesai</span>
                                        @endif
                                    </div>
                                    @if ($produksi->qc == null)
                                        <div class="d-flex justify-content-between align-items-center mb-2 pb-1">
                                            <small>Task: 0/{{ $produksi->jumlah }}</small>
                                            <small>0%</small>
                                        </div>
                                    @elseif ($produksi->qc->count() == $produksi->jumlah)
                                        <div class="d-flex justify-content-between align-items-center mb-2 pb-1">
                                            <small>Task: {{ $produksi->qc->count() }}/{{ $produksi->jumlah }}</small>
                                            <small>{{ ($produksi->qc->count() / $produksi->jumlah) * 100 }}%</small>
                                        </div> @endif
                                <div class="progress
                                        mb-2" style="height: 8px;">
                                        <div class="progress-bar" role="progressbar" style="width: 95%;" aria-valuenow="95"
                                            aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!--/ Project Cards -->
            </div>
        </div>
        <!-- Examples -->

    </div>
    <!--/ Content -->


@endsection
