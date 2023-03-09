@extends('layouts.main')

@section('title', 'Produksi')

@section('content')
    @php
        $kekurangan = 0;
    @endphp
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- User Profile Content -->
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-5">
                <!-- Profile Overview -->
                <div class="card mb-4">
                    <div class="user-profile-header-banner">
                        <img src="{{ asset('storage/' . $produksi->product->foto_product) }}" alt="Banner image" class="rounded-top">
                    </div>
                    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center">
                        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                            <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($produksi->product->sku, 'QRCODE', 15, 15) }}" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" style="background-color: white">
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
                            @if (Auth::user()->role_id == 6 && $produksi->status == 'Diproduksi')
                                <a class="btn btn-primary d-grid w-100 mb-2"
                                    href="/@role/verifikasi-product/{{ Illuminate\Support\Facades\Crypt::encryptString($produksi->kode) }}">
                                    <span class="d-flex align-items-center justify-content-center text-nowrap">
                                        <i class="ti ti-discount-check-filled ti-xs me-1"></i>Verifikasi Produk
                                    </span>
                                </a>
                            @elseif (Auth::user()->role_id == 2 && $produksi->status == 'Planning Produksi')
                                <button type="button" class="btn btn-success d-grid w-100 mb-2" data-bs-toggle="modal" data-bs-target="#setujui">
                                    <span class="d-flex align-items-center justify-content-center text-nowrap">
                                        <i class="ti ti-circle-check ti-xs me-1"></i>Setujui
                                    </span>
                                </button>
                                <!-- Modal setujui -->
                                <div class="modal fade" id="setujui"  aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel1">Silahkan Pilih Pengrajin</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="/@role/produksi/{{ $produksi->kode }}" class="needs-validation pt-0 row g-2" novalidate method="post">
                                                <div class="modal-body">
                                                    @method('put')
                                                    @csrf
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
                                                    <input type="hidden" name="status" value="Produksi Disetujui">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success"><i class="ti ti-circle-check ti-xs me-1"></i>Setujui</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <form action="/@role/produksi/{{ $produksi->kode }}" method="post">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="status" value="Produksi Ditolak">
                                    <a class="btn btn-outline-danger d-grid w-100 mb-2" onclick="return Swal.fire({title:'Apakah Anda yakin ingin menolak produksi ini?',icon:'warning',showCancelButton:true,confirmButtonText:'Ya',cancelButtonText:'Tidak',reverseButtons:true}).then((result) => {if (result.isConfirmed) {this.closest('form').submit();} else {return false;}});">
                                        <span class="d-flex align-items-center justify-content-center text-nowrap">
                                            <i class="ti ti-circle-x ti-xs me-1"></i>Tolak
                                        </span>
                                    </a>
                                </form>
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
                                    <div class="pt-1">
                                        <span>Tgl Mulai :</span>
                                        <span class="fw-semibold"> {{ $produksi->created_at->format('d-m-Y') }}</span>
                                    </div>
                                    <div class="pt-1">
                                        <span>Pengrajin :</span>
                                        @if ($produksi->pengrajin)
                                        <span class="fw-semibold"> {{ $produksi->pengrajin->nama }}</span>
                                        @endif
                                    </div>
                                    <div class="pt-1">
                                        <span>Status :</span>
                                        @if ($produksi->status == 'Planning Produksi')
                                            <span class="badge rounded-pill bg-label-warning">{{ $produksi->status }}</span>
                                        @elseif ($produksi->status == 'Produksi Disetujui')
                                            <span class="badge rounded-pill bg-label-success">{{ $produksi->status }}</span>
                                        @elseif ($produksi->status == 'Produksi Ditolak')
                                            <span class="badge rounded-pill bg-label-danger">{{ $produksi->status }}</span>
                                        @elseif ($produksi->status == 'Bahan Baku Dipesan')
                                            <span class="badge rounded-pill bg-label-warning">{{ $produksi->status }}</span>
                                        @elseif ($produksi->status == 'Bahan Baku Dikirim')
                                            <span class="badge rounded-pill bg-label-secondary">{{ $produksi->status }}</span>
                                        @elseif ($produksi->status == 'Sedang Di Produksi')
                                            <span class="badge rounded-pill bg-label-info">{{ $produksi->status }}</span>
                                        @elseif ($produksi->status == 'Produksi Selesai')
                                            <span class="badge rounded-pill bg-label-success">{{ $produksi->status }}</span>
                                        @endif
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
                                            <tr>
                                                <td class="pe-4">Catatan</td>
                                                <td>: {{ $produksi->catatan }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @if ($produksi->order->count() == 0)
                            <div class="table-responsive border-top">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>SKU Bahan Baku</th>
                                            <th>Bahan Baku</th>
                                            <th>Kebutuhan Produksi</th>
                                            <th>Stok Gudang</th>
                                            <th>Kekurangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $cek_kekurangan=0;
                                        @endphp
                                        @foreach ($assemblies as $assembly)
                                        @php
                                            $kebutuhan_produksi_lainnya=App\Models\Purchase\OrderBahanBaku::select()->whereNotNull('kode_produksi')->wherein('status',['Diajukan','Disetujui','Dipesan'])->where('sku_bahan_baku',$assembly->bahanbaku->sku)->where('kode','!=',$produksi->kode)->get()->sum('jumlah');
                                            $stok=$assembly->stok_bahanbaku->stok;
                                            $sku=$assembly->bahanbaku->sku;
                                            // $diorder=App\Models\Purchase\OrderBahanBaku::select()->whereNotNull('kode_produksi')->wherein('status',['Diajukan','Disetujui','Dipesan'])->where('sku_bahan_baku',$assembly->bahanbaku->sku)->get();
                                            $diorder=App\Models\Produksi\Produksi::withSum(['assembly' => function ($query) use ($sku) {$query->where('sku_bahan_baku', $sku);}],'jumlah')->has('assembly')->wherein('status',['Bahan Baku Dikirim','Bahan Baku Dipesan'])->where('kode','!=',$produksi->kode)->get();
                                            $dipakai=0;
                                            $qyt=0;
                                            if ($diorder->count()>0) {
                                                $dipakai=App\Models\Produksi\Produksi::withSum(['assembly' => function ($query) use ($sku) {$query->where('sku_bahan_baku', $sku);}],'jumlah')->has('assembly')->wherein('status',['Bahan Baku Dikirim','Bahan Baku Dipesan'])->where('kode','!=',$produksi->kode)->get()->sum('assembly_sum_jumlah');
                                                $qyt=App\Models\Produksi\Produksi::withSum(['assembly' => function ($query) use ($sku) {$query->where('sku_bahan_baku', $sku);}],'jumlah')->has('assembly')->wherein('status',['Bahan Baku Dikirim','Bahan Baku Dipesan'])->where('kode','!=',$produksi->kode)->get()->sum('jumlah');
                                            }
                                            if ($stok - $dipakai*$qyt > 0 && $diorder->count()>0) {
                                                foreach ($diorder as $value) {
                                                    $tes='a';
                                                    $kebutuhan=$assembly->jumlah * $produksi->jumlah;
                                                    $sisa=max(0,($stok - $dipakai*$qyt));
                                                    $stok=$sisa ;
                                                    $cek_kekurangan=min(0,($stok-$kebutuhan));
                                                    $kekurangan=abs($cek_kekurangan);
                                                }
                                            }else{
                                                $tes='b';
                                                $kebutuhan=$assembly->jumlah * $produksi->jumlah;
                                                $sisa=max(0,($stok - $dipakai*$qyt));
                                                $stok=$sisa;
                                                $cek_kekurangan=min(0,($stok-$kebutuhan));
                                                $kekurangan=abs($cek_kekurangan);
                                            }
                                        @endphp
                                            <tr>
                                                {{-- @dump($diorder->count()>0) --}}
                                                {{-- <dd>{{ $diorder }}</dd> --}}
                                                <td class="text-nowrap">{{ $assembly->bahanbaku->sku }}</td>
                                                <td class="text-nowrap">{{ $assembly->bahanbaku->nama }}</td>
                                                <td>{{ $assembly->jumlah * $produksi->jumlah }}</td>
                                                <td>{{ $sisa }}</td>
                                                <td>{{ $kekurangan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        <div class="card-body mx-3">
                            <div class="row">
                                <div class="col-12">
                                    @if (Auth::user()->role_id == 6)
                                        @if ($produksi->status == 'Bahan Baku Dipesan')
                                            <a class="btn btn-primary d-grid w-100 mb-2" href="/@role/verifikasi-bahan-baku/{{ Illuminate\Support\Facades\Crypt::encryptString($produksi->order->first()->kode) }}">
                                                <span class="d-flex align-items-center justify-content-center text-nowrap">
                                                    <i class="ti ti-discount-check-filled ti-xs me-1"></i>Verifikasi Bakan Baku
                                                </span>
                                            </a>
                                        @endif
                                        @if ($kekurangan == 0 && $produksi->status == 'Produksi Disetujui' && $produksi->order->count() == 0)
                                            <form action="/@role/transaksi-bahan-baku" method="POST">
                                                @csrf
                                                <input type="hidden" name="kode_produksi" value="{{ $produksi->kode }}">
                                                <input type="hidden" name="jenis_transaksi" value="Keluar">
                                                <input type="hidden" name="sku_product" value="{{ $produksi->sku_produk }}">
                                                <button type="submit" class="btn btn-primary d-grid w-100 mb-2">
                                                    <span class="d-flex align-items-center justify-content-center text-nowrap">
                                                        <i class="ti ti-send ti-xs me-1"></i>Kirim Bahan Baku
                                                    </span>
                                                </button>
                                            </form>
                                        @endif
                                    @endif
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
                        @if ($produksi->order->count() == 0 && $kekurangan > 0 && $produksi->status == 'Produksi Disetujui' && Auth::user()->role_id == 3)
                            <div class="card card-action mb-4">
                                <div class="card-header align-items-center">
                                    <h5 class="card-action-title mb-0">Form Order Bahan Baku</h5>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                                        <span class="alert-icon text-danger me-2">
                                            <i class="ti ti-exclamation-mark ti-xs"></i>
                                        </span>
                                        Tidak Boleh Ada Data Yang Kosong
                                    </div>
                                    <form id="form" class="form-repeater" action="/@role/order-bahan-baku" method="POST">
                                        @csrf
                                        <div data-repeater-list="order_bahan_baku">
                                            @foreach ($assemblies as $assembly)
                                            @php
                                                $kebutuhan_produksi_lainnya=App\Models\Purchase\OrderBahanBaku::select()->whereNotNull('kode_produksi')->wherein('status',['Diajukan','Disetujui','Dipesan'])->where('sku_bahan_baku',$assembly->bahanbaku->sku)->where('kode','!=',$produksi->kode)->get()->sum('jumlah');
                                                $stok=$assembly->stok_bahanbaku->stok;
                                                $sku=$assembly->bahanbaku->sku;
                                                // $diorder=App\Models\Purchase\OrderBahanBaku::select()->whereNotNull('kode_produksi')->wherein('status',['Diajukan','Disetujui','Dipesan'])->where('sku_bahan_baku',$assembly->bahanbaku->sku)->get();
                                                $diorder=App\Models\Produksi\Produksi::withSum(['assembly' => function ($query) use ($sku) {$query->where('sku_bahan_baku', $sku);}],'jumlah')->has('assembly')->wherein('status',['Bahan Baku Dikirim','Bahan Baku Dipesan'])->where('kode','!=',$produksi->kode)->get();
                                                $dipakai=0;
                                                $qyt=0;
                                                if ($diorder->count()>0) {
                                                    $dipakai=App\Models\Produksi\Produksi::withSum(['assembly' => function ($query) use ($sku) {$query->where('sku_bahan_baku', $sku);}],'jumlah')->has('assembly')->wherein('status',['Bahan Baku Dikirim','Bahan Baku Dipesan'])->where('kode','!=',$produksi->kode)->get()->sum('assembly_sum_jumlah');
                                                    $qyt=App\Models\Produksi\Produksi::withSum(['assembly' => function ($query) use ($sku) {$query->where('sku_bahan_baku', $sku);}],'jumlah')->has('assembly')->wherein('status',['Bahan Baku Dikirim','Bahan Baku Dipesan'])->where('kode','!=',$produksi->kode)->get()->sum('jumlah');
                                                }
                                                if ($stok - $dipakai*$qyt > 0 && $diorder->count()>0) {
                                                    foreach ($diorder as $value) {
                                                        $tes='a';
                                                        $kebutuhan=$assembly->jumlah * $produksi->jumlah;
                                                        $sisa=max(0,($stok - $dipakai*$qyt));
                                                        $stok=$sisa ;
                                                        $cek_kekurangan=min(0,($stok-$kebutuhan));
                                                        $kekurangan=abs($cek_kekurangan);
                                                    }
                                                }else{
                                                    $tes='b';
                                                    $kebutuhan=$assembly->jumlah * $produksi->jumlah;
                                                    $sisa=max(0,($stok - $dipakai*$qyt));
                                                    $stok=$sisa;
                                                    $cek_kekurangan=min(0,($stok-$kebutuhan));
                                                    $kekurangan=abs($cek_kekurangan);
                                                }
                                            @endphp
                                                @if ($kekurangan > 0)

                                                <div data-repeater-item>
                                                    <div class="row">
                                                        <div class="mb-3 col-lg-12 col-xl-4 col-12 mb-0">
                                                            <label class="form-label" for="form-repeater-1-1">Bahan
                                                                Baku</label>
                                                                <select id="form-repeater-1-1"
                                                                class="form-select @error('sku_bahan_baku') is-invalid @enderror"
                                                                name="sku_bahan_baku" required>
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
                                                            value="{{ $kekurangan }}" />
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
                            </div> @endif
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <!--/ Teams -->                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <!--/ User Profile Content -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <!--/ Content -->

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            @endsection
