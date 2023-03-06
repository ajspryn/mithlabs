@extends('layouts.main')

@section('title', 'Setting Vendor')

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
                            <th style="text-align: center">Kode</th>
                            <th style="text-align: center">Nama</th>
                            <th style="text-align: center">Alamat</th>
                            <th style="text-align: center">PIC</th>
                            <th style="text-align: center">No Telp</th>
                            <th style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vendors as $vendor)
                            <tr>
                                <td></td>
                                <td style="text-align: center">{{ $loop->iteration }}</td>
                                <td style="text-align: center">{{ $vendor->kode_vendor }}</td>
                                <td>{{ $vendor->nama }}</td>
                                <td>{{ $vendor->alamat }}</td>
                                <td>{{ $vendor->pic }}</td>
                                <td style="text-align: center">{{ $vendor->no_telp }}</td>
                                <td style="text-align: center">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-pencil me-1"></i> Edit</a>
                                            <form action="/@role/setting/vendor/{{ $vendor->id }}" method="POST" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); this.closest('form').submit();"><i class="ti ti-trash me-1"></i>
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
                <h5 class="offcanvas-title" id="exampleModalLabel">Form Tambah Vendor</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body flex-grow-1">
                <form class="needs-validation pt-0 row g-2" novalidate id="form-add-new-record" action="/@role/setting/vendor" method="post">
                    @csrf
                    <div class="col-sm-12">
                        <label class="form-label" for="kode_vendor">Kode Vendor</label>
                        <input type="text" id="kode_vendor" class="form-control @error('kode') is-invalid @enderror" name="kode" placeholder="Masukan Kode Vendor" required autofocus />
                        <p class="valid-feedback">Ok!</p>
                        <p class="invalid-feedback">Harus Diisi.</p>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label" for="nama">Nama</label>
                        <input type="text" id="nama" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="Masukan Nama Vendor" required />
                        <p class="valid-feedback">Ok!</p>
                        <p class="invalid-feedback">Harus Diisi.</p>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label" for="alamat">Alamat</label>
                        <textarea type="text" id="alamat" class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Masukan Alamat Vendor" required></textarea>
                        <p class="valid-feedback">Ok!</p>
                        <p class="invalid-feedback">Harus Diisi.</p>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label" for="pic">PIC Vendor</label>
                        <input type="text" id="pic" class="form-control @error('pic') is-invalid @enderror" name="pic" placeholder="Masukan PIC Vendor" required />
                        <p class="valid-feedback">Ok!</p>
                        <p class="invalid-feedback">Harus Diisi.</p>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label" for="no_telp">No Telp</label>
                        <input type="number" id="no_telp" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" placeholder="Masukan No Telp Vendor" required />
                        <p class="valid-feedback">Ok!</p>
                        <p class="invalid-feedback">Harus Diisi.</p>
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
