@extends('layouts.main')

@section('title', 'Order Bahan Baku')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">UI Elements /</span> Cards Basic</h4> --}}
        <div class="row">
            <!-- table order bahan baku -->
            <div class="col-lg-12 mb-4 order-1 order-lg-2 mb-4 mb-lg-0">
                <div class="card h-100">
                    <div class="table-responsive card-datatable">
                        <table class="datatables-basic table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th style="text-align: center">No</th>
                                    <th style="text-align: center">Kode Order</th>
                                    <th style="text-align: center">Tanggal Order</th>
                                    <th style="text-align: center">Jumlah Item Bahan Baku</th>
                                    <th style="text-align: center">Jumlah Qyt Bahan Baku</th>
                                    <th style="text-align: center">Jumlah Harga</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    @php
                                        $query = App\Models\Purchase\OrderBahanBaku::with('bahanbaku')
                                            ->select()
                                            ->where('kode', $order->kode)
                                            ->get();
                                        $bahan_bakus = App\Models\Warehouse\BahanBaku::all();
                                        $jumlah = $query->sum('jumlah');
                                        $harga = 0;
                                        foreach ($query as $key => $data) {
                                            $sku = $data->sku_bahan_baku;
                                            $hitung = $data->jumlah * $data->bahanbaku->harga;
                                            $harga = $harga + $hitung;
                                        }
                                        $jumlah_harga = $harga;
                                    @endphp
                                    <tr>
                                        <td></td>
                                        <td style="text-align: center">{{ $loop->iteration }}</td>
                                        <td style="text-align: center">{{ $order->kode }}</td>
                                        <td style="text-align: center">{{ $query->first()->created_at->format('d-m-Y') }}
                                        </td>
                                        <td style="text-align: center">{{ $query->count() }}</td>
                                        <td style="text-align: center">{{ $jumlah }}</td>
                                        <td style="text-align: center">@rupiah($jumlah_harga)</td>
                                        <td style="text-align: center">
                                            @if ($query->first()->status == 'Diajukan')
                                                <span class="badge rounded-pill bg-label-warning">{{ $query->first()->status }}</span>
                                            @elseif ($query->first()->status == 'Disetujui')
                                                <span class="badge rounded-pill bg-label-success">{{ $query->first()->status }}</span>
                                            @elseif ($query->first()->status == 'Ditolak')
                                                <span class="badge rounded-pill bg-label-danger">{{ $query->first()->status }}</span>
                                            @elseif ($query->first()->status == 'Dipesan')
                                                <span class="badge rounded-pill bg-label-secondary">{{ $query->first()->status }}</span>
                                            @elseif ($query->first()->status == 'Selsesai')
                                                <span class="badge rounded-pill bg-label-info">{{ $query->first()->status }}</span>
                                            @endif
                                        </td>
                                        <td style="text-align: center">
                                            <a class="btn-btn-primary" href="/@role/order-bahan-baku/{{ $order->kode }}"><i class="ti ti-eye me-1"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--/ table order bahan baku -->
        </div>

        <!-- Modal to add new record -->
        <div class="offcanvas offcanvas-end" id="add-new-record">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title" id="exampleModalLabel">Form Tambah Bahan Baku</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body flex-grow-1">
                <form id="form" class="form-repeater" action="/@role/order-bahan-baku" method="POST">
                    @csrf
                    <div data-repeater-list="order_bahan_baku">
                        <div data-repeater-item>
                            <div class="row">
                                <div class="mb-3 col-lg-12 col-xl-6 col-12 mb-0">
                                    <label class="form-label" for="form-repeater-1-1">Bahan Baku</label>
                                    <select id="form-repeater-1-1" class="form-select @error('sku_bahan_baku') is-invalid @enderror" name="sku_bahan_baku">
                                        <option value="">Pilih Bahan Baku</option>
                                        @foreach ($bahan_bakus as $bahan_baku)
                                            <option value="{{ $bahan_baku->sku }}">{{ $bahan_baku->nama }} -
                                                ({{ $bahan_baku->warna }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- <div class="mb-3 col-lg-12 col-xl-6 col-12 mb-0">
                                    <label class="form-label" for="form-repeater-1-2">Vendor</label>
                                    <select id="form-repeater-1-2"
                                        class="form-select @error('kode_vendor') is-invalid @enderror" name="kode_vendor">
                                        <option value="">Pilih Vendor</option>
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->kode }}">{{ $vendor->nama }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="mb-3 col-lg-12 col-xl-4 col-12 mb-0">
                                    <label class="form-label" for="form-repeater-1-3">Jumlah</label>
                                    <input type="number" id="form-repeater-1-3" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" placeholder="Masukan Jumlah" />
                                </div>
                                <div class="mb-3 col-lg-12 col-xl-2 col-12 d-flex align-items-center mb-0">
                                    <button class="btn btn-label-danger mt-4" data-repeater-delete>
                                        <i class="ti ti-x ti-xs me-1"></i>
                                        {{-- <span class="align-middle">Delete</span> --}}
                                    </button>
                                </div>
                            </div>
                            <hr />
                        </div>
                    </div>
                    <div class="mb-3 col-lg-6 col-xl-12 col-12 mb-0">
                        <button class="btn btn-outline-primary" data-repeater-create>
                            <i class="ti ti-plus me-1"></i>
                            <span class="align-middle">Add</span>
                        </button>
                        <button class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('form').submit();">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!--/ DataTable with Buttons -->

    </div>
    <!--/ Content -->
@endsection
