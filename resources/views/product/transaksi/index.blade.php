@extends('layouts.main')

@section('title', 'Transaksi Bahan Baku')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            <!-- filter transaksi bahan baku -->
            <div class="col-lg-3 mb-4 mb-lg-0">
                <div class="card">
                    <h5 class="card-header">Filter</h5>
                    <div class="card-body">
                        <form class="needs-validation"
                            action="/@role/transaksi-bahan-baku" novalidate>
                            <div class="mb-3">
                                <label class="form-label" for="bahan_baku">Bahan Baku</label>
                                <select class="form-select" id="bahan_baku" name="bahan_baku" required>
                                    <option value="">Pilih Bahan Baku</option>
                                    @foreach ($bahan_bakus as $bahan_baku)
                                        <option value="{{ $bahan_baku->sku }}"
                                            {{ Request('bahan_baku') == $bahan_baku->sku ? 'selected' : '' }}>
                                            {{ $bahan_baku->nama }}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">Ok !</div>
                                <div class="invalid-feedback">Harus Diisi.</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="jenis_transaksi">Jenis Transaksi</label>
                                <select class="form-select" id="jenis_transaksi" name="jenis_transaksi" required>
                                    <option value="">Pilih Jenis Transaksi</option>
                                    <option value="Barang Keluar" {{ Request('jenis_transaksi') == 'Barang Keluar' ? 'selected' : '' }}>
                                        Keluar</option>
                                    <option value="Barang Masuk" {{ Request('jenis_transaksi') == 'Barang Masuk' ? 'selected' : '' }}>
                                        Masuk</option>
                                </select>
                                <div class="valid-feedback">Ok !</div>
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
            <!--/ filter transaksi bahan baku -->
            <!-- table transaksi bahan baku -->
            <div class="col-lg-9 mb-4 order-1 order-lg-2 mb-4 mb-lg-0">
                <div class="card h-100">
                    <div class="table-responsive card-datatable">
                        <table class="table datatable-invoice border-top">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th style="text-align: center">No</th>
                                    <th style="text-align: center">SKU</th>
                                    <th style="text-align: center">Bahan Baku</th>
                                    <th style="text-align: center">Kode Transaksi</th>
                                    <th style="text-align: center">Jenis Transaksi</th>
                                    <th style="text-align: center">Tanggal</th>
                                    <th style="text-align: center">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksis as $transaksi)
                                    <tr>
                                        <td></td>
                                        <td style="text-align: center">{{ $loop->iteration }}</td>
                                        <td style="text-align: center">{{ $transaksi->bahanbaku->sku }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <span
                                                        class="fw-semibold d-block">{{ $transaksi->bahanbaku->nama }}</span>
                                                    <small class="text-muted">{{ $transaksi->bahanbaku->warna }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align: center">{{ $transaksi->kode_order }}</td>
                                        <td style="text-align: center">
                                            @if ($transaksi->jenis_transaksi == 'Barang Masuk')
                                                <span class="badge bg-label-success">Barang Masuk</span>
                                            @elseif ($transaksi->jenis_transaksi == 'Barang Keluar')
                                                <span class="badge bg-label-danger">Barang Keluar</span> @endif
                                        </td>
                                        <td style="text-align:
                            center">{{ $transaksi->created_at->format('d-m-Y') }}</td>
                            <td style="text-align: center">{{ $transaksi->jumlah }}</td>
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
                <form class="needs-validation pt-0 row g-2" novalidate id="form-add-new-record" action="/bahan-baku"
                    method="post">
                    @csrf
                    <div class="col-sm-12">
                        <label class="form-label" for="sku">SKU</label>
                        <input type="text" id="sku" class="form-control @error('sku') is-invalid @enderror"
                            name="sku" placeholder="Masukan SKU Bahan Baku" required autofocus />
                        <div class="valid-feedback">Ok!</div>
                        <div class="invalid-feedback">Harus Diisi.</div>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label" for="nama">Nama Bahan Baku</label>
                        <input type="text" id="nama" class="form-control @error('nama') is-invalid @enderror"
                            name="nama" placeholder="Masukan Nama Bahan Baku" required />
                        <div class="valid-feedback">Ok!</div>
                        <div class="invalid-feedback">Harus Diisi.</div>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label" for="harga">Harga/Satuan</label>
                        <input type="number" id="harga" class="form-control @error('harga') is-invalid @enderror"
                            name="harga" placeholder="Masukan Harga/Satuan" required />
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
