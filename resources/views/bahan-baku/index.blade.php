@extends('layouts.main')

@section('title', 'Bahan Baku')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Table -->
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                <table class="datatables-basic table">
                    <thead>
                        <tr>
                            <th></th>
                            <th style="text-align: center">No</th>
                            <th style="text-align: center">SKU</th>
                            <th style="text-align: center">Nama</th>
                            <th style="text-align: center">Warna</th>
                            <th style="text-align: center">Satuan</th>
                            <th style="text-align: center">Harga/Satuan</th>
                            <th style="text-align: center">Vendor</th>
                            <th style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bahan_bakus as $bahan_baku)
                            <tr>
                                <td></td>
                                <td style="text-align: center">{{ $loop->iteration }}</td>
                                <td>{{ $bahan_baku->sku }}</td>
                                <td>{{ $bahan_baku->nama }}</td>
                                <td style="text-align: center">{{ $bahan_baku->warna }}</td>
                                <td style="text-align: center">{{ $bahan_baku->satuan }}</td>
                                <td>@rupiah($bahan_baku->harga)</td>
                                <td>{{ $bahan_baku->vendor->nama }}</td>
                                <td style="text-align: center">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-pencil me-1"></i> Edit</a>
                                            <form action="/warehouse/bahan-baku/{{ $bahan_baku->id }}" method="POST" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <a class="dropdown-item" href="#"
                                                    onclick="event.preventDefault(); this.closest('form').submit();"><i class="ti ti-trash me-1"></i>
                                                    Delete</a>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
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
                        <label class="form-label" for="satuan">Satuan</label>
                        <select class="form-select @error('satuan') is-invalid @enderror" name="satuan" id="satuan" required>
                            <option value="">Pilih Satuan</option>
                            @foreach ($satuans as $satuan)
                                <option value="{{ $satuan->nama }}">{{ $satuan->nama }}</option>
                            @endforeach
                        </select>
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
                        <label class="form-label" for="kode_vendor">Vendor</label>
                        <select class="form-select @error('kode_vendor') is-invalid @enderror" name="kode_vendor" id="kode_vendor" required>
                            <option value="">Pilih Vendor</option>
                            @foreach ($vendors as $vendor)
                                <option value="{{ $vendor->kode_vendor }}">{{ $vendor->nama }}</option>
                            @endforeach
                        </select>
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
