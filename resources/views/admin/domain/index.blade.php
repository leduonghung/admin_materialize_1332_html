@extends('admin.layouts.main')

@section('title', $data['index'] ?? 'Page Title')
@section('styles')
<link rel="stylesheet" href="{{ asset('backend/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('backend/vendor\libs\datatables-checkboxes-jquery\datatables.checkboxes.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css') }}" /> --}}
    

    {{-- <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css') }}" /> --}}
    {{-- <link rel="stylesheet" href="{{ asset('https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css') }}" /> --}}
    {{-- <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" /> --}}

    <link rel="stylesheet" href="{{ asset('backend/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/vendor/css/pages/app-email.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/vendor/libs/select2/select2.css') }}" />
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
        <div class="app-email card">
            <div class="border-0">
                <div class="row g-0">
                    <!-- Email Sidebar -->
                    @include('admin.domain.components.sidebar')
                    <!--/ Email Sidebar -->

                    <!-- Emails List -->
                    <div class="col app-emails-list">


                        <div class="card shadow-none border-0 rounded-0">
                            {{-- <h5 class="card-header text-md-start text-center">Ajax Sourced Server-side</h5> --}}
                            <div class="card-body emails-list-header p-3 py-2">
                                <div class="p-absolute justify-content-between align-items-center px-3 mt-2">
                                    <div class="align-items-center w-100">
                                        <i class="ri-menu-line ri-24px cursor-pointer d-block d-lg-none me-4 mb-4"
                                            data-bs-toggle="sidebar" data-target="#app-email-sidebar" data-overlay></i>
                                        {{-- <div class="mb-4 w-100">
                      <div class="input-group input-group-merge shadow-none">
                        <span class="input-group-text border-0 ps-0 py-0" id="email-search">
                          <i class="ri-search-line ri-22px"></i>
                        </span>
                        <input
                          type="text"
                          class="form-control email-search-input border-0 py-0"
                          placeholder="Search mail"
                          aria-label="Search mail"
                          aria-describedby="email-search" />
                      </div>
                    </div> --}}
                                    </div>
                                </div>

                                @include('admin.domain.components.list',['domains'=>$data['domains']])
                            </div>
                            <hr class="container-m-nx m-0" />
                            <!-- Email List: Items -->
                            <div class="email-list pt-0">
                            </div>
                        </div>
                        <div class="app-overlay"></div>
                    </div>
                    <!-- /Emails List -->

                    <!-- Email View -->
                    <div class="col app-email-view flex-grow-0 bg-lighter" id="app-email-view">
                        <div class="card-body app-email-view-header p-5 pt-md-4 py-2">
                            <!-- Email View : Title  bar-->
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center overflow-hidden">
                                    <span class="ms-sm-2 me-4"><i class="ri-arrow-left-s-line ri-22px cursor-pointer"
                                            data-bs-toggle="sidebar" data-target="#app-email-view"></i></span>
                                    <h6 class="text-truncate mb-0 me-2 fw-normal">Focused impactful open issues</h6>
                                    <span class="badge bg-label-warning rounded-pill">Important</span>
                                </div>
                                <!-- Email View : Action bar-->
                                <div class="d-flex align-items-center">
                                    <span class="btn btn-icon p-0 me-2 text-muted">
                                        <i class="ri-arrow-left-s-line ri-22px"></i>
                                    </span>
                                    <span class="btn btn-icon p-0">
                                        <i class="ri-arrow-right-s-line ri-22px"></i>
                                    </span>
                                </div>
                            </div>
                            <hr class="app-email-view-hr mx-n5 mb-2" />
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <span class="btn btn-icon btn-text-secondary rounded-pill me-1"><i
                                            class="ri-delete-bin-7-line ri-22px cursor-pointer"></i></span>
                                    <span class="btn btn-icon btn-text-secondary rounded-pill me-1"><i
                                            class="ri-mail-line ri-22px cursor-pointer" data-bs-toggle="sidebar"
                                            data-target="#app-email-view"></i></span>
                                    <div class="dropdown">
                                        <button class="btn btn-icon btn-text-secondary rounded-pill p-0 me-1"
                                            type="button" id="dropdownMenuFolderOne" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="ri-folder-line ri-22px"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="dropdownMenuFolderOne">
                                            <a class="dropdown-item" href="javascript:void(0)">
                                                <i class="ri-spam-2-line me-1"></i>
                                                <span class="align-middle">Spam</span>
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0)">
                                                <i class="ri-edit-box-line me-1"></i>
                                                <span class="align-middle">Draft</span>
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0)">
                                                <i class="ri-mail-line me-1"></i>
                                                <span class="align-middle">Trash</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-icon btn-text-secondary rounded-pill p-0" type="button"
                                            id="dropdownLabelTwo" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="ri-price-tag-3-line ri-22px"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownLabelTwo">
                                            <a class="dropdown-item" href="javascript:void(0)">
                                                <i class="badge badge-dot bg-success me-1"></i>
                                                <span class="align-middle">Workshop</span>
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0)">
                                                <i class="badge badge-dot bg-primary me-1"></i>
                                                <span class="align-middle">Company</span>
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0)">
                                                <i class="badge badge-dot bg-info me-1"></i>
                                                <span class="align-middle">Important</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="btn btn-icon btn-text-secondary rounded-pill p-0">
                                        <i class="ri-star-line ri-22px"></i>
                                    </span>
                                    <div class="dropdown ms-1">
                                        <button class="btn btn-icon btn-text-secondary rounded-pill p-0" type="button"
                                            id="dropdownMoreOptions" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="ri-more-2-line ri-22px"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="dropdownMoreOptions">
                                            <a class="dropdown-item" href="javascript:void(0)">
                                                <i class="ri-mail-line me-1"></i>
                                                <span class="align-middle">Mark as unread</span>
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0)">
                                                <i class="ri-mail-open-line me-1"></i>
                                                <span class="align-middle">Mark as read</span>
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0)">
                                                <i class="ri-star-line me-1"></i>
                                                <span class="align-middle">Add star</span>
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0)">
                                                <i class="ri-calendar-2-line me-1"></i>
                                                <span class="align-middle">Create Event</span>
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0)">
                                                <i class="ri-volume-mute-line me-1"></i>
                                                <span class="align-middle">Mute</span>
                                            </a>
                                            <a class="dropdown-item d-sm-none d-block" href="javascript:void(0)">
                                                <i class="ri-printer-line me-1"></i>
                                                <span class="align-middle">Print</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Email View : Content-->

                    </div>
                    <!-- Email View -->
                </div>
            </div>

            <!-- Compose Email -->

            <!-- /Compose Email -->
        </div>
    </div>
    <div class="bottom-fix">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#domainModal"> Thêm Domain
        </button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#onboardImageModal"> Thêm
            TLD </button>
    </div>

    @include('admin.domain.components.domain')
    @include('admin.domain.components.domain-extension')

@endsection

@section('scripts')
    <script src="{{ asset('backend/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('backend/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('backend/js/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('backend/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('backend/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('backend/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js') }}"></script>
    <script src="{{ asset('backend/vendor/libs/jquery-timepicker/jquery-timepicker.js') }}"></script>
    <script src="{{ asset('backend/vendor/libs/pickr/pickr.js') }}"></script>
    <script src="{{ asset('backend/js/ui-popover.js') }}"></script>
    <script src="{{ asset('backend/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    @parent
    <script src="{{ asset('backend/js/global.js') }}"></script>
    {{-- <script src="{{ asset('backend/js/forms-pickers.js') }}"></script> --}}
    <script src="{{ asset('backend/js/custom/form-validation-domain-extension.js') }}"></script>
    
@endsection
