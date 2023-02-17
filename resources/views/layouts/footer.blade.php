<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl">
        <div class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
            <div>
                <a href="/" target="_blank" class="footer-text fw-bolder">Mithlabs</a>
                ©
                <script>
                    document.write(new Date().getFullYear());
                </script>
                , made with ❤️
            </div>
        </div>
    </div>
</footer>

{{-- <footer class="footer bg-light">
    <div class="container-fluid d-flex flex-md-row flex-column justify-content-between align-items-md-center gap-1 container-p-x py-3">
        <div>
            <a href="/" target="_blank" class="footer-text fw-bolder">Mithlabs</a>
            ©
            <script>
                document.write(new Date().getFullYear());
            </script>
            , made with ❤️
        </div>
        <div>
            <div class="dropdown dropup footer-link me-3">
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    Currency
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-currency-dollar"></i> USD</a>
                    <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-currency-euro"></i> Euro</a>
                    <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-currency-pound"></i> Pound</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-currency-bitcoin"></i> Bitcoin</a>
                </div>
            </div>
            <a class="btn btn-sm btn-outline-danger" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="ti ti-logout me-1"></i>{{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</footer> --}}
<!-- / Footer -->
