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

        <form action="{{ route('db.search') }}" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>

        <ul class="sidebar-menu">
            <li class="treeview {{ active_class(Active::checkRoutePattern('db.acc.*')) }}">
                <a href="#">
                    <i class="fa fa-table fa-fw"></i> <span>@lang('menu.item.accounting')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ active_class(Active::checkRoutePattern('db.acc.cash') || Active::checkRoutePattern('db.acc.cash.*')) }}"><a href="{{ route('db.acc.cash') }}"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.cash')</a></li>
                    <li class="{{ active_class(Active::checkRoutePattern('db.acc.capital.*')) }}">
                        <a href="#"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.capital')
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ active_class(Active::checkRoutePattern('db.acc.capital.deposit.*')) }}"><a href="{{ route('db.acc.capital.deposit.index') }}"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.capital.deposit')</a></li>
                            <li class="{{ active_class(Active::checkRoutePattern('db.acc.capital.withdrawal.*')) }}"><a href="{{ route('db.acc.capital.withdrawal.index') }}"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.capital.withdrawal')</a></li>
                        </ul>
                    </li>
                    <li class="{{ active_class( Active::checkRoutePattern('db.acc.cost') ||
                                                Active::checkRoutePattern('db.acc.cost.create') ||
                                                Active::checkRoutePattern('db.acc.cost.edit') ||
                                                Active::checkRoutePattern('db.acc.cost.category') ||
                                                Active::checkRoutePattern('db.acc.cost.category.*')) }}">
                        <a href="#"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.cost')
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ active_class( Active::checkRoutePattern('db.acc.cost') ||
                                                        Active::checkRoutePattern('db.acc.cost.create') ||
                                                        Active::checkRoutePattern('db.acc.cost.edit')) }}">
                                <a href="{{ route('db.acc.cost') }}"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.cost.cost')</a>
                            </li>
                            <li class="{{ active_class( Active::checkRoutePattern('db.acc.cost.category') ||
                                                        Active::checkRoutePattern('db.acc.cost.category.*')) }}">
                                <a href="{{ route('db.acc.cost.category') }}"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.cost.category')</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ active_class( Active::checkRoutePattern('db.acc.revenue') ||
                                                Active::checkRoutePattern('db.acc.revenue.create') ||
                                                Active::checkRoutePattern('db.acc.revenue.edit') ||
                                                Active::checkRoutePattern('db.acc.revenue.category') ||
                                                Active::checkRoutePattern('db.acc.revenue.category.*')) }}">
                        <a href="#"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.revenue')
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ active_class( Active::checkRoutePattern('db.acc.revenue') ||
                                                        Active::checkRoutePattern('db.acc.revenue.create') ||
                                                        Active::checkRoutePattern('db.acc.revenue.edit')) }}">
                                <a href="{{ route('db.acc.revenue') }}"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.revenue.revenue')</a>
                            </li>
                            <li class="{{ active_class( Active::checkRoutePattern('db.acc.revenue.category') ||
                                                        Active::checkRoutePattern('db.acc.revenue.category.*')) }}">
                                <a href="{{ route('db.acc.revenue.category') }}"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.revenue.category')</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="{{ route('db.acc.cash_flow') }}"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.cash_flow')</a></li>
                </ul>
            </li>
            @if(Laratrust::can('po-create') OR
                Laratrust::can('po-revise') OR
                Laratrust::can('po-payment') OR
                Laratrust::can('po-copy'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.po.*')) }}">
                    <a href="#"><i class="fa fa-truck fa-fw"></i><span>&nbsp;@lang('menu.item.po')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Laratrust::can('po-create'))
                            <li class="{{ active_class(if_route('db.po.create')) }}">
                                <a href="{{ route('db.po.create') }}"><i class="fa fa-truck fa-fw"></i>&nbsp;@lang('menu.item.po_new')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('po-revise'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.po.revise') || Active::checkRoutePattern('db.po.revise.*')) }}">
                                <a href="{{ route('db.po.revise.index') }}"><i class="fa fa-code-fork fa-rotate-180 fa-fw"></i>&nbsp;@lang('menu.item.po_revise')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('po-payment'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.po.payment') || Active::checkRoutePattern('db.po.payment.*')) }}">
                                <a href="{{ route('db.po.payment.index') }}"><i class="fa fa-calculator fa-fw"></i>&nbsp;@lang('menu.item.po_payment')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('po-copy'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.po.copy') || Active::checkRoutePattern('db.po.copy.*')) }}">
                                <a href="{{ route('db.po.copy') }}"><i class="fa fa-copy fa-rotate-180 fa-fw"></i>&nbsp;@lang('menu.item.po_copy')</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Laratrust::can('so-create') OR
                Laratrust::can('so-revise') OR
                Laratrust::can('so-payment') OR
                Laratrust::can('so-copy'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.so.*')) }}">
                    <a href="#"><i class="fa fa-cart-arrow-down fa-fw"></i><span>&nbsp;@lang('menu.item.so')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Laratrust::can('so-create'))
                            <li class="{{ active_class(if_route('db.so.create')) }}">
                                <a href="{{ route('db.so.create') }}"><i class="fa fa-cart-arrow-down fa-fw"></i>&nbsp;@lang('menu.item.so_new')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('so-revise'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.so.revise') || Active::checkRoutePattern('db.so.revise.*')) }}">
                                <a href="{{ route('db.so.revise.index') }}"><i class="fa fa fa-code-fork fa-fw"></i>&nbsp;@lang('menu.item.so_revise')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('so-payment'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.so.payment') || Active::checkRoutePattern('db.so.payment.*')) }}">
                                <a href="{{ route('db.so.payment.index') }}"><i class="fa fa-calculator fa-fw"></i>&nbsp;@lang('menu.item.so_payment')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('so-copy'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.so.copy') || Active::checkRoutePattern('db.so.copy.*')) }}">
                                <a href="{{ route('db.so.copy') }}"><i class="fa fa-copy fa-fw"></i>&nbsp;@lang('menu.item.so_copy')</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Laratrust::can('today_price-list') OR
                Laratrust::can('today_price-create') OR
                Laratrust::can('price_level-list') OR
                Laratrust::can('price_level-create') OR
                Laratrust::can('price_level-edit') OR
                Laratrust::can('price_level-delete'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.price.*')) }}">
                    <a href="#"><i class="fa fa-barcode fa-fw"></i><span>&nbsp;@lang('menu.item.price')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Laratrust::can('today_price-list') OR
                            Laratrust::can('today_price-create'))
                            <li><a href="{{ route('db.price.today') }}"><i class="fa fa-barcode fa-fw"></i>&nbsp;@lang('menu.item.price_todayprice')</a></li>
                        @endif
                        @if(Laratrust::can('price_level-list') OR
                            Laratrust::can('price_level-create') OR
                            Laratrust::can('price_level-edit') OR
                            Laratrust::can('price_level-delete'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.price.price_level') || Active::checkRoutePattern('db.price.price_level.*')) }}"><a href="{{ route('db.price.price_level') }}"><i class="fa  fa-table fa-fw"></i>&nbsp;@lang('menu.item.price_pricelevel')</a></li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Laratrust::can('warehouse_input-inflow') OR
                Laratrust::can('warehouse_input-outflow') OR
                Laratrust::can('warehouse_input-stock_opname') OR
                Laratrust::can('warehouse_input-transfer_stock'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.warehouse') || Active::checkRoutePattern('db.warehouse.*')) }}">
                    <a href="#"><i class="fa fa-wrench fa-fw"></i><span>&nbsp;@lang('menu.item.wh')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Laratrust::can('warehouse_input-inflow'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.warehouse.inflow.*')) }}">
                                <a href="{{ route('db.warehouse.inflow.index') }}"><i class="fa fa-mail-forward fa-rotate-90 fa-fw"></i>&nbsp;@lang('menu.item.wh_inflow')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('warehouse_input-outflow'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.warehouse.outflow.*')) }}">
                                <a href="{{ route('db.warehouse.outflow.index') }}"><i class="fa fa-mail-reply fa-rotate-90 fa-fw"></i>&nbsp;@lang('menu.item.wh_outflow')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('warehouse_input-stock_opname'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.warehouse.stockopname.*')) }}">
                                <a href="{{ route('db.warehouse.stockopname.index') }}"><i class="fa fa-database fa-fw"></i>&nbsp;@lang('menu.item.wh_stockopname')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('warehouse_input-transfer_stock'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.warehouse.transfer_stock.*')) }}">
                                <a href="{{ route('db.warehouse.transfer_stock.index') }}"><i class="fa fa-refresh fa-fw"></i>&nbsp;@lang('menu.item.wh_transfer')</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Laratrust::can('bank_data-upload') OR
                Laratrust::can('bank_data-consolidate') OR
                Laratrust::can('bank_giro-list'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.bank') || Active::checkRoutePattern('db.bank.*')) }}">
                    <a href="#"><i class="fa fa-bank fa-fw"></i><span>&nbsp;@lang('menu.item.bank')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Laratrust::can('bank_data-upload'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.bank.upload')) }}">
                                <a href="{{ route('db.bank.upload') }}"><i class="fa fa-cloud-upload fa-fw"></i>&nbsp;@lang('menu.item.bank_upload')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('bank_data-consolidate'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.bank.consolidate')) }}">
                                <a href="{{ route('db.bank.consolidate') }}"><i class="fa fa-compress fa-fw"></i>&nbsp;@lang('menu.item.bank_consolidate')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('bank_giro-list'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.bank.giro') || Active::checkRoutePattern('db.bank.giro.*')) }}">
                                <a href="{{ route('db.bank.giro') }}"><i class="fa fa-book fa-fw"></i>&nbsp;@lang('menu.item.bank_giro')</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Laratrust::can('customer-confirmation') OR
                Laratrust::can('customer-payment') OR
                Laratrust::can('customer-approval'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.customer.confirmation.*') || Active::checkRoutePattern('db.customer.payment.*') || Active::checkRoutePattern('db.customer.approval.*')) }}">
                    <a href="#"><i class="fa fa-smile-o fa-fw"></i><span>&nbsp;@lang('menu.item.customer')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Laratrust::can('customer-confirmation'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.customer.confirmation.*')) }}">
                                <a href="{{ route('db.customer.confirmation.index') }}"><i class="fa fa-check fa-fw"></i>&nbsp;@lang('menu.item.customer_confirm')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('customer-payment'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.customer.payment.*')) }}">
                                <a href="{{ route('db.customer.payment.index') }}"><i class="fa fa-calculator fa-fw"></i>&nbsp;@lang('menu.item.customer_payment')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('customer-approval'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.customer.approval.*')) }}">
                                <a href="{{ route('db.customer.approval.index') }}"><i class="fa fa-bell-o"></i>&nbsp;@lang('menu.item.customer_approval')</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Laratrust::can('truck_maintenance-list') OR
                Laratrust::can('truck_maintenance-create') OR
                Laratrust::can('truck_maintenance-edit') OR
                Laratrust::can('truck_maintenance-delete'))
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
            @if(Laratrust::can('employee-list') OR
                Laratrust::can('employee-create') OR
                Laratrust::can('employee-edit') OR
                Laratrust::can('employee-delete') OR
                Laratrust::can('employee_salary-list') OR
                Laratrust::can('employee_salary-generate') OR
                Laratrust::can('employee_salary-create') OR
                Laratrust::can('employee_salary-show'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.employee.employee') ||
                                                    Active::checkRoutePattern('db.employee.employee.*') ||
                                                    Active::checkRoutePattern('db.employee.employee_salary') ||
                                                    Active::checkRoutePattern('db.employee.employee_salary.*')) }}">
                    <a href="#"><i class="fa fa-odnoklassniki fa-fw"></i><span>&nbsp;@lang('menu.item.employee')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ active_class(Active::checkRoutePattern('db.employee.employee') || Active::checkRoutePattern('db.employee.employee.*')) }}">
                            <a href="{{ route('db.employee.employee') }}"><i class="fa fa-odnoklassniki fa-fw"></i>&nbsp;@lang('menu.item.employee.employee_list')</a>
                        </li>
                        <li class="{{ active_class(Active::checkRoutePattern('db.employee.employee_salary') || Active::checkRoutePattern('db.employee.employee_salary.*')) }}">
                            <a href="{{ route('db.employee.employee_salary') }}"><i class="fa fa-money fa-fw"></i>&nbsp;@lang('menu.item.employee.salary')</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(Laratrust::can('report-user') OR
                Laratrust::can('report-role') OR
                Laratrust::can('report-store') OR
                Laratrust::can('report-unit') OR
                Laratrust::can('report-phone_provider') OR
                Laratrust::can('report-settings') OR
                Laratrust::can('report-supplier') OR
                Laratrust::can('report-customer') OR
                Laratrust::can('report-product') OR
                Laratrust::can('report-product_type') OR
                Laratrust::can('report-user') OR
                Laratrust::can('report-warehouse') OR
                Laratrust::can('report-bank') OR
                Laratrust::can('report-truck') OR
                Laratrust::can('report-truck_maintenance') OR
                Laratrust::can('report-vendor_trucking') OR
                Laratrust::can('report-po') OR
                Laratrust::can('report-so'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.report') || Active::checkRoutePattern('db.report.*')) }}">
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i><span>&nbsp;@lang('menu.item.rpt')</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Laratrust::can('report-po') OR
                            Laratrust::can('report-so'))
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
                        @if(Laratrust::can('report-supplier') OR
                            Laratrust::can('report-customer') OR
                            Laratrust::can('report-product') OR
                            Laratrust::can('report-product_type') OR
                            Laratrust::can('report-user') OR
                            Laratrust::can('report-warehouse') OR
                            Laratrust::can('report-bank') OR
                            Laratrust::can('report-truck') OR
                            Laratrust::can('report-truck_maintenance') OR
                            Laratrust::can('report-vendor_trucking'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.report.master')) }}">
                                <a href="{{ route('db.report.master') }}"><i class="fa fa-file-text-o fa-fw"></i>&nbsp;@lang('menu.item.rpt_rptmaster')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('report-user') OR
                            Laratrust::can('report-role') OR
                            Laratrust::can('report-store') OR
                            Laratrust::can('report-unit') OR
                            Laratrust::can('report-phone_provider') OR
                            Laratrust::can('report-settings'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.report.admin')) }}">
                                <a href="{{ route('db.report.admin') }}"><i class="glyphicon glyphicon-cog"></i>&nbsp;@lang('menu.item.rpt_rptadmin')</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Laratrust::can('customer-list') OR
                Laratrust::can('customer-create') OR
                Laratrust::can('customer-edit') OR
                Laratrust::can('customer-delete') OR
                Laratrust::can('supplier-list') OR
                Laratrust::can('supplier-create') OR
                Laratrust::can('supplier-edit') OR
                Laratrust::can('supplier-delete') OR
                Laratrust::can('product-list') OR
                Laratrust::can('product-create') OR
                Laratrust::can('product-edit') OR
                Laratrust::can('product-delete') OR
                Laratrust::can('product_type-list') OR
                Laratrust::can('product_type-create') OR
                Laratrust::can('product_type-edit') OR
                Laratrust::can('product_type-delete') OR
                Laratrust::can('warehouse-list') OR
                Laratrust::can('warehouse-create') OR
                Laratrust::can('warehouse-edit') OR
                Laratrust::can('warehouse-delete') OR
                Laratrust::can('bank-list') OR
                Laratrust::can('bank-create') OR
                Laratrust::can('bank-edit') OR
                Laratrust::can('bank-delete') OR
                Laratrust::can('truck-list') OR
                Laratrust::can('truck-create') OR
                Laratrust::can('truck-edit') OR
                Laratrust::can('truck-delete') OR
                Laratrust::can('truck_vendor-list') OR
                Laratrust::can('truck_vendor-create') OR
                Laratrust::can('truck_vendor-edit') OR
                Laratrust::can('truck_vendor-delete') OR
                Laratrust::can('expense_template-list') OR
                Laratrust::can('expense_template-create') OR
                Laratrust::can('expense_template-edit') OR
                Laratrust::can('expense_template-delete'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.master.*')) }}">
                    <a href="#"><i class="fa fa-file-text-o fa-fw"></i><span>&nbsp;@lang('menu.item.master')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Laratrust::can('customer-list') OR
                            Laratrust::can('customer-create') OR
                            Laratrust::can('customer-edit') OR
                            Laratrust::can('customer-delete'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.master.customer') || Active::checkRoutePattern('db.master.customer.*')) }}">
                                <a href="{{ route('db.master.customer') }}"><i class="fa fa-smile-o fa-fw"></i>&nbsp;@lang('menu.item.master_customer')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('supplier-list') OR
                            Laratrust::can('supplier-create') OR
                            Laratrust::can('supplier-edit') OR
                            Laratrust::can('supplier-delete'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.master.supplier') || Active::checkRoutePattern('db.master.supplier.*')) }}">
                                <a href="{{ route('db.master.supplier') }}"><i class="fa fa-building-o fa-fw"></i>&nbsp;@lang('menu.item.master_supplier')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('product-list') OR
                            Laratrust::can('product-create') OR
                            Laratrust::can('product-edit') OR
                            Laratrust::can('product-delete') OR
                            Laratrust::can('product_type-list') OR
                            Laratrust::can('product_type-create') OR
                            Laratrust::can('product_type-edit') OR
                            Laratrust::can('product_type-delete'))
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
                        @if(Laratrust::can('warehouse-list') OR
                            Laratrust::can('warehouse-create') OR
                            Laratrust::can('warehouse-edit') OR
                            Laratrust::can('warehouse-delete'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.master.warehouse') || Active::checkRoutePattern('db.master.warehouse.*')) }}">
                                <a href="{{ route('db.master.warehouse') }}"><i class="fa fa-wrench fa-fw"></i>&nbsp;@lang('menu.item.master_warehouse')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('bank-list') OR
                            Laratrust::can('bank-create') OR
                            Laratrust::can('bank-edit') OR
                            Laratrust::can('bank-delete'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.master.bank') || Active::checkRoutePattern('db.master.bank.*')) }}">
                                <a href="{{ route('db.master.bank') }}"><i class="fa fa-bank fa-fw"></i>&nbsp;@lang('menu.item.master_bank')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('truck-list') OR
                            Laratrust::can('truck-create') OR
                            Laratrust::can('truck-edit') OR
                            Laratrust::can('truck-delete'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.master.truck') || Active::checkRoutePattern('db.master.truck.*')) }}">
                                <a href="{{ route('db.master.truck') }}"><i class="fa fa-truck fa-flip-horizontal fa-fw"></i>&nbsp;@lang('menu.item.master_truck')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('truck_vendor-list') OR
                            Laratrust::can('truck_vendor-create') OR
                            Laratrust::can('truck_vendor-edit') OR
                            Laratrust::can('truck_vendor-delete'))
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
                        @if(Laratrust::can('expense_template-list') OR
                            Laratrust::can('expense_template-create') OR
                            Laratrust::can('expense_template-edit') OR
                            Laratrust::can('expense_template-delete'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.master.expense_template') || Active::checkRoutePattern('db.master.expense_template.*')) }}">
                                <a href="{{ route('db.master.expense_template') }}"><i class="fa fa-ticket fa-fw"></i>&nbsp;@lang('menu.item.master_expense_template')</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Laratrust::hasRole('admin'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.admin.*')) }}">
                    <a href="#"><i class="glyphicon glyphicon-cog"></i><span>&nbsp;@lang('menu.item.adm')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Laratrust::can('user-list') OR
                            Laratrust::can('user-create') OR
                            Laratrust::can('user-edit') OR
                            Laratrust::can('user-delete'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.admin.user') || Active::checkRoutePattern('db.admin.user.*')) }}">
                                <a href="{{ route('db.admin.user') }}"><i class="fa fa-user fa-fw"></i>&nbsp;@lang('menu.item.adm_user')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('role-list') OR
                            Laratrust::can('role-create') OR
                            Laratrust::can('role-edit') OR
                            Laratrust::can('role-delete'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.admin.roles') || Active::checkRoutePattern('db.admin.roles.*')) }}">
                                <a href="{{ route('db.admin.roles') }}"><i class="fa fa-key fa-fw"></i>&nbsp;@lang('menu.item.adm_role')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('store-list') OR
                            Laratrust::can('store-create') OR
                            Laratrust::can('store-edit') OR
                            Laratrust::can('store-delete'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.admin.store') || Active::checkRoutePattern('db.admin.store.*')) }}">
                                <a href="{{ route('db.admin.store') }}"><i class="fa fa-umbrella fa-fw"></i>&nbsp;@lang('menu.item.adm_store')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('unit-list') OR
                            Laratrust::can('unit-create') OR
                            Laratrust::can('unit-edit') OR
                            Laratrust::can('unit-delete'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.admin.unit') || Active::checkRoutePattern('db.admin.unit.*')) }}">
                                <a href="{{ route('db.admin.unit') }}"><i class="glyphicon glyphicon-flash"></i>&nbsp;@lang('menu.item.adm_unit')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('currencies-list') OR
                            Laratrust::can('currencies-create') OR
                            Laratrust::can('currencies-edit') OR
                            Laratrust::can('currencies-delete'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.admin.currencies') || Active::checkRoutePattern('db.admin.currencies.*')) }}">
                                <a href="{{ route('db.admin.currencies') }}"><i class="glyphicon glyphicon-usd"></i>&nbsp;@lang('menu.item.adm_currencies')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('settings-list') OR
                            Laratrust::can('settings-edit'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.admin.settings') || Active::checkRoutePattern('db.admin.settings.*')) }}">
                                <a href="{{ route('db.admin.settings') }}"><i class="glyphicon glyphicon-th"></i>&nbsp;@lang('menu.item.adm_settings')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('phone_provider-list') OR
                            Laratrust::can('phone_provider-create') OR
                            Laratrust::can('phone_provider-edit') OR
                            Laratrust::can('phone_provider-delete'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.admin.phone_provider') || Active::checkRoutePattern('db.admin.phone_provider.*')) }}">
                                <a href="{{ route('db.admin.phone_provider') }}"><i class="glyphicon glyphicon-phone"></i>&nbsp;@lang('menu.item.adm_phone_provider')</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
        </ul>
    </section>
</aside>