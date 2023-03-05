<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>
        @yield('title')
    </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ url('/') }}/favicon.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/css/rtl/core.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/css/rtl/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/libs/swiper/swiper.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet"
        href="{{ url('/') }}/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet"
        href="{{ url('/') }}/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet"
        href="{{ url('/') }}/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css">
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/libs/bootstrap-select/bootstrap-select.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/libs/tagify/tagify.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/libs/bs-stepper/bs-stepper.css" />

    <!-- Row Group CSS -->
    <link rel="stylesheet"
        href="{{ url('/') }}/assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css">

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/css/pages/cards-advance.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/css/pages/page-account-settings.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/css/pages/page-profile.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/css/pages/page-faq.css" />
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <!-- Page -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="{{ url('/') }}/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ url('/') }}/assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ url('/') }}/assets/js/config.js"></script>
    {{-- <link rel="stylesheet" href="{{ url('/') }}/assets/preload.css"> --}}
    @laravelPWA
    {{-- @preload --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/spinkit/2.0.2/spinkit.min.css"> --}}
    <style>
        .loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* background-color: #fff; */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            backdrop-filter: blur(10px);
        }

        .spinner {
            width: 60px;
            height: 60px;
            /* background-color: #333; */

            margin: 100px auto;
            -webkit-animation: sk-rotateplane 1.2s infinite ease-in-out;
            animation: sk-rotateplane 1.2s infinite ease-in-out;
        }

        @-webkit-keyframes sk-rotateplane {
            0% {
                -webkit-transform: perspective(120px)
            }

            50% {
                -webkit-transform: perspective(120px) rotateX(-180deg)
            }

            100% {
                -webkit-transform: perspective(120px) rotateX(-180deg) rotateY(-180deg)
            }
        }

        @keyframes sk-rotateplane {
            0% {
                transform: perspective(120px) rotateY(0deg) rotateX(0deg);
                -webkit-transform: perspective(120px) rotateY(0deg) rotateX(0deg)
            }

            50% {
                transform: perspective(120px) rotateY(180.1deg) rotateX(0deg);
                -webkit-transform: perspective(120px) rotateY(180.1deg) rotateX(0deg)
            }

            100% {
                transform: perspective(120px) rotateY(180deg) rotateX(179.9deg);
                -webkit-transform: perspective(120px) rotateY(-180deg) rotateX(-179.9deg);
            }
        }
    </style>
</head>
