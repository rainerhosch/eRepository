<!-- Topbar Start -->
<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-end mb-0">
        <li class="d-none d-lg-block">
            <form class="app-search">
                <div class="app-search-box">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search..." id="top-search">
                        <button class="btn input-group-text" type="submit">
                            <i class="fe-search"></i>
                        </button>
                    </div>
                    <div class="dropdown-menu dropdown-lg" id="search-dropdown">
                        <div class="dropdown-header noti-title">
                            <h5 class="text-overflow mb-2">Found 22 results</h5>
                        </div>
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-home me-1"></i>
                            <span>Analytics Report</span>
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-aperture me-1"></i>
                            <span>How can I help you?</span>
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-settings me-1"></i>
                            <span>User profile settings</span>
                        </a>
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
                        </div>
                        <div class="notification-list">
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="d-flex align-items-start">
                                    <img class="d-flex me-2 rounded-circle" src="<?= base_url('assets/template') ?>/images/users/user-2.jpg" alt="Generic placeholder image" height="32">
                                    <div class="w-100">
                                        <h5 class="m-0 font-14">Erwin E. Brown</h5>
                                        <span class="font-12 mb-0">UI Designer</span>
                                    </div>
                                </div>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="d-flex align-items-start">
                                    <img class="d-flex me-2 rounded-circle" src="<?= base_url('assets/template') ?>/images/users/user-5.jpg" alt="Generic placeholder image" height="32">
                                    <div class="w-100">
                                        <h5 class="m-0 font-14">Jacob Deo</h5>
                                        <span class="font-12 mb-0">Developer</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </li>
        <li class="dropdown d-inline-block d-lg-none">
            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="fe-search noti-icon"></i>
            </a>
            <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                <form class="p-3">
                    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                </form>
            </div>
        </li>

        <!-- Notifikasi -->
        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="fe-bell noti-icon"></i>
                <span class="badge bg-danger rounded-circle noti-icon-badge">9</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-lg">
                <div class="dropdown-item noti-title">
                    <h5 class="m-0">
                        <span class="float-end">
                            <a href="" class="text-dark">
                                <small>Clear All</small>
                            </a>
                        </span>Notification
                    </h5>
                </div>
                <!-- <div class="noti-scroll" data-simplebar>
                    <a href="javascript:void(0);" class="dropdown-item notify-item active">
                        <div class="notify-icon">
                            <img src="<?= base_url('assets/template') ?>/images/users/user-1.jpg" class="img-fluid rounded-circle" alt="" />
                        </div>
                        <p class="notify-details">Cristina Pride</p>
                        <p class="text-muted mb-0 user-msg">
                            <small>Hi, How are you? What about our next meeting</small>
                        </p>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-primary">
                            <i class="mdi mdi-comment-account-outline"></i>
                        </div>
                        <p class="notify-details">Caleb Flakelar commented on Admin
                            <small class="text-muted">1 min ago</small>
                        </p>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon">
                            <img src="<?= base_url('assets/template') ?>/images/users/user-4.jpg" class="img-fluid rounded-circle" alt="" />
                        </div>
                        <p class="notify-details">Karen Robinson</p>
                        <p class="text-muted mb-0 user-msg">
                            <small>Wow ! this admin looks good and awesome design</small>
                        </p>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-warning">
                            <i class="mdi mdi-account-plus"></i>
                        </div>
                        <p class="notify-details">New user registered.
                            <small class="text-muted">5 hours ago</small>
                        </p>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-info">
                            <i class="mdi mdi-comment-account-outline"></i>
                        </div>
                        <p class="notify-details">Caleb Flakelar commented on Admin
                            <small class="text-muted">4 days ago</small>
                        </p>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon bg-secondary">
                            <i class="mdi mdi-heart"></i>
                        </div>
                        <p class="notify-details">Carlos Crouch liked
                            <b>Admin</b>
                            <small class="text-muted">13 days ago</small>
                        </p>
                    </a>
                </div> -->
                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                    View all
                    <i class="fe-arrow-right"></i>
                </a>
            </div>
        </li>

        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="<?= base_url('assets/template') ?>/images/users/user-1.jpg" alt="user-image" class="rounded-circle">
                <span class="pro-user-name ms-1">
                    <?= $this->session->userdata('fullname'); ?> <i class="mdi mdi-chevron-down"></i>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome !</h6>
                </div>
                <a href="contacts-profile.html" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>My Account</span>
                </a>
                <a href="auth-lock-screen.html" class="dropdown-item notify-item">
                    <i class="fe-lock"></i>
                    <span>Lock Screen</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?= base_url('auth'); ?>/logout" class="dropdown-item notify-item">
                    <i class="fe-log-out"></i>
                    <span>Logout</span>
                </a>
            </div>
        </li>

    </ul>
    <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
        <li>
            <button class="button-menu-mobile disable-btn waves-effect">
                <i class="fe-menu"></i>
            </button>
        </li>

        <li>
            <h4 class="page-title-main"><?php
                                        echo $page;
                                        if (isset($subpage)) {
                                            echo '<i class="mdi mdi-triangle-wave"></i>' . $subpage;
                                        }; ?>
            </h4>
        </li>
    </ul>
    <!-- LOGO -->
    <div class="logo-box">
        <h3 href="#" class="logo text-center" style="margin:0px; color:#fff;">
            <span class="logo-sm">
                <!-- <img src="<?= base_url('assets/template') ?>/images/logo-sm.png" alt="" height="22"> -->
                <strong>
                    <i class="dripicons-store"></i>
                </strong>
            </span>
            <span class="logo-lg">
                <!-- <img src="<?= base_url('assets/template') ?>/images/logo-light.png" alt="" height="16"> -->
                <strong height="16"><i class="dripicons-store"></i> e-Library </strong>
            </span>
        </h3>
        <a href="#" class="logo logo-dark text-center">
            <span class="logo-sm">
                <img src="<?= base_url('assets/template') ?>/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?= base_url('assets/template') ?>/images/logo-dark.png" alt="" height="16">
            </span>
        </a>
    </div>


    <div class="clearfix"></div>

</div>
<!-- end Topbar -->