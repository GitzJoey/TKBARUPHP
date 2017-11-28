<aside class="main-sidebar">
    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ empty(Auth::user()->profile->image_filename) ? asset('images/def-user.png'):asset('images/'.Auth::user()->profile->image_filename) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <a href="{{ route('db.user.profile.show', Auth::user()->hId()) }}"><p>{{ Auth::user()->name }}</p></a>
                <a href="{{ route('db.user.profile.show', Auth::user()->hId()) }}"><i class="fa fa-circle text-success"></i> Type : @lang('lookup.'.Auth::user()->userDetail->type)</a>
            </div>
        </div>

        <form action="{{ route('db.search') }}" method="get" class="sidebar-form">
            <div class="input-group">
                @if (Active::checkRoutePattern('db.search'))
                    <input type="text" name="q" class="form-control" placeholder="Search..." value="{{ Request::query('q') }}">
                @else
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                @endif
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="treeview {{ active_class(Active::checkRoutePattern('db.acc.*')) }}">
                <a href="#">
                    <i class="fa fa-table fa-fw"></i> <span>@lang('menu.item.accounting')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ active_class(Active::checkRoutePattern('db.acc.cash') || Active::checkRoutePattern('db.acc.cash.*')) }}"><a href="{{ route('db.acc.cash') }}"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.cash')</a></li>
                    <li class="treeview {{ active_class(Active::checkRoutePattern('db.acc.capital.*')) }}">
                        <a href="#"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.capital')
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ active_class(Active::checkRoutePattern('db.acc.capital.deposit.*')) }}"><a href="{{ route('db.acc.capital.deposit.index') }}"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.capital.deposit')</a></li>
                            <li class="{{ active_class(Active::checkRoutePattern('db.acc.capital.withdrawal.*')) }}"><a href="{{ route('db.acc.capital.withdrawal.index') }}"><i class="fa fa-circle-o fa-fw"></i>&nbsp;@lang('menu.item.accounting.capital.withdrawal')</a></li>
                        </ul>
                    </li>
                    <li class="treeview {{ active_class( Active::checkRoutePattern('db.acc.cost') ||
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
                    <li class="treeview {{ active_class( Active::checkRoutePattern('db.acc.revenue') ||
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
            @if(Laratrust::can('menu-purchaseorder_create') OR
                Laratrust::can('menu-purchaseorder_update') OR
                Laratrust::can('menu-popayment') OR
                Laratrust::can('menu-pocopy'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.po.*')) }}">
                    <a href="#"><i class="fa fa-truck fa-fw"></i><span>&nbsp;@lang('menu.item.po')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Laratrust::can('menu-purchaseorder_create'))
                            <li class="{{ active_class(if_route('db.po.create')) }}">
                                <a href="{{ route('db.po.create') }}"><i class="fa fa-truck fa-fw"></i>&nbsp;@lang('menu.item.po_new')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-purchaseorder_update'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.po.revise') || Active::checkRoutePattern('db.po.revise.*')) }}">
                                <a href="{{ route('db.po.revise.index') }}"><i class="fa fa-code-fork fa-rotate-180 fa-fw"></i>&nbsp;@lang('menu.item.po_revise')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-popayment'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.po.payment') || Active::checkRoutePattern('db.po.payment.*')) }}">
                                <a href="{{ route('db.po.payment.index') }}"><i class="fa fa-calculator fa-fw"></i>&nbsp;@lang('menu.item.po_payment')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-pocopy'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.po.copy') || Active::checkRoutePattern('db.po.copy.*')) }}">
                                <a href="{{ route('db.po.copy') }}"><i class="fa fa-copy fa-rotate-180 fa-fw"></i>&nbsp;@lang('menu.item.po_copy')</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Laratrust::can('menu-salesorder_create') OR
                Laratrust::can('menu-salesorder_update') OR
                Laratrust::can('menu-sopayment') OR
                Laratrust::can('menu-socopy'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.so.*')) }}">
                    <a href="#"><i class="fa fa-cart-arrow-down fa-fw"></i><span>&nbsp;@lang('menu.item.so')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Laratrust::can('menu-salesorder_create'))
                            <li class="{{ active_class(if_route('db.so.create')) }}">
                                <a href="{{ route('db.so.create') }}"><i class="fa fa-cart-arrow-down fa-fw"></i>&nbsp;@lang('menu.item.so_new')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-salesorder_update'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.so.revise') || Active::checkRoutePattern('db.so.revise.*')) }}">
                                <a href="{{ route('db.so.revise.index') }}"><i class="fa fa fa-code-fork fa-fw"></i>&nbsp;@lang('menu.item.so_revise')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-sopayment'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.so.payment') || Active::checkRoutePattern('db.so.payment.*')) }}">
                                <a href="{{ route('db.so.payment.index') }}"><i class="fa fa-calculator fa-fw"></i>&nbsp;@lang('menu.item.so_payment')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-socopy'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.so.copy') || Active::checkRoutePattern('db.so.copy.*')) }}">
                                <a href="{{ route('db.so.copy') }}"><i class="fa fa-copy fa-fw"></i>&nbsp;@lang('menu.item.so_copy')</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Laratrust::can('menu-todayprice') OR
                Laratrust::can('menu-pricelevel'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.price.*')) }}">
                    <a href="#"><i class="fa fa-barcode fa-fw"></i><span>&nbsp;@lang('menu.item.price')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Laratrust::can('menu-todayprice'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.price.today') || Active::checkRoutePattern('db.price.today.*')) }}"><a href="{{ route('db.price.today') }}"><i class="fa fa-barcode fa-fw"></i>&nbsp;@lang('menu.item.price_todayprice')</a></li>
                        @endif
                        @if(Laratrust::can('menu-pricelevel'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.price.price_level') || Active::checkRoutePattern('db.price.price_level.*')) }}"><a href="{{ route('db.price.price_level') }}"><i class="fa  fa-table fa-fw"></i>&nbsp;@lang('menu.item.price_pricelevel')</a></li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Laratrust::can('menu-warehouse_inflow') OR
                Laratrust::can('menu-warehouse_outflow') OR
                Laratrust::can('menu-warehouse_stockopname') OR
                Laratrust::can('menu-warehouse_transferstock') OR
                Laratrust::can('menu-warehouse_stockmerger'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.warehouse') || Active::checkRoutePattern('db.warehouse.*')) }}">
                    <a href="#"><i class="fa fa-wrench fa-fw"></i><span>&nbsp;@lang('menu.item.wh')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Laratrust::can('menu-warehouse_inflow'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.warehouse.inflow.*')) }}">
                                <a href="{{ route('db.warehouse.inflow.index') }}"><i class="fa fa-mail-forward fa-rotate-90 fa-fw"></i>&nbsp;@lang('menu.item.wh_inflow')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-warehouse_outflow'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.warehouse.outflow.*')) }}">
                                <a href="{{ route('db.warehouse.outflow.index') }}"><i class="fa fa-mail-reply fa-rotate-90 fa-fw"></i>&nbsp;@lang('menu.item.wh_outflow')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-warehouse_stockopname'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.warehouse.stockopname.*')) }}">
                                <a href="{{ route('db.warehouse.stockopname.index') }}"><i class="fa fa-database fa-fw"></i>&nbsp;@lang('menu.item.wh_stockopname')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-warehouse_transferstock'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.warehouse.transfer_stock.*')) }}">
                                <a href="{{ route('db.warehouse.transfer_stock.index') }}"><i class="fa fa-refresh fa-fw"></i>&nbsp;@lang('menu.item.wh_transfer')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-warehouse_stockmerger'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.warehouse.stock_merger.*')) }}">
                                <a href="{{ route('db.warehouse.stock_merger.index') }}"><i class="fa fa-sort-amount-asc fa-fw"></i>&nbsp;@lang('menu.item.wh_stockmerger')</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Laratrust::can('menu-bank_upload') OR
                Laratrust::can('menu-bank_consolidate') OR
                Laratrust::can('menu-bank_giro'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.bank') || Active::checkRoutePattern('db.bank.*')) }}">
                    <a href="#"><i class="fa fa-bank fa-fw"></i><span>&nbsp;@lang('menu.item.bank')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Laratrust::can('menu-bank_upload'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.bank.upload')) }}">
                                <a href="{{ route('db.bank.upload') }}"><i class="fa fa-cloud-upload fa-fw"></i>&nbsp;@lang('menu.item.bank_upload')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-bank_consolidate'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.bank.consolidate')) }}">
                                <a href="{{ route('db.bank.consolidate') }}"><i class="fa fa-compress fa-fw"></i>&nbsp;@lang('menu.item.bank_consolidate')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-bank_giro'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.bank.giro') || Active::checkRoutePattern('db.bank.giro.*')) }}">
                                <a href="{{ route('db.bank.giro') }}"><i class="fa fa-book fa-fw"></i>&nbsp;@lang('menu.item.bank_giro')</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Laratrust::can('menu-customer_confirmation') OR
                Laratrust::can('menu-customer_payment') OR
                Laratrust::can('menu-customer_approval'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.customer.confirmation.*') || Active::checkRoutePattern('db.customer.payment.*') || Active::checkRoutePattern('db.customer.approval.*')) }}">
                    <a href="#"><i class="fa fa-smile-o fa-fw"></i><span>&nbsp;@lang('menu.item.customer')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Laratrust::can('menu-customer_confirmation'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.customer.confirmation.*')) }}">
                                <a href="{{ route('db.customer.confirmation.index') }}"><i class="fa fa-check fa-fw"></i>&nbsp;@lang('menu.item.customer_confirm')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-customer_payment'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.customer.payment.*')) }}">
                                <a href="{{ route('db.customer.payment.index') }}"><i class="fa fa-calculator fa-fw"></i>&nbsp;@lang('menu.item.customer_payment')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-customer_approval'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.customer.approval.*')) }}">
                                <a href="{{ route('db.customer.approval.index') }}"><i class="fa fa-bell-o"></i>&nbsp;@lang('menu.item.customer_approval')</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Laratrust::can('menu-truck_maintenance'))
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
            @if(Laratrust::can('menu-employee') OR
                Laratrust::can('menu-employee_salary'))
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
            @if(Laratrust::can('menu-tax-input') OR
                Laratrust::can('menu-tax-output') OR
                Laratrust::can('menu-tax-generate'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.tax.invoice.input.') ||
                                                    Active::checkRoutePattern('db.tax.invoice.input.*') ||
                                                    Active::checkRoutePattern('db.tax.invoice.output.') ||
                                                    Active::checkRoutePattern('db.tax.invoice.output.*') ||
                                                    Active::checkRoutePattern('db.tax.generate')) }}">
                    <a href="#"><i class="fa fa-legal fa-fw"></i><span>&nbsp;@lang('menu.item.tax')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>

                    <ul class="treeview-menu">
                        <li class="treeview {{ active_class(Active::checkRoutePattern('db.tax.invoice.input.*') ||
                                                    Active::checkRoutePattern('db.tax.invoice.output.*')) }}">
                            <a href="#"><i class="fa fa-exchange fa-fw"></i>&nbsp;@lang('menu.item.tax.invoice')
                                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="{{ active_class(Active::checkRoutePattern('db.tax.invoice.input.*')) }}"><a href="{{ route('db.tax.invoice.input.index') }}"><i class="fa fa-arrow-left"></i>&nbsp;@lang('menu.item.tax.invoice.input')</a></li>
                                <li class="{{ active_class(Active::checkRoutePattern('db.tax.invoice.output.*')) }}"><a href="{{ route('db.tax.invoice.output.index') }}"><i class="fa fa-arrow-right"></i>&nbsp;@lang('menu.item.tax.invoice.output')</a></li>
                            </ul>
                        </li>
                        <li class=" {{ active_class(Active::checkRoutePattern('db.tax.generate')) }}">
                            <a href="{{ route('db.tax.generate') }}"><i class="fa fa-magic fa-fw"></i>&nbsp;@lang('menu.item.tax.generate')</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(Laratrust::can('menu-report_transaction') OR
                Laratrust::can('menu-report_monitoring') OR
                Laratrust::can('menu-report_tax') OR
                Laratrust::can('menu-report_master') OR
                Laratrust::can('menu-report_admin'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.report') || Active::checkRoutePattern('db.report.*')) }}">
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i><span>&nbsp;@lang('menu.item.rpt')</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Laratrust::can('menu-report_transaction'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.report.transaction')) }}">
                                <a href="{{ route('db.report.transaction') }}"><i class="fa fa-connectdevelop fa-fw"></i>&nbsp;@lang('menu.item.rpt_rpttrx')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-report_monitoring'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.report.monitoring')) }}">
                                <a href="{{ route('db.report.monitoring') }}"><i class="fa fa-eye fa-fw"></i>&nbsp;@lang('menu.item.rpt_rptmntr')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-report_tax'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.report.tax')) }}">
                                <a href="{{ route('db.report.tax') }}"><i class="fa fa-institution fa-fw"></i>&nbsp;@lang('menu.item.rpt_rpttax')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-report_master'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.report.master')) }}">
                                <a href="{{ route('db.report.master') }}"><i class="fa fa-file-text-o fa-fw"></i>&nbsp;@lang('menu.item.rpt_rptmaster')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-report_admin'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.report.admin')) }}">
                                <a href="{{ route('db.report.admin') }}"><i class="fa fa-viacoin fa-flip-vertical fa-fw"></i>&nbsp;@lang('menu.item.rpt_rptadmin')</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Laratrust::can('menu-customer') OR
                Laratrust::can('menu-supplier') OR
                Laratrust::can('menu-product') OR
                Laratrust::can('menu-producttype') OR
                Laratrust::can('menu-warehouse') OR
                Laratrust::can('menu-bank') OR
                Laratrust::can('menu-truck') OR
                Laratrust::can('menu-vendortrucking') OR
                Laratrust::can('menu-expensetemplate'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.master.*')) }}">
                    <a href="#"><i class="fa fa-file-text-o fa-fw"></i><span>&nbsp;@lang('menu.item.master')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Laratrust::can('menu-customer'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.master.customer') || Active::checkRoutePattern('db.master.customer.*')) }}">
                                <a href="{{ route('db.master.customer') }}"><i class="fa fa-smile-o fa-fw"></i>&nbsp;@lang('menu.item.master_customer')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-supplier'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.master.supplier') || Active::checkRoutePattern('db.master.supplier.*')) }}">
                                <a href="{{ route('db.master.supplier') }}"><i class="fa fa-building-o fa-fw"></i>&nbsp;@lang('menu.item.master_supplier')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-product') OR
                            Laratrust::can('menu-producttype'))
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
                                    @if(Laratrust::can('menu-product'))
                                        <li class="{{ active_class(Active::checkRoutePattern('db.master.product') || Active::checkRoutePattern('db.master.product.*')) }}">
                                            <a href="{{ route('db.master.product') }}"><i class="fa fa-cubes fa-fw"></i>&nbsp;@lang('menu.item.master_product')</a>
                                        </li>
                                    @endif
                                    @if(Laratrust::can('menu-producttype'))
                                        <li class="{{ active_class(Active::checkRoutePattern('db.master.producttype') || Active::checkRoutePattern('db.master.producttype.*')) }}">
                                            <a href="{{ route('db.master.producttype') }}"><i class="fa fa-cube fa-fw"></i>&nbsp;@lang('menu.item.master_producttype')</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-warehouse'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.master.warehouse') || Active::checkRoutePattern('db.master.warehouse.*')) }}">
                                <a href="{{ route('db.master.warehouse') }}"><i class="fa fa-wrench fa-fw"></i>&nbsp;@lang('menu.item.master_warehouse')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-bank'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.master.bank') || Active::checkRoutePattern('db.master.bank.*')) }}">
                                <a href="{{ route('db.master.bank') }}"><i class="fa fa-bank fa-fw"></i>&nbsp;@lang('menu.item.master_bank')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-truck'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.master.truck') || Active::checkRoutePattern('db.master.truck.*')) }}">
                                <a href="{{ route('db.master.truck') }}"><i class="fa fa-truck fa-flip-horizontal fa-fw"></i>&nbsp;@lang('menu.item.master_truck')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-vendortrucking'))
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
                        @if(Laratrust::can('menu-expensetemplate'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.master.expense_template') || Active::checkRoutePattern('db.master.expense_template.*')) }}">
                                <a href="{{ route('db.master.expense_template') }}"><i class="fa fa-ticket fa-fw"></i>&nbsp;@lang('menu.item.master_expense_template')</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if(Laratrust::hasRole('admin'))
                <li class="treeview {{ active_class(Active::checkRoutePattern('db.admin.*')) }}">
                    <a href="#"><i class="fa fa-viacoin fa-flip-vertical fa-fw"></i><span>&nbsp;@lang('menu.item.adm')</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @if(Laratrust::can('menu-user'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.admin.user') || Active::checkRoutePattern('db.admin.user.*')) }}">
                                <a href="{{ route('db.admin.user') }}"><i class="fa fa-user fa-fw"></i>&nbsp;@lang('menu.item.adm_user')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-role'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.admin.roles') || Active::checkRoutePattern('db.admin.roles.*')) }}">
                                <a href="{{ route('db.admin.roles') }}"><i class="fa fa-key fa-fw"></i>&nbsp;@lang('menu.item.adm_role')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-store'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.admin.store') || Active::checkRoutePattern('db.admin.store.*')) }}">
                                <a href="{{ route('db.admin.store') }}"><i class="fa fa-umbrella fa-fw"></i>&nbsp;@lang('menu.item.adm_store')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-unit'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.admin.unit') || Active::checkRoutePattern('db.admin.unit.*')) }}">
                                <a href="{{ route('db.admin.unit') }}"><i class="glyphicon glyphicon-flash"></i>&nbsp;@lang('menu.item.adm_unit')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-currencies'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.admin.currencies') || Active::checkRoutePattern('db.admin.currencies.*')) }}">
                                <a href="{{ route('db.admin.currencies') }}"><i class="glyphicon glyphicon-usd"></i>&nbsp;@lang('menu.item.adm_currencies')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-settings'))
                            <li class="{{ active_class(Active::checkRoutePattern('db.admin.settings') || Active::checkRoutePattern('db.admin.settings.*')) }}">
                                <a href="{{ route('db.admin.settings') }}"><i class="glyphicon glyphicon-th"></i>&nbsp;@lang('menu.item.adm_settings')</a>
                            </li>
                        @endif
                        @if(Laratrust::can('menu-phoneprovider'))
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
