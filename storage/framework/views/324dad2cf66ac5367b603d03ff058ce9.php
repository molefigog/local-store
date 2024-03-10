<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Place this tag where you want the button to render. -->
            
            <button id="toggle-dark-mode" class="btn rounded-pill btn-icon btn-outline-secondary">
                              <span class="tf-icons bx bx-bulb"></span>
                            </button>
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="<?php echo e(\Storage::url(auth()->user()->avatar ?? 'default_avatar.png')); ?>" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="<?php echo e(\Storage::url(auth()->user()->avatar ?? 'default_avatar.png')); ?>" alt="Avatar"
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block"><?php echo e(Auth::user()->name); ?></span>
                                    <small class="text-muted"><?php echo e(Auth::user()->balance); ?></small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    
                    <li>
                        <a class="dropdown-item" href="<?php echo e(url('edit-profile')); ?>">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                   
                   
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                        onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                    </a>

                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                        class="d-none">
                        <?php echo csrf_field(); ?>
                    </form>

                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
<?php /**PATH /home/gw-ent.co.za/public_html/resources/views/admin/components/navbar.blade.php ENDPATH**/ ?>