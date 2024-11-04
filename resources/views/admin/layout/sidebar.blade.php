<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard.index') }}">Goat</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard.index') }}">Goat</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class><a class="nav-link" href="{{ route('dashboard.index') }}">Ecommerce Dashboard</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <span>User</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('user.index') }}">Danh sách người dùng</a></li>
                    <li><a class="nav-link" href="{{ route('user.indexSoftDelete') }}">Đã xóa gần đây</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <span>Role</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('role.index') }}">Role List</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <span>Category</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('category.index') }}">Category List</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <span>Product</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('product.index') }}">Product List</a></li>
                    <li><a class="nav-link" href="{{ route('product.indexSoftDelete') }}">Đã xóa gần đây</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <span>Variant</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('variant.index') }}">Variant List</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <span>Coupon</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('coupon.index') }}">Coupon List</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <span>Order</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('order.index') }}">Order List</a></li>
                </ul>
            </li>
            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                    <i class="fas fa-rocket"></i> Documentation
                </a>
            </div>
        </ul>
    </aside>
</div>
