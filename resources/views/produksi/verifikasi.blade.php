@extends('layouts.main')

@section('title', 'Verifikasi Product')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        @if (Session::has('error'))
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <span class="alert-icon text-danger me-2">
                    <i class="ti ti-ban ti-xs"></i>
                </span>
                {{ Session::get('error') }}
            </div>
        @endif

        <form
            action="/@role/verifikasi-bahan-baku/{{ Illuminate\Support\Facades\Crypt::encryptString($orders->first()->kode) }}"
            method="POST">
            @method('put')
            @csrf
            <div class="faq-header d-flex flex-column justify-content-center align-items-center rounded mb-4">
                <h3 class="text-center"> Scan Barcode Bahan Baku </h3>
                <div class="input-wrapper mb-3 input-group input-group-lg input-group-merge">
                    <span class="input-group-text" id="basic-addon1"><i class="ti ti-barcode"></i></span>
                    <input type="text" class="form-control" name="sku" placeholder="Scan Barcode" autofocus
                        autocomplete />
                </div>
                <p class="text-center mb-0 px-3">Atau Ketikan SKU Bahan Baku</p>
                <p class="text-center mb-0 px-3"><a href="/order-bahan-baku/{{ $orders->first()->kode }}"><i
                            class="ti ti-arrow-narrow-left"></i>Kembali</a></p>
            </div>
        </form>

        <div class="row invoice-preview">
            <!-- Invoice -->
            <div class="col-xl-12 col-md-8 col-12 mb-md-0 mb-4">
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
                                                <td>: <span
                                                        class="badge rounded-pill bg-label-warning">{{ $orders->first()->status }}</span>
                                                </td>
                                            @elseif ($orders->first()->status == 'Disetujui')
                                                <td>: <span
                                                        class="badge rounded-pill bg-label-success">{{ $orders->first()->status }}</span>
                                                </td>
                                            @elseif ($orders->first()->status == 'Ditolak')
                                                <td>: <span
                                                        class="badge rounded-pill bg-label-danger">{{ $orders->first()->status }}</span>
                                                </td>
                                            @elseif ($orders->first()->status == 'Dipesan')
                                                <td>: <span
                                                        class="badge rounded-pill bg-label-secondary">{{ $orders->first()->status }}</span>
                                                </td>
                                            @elseif ($orders->first()->status == 'Selsesai')
                                                <td>: <span
                                                        class="badge rounded-pill bg-label-info">{{ $orders->first()->status }}</span>
                                                </td>
                                            @endif

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="col-xl-6 col-md-12 col-sm-7 col-12">
                                <h6 class="mb-4">Bill To:</h6>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="pe-4">Total Due:</td>
                                            <td><strong>$12,110.55</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="pe-4">Bank name:</td>
                                            <td>American Bank</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-4">Country:</td>
                                            <td>United States</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-4">IBAN:</td>
                                            <td>ETD95476213874685</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-4">SWIFT code:</td>
                                            <td>BR91905</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> --}}
                        </div>
                    </div>
                    <div class="table-responsive border-top">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>SKU Bahan Baku</th>
                                    <th>Bahan Baku</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
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
                                    <tr class=@if ($order->catatan) "table-success" @else "table-danger" @endif>
                                        <td class="text-nowrap">{{ $order->sku_bahan_baku }}</td>
                                        <td class="text-nowrap">{{ $order->bahanbaku->nama }}</td>
                                        <td>@rupiah($order->bahanbaku->harga)</td>
                                        <td>{{ $order->jumlah }}</td>
                                        <td>@rupiah($order->bahanbaku->harga * $order->jumlah)</td>
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
                                </tr>
                            </tbody>
                        </table>
                    </div>

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
        </div>

    </div>
    <!--/ Content -->
@endsection
