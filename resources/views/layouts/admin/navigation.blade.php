<div class="js-sidebar-scroll">
    <!-- Side Navigation -->
    <div class="content-side">
        <ul class="nav-main">
            <li class="nav-main-item">
                <a class="nav-main-link" href="{{route('dashboard')}}">
                    <i class="nav-main-link-icon si si-speedometer"></i>
                    <span class="nav-main-link-name">Dashboard</span>
                </a>
            </li>
            @role('admin')
            <li class="nav-main-item open">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true" href="#">
                    <i class="nav-main-link-icon si si-docs"></i>
                    <span class="nav-main-link-name">Transactions</span>
                </a>
                <ul class="nav-main-submenu">
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="{{route('purchase-request.index')}}">
                            <span class="nav-main-link-name">Purchase Request</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="be_comp_image_cropper.html">
                            <span class="nav-main-link-name">Request for Qoutation</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="be_comp_appear.html">
                            <span class="nav-main-link-name">Abstract of Canvass</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="be_comp_charts.html">
                            <span class="nav-main-link-name">Approved Budget for contract</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="be_comp_calendar.html">
                            <span class="nav-main-link-name">Notice of Award</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="be_comp_sliders.html">
                            <span class="nav-main-link-name">Notice to Proceed</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link" href="be_comp_syntax_highlighting.html">
                            <span class="nav-main-link-name">Disbursement Voucher</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="{{route('official.index')}}">
                    <i class="nav-main-link-icon si si-users"></i>
                    <span class="nav-main-link-name">Officials</span>
                </a>
            </li>
            <li class="nav-main-item">
                <a class="nav-main-link" href="be_pages_dashboard.html">
                    <i class="nav-main-link-icon si si-wallet"></i>
                    <span class="nav-main-link-name">Budget</span>
                </a>
            </li>
            @endrole
            @role('super-admin')
            <li class="nav-main-item">
                <a class="nav-main-link" href="{{route('user.index')}}">
                    <i class="nav-main-link-icon si si-user-follow"></i>
                    <span class="nav-main-link-name">User</span>
                </a>
            </li>
            @endrole

        </ul>
    </div>
    <!-- END Side Navigation -->
</div>