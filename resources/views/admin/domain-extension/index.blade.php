@extends('admin.layouts.main')

@section('title', $data['index'] ?? 'Page Title')
@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/vendor\libs\datatables-checkboxes-jquery\datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/vendor/libs/typeahead-js/typeahead.css') }}" />
    {{--
    <link rel="stylesheet" href="{{ asset('backend/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/vendor/css/pages/app-email.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/vendor/libs/select2/select2.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('backend/css/flag-icon-css/flag-icon.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    @parent
    <style>
        .page-link.active, .active > .page-link{z-index: unset;}
        .table > :not(caption) > * > * {
            padding: 4px;
        }
        .bottom-fix {
            right: 4%;
            bottom: 1%;
            position: fixed;
        }

        .form-control.error {
            border-color: #ff0000;
        }

        .form-control.error:focus {
            border-color: #ff0000 !important;
        }

        .form-floating.form-floating-outline label.error {
            display: unset;
            position: absolute;
            top: 76%;
            color: #ff0000;
        }

        .form-floating.form-floating-outline>.form-control:focus~label.error {
            color: #ff0000;
            top: 120%;
        }

        .form-floating.form-floating-outline .position-relative label.error {
            top: 123%;
        }

        .form-floating.form-floating-outline .input-group.input-daterange label.error {
            top: 100%;
        }

        @media (min-width: 1200px) {
            .layout-horizontal .app-email .app-email-sidebar .email-filters {
                height: auto;
            }

            .app-email.card {
                height: auto !important;
            }
        }

        @media (max-width: 991.98px) {
            .p-absolute {
                position: absolute;
                top: 28px;
            }

            .dataTables_length label {
                margin-left: 12%;
            }
        }
    </style>

@endsection

@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        @include('admin.domain-extension.components.list',['domains'=>$data['domainExtensions']])
    </div>
    <div class="bottom-fix">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#onboardImageModal"> Thêm mới </button>
    </div>
    @include('admin.domain-extension.components.domain-extension')
@endsection

@section('scripts')
    
    <script src="{{ asset('backend/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('backend/js/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    {{-- <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.14.5/sweetalert2.min.js') }}"></script> --}}
    @parent
    <script src="{{ asset('backend/js/global.js') }}"></script>
    {{-- <script src="{{ asset('backend/js/forms-pickers.js') }}"></script> --}}
    <script src="{{ asset('backend/js/custom/form-validation-domain-extension.js') }}"></script>
    
@endsection
