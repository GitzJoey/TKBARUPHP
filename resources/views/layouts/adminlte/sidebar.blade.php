<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('images/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Role : Admin</a>
            </div>
        </div>

        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>

        <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <li class="treeview">
                <a href="#"><i class="fa fa-truck fa-fw"></i><span>&nbsp;Purchase Order</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('db.po.create') }}"><i class="fa fa-truck fa-fw"></i>&nbsp;PO New</a></li>
                    <li><a href="#"><i class="fa fa-code-fork fa-rotate-180 fa-fw"></i>&nbsp;PO Revise</a></li>
                    <li><a href="#"><i class="fa fa-calculator fa-fw"></i>&nbsp;PO Payment</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-cart-arrow-down fa-fw"></i><span>&nbsp;Sales Order</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-cart-arrow-down fa-fw"></i>&nbsp;SO New</a></li>
                    <li><a href="#"><i class="fa fa fa-code-fork fa-fw"></i>&nbsp;SO Revise</a></li>
                    <li><a href="#"><i class="fa fa-calculator fa-fw"></i>&nbsp;SO Payment</a></li>
                    <li><a href="#"><i class="fa fa-copy fa-fw"></i>&nbsp;SO Copy</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-barcode fa-fw"></i><span>&nbsp;Price</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-barcode fa-fw"></i>&nbsp;Today Price</a></li>
                    <li><a href="#"><i class="fa  fa-table fa-fw"></i>&nbsp;Price Level</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-wrench fa-fw"></i><span>&nbsp;Warehouse</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('db.warehouse.inflow') }}"><i class="fa fa-mail-forward fa-rotate-90 fa-fw"></i>&nbsp;Inflow</a></li>
                    <li><a href="{{ route('db.warehouse.outflow') }}"><i class="fa fa-mail-reply fa-rotate-90 fa-fw"></i>&nbsp;Outflow</a></li>
                    <li><a href="{{ route('db.warehouse.stockopname') }}"><i class="fa fa-database"></i>&nbsp;Stock Opname</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-bank fa-fw"></i><span>&nbsp;Bank</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-cloud-upload fa-fw"></i>&nbsp;Upload</a></li>
                    <li><a href="#"><i class="fa fa-compress fa-fw"></i>&nbsp;Consolidate</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-smile-o fa-fw"></i><span>&nbsp;Customer</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('db.customer.confirmation') }}"><i class="fa fa-check fa-fw"></i>&nbsp;Confirmation</a></li>
                    <li><a href="{{ route('db.customer.approval') }}"><i class="fa fa-bell-o"></i>&nbsp;Approval</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i><span>&nbsp;Report</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-connectdevelop fa-fw"></i>&nbsp;Transactions</a></li>
                    <li><a href="#"><i class="fa fa-eye fa-fw"></i>&nbsp;Monitoring</a></li>
                    <li><a href="#"><i class="fa fa-institution fa-fw"></i>&nbsp;Tax Reports</a></li>
                    <li><a href="#"><i class="fa fa-file-text-o fa-fw"></i>&nbsp;Master Data</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-file-text-o fa-fw"></i><span>&nbsp;Master</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('db.master.customer') }}"><i class="fa fa-smile-o fa-fw"></i>&nbsp;Customer</a></li>
                    <li><a href="{{ route('db.master.supplier') }}"><i class="fa fa-building-o fa-fw"></i>&nbsp;Supplier</a></li>
                    <li><a href="{{ route('db.master.product') }}"><i class="fa fa-cubes fa-fw"></i>&nbsp;Product</a></li>
                    <li><a href="{{ route('db.master.warehouse') }}"><i class="fa fa-wrench fa-fw"></i>&nbsp;Warehouse</a></li>
                    <li><a href="{{ route('db.master.bank') }}"><i class="fa fa-bank fa-fw"></i>&nbsp;Bank</a></li>
                    <li class="treeview">
                        <a href="{{ route('db.master.truck') }}">
                            <i class="fa fa-truck fa-flip-horizontal fa-fw"></i>&nbsp;Trucks
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('db.master.truck.maintenance') }}"><i class="fa fa-gears fa-fw"></i>&nbsp;Maintenance</a></li>
                            <li><a href="{{ route('db.master.truck') }}"><i class="fa fa-gears fa-fw"></i>&nbsp;Trucks</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-vine fa-flip-horizontal fa-fw"></i>&nbsp;Vendors
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('db.master.vendor.trucking') }}"><i class="fa fa-ge fa-fw"></i>&nbsp;Trucking</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="active treeview">
                <a href="#"><i class="glyphicon glyphicon-cog"></i><span>&nbsp;Admin Menu</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('db.admin.user') }}"><i class="fa fa-user fa-fw"></i>&nbsp;User</a></li>
                    <li><a href="{{ route('db.admin.roles') }}"><i class="fa fa-key fa-fw"></i>&nbsp;Roles</a></li>
                    <li><a href="{{ route('db.admin.store') }}"><i class="fa fa-umbrella fa-fw"></i>&nbsp;Store</a></li>
                    <li><a href="{{ route('db.admin.unit') }}"><i class="glyphicon glyphicon-flash"></i>&nbsp;Unit</a></li>
                    <li><a href="{{ route('db.admin.settings') }}"><i class="fa fa-minus-square fa-fw"></i>&nbsp;Settings</a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-cog fa-fw"></i><span>&nbsp;SMS Service</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-envelope fa-fw"></i>&nbsp;SMS In</a></li>
                            <li><a href="#"><i class="fa fa-paper-plane fa-fw"></i>&nbsp;SMS Out</a></li>
                            <li><a href="#"><i class="fa fa-cog fa-fw"></i>&nbsp;Modem</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
</aside>