<!doctype html>

<html lang="{{ config('app.locale', 'en') }}" class="light-style layout-menu-fixed layout-wide" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('backend') }}/" data-template="horizontal-menu-template-starter" data-style="light">
  @include('admin.layouts.components.head')

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
      <div class="layout-container">
        <!-- Navbar -->
        @include('admin.layouts.components.navbar')
        <!-- / Navbar -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Menu -->
            @include('admin.layouts.components.menu')
            <!-- / Menu -->

            <!-- Content -->
            @yield('content')
            <!--/ Content -->

            <!-- Footer -->
            @include('admin.layouts.components.footer')
            
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!--/ Content wrapper -->
        </div>

        <!--/ Layout container -->
      </div>
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>

    <!--/ Layout wrapper -->

    <!-- Core JS -->
    @include('admin.layouts.components.script')
    <!-- Page JS -->
  </body>
</html>
