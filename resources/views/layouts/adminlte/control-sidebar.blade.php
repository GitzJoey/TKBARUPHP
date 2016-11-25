<aside class="control-sidebar control-sidebar-dark">
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-activity-tab" data-toggle="tab"><i class="fa fa-heartbeat"></i></a></li>
        <li><a href='#control-sidebar-theme-options-tab' data-toggle='tab'><i class='fa fa-wrench'></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="control-sidebar-activity-tab">
            <h3 class="control-sidebar-heading">@lang('control_sidebar.tab.recent_activity')</h3>
        </div>

        <div class="tab-pane" id="control-sidebar-theme-options-tab">
            <h4 class='control-sidebar-heading'>Layout Options</h4>
            <div class='form-group'>
                <label class='control-sidebar-subheading'>
                    <input id="cbx_settings_fixedLayout" type='checkbox' data-layout='fixed' class='pull-right'/>
                    <span data-toggle="tooltip" data-placement="left" title="Activate the fixed layout. You can't use fixed and boxed layouts together">Fixed layout</span>
                </label>
            </div>
            <div class='form-group'>
                <label class='control-sidebar-subheading'>
                    <input id="cbx_settings_boxedLayout" type='checkbox' data-layout='layout-boxed'class='pull-right'/>
                    <span data-toggle="tooltip" data-placement="left" title="Activate the boxed layout">Boxed Layout</span>
                </label>
            </div>
            <div class='form-group'>
                <label class='control-sidebar-subheading'>
                    <input id="cbx_settings_toggleSidebar" type='checkbox' data-layout='sidebar-collapse' class='pull-right'/>
                    <span data-toggle="tooltip" data-placement="left" title="Toggle the left sidebar's state (open or collapse)">Toggle Sidebar</span>
                </label>
            </div>
            <div class='form-group'>
                <label class='control-sidebar-subheading'>
                    <input id="cbx_settings_expandOnHover" type='checkbox' data-enable='expandOnHover' class='pull-right'/>
                    <span data-toggle="tooltip" data-placement="left" title="Let the sidebar mini expand on hover">Sidebar Expand on Hover</span>
                </label>
            </div>
            <div class='form-group'>
                <label class='control-sidebar-subheading'>
                    <input id="cbx_settings_toggleRightSidebarSlide" type='checkbox' data-controlsidebar='control-sidebar-open' class='pull-right'/>
                    <span data-toggle="tooltip" data-placement="left" title="Toggle between slide over content and push content effects">Toggle Right Sidebar Slide</span>
                </label>
            </div>
            <div class='form-group'>
                <label class='control-sidebar-subheading'>
                    <input id="cbx_settings_toggleRightSidebarSkin" type='checkbox' data-sidebarskin='toggle' class='pull-right'/>
                    <span data-toggle="tooltip" data-placement="left" title="Toggle between dark and light skins for the right sidebar">Toggle Right Sidebar Skin</span>
                </label>
            </div>

            <h4 class='control-sidebar-heading'>Skins</h4>

            <ul class="list-unstyled clearfix" style="background-color: dimgrey;">
                <li style="float:left; width: 33.33333%; padding: 5px;">
                    <a id="btn_skin-blue" href='#' data-skin='skin-blue' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>
                        <div><span style='display:block; width: 20%; float: left; height: 7px; background: #367fa9;'></span><span class='bg-light-blue' style='display:block; width: 80%; float: left; height: 7px;'></span></div>
                        <div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>
                    </a>
                    <p class='text-center no-margin'>Blue</p>
                </li>
                <li style="float:left; width: 33.33333%; padding: 5px;">
                    <a id="btn_skin-black" href='#' data-skin='skin-black' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>
                        <div style='box-shadow: 0 0 2px rgba(0,0,0,0.1)' class='clearfix'><span style='display:block; width: 20%; float: left; height: 7px; background: #fefefe;'></span><span style='display:block; width: 80%; float: left; height: 7px; background: #fefefe;'></span></div>
                        <div><span style='display:block; width: 20%; float: left; height: 20px; background: #222;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>
                    </a>
                    <p class='text-center no-margin'>Black</p>
                </li>
                <li style="float:left; width: 33.33333%; padding: 5px;">
                    <a id="btn_skin-purple" href='#' data-skin='skin-purple' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>
                        <div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-purple-active'></span><span class='bg-purple' style='display:block; width: 80%; float: left; height: 7px;'></span></div>
                        <div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>
                    </a>
                    <p class='text-center no-margin'>Purple</p>
                </li>
                <li style="float:left; width: 33.33333%; padding: 5px;">
                    <a id="btn_skin-green" href='#' data-skin='skin-green' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>
                        <div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-green-active'></span><span class='bg-green' style='display:block; width: 80%; float: left; height: 7px;'></span></div>
                        <div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>
                    </a>
                    <p class='text-center no-margin'>Green</p>
                </li>
                <li style="float:left; width: 33.33333%; padding: 5px;">
                    <a id="btn_skin-red" href='#' data-skin='skin-red' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>
                        <div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-red-active'></span><span class='bg-red' style='display:block; width: 80%; float: left; height: 7px;'></span></div>
                        <div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>
                    </a>
                    <p class='text-center no-margin'>Red</p>
                </li>
                <li style="float:left; width: 33.33333%; padding: 5px;">
                    <a id="btn_skin-yellow" href='#' data-skin='skin-yellow' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>
                        <div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-yellow-active'></span><span class='bg-yellow' style='display:block; width: 80%; float: left; height: 7px;'></span></div>
                        <div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>
                    </a>
                    <p class='text-center no-margin'>Yellow</p>
                </li>
                <li style="float:left; width: 33.33333%; padding: 5px;">
                    <a id="btn_skin-blue-light" href='#' data-skin='skin-blue-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>
                        <div><span style='display:block; width: 20%; float: left; height: 7px; background: #367fa9;'></span><span class='bg-light-blue' style='display:block; width: 80%; float: left; height: 7px;'></span></div>
                        <div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>
                    </a>
                    <p class='text-center no-margin' style='font-size: 12px'>Blue Light</p>
                </li>
                <li style="float:left; width: 33.33333%; padding: 5px;">
                    <a id="btn_skin-black-light" href='#' data-skin='skin-black-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>
                        <div style='box-shadow: 0 0 2px rgba(0,0,0,0.1)' class='clearfix'><span style='display:block; width: 20%; float: left; height: 7px; background: #fefefe;'></span><span style='display:block; width: 80%; float: left; height: 7px; background: #fefefe;'></span></div>
                        <div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>
                    </a>
                    <p class='text-center no-margin' style='font-size: 12px'>Black Light</p>
                </li>
                <li style="float:left; width: 33.33333%; padding: 5px;">
                    <a id="btn_skin-purple-light" data-skin='skin-purple-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>
                        <div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-purple-active'></span><span class='bg-purple' style='display:block; width: 80%; float: left; height: 7px;'></span></div>
                        <div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>
                    </a>
                    <p class='text-center no-margin' style='font-size: 12px'>Purple Light</p>
                </li>
                <li style="float:left; width: 33.33333%; padding: 5px;">
                    <a id="btn_skin-green-light" data-skin='skin-green-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>
                        <div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-green-active'></span><span class='bg-green' style='display:block; width: 80%; float: left; height: 7px;'></span></div>
                        <div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>
                    </a>
                    <p class='text-center no-margin' style='font-size: 12px'>Green Light</p>
                </li>
                <li style="float:left; width: 33.33333%; padding: 5px;">
                    <a id="btn_skin-red-light" data-skin='skin-red-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>
                        <div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-red-active'></span><span class='bg-red' style='display:block; width: 80%; float: left; height: 7px;'></span></div>
                        <div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>
                    </a>
                    <p class='text-center no-margin' style='font-size: 12px'>Red Light</p>
                </li>
                <li style="float:left; width: 33.33333%; padding: 5px;">
                    <a id="btn_skin-yellow-light" data-skin='skin-yellow-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>
                        <div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-yellow-active'></span><span class='bg-yellow' style='display:block; width: 80%; float: left; height: 7px;'></span></div>
                        <div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>
                    </a>
                    <p class='text-center no-margin' style='font-size: 12px;'>Yellow Light</p>
                </li>
            </ul>
        </div>

        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">@lang('control_sidebar.tab.general_settings')</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">@lang('control_sidebar.settings.field.date_format')</label>
                    <select class="form-control">
                        <option>DD-MM-YYYY</option>
                        <option>DD MMM YYYY</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-sidebar-subheading">@lang('control_sidebar.settings.field.time_format')</label>
                    <select class="form-control">
                        <option>HH:mm</option>
                        <option>HH:mm:ss</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        @lang('control_sidebar.settings.field.24hour')
                        <input type="checkbox" class="pull-right" checked>
                    </label>
                </div>
                <div class="form-group">
                    <label class="control-sidebar-subheading">@lang('control_sidebar.settings.field.thousand_separator')</label>
                    <select class="form-control">
                        <option>Comma</option>
                        <option>Dot</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-sidebar-subheading">@lang('control_sidebar.settings.field.decimal_separator')</label>
                    <select class="form-control">
                        <option>Comma</option>
                        <option>Dot</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-sidebar-subheading">@lang('control_sidebar.settings.field.decimal_digit')</label>
                    <select class="form-control">
                        <option>0</option>
                        <option>2</option>
                    </select>
                </div>
                <hr>
                <div class="form-group">
                    <button type="button" class="btn btn-xs btn-default">@lang('buttons.apply_button')</button>
                </div>
            </form>
        </div>
    </div>
</aside>

<div class="control-sidebar-bg"></div>