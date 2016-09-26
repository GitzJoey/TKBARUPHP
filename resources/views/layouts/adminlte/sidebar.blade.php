<aside class="main-sidebar">
    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('images/blank.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a><i class="fa fa-circle text-success"></i> Type : @lang('lookup.'.Auth::user()->userDetail->type)</a>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="header">&nbsp;</li>
            @if(Entrust::can('po.po-create') OR
                Entrust::can('po.po-revise') OR
                Entrust::can('po.po-payment'))
                <li class="treeview">
                    <a href="#"><i class="fa fa-truck fa-fw"></i><span>&nbsp;@lang('menu.item.po')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Entrust::can('po.po-create'))
                            <li><a href="{{ route('db.po.create') }}"><i class="fa fa-truck fa-fw"></i>&nbsp;@lang('menu.item.po_new')</a></li>
                        @endif
                        @if(Entrust::can('po.po-revise'))
                            <li><a href="#"><i class="fa fa-code-fork fa-rotate-180 fa-fw"></i>&nbsp;@lang('menu.item.po_revise')</a></li>
                        @endif
                        @if(Entrust::can('po.po-payment'))
                            <li><a href="#"><i class="fa fa-calculator fa-fw"></i>&nbsp;@lang('menu.item.po_payment')</a></li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Entrust::can('so.so-create') OR
                Entrust::can('so.so-revise') OR
                Entrust::can('so.so-payment') OR
                Entrust::can('so.so-copy'))
                <li class="treeview">
                    <a href="#"><i class="fa fa-cart-arrow-down fa-fw"></i><span>&nbsp;@lang('menu.item.so')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Entrust::can('so.so-create'))
                            <li><a href="#"><i class="fa fa-cart-arrow-down fa-fw"></i>&nbsp;@lang('menu.item.so_new')</a></li>
                        @endif
                        @if(Entrust::can('so.so-revise'))
                            <li><a href="#"><i class="fa fa fa-code-fork fa-fw"></i>&nbsp;@lang('menu.item.so_revise')</a></li>
                        @endif
                        @if(Entrust::can('so.so-payment'))
                            <li><a href="#"><i class="fa fa-calculator fa-fw"></i>&nbsp;@lang('menu.item.so_payment')</a></li>
                        @endif
                        @if(Entrust::can('so.so-copy'))
                            <li><a href="#"><i class="fa fa-copy fa-fw"></i>&nbsp;@lang('menu.item.so_copy')</a></li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Entrust::can('price.todayprice-list') OR
                Entrust::can('price.todayprice-create') OR
                Entrust::can('price.pricelevel-list') OR
                Entrust::can('price.pricelevel-create') OR
                Entrust::can('price.pricelevel-edit') OR
                Entrust::can('price.pricelevel-delete'))
                <li class="treeview">
                    <a href="#"><i class="fa fa-barcode fa-fw"></i><span>&nbsp;@lang('menu.item.price')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Entrust::can('price.todayprice-list') OR
                            Entrust::can('price.todayprice-create'))
                            <li><a href="#"><i class="fa fa-barcode fa-fw"></i>&nbsp;@lang('menu.item.price_todayprice')</a></li>
                        @endif
                        @if(Entrust::can('price.pricelevel-list') OR
                            Entrust::can('price.pricelevel-create') OR
                            Entrust::can('price.pricelevel-edit') OR
                            Entrust::can('price.pricelevel-delete'))
                            <li><a href="{{ route('db.price.price_level') }}"><i class="fa  fa-table fa-fw"></i>&nbsp;@lang('menu.item.price_pricelevel')</a></li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Entrust::can('warehouse.inflow-input') OR
                Entrust::can('warehouse.outflow-input') OR
                Entrust::can('warehouse.stockopname'))
                <li class="treeview">
                    <a href="#"><i class="fa fa-wrench fa-fw"></i><span>&nbsp;@lang('menu.item.wh')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Entrust::can('warehouse.inflow-input'))
                            <li><a href="{{ route('db.warehouse.inflow') }}"><i class="fa fa-mail-forward fa-rotate-90 fa-fw"></i>&nbsp;@lang('menu.item.wh_inflow')</a></li>
                        @endif
                        @if(Entrust::can('warehouse.outflow-input'))
                            <li><a href="{{ route('db.warehouse.outflow') }}"><i class="fa fa-mail-reply fa-rotate-90 fa-fw"></i>&nbsp;@lang('menu.item.wh_outflow')</a></li>
                        @endif
                        @if(Entrust::can('warehouse.stockopname'))
                            <li><a href="{{ route('db.warehouse.stockopname') }}"><i class="fa fa-database"></i>&nbsp;@lang('menu.item.wh_stockopname')</a></li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Entrust::can('bank.upload') OR
                Entrust::can('bank.consolidate'))
                <li class="treeview">
                    <a href="#"><i class="fa fa-bank fa-fw"></i><span>&nbsp;@lang('menu.item.bank')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Entrust::can('bank.upload'))
                            <li><a href="{{ route('db.bank.upload') }}"><i class="fa fa-cloud-upload fa-fw"></i>&nbsp;@lang('menu.item.bank_upload')</a></li>
                        @endif
                        @if(Entrust::can('bank.consolidate'))
                            <li><a href="#"><i class="fa fa-compress fa-fw"></i>&nbsp;@lang('menu.item.bank_consolidate')</a></li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Entrust::can('customer.confirmation') OR
                Entrust::can('customer.approval'))
                <li class="treeview">
                    <a href="#"><i class="fa fa-smile-o fa-fw"></i><span>&nbsp;@lang('menu.item.customer')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Entrust::can('customer.confirmation'))
                            <li><a href="{{ route('db.customer.confirmation') }}"><i class="fa fa-check fa-fw"></i>&nbsp;@lang('menu.item.customer_confirm')</a></li>
                        @endif
                        @if(Entrust::can('customer.approval'))
                            <li><a href="{{ route('db.customer.approval') }}"><i class="fa fa-bell-o"></i>&nbsp;@lang('menu.item.customer_approval')</a></li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Entrust::can('truck.maintenance-list') OR
                Entrust::can('truck.maintenance-create') OR
                Entrust::can('truck.maintenance-edit') OR
                Entrust::can('truck.maintenance-delete'))
                <li class="treeview">
                    <a href="#"><i class="fa fa-truck fa-flip-horizontal fa-fw"></i><span>&nbsp;@lang('menu.item.truck')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('db.truck.maintenance') }}"><i class="fa fa-gears fa-fw"></i>&nbsp;@lang('menu.item.truck_maintenance')</a></li>
                    </ul>
                </li>
            @endif
            <li class="treeview">
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i><span>&nbsp;@lang('menu.item.rpt')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-connectdevelop fa-fw"></i>&nbsp;@lang('menu.item.rpt_rpttrx')</a></li>
                    <li><a href="#"><i class="fa fa-eye fa-fw"></i>&nbsp;@lang('menu.item.rpt_rptmntr')</a></li>
                    <li><a href="#"><i class="fa fa-institution fa-fw"></i>&nbsp;@lang('menu.item.rpt_rpttax')</a></li>
                    <li><a href="#"><i class="fa fa-file-text-o fa-fw"></i>&nbsp;@lang('menu.item.rpt_rptmaster')</a></li>
                    <li><a href="#"><i class="fa fa-file-text-o fa-fw"></i>&nbsp;@lang('menu.item.rpt_rptadmin')</a></li>
                </ul>
            </li>
            @if(Entrust::can('master.customer-list') OR
                Entrust::can('master.customer-create') OR
                Entrust::can('master.customer-edit') OR
                Entrust::can('master.customer-delete') OR
                Entrust::can('master.supplier-list') OR
                Entrust::can('master.supplier-create') OR
                Entrust::can('master.supplier-edit') OR
                Entrust::can('master.supplier-delete') OR
                Entrust::can('master.product-list') OR
                Entrust::can('master.product-create') OR
                Entrust::can('master.product-edit') OR
                Entrust::can('master.product-delete') OR
                Entrust::can('master.product.producttype-list') OR
                Entrust::can('master.product.producttype-create') OR
                Entrust::can('master.product.producttype-edit') OR
                Entrust::can('master.product.producttype-delete') OR
                Entrust::can('master.warehouse-list') OR
                Entrust::can('master.warehouse-create') OR
                Entrust::can('master.warehouse-edit') OR
                Entrust::can('master.warehouse-delete') OR
                Entrust::can('master.bank-list') OR
                Entrust::can('master.bank-create') OR
                Entrust::can('master.bank-edit') OR
                Entrust::can('master.bank-delete') OR
                Entrust::can('master.truck-list') OR
                Entrust::can('master.truck-create') OR
                Entrust::can('master.truck-edit') OR
                Entrust::can('master.truck-delete') OR
                Entrust::can('master.vendor.truck-list') OR
                Entrust::can('master.vendor.truck-create') OR
                Entrust::can('master.vendor.truck-edit') OR
                Entrust::can('master.vendor.truck-delete'))
                <li class="treeview">
                    <a href="#"><i class="fa fa-file-text-o fa-fw"></i><span>&nbsp;@lang('menu.item.master')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Entrust::can('master.customer-list') OR
                            Entrust::can('master.customer-create') OR
                            Entrust::can('master.customer-edit') OR
                            Entrust::can('master.customer-delete'))
                            <li><a href="{{ route('db.master.customer') }}"><i class="fa fa-smile-o fa-fw"></i>&nbsp;@lang('menu.item.master_customer')</a></li>
                        @endif
                        @if(Entrust::can('master.supplier-list') OR
                            Entrust::can('master.supplier-create') OR
                            Entrust::can('master.supplier-edit') OR
                            Entrust::can('master.supplier-delete'))
                            <li><a href="{{ route('db.master.supplier') }}"><i class="fa fa-building-o fa-fw"></i>&nbsp;@lang('menu.item.master_supplier')</a></li>
                        @endif
                        @if(Entrust::can('master.product-list') OR
                            Entrust::can('master.product-create') OR
                            Entrust::can('master.product-edit') OR
                            Entrust::can('master.product-delete') OR
                            Entrust::can('master.product.producttype-list') OR
                            Entrust::can('master.product.producttype-create') OR
                            Entrust::can('master.product.producttype-edit') OR
                            Entrust::can('master.product.producttype-delete'))
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-cubes fa-fw"></i>&nbsp;@lang('menu.item.master_product')
                                    <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{ route('db.master.product') }}"><i class="fa fa-cubes fa-fw"></i>&nbsp;@lang('menu.item.master_product')</a></li>
                                    <li><a href="{{ route('db.master.producttype') }}"><i class="fa fa-cube fa-fw"></i>&nbsp;@lang('menu.item.master_producttype')</a></li>
                                </ul>
                            </li>
                        @endif
                        @if(Entrust::can('master.warehouse-list') OR
                            Entrust::can('master.warehouse-create') OR
                            Entrust::can('master.warehouse-edit') OR
                            Entrust::can('master.warehouse-delete'))
                            <li><a href="{{ route('db.master.warehouse') }}"><i class="fa fa-wrench fa-fw"></i>&nbsp;@lang('menu.item.master_warehouse')</a></li>
                        @endif
                        @if(Entrust::can('master.bank-list') OR
                           Entrust::can('master.bank-create') OR
                            Entrust::can('master.bank-edit') OR
                            Entrust::can('master.bank-delete'))
                            <li><a href="{{ route('db.master.bank') }}"><i class="fa fa-bank fa-fw"></i>&nbsp;@lang('menu.item.master_bank')</a></li>
                        @endif
                        @if(Entrust::can('master.truck-list') OR
                            Entrust::can('master.truck-create') OR
                            Entrust::can('master.truck-edit') OR
                            Entrust::can('master.truck-delete'))
                            <li><a href="{{ route('db.master.truck') }}"><i class="fa fa-truck fa-flip-horizontal fa-fw"></i>&nbsp;@lang('menu.item.master_truck')</a></li>
                        @endif
                        @if(Entrust::can('master.vendor.truck-list') OR
                            Entrust::can('master.vendor.truck-create') OR
                            Entrust::can('master.vendor.truck-edit') OR
                            Entrust::can('master.vendor.truck-delete'))
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-vine fa-flip-horizontal fa-fw"></i>&nbsp;@lang('menu.item.master_vendor')
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="{{ route('db.master.vendor.trucking') }}"><i class="fa fa-ge fa-fw"></i>&nbsp;@lang('menu.item.master_vendor_trucking')</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Entrust::can('admin.user-list') OR
                Entrust::can('admin.user-create') OR
                Entrust::can('admin.user-edit') OR
                Entrust::can('admin.user-delete') OR
                Entrust::can('admin.role-list') OR
                Entrust::can('admin.role-create') OR
                Entrust::can('admin.role-edit') OR
                Entrust::can('admin.role-delete') OR
                Entrust::can('admin.store-list') OR
                Entrust::can('admin.store-create') OR
                Entrust::can('admin.store-edit') OR
                Entrust::can('admin.store-delete') OR
                Entrust::can('admin.unit-list') OR
                Entrust::can('admin.unit-create') OR
                Entrust::can('admin.unit-edit') OR
                Entrust::can('admin.unit-delete') OR
                Entrust::can('admin.settings-list') OR
                Entrust::can('admin.settings-edit') OR
                Entrust::can('admin.phoneprovider-list') OR
                Entrust::can('admin.phoneprovider-create') OR
                Entrust::can('admin.phoneprovider-edit') OR
                Entrust::can('admin.phoneprovider-delete') OR
                Entrust::can('admin.smsservice-list') OR
                Entrust::can('admin.smsservice-modem') OR
                Entrust::can('admin.smsservice-send'))
                <li class="treeview">
                    <a href="#"><i class="glyphicon glyphicon-cog"></i><span>&nbsp;@lang('menu.item.adm')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Entrust::can('admin.user-list') OR
                            Entrust::can('admin.user-create') OR
                            Entrust::can('admin.user-edit') OR
                            Entrust::can('admin.user-delete'))
                            <li><a href="{{ route('db.admin.user') }}"><i class="fa fa-user fa-fw"></i>&nbsp;@lang('menu.item.adm_user')</a></li>
                        @endif
                        @if(Entrust::can('admin.role-list') OR
                            Entrust::can('admin.role-create') OR
                            Entrust::can('admin.role-edit') OR
                            Entrust::can('admin.role-delete'))
                            <li><a href="{{ route('db.admin.roles') }}"><i class="fa fa-key fa-fw"></i>&nbsp;@lang('menu.item.adm_role')</a></li>
                        @endif
                        @if(Entrust::can('admin.store-list') OR
                            Entrust::can('admin.store-create') OR
                            Entrust::can('admin.store-edit') OR
                            Entrust::can('admin.store-delete'))
                            <li><a href="{{ route('db.admin.store') }}"><i class="fa fa-umbrella fa-fw"></i>&nbsp;@lang('menu.item.adm_store')</a></li>
                        @endif
                        @if(Entrust::can('admin.unit-list') OR
                            Entrust::can('admin.unit-create') OR
                            Entrust::can('admin.unit-edit') OR
                            Entrust::can('admin.unit-delete'))
                            <li><a href="{{ route('db.admin.unit') }}"><i class="glyphicon glyphicon-flash"></i>&nbsp;@lang('menu.item.adm_unit')</a></li>
                        @endif
                        @if(Entrust::can('admin.settings-list') OR
                            Entrust::can('admin.settings-edit'))
                            <li><a href="{{ route('db.admin.settings') }}"><i class="fa fa-minus-square fa-fw"></i>&nbsp;@lang('menu.item.adm_settings')</a></li>
                        @endif
                        @if(Entrust::can('admin.phoneprovider-list') OR
                            Entrust::can('admin.phoneprovider-create') OR
                            Entrust::can('admin.phoneprovider-edit') OR
                            Entrust::can('admin.phoneprovider-delete'))
                            <li><a href="{{ route('db.admin.phoneProvider') }}"><i class="glyphicon glyphicon-phone"></i>&nbsp;@lang('menu.item.adm_phone_provider')</a></li>
                        @endif
                        @if(Entrust::can('admin.smsservice-list') OR
                            Entrust::can('admin.smsservice-modem') OR
                            Entrust::can('admin.smsservice-send'))
                        <li class="treeview">
                            <a href="#"><i class="fa fa-cog fa-fw"></i><span>&nbsp;@lang('menu.item.adm_sms')</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#"><i class="fa fa-envelope fa-fw"></i>&nbsp;@lang('menu.item.adm_sms_in')</a></li>
                                <li><a href="#"><i class="fa fa-paper-plane fa-fw"></i>&nbsp;@lang('menu.item.adm_sms_out')</a></li>
                                <li><a href="#"><i class="fa fa-cog fa-fw"></i>&nbsp;@lang('menu.item.adm_modem')</a></li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </li>
            @endif
            <li class="header">&nbsp;</li>
        </ul>
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
    </section>
</aside>