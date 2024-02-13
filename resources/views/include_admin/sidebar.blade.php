<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
        <img src="{{asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="/admin" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview {{request()->is("admin") ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{request()->is("admin") ? 'active' : ''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin')}}" class="nav-link {{request()->is("admin") ? 'active' : ''}}">
                                <i class="far fa-file nav-icon"></i>
                                <p>Dashboard V1</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{request()->is("admin/categories") || request()->is("admin/categories/add") ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link"{{request()->is("admin/categories") ? 'active' : ''}}>
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Categories
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/categories/add')}}" class="nav-link {{request()->is("admin/categories/add") ? 'active' : ''}}">
                                <i class="far fa-file nav-icon"></i>
                                <p>Add category</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/categories')}}" class="nav-link {{request()->is("admin/categories") ? 'active' : ''}}">
                                <i class="far fa-file nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{request()->is("admin/sliders") || request()->is("admin/sliders/add") ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{request()->is("admin/sliders") || request()->is("admin/sliders/add") ? 'active' : ''}}">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Sliders
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/sliders/add')}}" class="nav-link {{request()->is("admin/sliders/add") ? 'active' : ''}}">
                                <i class="far fa-file nav-icon"></i>
                                <p>Add slider</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview ">
                        <li class="nav-item">
                            <a href="{{url('admin/sliders')}}" class="nav-link {{request()->is("admin/sliders") ? 'active' : ''}}">
                                <i class="far fa-file nav-icon"></i>
                                <p>Sliders</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{request()->is("admin/products") || request()->is("admin/products/add") ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Products
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/products/add')}}" class="nav-link {{request()->is("admin/products/add") ? 'active' : ''}}">
                                <i class="far fa-file nav-icon"></i>
                                <p>Add product</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/products')}}" class="nav-link {{request()->is("admin/products") ? 'active' : ''}}">
                                <i class="far fa-file nav-icon"></i>
                                <p>Products</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview {{request()->is("admin/orders") ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link" {{request()->is("admin/orders") ? 'active' : ''}}>
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Orders
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/orders')}}" class="nav-link {{request()->is("admin/orders") ? 'active' : ''}}">
                                <i class="far fa-file nav-icon"></i>
                                <p>Orders</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">MISCELLANEOUS</li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
