@include('admin.components.header')
<!-- Layout wrapper -->  
<div class="progress ajax-progress-bar">
                <div class="progress-bar"></div>
            </div>
    <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        @include('flash-message')
        @include('admin.components.sidebar')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->


            @include('admin.components.navbar')
            <!-- / Navbar -->
          
            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->

                @yield('content')
                <!-- / Content -->

                <!-- Footer -->
@include('admin.components.footer')
