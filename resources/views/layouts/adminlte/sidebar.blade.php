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
            <li class="treeview {{ active_class(Active::checkRoutePattern('db.acc.*')) }}">
                <a href="#">
                    <i class="fa fa-table fa-fw"></i> <span>@lang('menu.item.accounting')</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ active_class(Active::checkRoutePattern('db.acc.cash') || Active::checkRoutePattern('db.acc.cash.*')) }}"><a href="{{ route('db.acc.cash') }}"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.cash')</a></li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.capital')
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('db.acc.capital.deposit.index') }}"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.capital.deposit')</a></li>
                            <li><a href="{{ route('db.acc.capital.withdrawal.index') }}"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.capital.withdrawal')</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.cost')
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('db.acc.cost') }}"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.cost.cost')</a></li>
                            <li><a href="{{ route('db.acc.cost.category') }}"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.cost.category')</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.revenue')
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('db.acc.revenue') }}"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.revenue.revenue')</a></li>
                            <li><a href="{{ route('db.acc.revenue.category') }}"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.revenue.category')</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('db.acc.cash_flow') }}"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.cash_flow')</a></li>
                </ul>
            </li>
            @if(Entrust::can('po.po-create') OR
                Entrust::can('po.po-revise') OR
                Entrust::can('po.po-payment') OR
                Entrust::can('po.po-copy'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.po.*')) }}">
                    <a href="#"><i class="fa fa-truck fa-fw"></i><span>&nbsp;@lang('menu.item.po')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Entrust::can('po.po-create'))
                            <li class="{{ active_class(if_route('db.po.create')) }}">
                                <a href="{{ route('db.po.create') }}"><i class="fa fa-truck fa-fw"></i>&nbsp;@lang('menu.item.po_new')</a>
                            </li>
                        @endif
                        @if(Entrust::can('po.po-revise'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.po.revise') || Active::checkRoutePattern('db.po.revise.*')) }}">
                                <a href="{{ route('db.po.revise.index') }}"><i class="fa fa-code-fork fa-rotate-180 fa-fw"></i>&nbsp;@lang('menu.item.po_revise')</a>
                            </li>
                        @endif
                        @if(Entrust::can('po.po-payment'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.po.payment') || Active::checkRoutePattern('db.po.payment.*')) }}">
                                <a href="{{ route('db.po.payment.index') }}"><i class="fa fa-calculator fa-fw"></i>&nbsp;@lang('menu.item.po_payment')</a>
                            </li>
                        @endif
                        @if(Entrust::can('po.po-copy'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.po.copy') || Active::checkRoutePattern('db.po.copy.*')) }}">
                                <a href="{{ route('db.po.copy') }}"><i class="fa fa-copy fa-rotate-180 fa-fw"></i>&nbsp;@lang('menu.item.po_copy')</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Entrust::can('so.so-create') OR
                Entrust::can('so.so-revise') OR
                Entrust::can('so.so-payment') OR
                Entrust::can('so.so-copy'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.so.*')) }}">
                    <a href="#"><i class="fa fa-cart-arrow-down fa-fw"></i><span>&nbsp;@lang('menu.item.so')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Entrust::can('so.so-create'))
                            <li class="{{ active_class(if_route('db.so.create')) }}">
                                <a href="{{ route('db.so.create') }}"><i class="fa fa-cart-arrow-down fa-fw"></i>&nbsp;@lang('menu.item.so_new')</a>
                            </li>
                        @endif
                        @if(Entrust::can('so.so-revise'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.so.revise') || Active::checkRoutePattern('db.so.revise.*')) }}">
                                <a href="{{ route('db.so.revise.index') }}"><i class="fa fa fa-code-fork fa-fw"></i>&nbsp;@lang('menu.item.so_revise')</a>
                            </li>
                        @endif
                        @if(Entrust::can('so.so-payment'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.so.payment') || Active::checkRoutePattern('db.so.payment.*')) }}">
                                <a href="{{ route('db.so.payment.index') }}"><i class="fa fa-calculator fa-fw"></i>&nbsp;@lang('menu.item.so_payment')</a>
                            </li>
                        @endif
                        @if(Entrust::can('so.so-copy'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.so.copy') || Active::checkRoutePattern('db.so.copy.*')) }}">
                                <a href="{{ route('db.so.copy') }}"><i class="fa fa-copy fa-fw"></i>&nbsp;@lang('menu.item.so_copy')</a>
                            </li>
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
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.price.*')) }}">
                    <a href="#"><i class="fa fa-barcode fa-fw"></i><span>&nbsp;@lang('menu.item.price')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Entrust::can('price.todayprice-list') OR
                            Entrust::can('price.todayprice-create'))
                            <li><a href="{{ route('db.price.today') }}"><i class="fa fa-barcode fa-fw"></i>&nbsp;@lang('menu.item.price_todayprice')</a></li>
                        @endif
                        @if(Entrust::can('price.pricelevel-list') OR
                            Entrust::can('price.pricelevel-create') OR
                            Entrust::can('price.pricelevel-edit') OR
                            Entrust::can('price.pricelevel-delete'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.price.price_level') || Active::checkRoutePattern('db.price.price_level.*')) }}"><a href="{{ route('db.price.price_level') }}"><i class="fa  fa-table fa-fw"></i>&nbsp;@lang('menu.item.price_pricelevel')</a></li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Entrust::can('warehouse.inflow-input') OR
                Entrust::can('warehouse.outflow-input') OR
                Entrust::can('warehouse.stockopname') OR
                Entrust::can('warehouse.transfer-stock'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.warehouse') || Active::checkRoutePattern('db.warehouse.*')) }}">
                    <a href="#"><i class="fa fa-wrench fa-fw"></i><span>&nbsp;@lang('menu.item.wh')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Entrust::can('warehouse.inflow-input'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.warehouse.inflow.*')) }}">
                                <a href="{{ route('db.warehouse.inflow.index') }}"><i class="fa fa-mail-forward fa-rotate-90 fa-fw"></i>&nbsp;@lang('menu.item.wh_inflow')</a>
                            </li>
                        @endif
                        @if(Entrust::can('warehouse.outflow-input'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.warehouse.outflow.*')) }}">
                                <a href="{{ route('db.warehouse.outflow.index') }}"><i class="fa fa-mail-reply fa-rotate-90 fa-fw"></i>&nbsp;@lang('menu.item.wh_outflow')</a>
                            </li>
                        @endif
                        @if(Entrust::can('warehouse.stockopname'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.warehouse.stockopname.*')) }}">
                                <a href="{{ route('db.warehouse.stockopname.index') }}"><i class="fa fa-database fa-fw"></i>&nbsp;@lang('menu.item.wh_stockopname')</a>
                            </li>
                        @endif
                        @if(Entrust::can('warehouse.transfer-stock'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.warehouse.transfer_stock.*')) }}">
                                <a href="{{ route('db.warehouse.transfer_stock.index') }}"><i class="fa fa-refresh fa-fw"></i>&nbsp;@lang('menu.item.wh_transfer')</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Entrust::can('bank.upload') OR
                Entrust::can('bank.consolidate') OR
                Entrust::can('bank.giro'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.bank') || Active::checkRoutePattern('db.bank.*')) }}">
                    <a href="#"><i class="fa fa-bank fa-fw"></i><span>&nbsp;@lang('menu.item.bank')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Entrust::can('bank.upload'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.bank.upload')) }}">
                                <a href="{{ route('db.bank.upload') }}"><i class="fa fa-cloud-upload fa-fw"></i>&nbsp;@lang('menu.item.bank_upload')</a>
                            </li>
                        @endif
                        @if(Entrust::can('bank.consolidate'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.bank.consolidate')) }}">
                                <a href="{{ route('db.bank.consolidate') }}"><i class="fa fa-compress fa-fw"></i>&nbsp;@lang('menu.item.bank_consolidate')</a>
                            </li>
                        @endif
                        @if(Entrust::can('bank.giro'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.bank.giro') || Active::checkRoutePattern('db.bank.giro.*')) }}">
                                <a href="{{ route('db.bank.giro') }}"><i class="fa fa-book fa-fw"></i>&nbsp;@lang('menu.item.bank_giro')</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Entrust::can('customer.confirmation') OR
                Entrust::can('customer.payment') OR
                Entrust::can('customer.approval'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.customer.confirmation.*') || Active::checkRoutePattern('db.customer.payment.*') || Active::checkRoutePattern('db.customer.approval.*')) }}">
                    <a href="#"><i class="fa fa-smile-o fa-fw"></i><span>&nbsp;@lang('menu.item.customer')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Entrust::can('customer.confirmation'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.customer.confirmation.*')) }}">
                                <a href="{{ route('db.customer.confirmation.index') }}"><i class="fa fa-check fa-fw"></i>&nbsp;@lang('menu.item.customer_confirm')</a>
                            </li>
                        @endif
                        @if(Entrust::can('customer.payment'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.customer.payment.*')) }}">
                                <a href="{{ route('db.customer.payment.index') }}"><i class="fa fa-calculator fa-fw"></i>&nbsp;@lang('menu.item.customer_payment')</a>
                            </li>
                        @endif
                        @if(Entrust::can('customer.approval'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.customer.approval.*')) }}">
                                <a href="{{ route('db.customer.approval.index') }}"><i class="fa fa-bell-o"></i>&nbsp;@lang('menu.item.customer_approval')</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Entrust::can('truck.maintenance-list') OR
                Entrust::can('truck.maintenance-create') OR
                Entrust::can('truck.maintenance-edit') OR
                Entrust::can('truck.maintenance-delete'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.truck.maintenance') || Active::checkRoutePattern('db.truck.maintenance.*')) }}">
                    <a href="#"><i class="fa fa-truck fa-flip-horizontal fa-fw"></i><span>&nbsp;@lang('menu.item.truck')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ active_class(Active::checkRoutePattern('db.truck.maintenance') || Active::checkRoutePattern('db.truck.maintenance.*')) }}">
                            <a href="{{ route('db.truck.maintenance') }}"><i class="fa fa-truck fa-flip-horizontal fa-fw"></i>&nbsp;@lang('menu.item.truck_maintenance')</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(Entrust::can('employee.employee-list') OR
                Entrust::can('employee.employee-create') OR
                Entrust::can('employee.employee-edit') OR
                Entrust::can('employee.employee-delete'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.employee.employee') || Active::checkRoutePattern('db.employee.employee.*')) }}">
                    <a href="#"><i class="fa fa-odnoklassniki fa-fw"></i><span>&nbsp;@lang('menu.item.employee')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ active_class(Active::checkRoutePattern('db.employee.employee') || Active::checkRoutePattern('db.employee.employee.*')) }}">
                            <a href="{{ route('db.employee.employee') }}"><i class="fa fa-odnoklassniki fa-fw"></i>&nbsp;@lang('menu.item.employee.employee_list')</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(Entrust::can('report.admin-user') OR
                Entrust::can('report.admin-role') OR
                Entrust::can('report.admin-store') OR
                Entrust::can('report.admin-unit') OR
                Entrust::can('report.admin-phone_provider') OR
                Entrust::can('report.admin-settings') OR
                Entrust::can('report.master-supplier') OR
                Entrust::can('report.master-customer') OR
                Entrust::can('report.master-product') OR
                Entrust::can('report.master-product_type') OR
                Entrust::can('report.master-user') OR
                Entrust::can('report.master-warehouse') OR
                Entrust::can('report.master-bank') OR
                Entrust::can('report.master-truck') OR
                Entrust::can('report.master-truck_maintenance') OR
                Entrust::can('report.master-vendor_trucking') OR
                Entrust::can('report.trx-po') OR
                Entrust::can('report.trx-so'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.report') || Active::checkRoutePattern('db.report.*')) }}">
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i><span>&nbsp;@lang('menu.item.rpt')</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Entrust::can('report.trx-po') OR
                            Entrust::can('report.trx-so'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.report.transaction')) }}">
                                <a href="{{ route('db.report.transaction') }}"><i class="fa fa-connectdevelop fa-fw"></i>&nbsp;@lang('menu.item.rpt_rpttrx')</a>
                            </li>
                        @endif
                        <li class="{{ active_class(Active::checkRoutePattern('db.report.monitoring')) }}">
                            <a href="{{ route('db.report.monitoring') }}"><i class="fa fa-eye fa-fw"></i>&nbsp;@lang('menu.item.rpt_rptmntr')</a>
                        </li>
                        <li class="{{ active_class(Active::checkRoutePattern('db.report.tax')) }}">
                            <a href="{{ route('db.report.tax') }}"><i class="fa fa-institution fa-fw"></i>&nbsp;@lang('menu.item.rpt_rpttax')</a>
                        </li>
                        @if(Entrust::can('report.master-supplier') OR
                            Entrust::can('report.master-customer') OR
                            Entrust::can('report.master-product') OR
                            Entrust::can('report.master-product_type') OR
                            Entrust::can('report.master-user') OR
                            Entrust::can('report.master-warehouse') OR
                            Entrust::can('report.master-bank') OR
                            Entrust::can('report.master-truck') OR
                            Entrust::can('report.master-truck_maintenance') OR
                            Entrust::can('report.master-vendor_trucking'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.report.master')) }}">
                                <a href="{{ route('db.report.master') }}"><i class="fa fa-file-text-o fa-fw"></i>&nbsp;@lang('menu.item.rpt_rptmaster')</a>
                            </li>
                        @endif
                        @if(Entrust::can('report.admin-user') OR
                            Entrust::can('report.admin-role') OR
                            Entrust::can('report.admin-store') OR
                            Entrust::can('report.admin-unit') OR
                            Entrust::can('report.admin-phone_provider') OR
                            Entrust::can('report.admin-settings'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.report.admin')) }}">
                                <a href="{{ route('db.report.admin') }}"><i class="glyphicon glyphicon-cog"></i>&nbsp;@lang('menu.item.rpt_rptadmin')</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
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
                Entrust::can('master.vendor.truck-delete') OR
                Entrust::can('master.expense_template-list') OR
                Entrust::can('master.expense_template-create') OR
                Entrust::can('master.expense_template-edit') OR
                Entrust::can('master.expense_template-delete'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.master.*')) }}">
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
                            <li class="{{ active_class(Active::checkRoutePattern('db.master.customer') || Active::checkRoutePattern('db.master.customer.*')) }}">
                                <a href="{{ route('db.master.customer') }}"><i class="fa fa-smile-o fa-fw"></i>&nbsp;@lang('menu.item.master_customer')</a>
                            </li>
                        @endif
                        @if(Entrust::can('master.supplier-list') OR
                            Entrust::can('master.supplier-create') OR
                            Entrust::can('master.supplier-edit') OR
                            Entrust::can('master.supplier-delete'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.master.supplier') || Active::checkRoutePattern('db.master.supplier.*')) }}">
                                <a href="{{ route('db.master.supplier') }}"><i class="fa fa-building-o fa-fw"></i>&nbsp;@lang('menu.item.master_supplier')</a>
                            </li>
                        @endif
                        @if(Entrust::can('master.product-list') OR
                            Entrust::can('master.product-create') OR
                            Entrust::can('master.product-edit') OR
                            Entrust::can('master.product-delete') OR
                            Entrust::can('master.product.producttype-list') OR
                            Entrust::can('master.product.producttype-create') OR
                            Entrust::can('master.product.producttype-edit') OR
                            Entrust::can('master.product.producttype-delete'))
                            <li class="treeview {{ active_class(Active::checkRoutePattern('db.master.product') ||
                                                                Active::checkRoutePattern('db.master.product.*') ||
                                                                Active::checkRoutePattern('db.master.producttype') ||
                                                                Active::checkRoutePattern('db.master.producttype.*')) }}">
                                <a href="#">
                                    <i class="fa fa-cubes fa-fw"></i>&nbsp;@lang('menu.item.master_product')
                                    <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="{{ active_class(Active::checkRoutePattern('db.master.product') || Active::checkRoutePattern('db.master.product.*')) }}">
                                        <a href="{{ route('db.master.product') }}"><i class="fa fa-cubes fa-fw"></i>&nbsp;@lang('menu.item.master_product')</a>
                                    </li>
                                    <li class="{{ active_class(Active::checkRoutePattern('db.master.producttype') || Active::checkRoutePattern('db.master.producttype.*')) }}">
                                        <a href="{{ route('db.master.producttype') }}"><i class="fa fa-cube fa-fw"></i>&nbsp;@lang('menu.item.master_producttype')</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if(Entrust::can('master.warehouse-list') OR
                            Entrust::can('master.warehouse-create') OR
                            Entrust::can('master.warehouse-edit') OR
                            Entrust::can('master.warehouse-delete'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.master.warehouse') || Active::checkRoutePattern('db.master.warehouse.*')) }}">
                                <a href="{{ route('db.master.warehouse') }}"><i class="fa fa-wrench fa-fw"></i>&nbsp;@lang('menu.item.master_warehouse')</a>
                            </li>
                        @endif
                        @if(Entrust::can('master.bank-list') OR
                            Entrust::can('master.bank-create') OR
                            Entrust::can('master.bank-edit') OR
                            Entrust::can('master.bank-delete'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.master.bank') || Active::checkRoutePattern('db.master.bank.*')) }}">
                                <a href="{{ route('db.master.bank') }}"><i class="fa fa-bank fa-fw"></i>&nbsp;@lang('menu.item.master_bank')</a>
                            </li>
                        @endif
                        @if(Entrust::can('master.truck-list') OR
                            Entrust::can('master.truck-create') OR
                            Entrust::can('master.truck-edit') OR
                            Entrust::can('master.truck-delete'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.master.truck') || Active::checkRoutePattern('db.master.truck.*')) }}">
                                <a href="{{ route('db.master.truck') }}"><i class="fa fa-truck fa-flip-horizontal fa-fw"></i>&nbsp;@lang('menu.item.master_truck')</a>
                            </li>
                        @endif
                        @if(Entrust::can('master.vendor.truck-list') OR
                            Entrust::can('master.vendor.truck-create') OR
                            Entrust::can('master.vendor.truck-edit') OR
                            Entrust::can('master.vendor.truck-delete'))
                            <li class="treeview {{ active_class(Active::checkRoutePattern('db.master.vendor.trucking') || Active::checkRoutePattern('db.master.vendor.trucking.*')) }}">
                                <a href="#">
                                    <i class="fa fa-vine fa-flip-horizontal fa-fw"></i>&nbsp;@lang('menu.item.master_vendor')
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="{{ active_class(Active::checkRoutePattern('db.master.vendor.trucking') || Active::checkRoutePattern('db.master.vendor.trucking.*')) }}">
                                        <a href="{{ route('db.master.vendor.trucking') }}"><i class="fa fa-ge fa-fw"></i>&nbsp;@lang('menu.item.master_vendor_trucking')</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if(Entrust::can('master.expense_template-list') OR
                            Entrust::can('master.expense_template-create') OR
                            Entrust::can('master.expense_template-edit') OR
                            Entrust::can('master.expense_template-delete'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.master.expense_template') || Active::checkRoutePattern('db.master.expense_template.*')) }}">
                                <a href="{{ route('db.master.expense_template') }}"><i class="fa fa-ticket fa-fw"></i>&nbsp;@lang('menu.item.master_expense_template')</a>
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
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.admin.*')) }}">
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
                            <li class="{{ active_class(Active::checkRoutePattern('db.admin.user') || Active::checkRoutePattern('db.admin.user.*')) }}">
                                <a href="{{ route('db.admin.user') }}"><i class="fa fa-user fa-fw"></i>&nbsp;@lang('menu.item.adm_user')</a>
                            </li>
                        @endif
                        @if(Entrust::can('admin.role-list') OR
                            Entrust::can('admin.role-create') OR
                            Entrust::can('admin.role-edit') OR
                            Entrust::can('admin.role-delete'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.admin.roles') || Active::checkRoutePattern('db.admin.roles.*')) }}">
                                <a href="{{ route('db.admin.roles') }}"><i class="fa fa-key fa-fw"></i>&nbsp;@lang('menu.item.adm_role')</a>
                            </li>
                        @endif
                        @if(Entrust::can('admin.store-list') OR
                            Entrust::can('admin.store-create') OR
                            Entrust::can('admin.store-edit') OR
                            Entrust::can('admin.store-delete'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.admin.store') || Active::checkRoutePattern('db.admin.store.*')) }}">
                                <a href="{{ route('db.admin.store') }}"><i class="fa fa-umbrella fa-fw"></i>&nbsp;@lang('menu.item.adm_store')</a>
                            </li>
                        @endif
                        @if(Entrust::can('admin.unit-list') OR
                            Entrust::can('admin.unit-create') OR
                            Entrust::can('admin.unit-edit') OR
                            Entrust::can('admin.unit-delete'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.admin.unit') || Active::checkRoutePattern('db.admin.unit.*')) }}">
                                <a href="{{ route('db.admin.unit') }}"><i class="glyphicon glyphicon-flash"></i>&nbsp;@lang('menu.item.adm_unit')</a>
                            </li>
                        @endif
                        @if(Entrust::can('admin.settings-list') OR
                            Entrust::can('admin.settings-edit'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.admin.settings') || Active::checkRoutePattern('db.admin.settings.*')) }}">
                                <a href="{{ route('db.admin.settings') }}"><i class="fa fa-minus-square fa-fw"></i>&nbsp;@lang('menu.item.adm_settings')</a>
                            </li>
                        @endif
                        @if(Entrust::can('admin.phoneprovider-list') OR
                            Entrust::can('admin.phoneprovider-create') OR
                            Entrust::can('admin.phoneprovider-edit') OR
                            Entrust::can('admin.phoneprovider-delete'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.admin.phone_provider') || Active::checkRoutePattern('db.admin.phone_provider.*')) }}">
                                <a href="{{ route('db.admin.phone_provider') }}"><i class="glyphicon glyphicon-phone"></i>&nbsp;@lang('menu.item.adm_phone_provider')</a>
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