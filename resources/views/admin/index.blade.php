@extends('admin.layouts.main')
 
@section('title', 'Page Title')
@section('styles')
<link rel="stylesheet" href="{{ asset('backend/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/vendor/css/pages/app-email.css') }}" />
    <style>
      @media (min-width: 1200px) {
          .layout-horizontal .app-email .app-email-sidebar .email-filters {
              height: auto;
          }
          .app-email.card{height: auto !important;}
      }
      @media (max-width: 991.98px) {
          .p-absolute{position: absolute; top: 28px;}
            .dataTables_length label{margin-left: 12%;}
      }
    </style>
    @parent
@endsection

@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="app-email card">
      <div class="border-0">
        <div class="row g-0">
          <!-- Email Sidebar -->
          <div class="col app-email-sidebar border-end flex-grow-0" id="app-email-sidebar">
            <div class="btn-compost-wrapper d-grid">
              <button
                class="btn btn-primary btn-compose"
                data-bs-toggle="modal"
                data-bs-target="#emailComposeSidebar">
                Compose
              </button>
            </div>
            <!-- Email Filters -->
            <div class="email-filters pt-4 pb-2">
              <!-- Email Filters: Folder -->
              <ul class="email-filter-folders list-unstyled">
                <li class="active d-flex justify-content-between align-items-center mb-1" data-target="inbox">
                  <a href="javascript:void(0);" class="d-flex flex-wrap align-items-center">
                    <i class="ri-mail-line ri-20px"></i>
                    <span class="align-middle ms-2">Inbox</span>
                  </a>
                  <div class="badge bg-label-primary rounded-pill">21</div>
                </li>
                <li class="d-flex mb-1" data-target="sent">
                  <a href="javascript:void(0);" class="d-flex flex-wrap align-items-center">
                    <i class="ri-send-plane-line ri-20px"></i>
                    <span class="align-middle ms-2">Sent</span>
                  </a>
                </li>
                <li class="d-flex justify-content-between align-items-center mb-1" data-target="draft">
                  <a href="javascript:void(0);" class="d-flex flex-wrap align-items-center">
                    <i class="ri-edit-box-line ri-20px"></i>
                    <span class="align-middle ms-2">Draft</span>
                  </a>
                  <div class="badge bg-label-warning rounded-pill">1</div>
                </li>
                <li class="d-flex justify-content-between mb-1" data-target="starred">
                  <a href="javascript:void(0);" class="d-flex flex-wrap align-items-center">
                    <i class="ri-star-line ri-20px"></i>
                    <span class="align-middle ms-2">Starred</span>
                  </a>
                </li>
                <li class="d-flex justify-content-between align-items-center mb-1" data-target="spam">
                  <a href="javascript:void(0);" class="d-flex flex-wrap align-items-center">
                    <i class="ri-spam-2-line ri-20px"></i>
                    <span class="align-middle ms-2">Spam</span>
                  </a>
                  <div class="badge bg-label-danger rounded-pill">6</div>
                </li>
                <li class="d-flex align-items-center mb-1" data-target="trash">
                  <a href="javascript:void(0);" class="d-flex flex-wrap align-items-center">
                    <i class="ri-delete-bin-7-line ri-20px"></i>
                    <span class="align-middle ms-2">Trash</span>
                  </a>
                </li>
              </ul>
              <!-- Email Filters: Labels -->
              <div class="email-filter-labels pt-4">
                <p class="small mx-5 text-muted text-uppercase">Labels</p>
                <ul class="list-unstyled mb-2">
                  <li data-target="work">
                    <a href="javascript:void(0);">
                      <i class="badge badge-dot bg-success"></i>
                      <span class="align-middle ms-2">Personal</span>
                    </a>
                  </li>
                  <li data-target="company">
                    <a href="javascript:void(0);">
                      <i class="badge badge-dot bg-primary"></i>
                      <span class="align-middle ms-2">Company</span>
                    </a>
                  </li>
                  <li data-target="important">
                    <a href="javascript:void(0);">
                      <i class="badge badge-dot bg-warning"></i>
                      <span class="align-middle ms-2">Important</span>
                    </a>
                  </li>
                  <li data-target="private">
                    <a href="javascript:void(0);">
                      <i class="badge badge-dot bg-danger"></i>
                      <span class="align-middle ms-2">Private</span>
                    </a>
                  </li>
                </ul>
              </div>
              <!--/ Email Filters -->
            </div>
          </div>
          <!--/ Email Sidebar -->
  
          <!-- Emails List -->
          <div class="col app-emails-list">
            
            
            <div class="card shadow-none border-0 rounded-0">
              {{-- <h5 class="card-header text-md-start text-center">Ajax Sourced Server-side</h5> --}}
              <div class="card-body emails-list-header p-3 py-2">
                <div class="p-absolute justify-content-between align-items-center px-3 mt-2">
                  <div class="align-items-center w-100">
                    <i
                      class="ri-menu-line ri-24px cursor-pointer d-block d-lg-none me-4 mb-4"
                      data-bs-toggle="sidebar"
                      data-target="#app-email-sidebar"
                      data-overlay></i>
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
  
                <div class="card-datatable text-nowrap">
                  <table class="datatables-ajax table table-bordered">
                    <thead>
                      <tr>
                        <th>Full name</th>
                        <th>Email</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Start date</th>
                        <th>Salary</th>
                      </tr>
                    </thead>
                  </table>
                </div>
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
          {{-- <div class="col app-email-view flex-grow-0 bg-lighter" id="app-email-view">
            <div class="card-body app-email-view-header p-5 pt-md-4 py-2">
              <!-- Email View : Title  bar-->
              <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center overflow-hidden">
                  <span class="ms-sm-2 me-4"
                    ><i
                      class="ri-arrow-left-s-line ri-22px cursor-pointer"
                      data-bs-toggle="sidebar"
                      data-target="#app-email-view"></i
                  ></span>
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
                  <span class="btn btn-icon btn-text-secondary rounded-pill me-1"
                    ><i class="ri-delete-bin-7-line ri-22px cursor-pointer"></i
                  ></span>
                  <span class="btn btn-icon btn-text-secondary rounded-pill me-1"
                    ><i
                      class="ri-mail-line ri-22px cursor-pointer"
                      data-bs-toggle="sidebar"
                      data-target="#app-email-view"></i
                  ></span>
                  <div class="dropdown">
                    <button
                      class="btn btn-icon btn-text-secondary rounded-pill p-0 me-1"
                      type="button"
                      id="dropdownMenuFolderOne"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false">
                      <i class="ri-folder-line ri-22px"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuFolderOne">
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
                    <button
                      class="btn btn-icon btn-text-secondary rounded-pill p-0"
                      type="button"
                      id="dropdownLabelTwo"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
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
                    <button
                      class="btn btn-icon btn-text-secondary rounded-pill p-0"
                      type="button"
                      id="dropdownMoreOptions"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false">
                      <i class="ri-more-2-line ri-22px"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMoreOptions">
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
            <hr class="m-0" />
            <!-- Email View : Content-->
            <div class="app-email-view-content py-4">
              <p class="email-earlier-msgs text-center cursor-pointer mb-12">1 Earlier Message</p>
              <!-- Email View : Previous mails-->
              <div class="card email-card-prev mx-sm-6 mx-3">
                <div
                  class="card-header d-flex justify-content-between align-items-center flex-wrap border-bottom">
                  <div class="d-flex align-items-center mb-sm-0 mb-3">
                    <img
                      src="../../assets/img/avatars/2.png"
                      alt="user-avatar"
                      class="flex-shrink-0 rounded-circle me-4"
                      height="38"
                      width="38" />
                    <div class="flex-grow-1 ms-1">
                      <h6 class="m-0 fw-normal">Ross Geller</h6>
                      <small class="text-body">rossGeller@email.com</small>
                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <p class="mb-0 me-4 text-muted">June 20th 2020, 08:30 AM</p>
                    <span class="btn btn-icon btn-text-secondary rounded-pill"
                      ><i class="ri-attachment-2 ri-22px cursor-pointer"></i
                    ></span>
                    <span class="btn btn-icon btn-text-secondary rounded-pill"
                      ><i class="email-list-item-bookmark ri-star-line ri-22px cursor-pointer"></i
                    ></span>
                    <div class="dropdown">
                      <button
                        class="btn btn-icon btn-text-secondary rounded-pill p-0"
                        type="button"
                        id="dropdownEmailOne"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                        <i class="ri-more-2-line ri-22px"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownEmailOne">
                        <a class="dropdown-item scroll-to-reply" href="javascript:void(0)">
                          <i class="ri-reply-line me-1"></i>
                          <span class="align-middle">Reply</span>
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="ri-share-forward-line me-1"></i>
                          <span class="align-middle">Forward</span>
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="ri-spam-2-line me-1"></i>
                          <span class="align-middle">Report</span>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body pt-5">
                  <p class="fw-medium">Greetings!</p>
                  <p>
                    It is a long established fact that a reader will be distracted by the readable content of
                    a page when looking at its layout.The point of using Lorem Ipsum is that it has a
                    more-or-less normal distribution of letters, as opposed to using 'Content here, content
                    here',making it look like readable English.
                  </p>
                  <p>
                    There are many variations of passages of Lorem Ipsum available, but the majority have
                    suffered alteration in some form, by injected humour, or randomised words which don't look
                    even slightly believable.
                  </p>
                  <p class="mb-0">Sincerely yours,</p>
                  <p class="fw-medium mb-0">Envato Design Team</p>
                  <hr />
                  <p class="text-muted mb-2">Attachments</p>
                  <div class="cursor-pointer">
                    <i class="ri-file-text-line"></i>
                    <span class="align-middle ms-1">report.xlsx</span>
                  </div>
                </div>
              </div>
              <!-- Email View : Last mail-->
              <div class="card email-card-last mx-sm-6 mx-3 mt-4">
                <div
                  class="card-header d-flex justify-content-between align-items-center flex-wrap border-bottom">
                  <div class="d-flex align-items-center mb-sm-0 mb-3">
                    <img
                      src="../../assets/img/avatars/1.png"
                      alt="user-avatar"
                      class="flex-shrink-0 rounded-circle me-4"
                      height="38"
                      width="38" />
                    <div class="flex-grow-1 ms-1">
                      <h6 class="m-0 fw-normal">Chandler Bing</h6>
                      <small class="text-body">iAmAhoot@email.com</small>
                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <p class="mb-0 me-4 text-muted">June 20th 2020, 08:10 AM</p>
                    <span class="btn btn-icon btn-text-secondary rounded-pill"
                      ><i class="ri-attachment-2 cursor-pointer ri-22px"></i
                    ></span>
                    <span class="btn btn-icon btn-text-secondary rounded-pill"
                      ><i class="email-list-item-bookmark ri-star-line ri-22px cursor-pointer"></i
                    ></span>
                    <div class="dropdown">
                      <button
                        class="btn btn-icon btn-text-secondary rounded-pill dropdown-toggle hide-arrow"
                        data-bs-toggle="dropdown"
                        aria-expanded="true"
                        id="dropdownEmailTwo">
                        <i class="ri-more-2-line ri-22px"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownEmailTwo">
                        <a class="dropdown-item scroll-to-reply" href="javascript:void(0)">
                          <i class="ri-reply-line me-1"></i>
                          <span class="align-middle">Reply</span>
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="ri-share-forward-line me-1"></i>
                          <span class="align-middle">Forward</span>
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)">
                          <i class="ri-spam-2-line me-1"></i>
                          <span class="align-middle">Report</span>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body pt-5">
                  <p class="fw-medium">Greetings!</p>
                  <p>
                    It is a long established fact that a reader will be distracted by the readable content of
                    a page when looking at its layout.The point of using Lorem Ipsum is that it has a
                    more-or-less normal distribution of letters, as opposed to using 'Content here, content
                    here',making it look like readable English.
                  </p>
                  <p>
                    There are many variations of passages of Lorem Ipsum available, but the majority have
                    suffered alteration in some form, by injected humour, or randomised words which don't look
                    even slightly believable.
                  </p>
                  <p class="mb-0">Sincerely yours,</p>
                  <p class="fw-medium mb-0">Envato Design Team</p>
                  <hr />
                  <p class="text-muted mb-2">Attachments</p>
                  <div class="cursor-pointer">
                    <i class="ri-file-text-line"></i>
                    <span class="align-middle ms-1">report.xlsx</span>
                  </div>
                </div>
              </div>
              <!-- Email View : Reply mail-->
              <div class="email-reply card mt-4 mx-sm-6 mx-3 mb-4">
                <h6 class="card-header border-0 fw-normal pb-4">Reply to Ross Geller</h6>
                <div class="card-body pt-0 ps-3">
                  <div class="d-flex justify-content-start">
                    <div class="email-reply-toolbar border-0 w-100 ps-0 pb-4">
                      <span class="ql-formats me-0">
                        <button class="ql-bold"></button>
                        <button class="ql-italic"></button>
                        <button class="ql-underline"></button>
                        <button class="ql-list" value="ordered"></button>
                        <button class="ql-list" value="bullet"></button>
                        <button class="ql-link"></button>
                        <button class="ql-image"></button>
                      </span>
                    </div>
                  </div>
                  <div class="email-reply-editor"></div>
                  <div class="d-flex justify-content-end align-items-center mt-4">
                    <div class="cursor-pointer btn btn-text-secondary text-secondary me-4">
                      <i class="ri-attachment-2 ri-16px me-2"></i>
                      <span class="align-middle">Attachments</span>
                    </div>
                    <button class="btn btn-primary">
                      <span class="align-middle">Send</span>
                      <i class="ri-send-plane-line ri-16px ms-2"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}
          <!-- Email View -->
        </div>
      </div>
  
      <!-- Compose Email -->
      
      <!-- /Compose Email -->
    </div>
  </div>

@endsection

@section('scripts')
<script src="{{ asset('backend/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
@parent
<script src="{{ asset('backend/js/tables-datatables-advanced.js') }}"></script>
{{-- <script src="{{ asset('backend/js/app-email.js') }}"></script> --}}
@endsection