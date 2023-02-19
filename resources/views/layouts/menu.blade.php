{{-- admin --}}
@if (Auth::user()->role_id == 0)
    <!-- Menu -->
    <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
        <div class="container-xxl d-flex h-100">
            <ul class="menu-inner">
                <!-- Dashboards -->
                <li class="menu-item {{ Request::is('/') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-smart-home"></i>
                        <div data-i18n="Dashboards">Dashboards</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ Request::is('/') ? 'active' : '' }}">
                            <a href="/" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-chart-pie-2"></i>
                                <div data-i18n="Analytics">Analytics</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Layouts -->
                <li class="menu-item {{ Request::is('admin/user*') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-users"></i>
                        <div data-i18n="User">User</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ Request::is('admin/user*') ? 'active' : '' }}">
                            <a href="/admin/user" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-user-search"></i>
                                <div data-i18n="Data User">Data User</div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </aside>
    <!-- / Menu -->

    {{-- owner --}}
@elseif (Auth::user()->role_id == 1)
    <!-- Menu -->
    <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
        <div class="container-xxl d-flex h-100">
            <ul class="menu-inner">
                <!-- Dashboards -->
                <li class="menu-item {{ Request::is('/') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-smart-home"></i>
                        <div data-i18n="Dashboards">Dashboards</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ Request::is('/') ? 'active' : '' }}">
                            <a href="/" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-chart-pie-2"></i>
                                <div data-i18n="Analytics">Analytics</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Produksi -->
                <li class="menu-item {{ Request::is('owner/product*') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-building-factory-2"></i>
                        <div data-i18n="Produksi">Produksi</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ Request::is('owner/product*') ? 'active' : '' }}">
                            <a href="/owner/product" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-building-store"></i>
                                <div data-i18n="Data Produk">Data Produk</div>
                            </a>
                        </li>
                        <li class="menu-item {{ Request::is('owner/rencana-produksi*') ? 'active' : '' }}">
                            <a href="/owner/rencana-produksi" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-file-time"></i>
                                <div data-i18n="Rencana Produksi">Rencana Produksi</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Plan Produksi -->
                <li class="menu-item {{ Request::is('owner/order-bahan-baku*') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-file-description"></i>
                        <div data-i18n="Pengajuan">Pengajuan</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ Request::is('owner/order-bahan-baku*') ? 'active' : '' }}">
                            <a href="/owner/order-bahan-baku" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-clipboard-text"></i>
                                <div data-i18n="Bahan Baku">Bahan Baku</div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </aside>
    <!-- / Menu -->

    {{-- purchase --}}
@elseif (Auth::user()->role_id == 2)
    <!-- Menu -->
    <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
        <div class="container-xxl d-flex h-100">
            <ul class="menu-inner">
                <!-- Dashboards -->
                <li class="menu-item {{ Request::is('/') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-smart-home"></i>
                        <div data-i18n="Dashboards">Dashboards</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ Request::is('/') ? 'active' : '' }}">
                            <a href="/" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-chart-pie-2"></i>
                                <div data-i18n="Analytics">Analytics</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Layouts -->
                <li
                    class="menu-item {{ Request::is('warehouse/inventory*', 'warehouse/asembly*', 'warehouse/product*', 'warehouse/product-stock*', 'warehouse/setting*', 'warehouse/transaksi-bahan-baku*') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-building-warehouse"></i>
                        <div data-i18n="Warehouse">Warehouse</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ Request::is('warehouse/product*', 'warehouse/product-stock*') ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-shopping-cart"></i>
                                <div data-i18n="Product">Product</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item {{ Request::is('warehouse/product*') ? 'active' : '' }}">
                                    <a href="/warehouse/product" class="menu-link">
                                        <div data-i18n="Product">Product</div>
                                    </a>
                                </li>
                                <li class="menu-item {{ Request::is('warehouse/product-stock') ? 'active' : '' }}">
                                    <a href="warehouse/product-stock" class="menu-link">
                                        <div data-i18n="Product Stock">Product Stock</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li
                            class="menu-item {{ Request::is('warehouse/bahan-baku*', 'warehouse/stok-bahan-baku*', 'warehouse/transaksi-bahan-baku*') ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-building-warehouse"></i>
                                <div data-i18n="Bahan Baku">Bahan Baku</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item {{ Request::is('warehouse/bahan-baku*') ? 'active' : '' }}">
                                    <a href="/warehouse/bahan-baku" class="menu-link">
                                        <div data-i18n="Data Bahan Baku">Bahan Baku</div>
                                    </a>
                                </li>
                                <li class="menu-item {{ Request::is('warehouse/stok-bahan-baku') ? 'active' : '' }}">
                                    <a href="warehouse/stok-bahan-baku" class="menu-link">
                                        <div data-i18n="Stok Bahan Baku">Stok Bahan Baku</div>
                                    </a>
                                </li>
                                <li class="menu-item {{ Request::is('warehouse/transaksi-bahan-baku') ? 'active' : '' }}">
                                    <a href="warehouse/transaksi-bahan-baku" class="menu-link">
                                        <div data-i18n="Transaksi Bahan Baku">Transaksi Bahan Baku</div>
                                    </a>
                                </li>
                                <li class="menu-item {{ Request::is('warehouse/order-bahan-baku') ? 'active' : '' }}">
                                    <a href="warehouse/order-bahan-baku" class="menu-link">
                                        <div data-i18n="Order Bahan Baku">Order Bahan Baku</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item {{ Request::is('warehouse/asembly*') ? 'active' : '' }}">
                            <a href="/warehouse/asembly" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-assembly"></i>
                                <div data-i18n="Assembly">Assembly</div>
                            </a>
                        </li>
                        <li class="menu-item {{ Request::is('warehouse/setting*') ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-settings"></i>
                                <div data-i18n="Setting">Setting</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item {{ Request::is('warehouse/setting/kategori-produk*') ? 'active' : '' }}">
                                    <a href="/warehouse/setting/kategori-produk" class="menu-link">
                                        <div data-i18n="Kategori Product">Kategori Product</div>
                                    </a>
                                </li>
                                <li class="menu-item {{ Request::is('warehouse/setting/gudang-penyimpanan*') ? 'active' : '' }}">
                                    <a href="/warehouse/setting/gudang-penyimpanan" class="menu-link">
                                        <div data-i18n="Gudang Penyimpanan">Gudang Penyimpanan</div>
                                    </a>
                                </li>
                                <li class="menu-item {{ Request::is('warehouse/setting/brand*') ? 'active' : '' }}">
                                    <a href="/warehouse/setting/brand" class="menu-link">
                                        <div data-i18n="Brand">Brand</div>
                                    </a>
                                </li>
                                <li class="menu-item {{ Request::is('warehouse/setting/satuan*') ? 'active' : '' }}">
                                    <a href="/warehouse/setting/satuan" class="menu-link">
                                        <div data-i18n="Satuan">Satuan</div>
                                    </a>
                                </li>
                                <li class="menu-item {{ Request::is('warehouse/setting/vendor*') ? 'active' : '' }}">
                                    <a href="/warehouse/setting/vendor" class="menu-link">
                                        <div data-i18n="Vendor">Vendor</div>
                                    </a>
                                </li>
                                <li class="menu-item {{ Request::is('warehouse/setting/warna*') ? 'active' : '' }}">
                                    <a href="/warehouse/setting/warna" class="menu-link">
                                        <div data-i18n="Warna">Warna</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </aside>
    <!-- / Menu -->

    {{-- production --}}
@elseif (Auth::user()->role_id == 3)
    {{-- QC --}}
@elseif (Auth::user()->role_id == 4)
    {{-- warehouse --}}
@elseif (Auth::user()->role_id == 5)
    <!-- Menu -->
    <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
        <div class="container-xxl d-flex h-100">
            <ul class="menu-inner">
                <!-- Dashboards -->
                <li class="menu-item {{ Request::is('/') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-smart-home"></i>
                        <div data-i18n="Dashboards">Dashboards</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ Request::is('/') ? 'active' : '' }}">
                            <a href="/" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-chart-pie-2"></i>
                                <div data-i18n="Analytics">Analytics</div>
                            </a>
                        </li>
                        {{-- <li class="menu-item">
                            <a href="dashboards-crm.html" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-3d-cube-sphere"></i>
                                <div data-i18n="CRM">CRM</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="dashboards-ecommerce.html" class="menu-link">
                                <i class="menu-icon tf-icons ti ti-atom-2"></i>
                                <div data-i18n="eCommerce">eCommerce</div>
                            </a>
                        </li> --}}
                    </ul>
                </li>

                <!-- Layouts -->
                <li
                    class="menu-item {{ Request::is('warehouse/inventory*', 'warehouse/asembly*', 'warehouse/product*', 'warehouse/product-stock*', 'warehouse/setting*', 'warehouse/transaksi-bahan-baku*', 'warehouse/order-bahan-baku', 'warehouse/bahan-baku*') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ti ti-building-warehouse"></i>
                        <div data-i18n="Warehouse">Warehouse</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ Request::is('warehouse/product*', 'warehouse/product-stock*') ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-building-store"></i>
                                <div data-i18n="Product">Product</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item {{ Request::is('warehouse/product*') ? 'active' : '' }}">
                                    <a href="/warehouse/product" class="menu-link">
                                        <div data-i18n="Product">Product</div>
                                    </a>
                                </li>
                                <li class="menu-item {{ Request::is('warehouse/product-stock') ? 'active' : '' }}">
                                    <a href="warehouse/product-stock" class="menu-link">
                                        <div data-i18n="Product Stock">Product Stock</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li
                            class="menu-item {{ Request::is('warehouse/bahan-baku*', 'warehouse/stok-bahan-baku*', 'warehouse/transaksi-bahan-baku*', 'warehouse/order-bahan-baku*') ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-building-warehouse"></i>
                                <div data-i18n="Bahan Baku">Bahan Baku</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item {{ Request::is('warehouse/bahan-baku*') ? 'active' : '' }}">
                                    <a href="/warehouse/bahan-baku" class="menu-link">
                                        <div data-i18n="Data Bahan Baku">Bahan Baku</div>
                                    </a>
                                </li>
                                <li class="menu-item {{ Request::is('warehouse/stok-bahan-baku') ? 'active' : '' }}">
                                    <a href="/warehouse/stok-bahan-baku" class="menu-link">
                                        <div data-i18n="Stok Bahan Baku">Stok Bahan Baku</div>
                                    </a>
                                </li>
                                <li class="menu-item {{ Request::is('warehouse/transaksi-bahan-baku') ? 'active' : '' }}">
                                    <a href="/warehouse/transaksi-bahan-baku" class="menu-link">
                                        <div data-i18n="Transaksi Bahan Baku">Transaksi Bahan Baku</div>
                                    </a>
                                </li>
                                <li class="menu-item {{ Request::is('warehouse/order-bahan-baku') ? 'active' : '' }}">
                                    <a href="/warehouse/order-bahan-baku" class="menu-link">
                                        <div data-i18n="Order Bahan Baku">Order Bahan Baku</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item {{ Request::is('warehouse/setting*') ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-settings"></i>
                                <div data-i18n="Setting">Setting</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item {{ Request::is('warehouse/setting/kategori-produk*') ? 'active' : '' }}">
                                    <a href="/warehouse/setting/kategori-produk" class="menu-link">
                                        <div data-i18n="Kategori Product">Kategori Product</div>
                                    </a>
                                </li>
                                <li class="menu-item {{ Request::is('warehouse/setting/gudang-penyimpanan*') ? 'active' : '' }}">
                                    <a href="/warehouse/setting/gudang-penyimpanan" class="menu-link">
                                        <div data-i18n="Gudang Penyimpanan">Gudang Penyimpanan</div>
                                    </a>
                                </li>
                                <li class="menu-item {{ Request::is('warehouse/setting/brand*') ? 'active' : '' }}">
                                    <a href="/warehouse/setting/brand" class="menu-link">
                                        <div data-i18n="Brand">Brand</div>
                                    </a>
                                </li>
                                <li class="menu-item {{ Request::is('warehouse/setting/satuan*') ? 'active' : '' }}">
                                    <a href="/warehouse/setting/satuan" class="menu-link">
                                        <div data-i18n="Satuan">Satuan</div>
                                    </a>
                                </li>
                                <li class="menu-item {{ Request::is('warehouse/setting/vendor*') ? 'active' : '' }}">
                                    <a href="/warehouse/setting/vendor" class="menu-link">
                                        <div data-i18n="Vendor">Vendor</div>
                                    </a>
                                </li>
                                <li class="menu-item {{ Request::is('warehouse/setting/warna*') ? 'active' : '' }}">
                                    <a href="/warehouse/setting/warna" class="menu-link">
                                        <div data-i18n="Warna">Warna</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </aside>
    <!-- / Menu -->
@endif
