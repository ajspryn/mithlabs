@extends('layouts.main')

@section('title', 'Detail Stok Bahan Baku')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            <!-- Earning Reports -->
            <div class="col-lg-12 mb-4">
                <div class="card h-100">
                    <div class="card-header pb-0 d-flex justify-content-between mb-lg-n4">
                        <div class="card-title mb-0">
                            <h5 class="mb-0">{{ $bahanbaku->nama }} <small
                                    class="text-muted">{{ $bahanbaku->warna }}</small></h5>
                            <small class="text-muted">{{ $bahanbaku->sku }}</small>
                        </div>
                        <div>
                            <button class="btn p-0" type="button" id="earningReportsId">
                                <i class="ti ti-printer ti-sm text-muted"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4 d-flex flex-column align-self-end">
                                <div class="d-flex gap-2 align-items-center mb-2 pb-1 flex-wrap mt-3">
                                    {!! DNS2D::getBarcodeHTML($bahanbaku->sku, 'QRCODE', 10, 10) !!}
                                </div>
                                <div class="d-flex gap-2 align-items-center mb-2 pb-1 flex-wrap">
                                    <h5 class="mb-0">@rupiah($bahanbaku->harga) / </h5>
                                    <div class="badge rounded bg-label-success">{{ $bahanbaku->satuan }}</div>
                                </div>
                            </div>
                            <div class="col-12 col-md-8 mt-3">
                                <!-- Vertical Scrollbar -->
                                <div class="card overflow-hidden mb-4" style="height: 300px;">
                                    <h5 class="card-header">Transaksi Keluar/Masuk</h5>
                                    <div class="card-body" id="vertical-example">
                                        @if ($bahanbaku->transaksi->count() > 0)
                                            <ul class="timeline mt-3 mb-0">
                                                @foreach ($bahanbaku->transaksi as $transaksi)
                                                    @if ($transaksi->jenis_transaksi == 'Barang Masuk')
                                                        <li
                                                            class="timeline-item timeline-item-success pb-4 border-left-dashed">
                                                            <span class="timeline-indicator timeline-indicator-success">
                                                                <i class="ti ti-transfer-in"></i>
                                                            </span>
                                                            <a href="/order-bahan-baku/{{ $transaksi->kode_order }}">
                                                                <div class="timeline-event">
                                                                    <div class="d-flex flex-sm-row flex-column">
                                                                        <div>
                                                                            <div class="timeline-header flex-wrap mb-2">
                                                                                <h6 class="mb-0">(Barang Masuk) Kode Order
                                                                                    {{ $transaksi->kode_order }}</h6>
                                                                                <span
                                                                                    class="text-muted">{{ $transaksi->created_at->diffForHumans() }}</span>
                                                                            </div>
                                                                            <table>
                                                                                <tbody>
                                                                                    @if (isset($transaksi->order->kode_produksi))
                                                                                        <tr>
                                                                                            <td class="pe-4">Kebutuhan
                                                                                            </td>
                                                                                            <td>: Di Order Untuk Produksi
                                                                                                {{ $transaksi->order->produksi }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    @else
                                                                                        <tr>
                                                                                            <td class="pe-4">Kebutuhan
                                                                                            </td>
                                                                                            <td>: Bukan Untuk Produksi</td>
                                                                                        </tr>
                                                                                    @endif
                                                                                    <tr>
                                                                                        <td>Status</td>
                                                                                        @if ($transaksi->order->status == 'Diajukan')
                                                                                            <td>: <span
                                                                                                    class="badge rounded-pill bg-label-warning">{{ $transaksi->order->status }}</span>
                                                                                            </td>
                                                                                        @elseif($transaksi->order->status == 'Disetujui')
                                                                                            <td>: <span
                                                                                                    class="badge rounded-pill bg-label-success">{{ $transaksi->order->status }}</span>
                                                                                            </td>
                                                                                        @elseif($transaksi->order->status == 'Ditolak')
                                                                                            <td>: <span
                                                                                                    class="badge rounded-pill bg-label-danger">{{ $transaksi->order->status }}</span>
                                                                                            </td>
                                                                                        @elseif($transaksi->order->status == 'Dipesan')
                                                                                            <td>: <span
                                                                                                    class="badge rounded-pill bg-label-secondary">{{ $transaksi->order->status }}</span>
                                                                                            </td>
                                                                                        @elseif($transaksi->order->status == 'Selsesai')
                                                                                            <td>: <span
                                                                                                    class="badge rounded-pill bg-label-info">{{ $transaksi->order->status }}</span>
                                                                                            </td>
                                                                                        @endif
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div
                                                                        class="d-flex justify-content-between flex-wrap flex-sm-row flex-column text-center">
                                                                        <div class="mb-sm-0 mb-2">
                                                                            <p class="mb-0">Vendor</p>
                                                                            <span
                                                                                class="text-muted">{{ $transaksi->order->vendor->nama }}</span>
                                                                        </div>
                                                                        <div class="mb-sm-0 mb-2">
                                                                            <p class="mb-0">Harga</p>
                                                                            <span
                                                                                class="text-muted">@rupiah($bahanbaku->harga * $transaksi->jumlah)</span>
                                                                        </div>
                                                                        <div>
                                                                            <p class="mb-0">Jumlah</p>
                                                                            <span
                                                                                class="text-muted">{{ $transaksi->jumlah }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    @else
                                                        <li
                                                            class="timeline-item timeline-item-danger pb-4 border-left-dashed">
                                                            <span class="timeline-indicator timeline-indicator-danger">
                                                                <i class="ti ti-transfer-out"></i>
                                                            </span>
                                                            <div class="timeline-event">
                                                                <div class="d-flex flex-sm-row flex-column">
                                                                    <div>
                                                                        <div class="timeline-header flex-wrap mb-2">
                                                                            <h6 class="mb-0">Sold Puma POPX Blue Color
                                                                            </h6>
                                                                            <span class="text-muted">5th October</span>
                                                                        </div>
                                                                        <p>
                                                                            PUMA presents the latest shoes from its
                                                                            collection.
                                                                            Light &
                                                                            comfortable made with highly durable material.
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-between flex-wrap flex-sm-row flex-column text-center">
                                                                    <div class="mb-sm-0 mb-2">
                                                                        <p class="mb-0">Customer</p>
                                                                        <span class="text-muted">Micheal Scott</span>
                                                                    </div>
                                                                    <div class="mb-sm-0 mb-2">
                                                                        <p class="mb-0">Price</p>
                                                                        <span class="text-muted">$375.00</span>
                                                                    </div>
                                                                    <div>
                                                                        <p class="mb-0">Quantity</p>
                                                                        <span class="text-muted">1</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @else
                                            <p style="text-align: center"> Tidak Ada Transaksi </p>
                                        @endif
                                    </div>
                                </div>
                                <!--/ Vertical Scrollbar -->
                            </div>
                        </div>
                        <div class="border rounded p-3 mt-2">
                            <div class="row gap-4 gap-sm-0">
                                <div class="col-12 col-sm-4">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="badge rounded bg-label-success p-1"><i
                                                class="ti ti-transfer-in ti-sm"></i></div>
                                        <h6 class="mb-0">Barang Masuk</h6>
                                    </div>
                                    <h4 class="my-2 pt-1">
                                        {{ $bahanbaku->transaksi->where('jenis_transaksi', 'Barang Masuk')->sum('jumlah') }}
                                    </h4>
                                    <div class="progress w-75" style="height:4px">
                                        <div class="progress-bar bg-success" role="progressbar"
                                            style="width: {{ $bahanbaku->transaksi->where('jenis_transaksi', 'Barang Masuk')->sum('jumlah') }}%"
                                            aria-valuenow="{{ $bahanbaku->transaksi->where('jenis_transaksi', 'Barang Masuk')->sum('jumlah') }}"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="badge rounded bg-label-primary p-1"><i
                                                class="ti ti-building-warehouse ti-sm"></i></div>
                                        <h6 class="mb-0">Stok Saat Ini</h6>
                                    </div>
                                    <h4 class="my-2 pt-1">{{ $bahanbaku->stok->stok }}</h4>
                                    <div class="progress w-75" style="height:4px">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ $bahanbaku->stok->stok }}%"
                                            aria-valuenow="{{ $bahanbaku->stok->stok }}" aria-valuemin="0"
                                            aria-valuemax="{{ $bahanbaku->transaksi->where('jenis_transaksi', 'Barang Masuk')->sum('jumlah') }}%"
                                            aria-valuenow="{{ $bahanbaku->transaksi->where('jenis_transaksi', 'Barang Masuk')->sum('jumlah') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="badge rounded bg-label-danger p-1"><i
                                                class="ti ti-transfer-out ti-sm"></i></div>
                                        <h6 class="mb-0">Barang Keluar</h6>
                                    </div>
                                    <h4 class="my-2 pt-1">
                                        {{ $bahanbaku->transaksi->where('jenis_transaksi', 'Barang Keluar')->sum('jumlah') }}
                                    </h4>
                                    <div class="progress w-75" style="height:4px">
                                        <div class="progress-bar bg-danger" role="progressbar"
                                            style="width: {{ $bahanbaku->transaksi->where('jenis_transaksi', 'Barang Keluar')->sum('jumlah') }}%"
                                            aria-valuenow="{{ $bahanbaku->transaksi->where('jenis_transaksi', 'Barang Keluar')->sum('jumlah') }}"
                                            aria-valuemin="0"
                                            aria-valuemax="{{ $bahanbaku->transaksi->where('jenis_transaksi', 'Barang Masuk')->sum('jumlah') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--/ Content -->
@endsection
