@extends('layouts.main')

@section('title', 'Setting Gudang Penyimpanan')

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
                            <th>Kode</th>
                            <th>Gudang</th>
                            <th>alamat</th>
                            <th style="text-align: center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gudangs as $gudang)
                            <tr>
                                <td></td>
                                <td style="text-align: center">{{ $loop->iteration }}</td>
                                <td>{{ $gudang->kode }}</td>
                                <td>{{ $gudang->nama }}
                                    @if ($gudang->status == 'Utama')
                                        <span class="badge bg-label-success ms-auto">{{ $gudang->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $gudang->alamat }}</td>
                                <td style="text-align: center">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            @if ($gudang->status == null)
                                                <form
                                                    action="/@role/setting/gudang-penyimpanan/{{ $gudang->id }}" method="POST" class="d-inline">
                                                @method('put')
                                                @csrf
                                                <input type="hidden" name="status" value="true">
                                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); this.closest('form').submit();"><i class="ti ti-discount-check me-1"></i> Jadikan Gudang Utama</a>
                                            </form> @endif
                                            <button class="dropdown-item"
                                                    type="button" class="btn btn-primary" aria-controls="offcanvasEnd" data-bs-toggle="offcanvas" data-bs-target="#edit{{ $gudang->id }}">
                                                    <i class="ti ti-pencil me-1"></i> Edit</button>
                                                    <form action="/@role/setting/gudang-penyimpanan/{{ $gudang->id }}" method="POST" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <a class="dropdown-item" href="#" onclick="return Swal.fire({title:'Apakah Anda yakin ingin menghapus data ini?',icon:'warning',showCancelButton:true,confirmButtonText:'Ya',cancelButtonText:'Tidak',reverseButtons:true}).then((result) => {if (result.isConfirmed) {this.closest('form').submit();} else {return false;}});"><i class="ti ti-trash me-1"></i>Delete</a>
                                                    </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal edit -->
                            <div class="offcanvas offcanvas-end" id="edit{{ $gudang->id }}">
                                <div class="offcanvas-header border-bottom">
                                    <h5 class="offcanvas-title" id="exampleModalLabel">Form Edit Gudang</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body flex-grow-1">
                                    <form class="needs-validation-edit pt-0 row g-2" id="form-edit" action="/@role/setting/gudang-penyimpanan/{{ $gudang->id }}" method="post">
                                        @method('put')
                                        @csrf
                                        <div class="col-sm-12">
                                            <label class="form-label" for="kode">Kode gudang</label>
                                            <input type="text" id="kode" class="form-control @error('kode') is-invalid @enderror" name="kode" placeholder="Masukan Kode gudang" required autofocus value="{{ old('kode', $gudang->kode) }}" />
                                        </div>
                                        <div class="col-sm-12">
                                            <label class="form-label" for="nama">Nama gudang</label>
                                            <input type="text" id="nama" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="Masukan Nama gudang" required value="{{ old('nama', $gudang->nama) }}" />
                                        </div>
                                        <div class="col-sm-12 mt-3">
                                            <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>
                                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--/ modal edit -->
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal to add new record -->
        <div class="offcanvas offcanvas-end" id="add-new-record">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title" id="exampleModalLabel">Form Tambah Gudang</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body flex-grow-1">
                <form class="needs-validation pt-0 row g-2" novalidate id="form-add-new-record" action="/@role/setting/gudang-penyimpanan" method="post">
                    @csrf
                    <div class="col-sm-12">
                        <label class="form-label" for="kode">Kode Gudang</label>
                        <input type="text" id="kode" class="form-control @error('kode') is-invalid @enderror" name="kode" placeholder="Masukan Kode Gudang" required autofocus />
                        <div class="valid-feedback">Ok!</div>
                        <div class="invalid-feedback">Harus Diisi.</div>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label" for="gudang">Nama Gudang</label>
                        <input type="text" id="gudang" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="Masukan Nama Gudang" required autofocus />
                        <div class="valid-feedback">Ok!</div>
                        <div class="invalid-feedback">Harus Diisi.</div>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label" for="alamat">Alamat Gudang</label>
                        <textarea type="text" id="alamat" class="form-control @error('alamat') is-invalid @enderror" name="alamat" placeholder="Masukan Alamat Gudang" required></textarea>
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
