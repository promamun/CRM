<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper"><a href="#"><img class="img-fluid for-light" src="../assets/images/logo/logo.png" alt=""><img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="#"><img class="img-fluid" src="../assets/images/logo/logo-icon.png" alt=""></a></div>
        <nav class="sidebar-main">
            <div id="sidebar-menu" >
                <ul class="sidebar-links text-center" id="simple-bar">
                    <li class="back-btn"><a href="#"><img class="img-fluid" src="../assets/images/logo/logo-icon.png" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-list">
                        <label class="badge badge-success">2</label><a class="sidebar-link sidebar-title" href="#"><i data-feather="home"></i><span class="lan-3">Dashboard              </span></a>
                        <ul class="sidebar-submenu">
                            <li><a class="lan-4" href="#">Default</a></li>
                            <li><a class="lan-5" href="#">Ecommerce</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <label class="badge badge-danger">New</label><a class="sidebar-link sidebar-title" href="#"><i data-feather="box"></i><span>Invoice</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{url('/invoice-list')}}">Invoice List</a></li>
                            <li><a href="{{url('/invoice-create')}}">Create new</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#"><i data-feather="shopping-bag"></i><span>Daily Entry</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{url('/entry-list')}}">Entry List</a></li>
                            <li><a href="{{url('/entry-create')}}">Create Entry</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="{{url('/customers')}}"><i data-feather="users"></i><span>Customers</span></a>

                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="{{url('/banks')}}"><i data-feather="home"></i><span>Banks</span></a>

                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
