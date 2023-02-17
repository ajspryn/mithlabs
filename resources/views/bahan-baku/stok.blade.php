@extends('layouts.main')

@section('title', 'Stok Bahan Baku')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">


        <div class="row">
            <!-- transaksi bahan baku -->
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title m-0 me-2">Transaksi Bahan Baku</h5>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="teamMemberList" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="teamMemberList">
                                <a class="dropdown-item" href="javascript:void(0);">Lihat Semua Transaksi</a>
                                <a class="dropdown-item" href="javascript:void(0);">Buat Transaksi Baru</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless border-top">
                            <thead class="border-bottom">
                                <tr>
                                    <th>Bahan Baku</th>
                                    <th>Transaksi</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="d-flex flex-column">
                                                <p class="mb-0 fw-semibold">*4230</p>
                                                <small class="text-muted">Credit</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <p class="mb-0 fw-semibold">Sent</p>
                                            <small class="text-muted text-nowrap">17 Mar 2022</small>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-label-success">Verified</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /transaksi bahan baku -->

            <!-- table stok bahan baku -->
            <div class="col-lg-8 mb-4 mb-lg-0">
                <div class="card">
                    <h5 class="card-header">Table Stok Bahan Baku</h5>
                    <div class="card-datatable table-responsive">
                        <table class="datatables-projects table border-top">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th style="text-align: center">No</th>
                                    <th style="text-align: center">SKU</th>
                                    <th style="text-align: center">Bahan Baku</th>
                                    <th style="text-align: center">Stok</th>
                                    <th style="text-align: center">Asset</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stoks as $stok)
                                    <tr>
                                        <td></td>
                                        <td style="text-align: center">{{ $loop->iteration }}</td>
                                        <td style="text-align: center">{{ $stok->bahanbaku->sku }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">{{ $stok->bahanbaku->nama }}</span>
                                                    <small class="text-muted">{{ $stok->bahanbaku->warna }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align: center">{{ $stok->stok }}</td>
                                        <td style="text-align: center">@rupiah($stok->bahanbaku->harga * $stok->stok)</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--/ table stok bahan baku -->
        </div>

        <!-- Modal to add new record -->
        <div class="offcanvas offcanvas-end" id="add-new-record">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title" id="exampleModalLabel">Form Tambah Bahan Baku</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body flex-grow-1">
                <form class="needs-validation pt-0 row g-2" novalidate id="form-add-new-record" action="/warehouse/bahan-baku" method="post">
                    @csrf
                    <div class="col-sm-12">
                        <label class="form-label" for="sku">SKU</label>
                        <input type="text" id="sku" class="form-control @error('sku') is-invalid @enderror" name="sku"
                            placeholder="Masukan SKU Bahan Baku" required autofocus />
                        <div class="valid-feedback">Ok!</div>
                        <div class="invalid-feedback">Harus Diisi.</div>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label" for="nama">Nama Bahan Baku</label>
                        <input type="text" id="nama" class="form-control @error('nama') is-invalid @enderror" name="nama"
                            placeholder="Masukan Nama Bahan Baku" required />
                        <div class="valid-feedback">Ok!</div>
                        <div class="invalid-feedback">Harus Diisi.</div>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label" for="harga">Harga/Satuan</label>
                        <input type="number" id="harga" class="form-control @error('harga') is-invalid @enderror" name="harga"
                            placeholder="Masukan Harga/Satuan" required />
                        <div class="valid-feedback">Ok!</div>
                        <div class="invalid-feedback">Harus Diisi.</div>
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <!--/ DataTable with Buttons -->

    </div>
    <!--/ Content -->
@endsection
