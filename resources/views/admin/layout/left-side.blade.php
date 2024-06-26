<!-- ########## START: LEFT PANEL ########## -->
<div class="sl-logo">
    <a href=""><i class="icon ion-android-star-outline"></i> starlight</a>
</div>

<div class="sl-sideleft">

    @php
        $dashboardPermission = getRolePermission(auth()->user()->role,'dashboard');
        $userPermission = getRolePermission(auth()->user()->role,'user');
        $rolePermission = getRolePermission(auth()->user()->role,'role');
        $permission = getRolePermission(auth()->user()->role,'permission');
        $purchasePermission = getRolePermission(auth()->user()->role,'purchase');
        $customerPermission = getRolePermission(auth()->user()->role,'customer');
        $supplierPermission = getRolePermission(auth()->user()->role,'supplier');
        $manufacturePermission = getRolePermission(auth()->user()->role,'manufacture');
        $reportPermission = getRolePermission(auth()->user()->role,'report');
        $orderPermission = getRolePermission(auth()->user()->role,'order');
        $productPermission = getRolePermission(auth()->user()->role,'product');
        $rawProductPermission = getRolePermission(auth()->user()->role,'raw-product');
    @endphp


    <label class="sidebar-label">Navigation</label>
    <div class="sl-sideleft-menu">

        @if($dashboardPermission > 0)
            <a href="{{route('admin.dashboard')}}"
               class="sl-menu-link {{\Illuminate\Support\Facades\Request::segment(2)=='dashboard'?'active':''}}">
                <div class="sl-menu-item">
                    <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                    <span class="menu-item-label">Dashboard</span>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
        @endif

        @if($userPermission > 0)
            <a href="#"
               class="sl-menu-link {{\Illuminate\Support\Facades\Request::segment(2)=='user'?'active show-sub':''}}">
                <div class="sl-menu-item">
                    <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
                    <span class="menu-item-label">User Section</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{route('admin.user.list')}}" class="nav-link">Manage User</a></li>
                <li class="nav-item"><a href="{{route('admin.create.user')}}" class="nav-link">Create User</a></li>
            </ul>
        @endif

        @if($rolePermission >0 || $permission > 0)
            <a href="#"
               class="sl-menu-link {{\Illuminate\Support\Facades\Request::segment(2)=='acl'?'active show-sub':''}}">
                <div class="sl-menu-item">
                    <i class="icon ion-navicon-round tx-20"></i>
                    <span class="menu-item-label">ACL</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{route('admin.permission.list')}}" class="nav-link">Permissions</a></li>
                <li class="nav-item"><a href="{{route('admin.role.list')}}" class="nav-link">Roles</a></li>
                {{--            <li class="nav-item"><a href="{{route('admin.role-permission')}}" class="nav-link">Roles & Permissions</a></li>--}}

            </ul>
        @endif

        @if($rawProductPermission > 0)
            <a href="#"
               class="sl-menu-link {{\Illuminate\Support\Facades\Request::segment(2)=='raw-product' || \Illuminate\Support\Facades\Request::segment(2)=='product-size' ?'active show-sub':''}}">
                <div class="sl-menu-item">
                    <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
                    <span class="menu-item-label">Raw Product</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{route('admin.create.product')}}" class="nav-link">Add Raw Product</a>
                </li>
                <li class="nav-item"><a href="{{route('admin.create.product.size')}}" class="nav-link">Add Product
                        Size</a></li>
                <li class="nav-item"><a href="{{route('admin.product.list')}}" class="nav-link">Raw Product List</a>
                </li>
            </ul>
        @endif

        @if($productPermission > 0)
            <a href="#"
               class="sl-menu-link {{\Illuminate\Support\Facades\Request::segment(2)=='ware-house' ?'active show-sub':''}}">
                <div class="sl-menu-item">
                    <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
                    <span class="menu-item-label">Product Warehouse</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{route('admin.warehouse.create')}}" class="nav-link">Manage Warehouse</a>
                </li>
                <li class="nav-item"><a href="{{route('admin.warehouse.rack')}}" class="nav-link">Manage Rack</a></li>
            </ul>


            <a href="#"
               class="sl-menu-link {{\Illuminate\Support\Facades\Request::segment(2)=='ware-house-product' ?'active show-sub':''}}">
                <div class="sl-menu-item">
                    <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
                    <span class="menu-item-label">Products</span>
                    <i class="menu-item-arrow fa fa-angle-down"></i>
                </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
                <li class="nav-item"><a href="{{route('admin.warehouse.product.create')}}" class="nav-link">Add Product</a>
                </li>
                <li class="nav-item"><a href="{{route('admin.warehouse.product.list')}}" class="nav-link">Manage Product</a></li>
            </ul>

        @endif


    </div><!-- sl-sideleft-menu -->

    <br>
</div><!-- sl-sideleft -->
<!-- ########## END: LEFT PANEL ########## -->
