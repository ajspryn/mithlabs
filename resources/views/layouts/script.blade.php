    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ url('/') }}/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/popper/popper.js"></script>
    <script src="{{ url('/') }}/assets/vendor/js/bootstrap.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/node-waves/node-waves.js"></script>

    <script src="{{ url('/') }}/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/typeahead-js/typeahead.js"></script>

    <script src="{{ url('/') }}/assets/vendor/js/menu.js"></script>
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ url('/') }}/assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/swiper/swiper.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/select2/select2.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/cleavejs/cleave.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/cleavejs/cleave-phone.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/moment/moment.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/flatpickr/flatpickr.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/tagify/tagify.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/bs-stepper/bs-stepper.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
    <script src="{{ url('/') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>


    <!-- Main JS -->
    <script src="{{ url('/') }}/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{ url('/') }}/assets/js/dashboards-analytics.js"></script>
    <script src="{{ url('/') }}/assets/js/pages-account-settings-security.js"></script>
    <script src="{{ url('/') }}/assets/js/modal-enable-otp.js"></script>
    <script src="{{ url('/') }}/assets/js/pages-auth.js"></script>
    <script src="{{ url('/') }}/assets/js/app-user-list.js"></script>
    <script src="{{ url('/') }}/assets/js/tables-datatables-basic.js"></script>
    <script src="{{ url('/') }}/assets/js/cards-statistics.js"></script>
    <script src="{{ url('/') }}/assets/js/form-validation.js"></script>
    <script src="{{ url('/') }}/assets/js/ui-modals.js"></script>
    <script src="{{ url('/') }}/assets/js/form-wizard-icons.js"></script>
    <script src="{{ url('/') }}/assets/js/forms-extras.js"></script>
    <script src="{{ url('/') }}/assets/js/pages-profile.js"></script>
    <script src="{{ url('/') }}/assets/js/dashboards-ecommerce.js"></script>
    <script src="{{ url('/') }}/assets/js/extended-ui-perfect-scrollbar.js"></script>


    <script>
        $(document).ready(function() {
            $('.loading').show(); // Menampilkan spinner
        });

        $(window).on('load', function() {
            $('.loading').fadeOut('slow', function() {
                $(this).remove(); // Menghapus spinner setelah konten halaman dimuat
            });
        });
    </script>

    <script>
        function deleteConfirmation() {
            swal({
                    title: "Apakah Anda yakin ingin menghapus data ini?",
                    icon: "warning",
                    buttons: ["Tidak", "Ya"],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        document.forms[0].submit();
                    } else {
                        return false;
                    }
                });
        }
    </script>
