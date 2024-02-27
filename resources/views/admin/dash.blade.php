<!DOCTYPE html>

@include('admin.components.header')
<!-- Layout wrapper -->

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

        @include('admin.components.sidebar')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            @include('admin.components.navbar')

            <!-- / Navbar -->
            <?php
            // Get the total number of posts
               $totalUsers = App\Models\User::count();

             // Get the total number of posts
               $totalMusic = App\Models\Music::count();
              
              // Get the total number of posts
                $totalPosts = App\Models\Product::count();
             
            ?>
            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">

                  <div class="row">
                   <div class="col-lg-4 col-md-4 order-1">
                      <div class="row">
                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                          <div class="card">
                            <div class="card-body">
                              <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                  <img src="../assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
                                </div>
                                <div class="dropdown">
                                  <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                  </button>
                                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3" style="">
                                   
                                    <a href="{{ url('/posts') }}" class="dropdown-item">Posts</a>
                                  </div>
                                </div>
                              </div>
                              <span class="fw-semibold d-block mb-1">Total Posts</span>
                              <h3 class="card-title mb-2"><?= $totalPosts; ?></h3>
                              <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +2.80%</small>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                          <div class="card">
                            <div class="card-body">
                              <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                  <img src="../assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded">
                                </div>
                                <div class="dropdown">
                                  <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                  </button>
                                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6" style="">
                                    <a href="{{ url('/all-music') }}" class="dropdown-item">Music</a>
                                  </div>
                                </div>
                              </div>
                              <span>Total Songs</span>
                              <h3 class="card-title text-nowrap mb-1"><?= $totalMusic; ?></h3>
                              <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +8.42%</small>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                      <div class="row">
                        <div class="col-6 mb-4">
                          <div class="card">
                            <div class="card-body">
                              <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                  <img src="../assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded">
                                </div>
                                <div class="dropdown">
                                  <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                  </button>
                                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                    <a href="{{ route('users.index') }}" class="dropdown-item">Users </a>
                                  </div>
                                </div>
                              </div>
                              <span class="d-block mb-1">Total Users</span>
                              <h3 class="card-title text-nowrap mb-2"><?= $totalUsers; ?></h3>
                              <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> 14.82%</small>
                            </div>
                          </div>
                        </div>
                        <div class="col-6 mb-4">
                          <div class="card">
                            <div class="card-body">
                              <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                  <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded">
                                </div>
                                <div class="dropdown">
                                  <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                  </div>
                                </div>
                              </div>
                              <span class="fw-semibold d-block mb-1">Transactions</span>
                              <h3 class="card-title mb-2">$14,857</h3>
                              <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
                            </div>
                          </div>
                        </div>
                        <!-- </div>
        <div class="row"> -->
                        
                      </div>
                    </div>
                  </div>
                </div>

                <!-- / Content -->

                <!-- Footer -->
                @include('admin.components.footer')
               
                