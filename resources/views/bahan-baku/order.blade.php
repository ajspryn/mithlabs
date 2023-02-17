@extends('layouts.main')

@section('title', 'Order Bahan Baku')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">


        <div class="row">
            <!-- table order bahan baku -->
            <div class="col-lg-12 mb-4 order-1 order-lg-2 mb-4 mb-lg-0">
                <div class="card h-100">
                    <h5 class="card-header">Table Order Bahan Baku</h5>
                    <div class="table-responsive card-datatable">
                        <table class="table datatable-invoice border-top">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th style="text-align: center">No</th>
                                    <th style="text-align: center">Kode Order</th>
                                    <th style="text-align: center">Tanggal Order</th>
                                    <th style="text-align: center">Jumlah Item Bahan Baku</th>
                                    <th style="text-align: center">Jumlah Qyt Bahan Baku</th>
                                    <th style="text-align: center">Jumlah Harga</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    @php
                                        $query = App\Models\Purchase\OrderBahanBaku::with('bahanbaku')
                                            ->select()
                                            ->where('kode_order', $order->kode_order)
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
                                        <td style="text-align: center">{{ $order->kode_order }}</td>
                                        <td style="text-align: center">{{ $query->first()->created_at->format('d-m-Y') }}</td>
                                        <td style="text-align: center">{{ $query->count() }}</td>
                                        <td style="text-align: center">{{ $jumlah }}</td>
                                        <td style="text-align: center">@rupiah($jumlah_harga)</td>
                                        <td style="text-align: center"></td>
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
                        <label class="form-label" for="harga">Harga/Satuan</label>
                        <input type="number" id="harga" class="form-control @error('harga') is-invalid @enderror" name="harga"
                            placeholder="Masukan Harga/Satuan" required />
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
