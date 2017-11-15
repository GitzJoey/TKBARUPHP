<aside class="control-sidebar control-sidebar-dark">
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-activity-tab" data-toggle="tab"><i class="fa fa-heartbeat"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="control-sidebar-activity-tab">
            <h4 class="control-sidebar-heading">@lang('control_sidebar.tab.notepad')</h4>
            <textarea id="notepadArea" rows="12" maxlength="500">{{ session('notepad', '') }}</textarea>
            <btn id="notepadButton" class="btn btn-xs btn-default">@lang('buttons.submit_button')</btn>
            <br/><br/><br/>
            <h4 class="control-sidebar-heading">@lang('control_sidebar.tab.server_info')</h4>
            <b>Server :</b><br/>
            {{ $_SERVER["SERVER_SOFTWARE"] }}<br/>
            <b>Enviroment :</b><br/>
            {{ App::environment() }}<br/>
            <b>DB Host :</b><br/>
            {{ env('DB_HOST') }}/{{ env('DB_PORT') }}<br/>
            <b>DB Name :</b><br/>
            {{ env('DB_DATABASE') }}<br/>
            <b>Debug :</b><br/>
            {{ env('APP_DEBUG') ? 'Enabled': 'Disabled' }}<br/>
        </div>

        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">@lang('control_sidebar.tab.general_settings')</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">@lang('control_sidebar.settings.field.date_format')</label>
                    <select id="settingDateFormat" class="form-control">
                        <option value="DD-MM-YYYY" {{ Auth::user()->store->date_format == 'DD-MM-YYYY' ? 'selected':'' }}>{{ date('d-m-Y') }} (default)</option>
                        <option value="DD MMM YYYY" {{ Auth::user()->store->date_format == 'DD MMM YYYY' ? 'selected':'' }}>{{ date('d M Y') }}</option>
                        <option value="DD/MM/YYYY" {{ Auth::user()->store->date_format == 'DD/MM/YYYY' ? 'selected':'' }}>{{ date('d/m/Y') }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-sidebar-subheading">@lang('control_sidebar.settings.field.time_format')</label>
                    <select id="settingTimeFormat" class="form-control">
                        <option value="hh:mm A" {{ Auth::user()->store->time_format == 'G:H A' ? 'selected':'' }}>{{ \Carbon\Carbon::now()->format('G:H A') }} (default)</option>
                        <option value="hh:mm:ss" {{ Auth::user()->store->time_format == 'G:H:s' ? 'selected':'' }}>{{ \Carbon\Carbon::now()->format('G:H:s') }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-sidebar-subheading">@lang('control_sidebar.settings.field.thousand_separator')</label>
                    <select id="settingThousandSeparator" class="form-control">
                        <option value="," {{ Auth::user()->store->thousand_separator == ',' ? 'selected':'' }}>@lang('store.field.comma')&nbsp;-&nbsp;1,000,000 (Default)</option>
                        <option value="." {{ Auth::user()->store->thousand_separator == '.' ? 'selected':'' }}>@lang('store.field.dot')&nbsp;-&nbsp;1.000.000</option>
                        <option value=" " {{ Auth::user()->store->thousand_separator == ' ' ? 'selected':'' }}>@lang('store.field.space')&nbsp;-&nbsp;1 000 000</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-sidebar-subheading">@lang('control_sidebar.settings.field.decimal_separator')</label>
                    <select id="settingDecimalSeparator" class="form-control">
                        <option value="," {{ Auth::user()->store->decimal_separator == ',' ? 'selected':'' }}>@lang('store.field.comma')&nbsp;-&nbsp;0,00 (Default)</option>
                        <option value="." {{ Auth::user()->store->decimal_separator == '.' ? 'selected':'' }}>@lang('store.field.dot')&nbsp;-&nbsp;0.00</option>
                        <option value=" " {{ Auth::user()->store->decimal_separator == ' ' ? 'selected':'' }}>@lang('store.field.space')&nbsp;-&nbsp;0 00</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-sidebar-subheading">@lang('control_sidebar.settings.field.decimal_digit')</label>
                    <select id="settingDecimalDigit" class="form-control">
                        <option value="0" {{ Auth::user()->store->decimal_digit == 0 ? 'selected':'' }}>@lang('control_sidebar.settings.field.0')</option>
                        <option value="1" {{ Auth::user()->store->decimal_digit == 1 ? 'selected':'' }}>@lang('control_sidebar.settings.field.1')</option>
                        <option value="2" {{ Auth::user()->store->decimal_digit == 2 ? 'selected':'' }}>@lang('control_sidebar.settings.field.2')</option>
                        <option value="3" {{ Auth::user()->store->decimal_digit == 3 ? 'selected':'' }}>@lang('control_sidebar.settings.field.3')</option>
                        <option value="4" {{ Auth::user()->store->decimal_digit == 4 ? 'selected':'' }}>@lang('control_sidebar.settings.field.4')</option>
                    </select>
                </div>
                <hr>
                <div class="form-group">
                    <button id="applySettingsButton" type="button" class="btn btn-xs btn-default">@lang('buttons.apply_button')</button>
                </div>
            </form>
        </div>
    </div>
</aside>

<div class="control-sidebar-bg"></div>