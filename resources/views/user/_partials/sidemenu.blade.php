<div id="sidebar">
    <nav class="sidebar-nav">
        <div class="sidebar-brand">
            <a class="navbar-brand" href="{{ route('homepage') }}" style="background-image: url('../images/Logo.svg');">Navbar</a>
        </div>
        <div id="sidebar-inner">
            <ul class="navbar-nav nav-main">
                <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center" href="{{ route('dashboard') }}">
                        <span class="sidebar-icon">
                            <img src="../img/dashboard/home.svg" alt="">
                        </span>
                        <span>{{ getLocale($locale_dashboard_user, 'sidebar1', 'Dashboard') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="javascript:void(0);">
                        <span class="sidebar-icon">
                            <img src="../img/dashboard/home.svg" alt="">
                        </span>
                        <span>{{ getLocale($locale_dashboard_user, 'sidebar2', 'My rent') }}</span>
                        <i class="fa fa-caret-down icon-toggler"></i>
                    </a>

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="javascript:void(0);">
                                <span>{{ getLocale($locale_dashboard_user, 'sidebar3', 'Ongoing Activities') }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="javascript:void(0);">
                                <span>{{ getLocale($locale_dashboard_user, 'sidebar4', 'My Place') }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="javascript:void(0);">
                                <span>{{ getLocale($locale_dashboard_user, 'sidebar5', 'History') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->routeIs('my-favourites') ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center" href="{{ route('my-favourites') }}">
                        <span class="sidebar-icon">
                            <img src="../img/dashboard/heart.svg" alt="">
                        </span>
                        <span>{{ getLocale($locale_dashboard_user, 'sidebar6', 'My favourites') }}</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('dashboard.recent-view') ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center" href="{{ route('dashboard.recent-view') }}">
                        <span class="sidebar-icon">
                            <img src="../img/dashboard/heart.svg" alt="">
                        </span>
                        <span>Recent view</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="javascript:void(0);">
                        <span class="sidebar-icon">
                            <img src="../img/dashboard/notif.svg" alt="">
                        </span>
                        <span>{{ getLocale($locale_dashboard_user, 'sidebar7', 'Notifications') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="javascript:void(0);">
                        <span class="sidebar-icon">
                            <img src="../img/dashboard/activities.svg" alt="">
                        </span>
                        <span>{{ getLocale($locale_dashboard_user, 'sidebar8', 'Activities & services') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="javascript:void(0);">
                        <span class="sidebar-icon">
                            <img src="../img/dashboard/payment.svg" alt="">
                        </span>
                        <span>{{ getLocale($locale_dashboard_user, 'sidebar9', 'Payment methods') }}</span>
                    </a>
                </li>
                <li class="nav-item py-4 mt-4 border-top border-bottom">
                    <a class="nav-link d-flex align-items-center" href="javascript:void(0);">
                        <span class="sidebar-icon">
                            <img src="../img/dashboard/list-property.svg" alt="">
                        </span>
                        <span>{{ getLocale($locale_dashboard_user, 'sidebar10', 'List my property') }}</span>
                    </a>
                </li>
                <li class="nav-item py-4 mt-1 border-bottom">
                    <a class="nav-link d-flex align-items-center" href="javascript:void(0);">
                        <span class="sidebar-icon">
                            <img src="../img/dashboard/list-property.svg" alt="">
                        </span>
                        <span>{{ getLocale($locale_dashboard_user, 'sidebar11', 'Link Account') }}</span>
                        <i class="fa fa-caret-down icon-toggler"></i>
                    </a>

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="javascript:void(0);">
                                <span>{{ getLocale($locale_dashboard_user, 'sidebar12', 'Ongoing activities') }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="javascript:void(0);">
                                <span>{{ getLocale($locale_dashboard_user, 'sidebar13', 'For listing purposes') }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="javascript:void(0);">
                                <span>{{ getLocale($locale_dashboard_user, 'sidebar14', 'For renting purposes') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item py-4">
                    <a class="nav-link d-flex align-items-center" href="javascript:void(0);">
                        <span class="sidebar-icon">
                            <img src="../img/dashboard/help.svg" alt="">
                        </span>
                        <span>{{ getLocale($locale_dashboard_user, 'sidebar15', 'Help and support') }}</span>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav nav-profile">
                <li class="nav-item py-4">
                    <a class="nav-link d-flex align-items-center" href="javascript:void(0);">
                        <span class="sidebar-icon mr-3">
                            @if ((auth()->user()->avatar))
                            <img id="sideProfilePic" class="img-profile" src="{{auth()->user()->avatar->url}}" alt="">
                            @else
                            <img id="sideProfilePic" class="img-profile" src="../img/dashboard/profile-pic.png" alt="">
                            @endif
                        </span>
                        <span id="sideFullname">{{ auth()->user()->full_name }}</span>
                        <i class="fa fa-caret-right icon-toggler"></i>
                    </a>

                    <template id="templatePopoverNavProfileMenu">
                        <div class="list-group nav-profile-menu">
                          <a class="list-group-item {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">{{ getLocale($locale_dashboard_user, 'sidebar16', 'Profile') }}</a>
                          <a class="list-group-item" href="#">{{ getLocale($locale_dashboard_user, 'sidebar17', 'Digital identity') }}</a>
                          <a class="list-group-item" href="#">{{ getLocale($locale_dashboard_user, 'sidebar18', 'Legal documents') }}</a>
                          <a class="list-group-item" href="#">{{ getLocale($locale_dashboard_user, 'sidebar19', 'Account settings') }}</a>
                        </div>
                    </template>
                </li>
            </ul>
            <button class="btn-chat background-primary">
                <i class="fas fa-comment-alt"></i>
            </button>
        </div>
    </nav>
</div>
