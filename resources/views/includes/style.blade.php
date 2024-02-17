<link rel="stylesheet" href="{{ asset('vendors/css/datatables-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/datepicker-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/datatables-buttons.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/css/toastr.min.css') }}">
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
        background:#b3a423;
    }
    ul li {
        list-style-type: none;
    }
/* 
    .redClass {
        background-color: rgb(185, 39, 39) !important;
    }

    .greenClass {
        background-color: rgb(102, 208, 125) !important;
    } */
</style>
