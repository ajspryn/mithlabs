@extends('layouts.main')

@section('title', 'Order Bahan Baku')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row invoice-preview">
            <!-- Invoice -->
            <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
                <div class="card invoice-preview-card">
                    <div class="card-body">
                        <div class="row p-sm-3 p-0">
                            <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                                <h2 class="mb-3">Detail Order Bahan Baku</h2>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="pe-4">Kode Order</td>
                                            <td>: <strong>{{ $orders->first()->kode }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="pe-4">Tgl Order</td>
                                            <td>: {{ $orders->first()->created_at }}</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-4">Kode Produksi</td>
                                            <td>:
                                                {{ $orders->first()->kode_produksi ?? 'Order Ini Tidak Berdasarkan Produksi', $orders->first()->kode_produksi }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pe-4">Status</td>
                                            @if ($orders->first()->status == 'Diajukan')
                                                <td>: <span class="badge rounded-pill bg-label-warning">{{ $orders->first()->status }}</span>
                                                </td>
                                            @elseif ($orders->first()->status == 'Disetujui')
                                                <td>: <span class="badge rounded-pill bg-label-success">{{ $orders->first()->status }}</span>
                                                </td>
                                            @elseif ($orders->first()->status == 'Ditolak')
                                                <td>: <span class="badge rounded-pill bg-label-danger">{{ $orders->first()->status }}</span>
                                                </td>
                                            @elseif ($orders->first()->status == 'Dipesan')
                                                <td>: <span class="badge rounded-pill bg-label-secondary">{{ $orders->first()->status }}</span>
                                                </td>
                                            @elseif ($orders->first()->status == 'Selsesai')
                                                <td>: <span class="badge rounded-pill bg-label-info">{{ $orders->first()->status }}</span>
                                                </td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if (Auth::user()->role_id == 3 && $orders[0]->kode_vendor == null)
                        <div class="card card-action mb-4">
                            <div class="card-body">
                                <form id="form" class="form-repeater"
                                    action="/@role/order-bahan-baku" method="POST">
                                    @csrf
                                    <div data-repeater-list="order_bahan_baku">
                                    @php
                                        $harga = 0;
                                    @endphp
                                    @foreach ($orders as $order)
                                        @php
                                            $harga = $harga + $order->bahanbaku->harga * $order->jumlah;
                                        @endphp
                                        <div data-repeater-item>
                                            <div class="row">
                                                <div class="mb-3 col-lg-12 col-xl-5 col-12 mb-0">
                                                    <label class="form-label" for="form-repeater-{{ $loop->iteration }}-1">Bahan Baku</label>
                                                    <select id="form-repeater-{{ $loop->iteration }}-1" class="form-select @error('sku_bahan_baku') is-invalid @enderror" name="sku_bahan_baku">
                                                        <option value="">Pilih Bahan Baku</option>
                                                        @foreach ($bahan_bakus as $bahan_baku)
                                                            <option value="{{ $bahan_baku->sku }}" {{ old('sku_bahan_baku', $order->sku_bahan_baku) ? 'selected' : '' }}>{{ $bahan_baku->nama }} -
                                                                ({{ $bahan_baku->warna }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-lg-12 col-xl-5 col-12 mb-0">
                                                    <label class="form-label" for="form-repeater-{{ $loop->iteration }}-2">Vendor</label>
                                                    <select id="form-repeater-{{ $loop->iteration }}-2"
                                                        class="form-select @error('kode_vendor') is-invalid @enderror" name="kode_vendor" @if (Auth::user()->role_id != 3) disable @endif>
                                                        <option value="">Pilih Vendor</option>
                                                        @foreach ($vendors as $vendor)
                                                            <option value="{{ $vendor->kode }}" {{ old('kode_vendor', $order->kode_vendor) ? 'selected' : '' }}>{{ $vendor->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-lg-12 col-xl-2 col-12 mb-0">
                                                    <label class="form-label" for="form-repeater-{{ $loop->iteration }}-3">Jumlah</label>
                                                    <input type="number" id="form-repeater-{{ $loop->iteration }}-3" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" placeholder="Masukan Jumlah" value="{{ $order->jumlah }}" readonly/>
                                                </div>
                                            </div>
                                            <hr />
                                        </div>
                                    @endforeach
                                    </div>
                                    <div class="mb-3 col-lg-6 col-xl-12 col-12 mb-0">
                                        <button class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('form').submit();">
                                            Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="table-responsive border-top">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>SKU Bahan Baku</th>
                                        <th>Bahan Baku</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Vendor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $harga = 0;
                                    @endphp
                                    @foreach ($orders as $order)
                                        @php
                                            $harga = $harga + $order->bahanbaku->harga * $order->jumlah;
                                        @endphp
                                        <tr>
                                            <td class="text-nowrap">{{ $order->sku_bahan_baku }}</td>
                                            <td class="text-nowrap">{{ $order->bahanbaku->nama }}</td>
                                            <td>@rupiah($order->bahanbaku->harga)</td>
                                            <td>{{ $order->jumlah }}</td>
                                            <td>@rupiah($order->bahanbaku->harga * $order->jumlah)</td>
                                            @if ($order->vendor)
                                                <td>{{ $order->vendor->nama }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3" class="align-top px-4 py-4">
                                            @if ($order->first()->produksi)
                                                <p class="mb-2 pt-3">Diorder Untuk Kebutuhan Produksi :</p>
                                                <p class="mb-2">{{ $order->first()->produksi->sku_product }}</p>
                                                <p class="mb-2"></p>
                                                <p class="mb-0 pb-3"></p>
                                            @endif
                                        </td>
                                        <td class="text-end pe-3 py-4">
                                            <p class="mb-0 pb-3">Total:</p>
                                        </td>
                                        <td class="ps-2 py-4">
                                            <p class="fw-semibold mb-0 pb-3">@rupiah($harga)</p>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <div class="card-body mx-3">
                        <div class="row">
                            <div class="col-12">
                                @if ($order->first()->order)
                                    <span class="fw-semibold">Catatan Produksi:</span>
                                    <span>{{ $order->first()->produksi->catatan }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Invoice -->

            <!-- Invoice Actions -->
            <div class="col-xl-3 col-md-4 col-12 invoice-actions">
                <div class="card">
                    <div class="card-body">
                        @if (Auth::user()->role_id == 6 && $orders->first()->status == 'Dipesan')
                            <a class="btn btn-primary d-grid w-100 mb-2"
                                href="/@role/verifikasi-bahan-baku/{{ Illuminate\Support\Facades\Crypt::encryptString($orders->first()->kode) }}">
                            <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                    class="ti ti-discount-check-filled ti-xs me-1"></i>Verifikasi
                                </span>
                            </a>
                        @endif
                        @if (Auth::user()->role_id == 2 && $orders->first()->status == 'Diajukan')
                            <button class="btn btn-outline-success d-grid w-100 mb-2" data-bs-toggle="offcanvas" data-bs-target="#acc">
                                <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                        class="ti ti-checkbox ti-xs me-1"></i>Setujui</span>
                            </button>
                            <button class="btn btn-danger d-grid w-100 mb-2" data-bs-toggle="offcanvas"
                                    data-bs-target="#tolak">
                                    <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                            class="ti ti-x ti-xs me-1"></i>Tolak</span>
                            </button> @endif
                                <button class="btn
                                    btn-secondary d-grid w-100" data-bs-toggle="offcanvas" data-bs-target="#addPaymentOffcanvas">
                                    <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="ti ti-printer ti-xs me-1"></i>Print Bacode</span>
                                    </button>
                            </div>
                        </div>
                </div>
                <!-- /Invoice Actions -->
            </div>

            <!-- Offcanvas -->
            <!-- Send Invoice Sidebar -->
            <div class="offcanvas offcanvas-end" id="acc" aria-hidden="true">
                <div class="offcanvas-header my-1">
                    <h5 class="offcanvas-title">Sejutui Order</h5>
                    <a type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></a>
                </div>
                <div class="offcanvas-body pt-0 flex-grow-1">
                    <form method="POST" action="/@role/order-bahan-baku/{{ $orders->first()->kode }}">
                        @method('put')
                        @csrf
                        <h3>Apakah Anda Yakin Ingin Menyetujui Order Ini ?</h3>
                        <div class="mb-3">
                            <label for="invoice-message" class="form-label">Catatan</label>
                            <textarea class="form-control" name="catatan" id="invoice-message" cols="3" rows="3"></textarea>
                        </div>
                        <input type="hidden" name="status" value="Disetujui">
                        <div class="mb-3 d-flex flex-wrap">
                            <button type="submit" class="btn btn-success me-3" data-bs-dismiss="offcanvas">Setujui</button>
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Send Invoice Sidebar -->

            <!-- Add Payment Sidebar -->
            <div class="offcanvas offcanvas-end" id="tolak" aria-hidden="true">
                <div class="offcanvas-header my-1">
                    <h5 class="offcanvas-title">Sejutui Order</h5>
                    <a type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></a>
                </div>
                <div class="offcanvas-body pt-0 flex-grow-1">
                    <form class="needs-validation pt-0 row g-2" novalidate method="POST" action="/@role/order-bahan-baku/{{ $orders->first()->kode }}">
                        @method('put')
                        @csrf
                        <h3>Apakah Anda Yakin Ingin Menyetujui Order Ini ?</h3>
                        <div class="mb-3">
                            <label for="invoice-message" class="form-label">Catatan</label>
                            <textarea class="form-control" name="catatan" id="invoice-message" cols="3" rows="3" required></textarea>
                            <div class="valid-feedback">Ok!</div>
                            <div class="invalid-feedback">Harus Diisi.</div>
                        </div>
                        <input type="hidden" name="status" value="Ditolak">
                        <div class="mb-3 d-flex flex-wrap">
                            <button type="submit" class="btn btn-success me-3" data-bs-dismiss="offcanvas">Setujui</button>
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Add Payment Sidebar -->

            <!-- /Offcanvas -->

        </div>
        <!--/ Content -->
    @endsection
