<aside class="control-sidebar control-sidebar-dark">
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-activity-tab" data-toggle="tab"><i class="fa fa-heartbeat"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="control-sidebar-activity-tab">
            <h3 class="control-sidebar-heading">@lang('control_sidebar.tab.recent_activity')</h3>
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