<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">    
    <title>Document</title>
    <!-- Google Icon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">

    <!-- custom select -->
    <link rel="stylesheet" href="{{ asset('css/custom-select.css') }}">

    <!-- dataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" />

    <!-- our css -->
    <link rel="stylesheet" href="{{ asset('css/master.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>

    <!-- j query -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>

    <!-- custom select  -->
    <script src="{{ asset('js/custom-select.min.js') }}"></script>
    <script src="{{ asset('js/custom-select.js') }}"></script>

    <!-- jQuery (required for Toastr) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Select.2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- data table  -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script> 
    <script src="{{ asset('js/dataTable.js') }}"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Toggle js  -->
    <!-- <script src="{{ asset('js/toggle.js') }}"></script> -->

    <style>

        #mainLayout {
            position: relative; /* Ensures layout stays behind the modal */
        }

        .modal-backdrop {
            z-index: 1040;
        }
        .modal {
            z-index: 1050;
        }

        #mainContent {
            filter: blur(0); /* Default */
        }

        .modal-open #mainContent {
            filter: blur(4px); /* Blurs background when modal is open */
            pointer-events: none;
        }
    </style>
</head>