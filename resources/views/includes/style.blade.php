<link rel="stylesheet" href="{{ asset('vendors/css/datatables-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/datepicker-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/datatables-buttons.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/sweetalert2.min.css') }}">
<script src="{{ asset('vendors/js/jquery.js') }}"></script>
<style>
    div.dt-button-background {
        background: none !important;
    }
</style>
<!-- Scripts -->
@vite(['resources/css/app.css', 'resources/js/app.js'])

<style>
    .table {
        width: 100% !important;
    }

    div.dataTables_processing>div:last-child>div {
        background: #b3a423;
    }

    ul li {
        list-style-type: none;
    }

    .redClass {
        background-color: rgb(217, 133, 133) !important;
    }

    .greenClass {
        background-color: rgb(133, 225, 153) !important;
    }

    input:read-only {
        background-color: #e1e1e1;
    }

    .password-wrapper {
        position: relative;
    }

    .password-wrapper input {
        width: 100%;
    }

    .hide-password,
    .show-password {
        position: absolute;
        right: 2%;
        cursor: pointer;
        top: 0;
    }
</style>
