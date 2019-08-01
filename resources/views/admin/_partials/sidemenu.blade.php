<aside class="main-sidebar">
    <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
            </ul>
        </li>
        <li class="{{ url()->current() == route('active-worker.index') ? 'active' : '' }}">
            <a href="{{ route('active-worker.index') }}"><i class="fa fa-map-marker"></i> <span>Active Worker</span></a>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-wrench"></i> <span>Manage Contents</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('content-service.index') }}"><i class="fa fa-circle-o"></i> Services</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-user"></i> <span>Manage User</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('manage-admin.index') }}"><i class="fa fa-circle-o"></i> Administrator</a></li>
                <li><a href="{{ route('manage-user.index') }}"><i class="fa fa-circle-o"></i> User</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-cogs"></i> <span>Manage Configurations</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ route('configuration-category.index') }}"><i class="fa fa-circle-o"></i> Categories</a></li>
                <li><a href="{{ route('configuration.index') }}"><i class="fa fa-circle-o"></i> Configurations</a></li>
            </ul>
        </li>
        <li class="{{ url()->current() == route('client-review.index') ? 'active' : '' }}">
            <a href="{{ route('client-review.index') }}"><i class="fa fa-map-marker"></i> <span>Client Reviews</span></a>
        </li>
        <li>
            <a href="{{ route('property.index') }}"><i class="fa fa-building"></i> <span>Properties</span></a>
        </li>
        <li class="{{ url()->current() == route('working-field.index') ? 'active' : '' }}">
            <a href="{{ route('working-field.index') }}"><i class="fa fa-user"></i> <span>Manage Working Field</span></a>
        </li>
    </ul>
    </section>
</aside>