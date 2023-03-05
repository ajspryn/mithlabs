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
                                <td style="text-align: center">
                                    <a class="btn-btn-primary"
                                        href="/@role/stok-bahan-baku/{{ Illuminate\Support\Facades\Crypt::encryptString($bahan_baku->sku) }}">
                                        <i class="ti ti-eye me-1"></i>
                                    </a>
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
                <ul class="nav nav-tabs nav-fill" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#forminput" aria-controls="forminput" aria-selected="true">
                            <i class="tf-icons ti ti-clipboard-text ti-xs me-1"></i> Form
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#formexel" aria-controls="formexel" aria-selected="false">
                            <i class="tf-icons ti ti-file-import ti-xs me-1"></i> Import Exel
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="forminput" role="tabpanel">
                        <form class="needs-validation pt-0 row g-2" novalidate id="form-add-new-record"
                            action="/@role/bahan-baku" method="post">
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
                                <input type="text" id="nama"
                                    class="form-control @error('nama') is-invalid @enderror" name="nama"
                                    placeholder="Masukan Nama Bahan Baku" required />
                                <div class="valid-feedback">Ok!</div>
                                <div class="invalid-feedback">Harus Diisi.</div>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label" for="warna">Warna</label>
                                <select class="form-select @error('warna') is-invalid @enderror" name="warna"
                                    id="warna" required>
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
                                <select class="form-select @error('satuan') is-invalid @enderror" name="satuan"
                                    id="satuan" required>
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
                                <input type="number" id="harga"
                                    class="form-control @error('harga') is-invalid @enderror" name="harga"
                                    placeholder="Masukan Harga/Satuan" required />
                                <div class="valid-feedback">Ok!</div>
                                <div class="invalid-feedback">Harus Diisi.</div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary"
                                    data-bs-dismiss="offcanvas">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="formexel" role="tabpanel">
                        <form class="needs-validation pt-0 row g-2" novalidate id="form-upload-new-record" method="post"
                            action="/@role/bahan-baku" enctype="multipart/form-data">
                            @csrf
                            <div class="col-sm-12">
                                <label class="form-label" for="upload_file">Upload File Exel</label>
                                <input type="file" class="form-control @error('upload_file') is-invalid @enderror"
                                    id="upload_file" name="upload_file" accept=".xlsx,.csv" required />
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary"
                                    data-bs-dismiss="offcanvas">Cancel</button>
                            </div>
                            <div class="d-flex flex-column ps-1">
                                <h5 class="alert-heading mb-2">Perhatian !!!</h5>
                                <p class="mb-0">- Pastikan Semua Data Setting Sudah Diisi Semua</p>
                                <p class="mb-0">- Sesuainkan Format Excel/CSV Sesuai Dengan Ketentuan <a
                                        href="/import/bahan_bakus.xlsx">(Download Format Disini)</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ DataTable with Buttons -->

    </div>
    <!--/ Content -->
@endsection
