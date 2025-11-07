<div class="page-content">
    <div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">
        <div class="sidebar-content">
            <div class="sidebar-section">
                <div class="sidebar-section-body d-flex justify-content-center">
                    <h5 class="sidebar-resize-hide flex-grow-1 my-auto">Admin Panel</h5>
                    <div>
                        <button type="button"
                            class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                            <i class="ph-arrows-left-right"></i>
                        </button>

                        <button type="button"
                            class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
                            <i class="ph-x"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="sidebar-section">
                <ul class="nav nav-sidebar" data-nav-type="accordion">
                    <li class="nav-item-header pt-0">
                        <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Menu</div>
                        <i class="ph-dots-three sidebar-resize-show"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/dashboard') }}" class="nav-link {{ !empty($menu) && $menu == 'dashboard' ? ' active' : '' }}">
                            <i class="ph-house"></i>
                            <span>
                                Dashboard
                                <span class="d-block fw-normal opacity-50"></span>
                            </span>
                        </a>
                        <a href="{{ url('admin/user') }}" class="nav-link {{ !empty($menu) && $menu == 'user' ? ' active' : '' }}">
                            <i class="ph-user-list"></i>
                            <span>
                                User
                                <span class="d-block fw-normal opacity-50"></span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
