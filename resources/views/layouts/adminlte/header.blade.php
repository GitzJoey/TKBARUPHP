<header class="main-header">
    <a href="/dashboard" class="logo">
        <span class="logo-mini"><i class="fa fa-home"></i></span>
        <span class="logo-lg {{ mt_rand(1, 5) == 1 ? 'animated flip':'' }}"><b>TK</b>BARU</span>
    </a>

    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li>
                    <a class="disabled" id="timeoutCount" title="Timeout Remaining">0:00:00</a>
                </li>
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if (App::getLocale() == 'id')
                            <img src="{{ asset('images/id.png') }}" width="20px" height="20px"/>
                        @else
                            <img src="{{ asset('images/us.png') }}" width="20px" height="20px"/>
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <ul class="menu">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <li>
                                        <a rel="alternate" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
                                            @if (App::getLocale() == $localeCode)
                                                <strong>{{ $properties['native'] }}</strong>
                                            @else
                                                {{ $properties['native'] }}
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ empty(Auth::user()->store->image_filename) ? asset('images/blank.png'):asset('images/'.Auth::user()->store->image_filename) }}" class="user-image" alt="Store Image">
                        <span class="hidden-xs">{{ Auth::user()->store->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{ empty(Auth::user()->store->image_filename) ? asset('images/blank.png'):asset('images/'.Auth::user()->store->image_filename) }}" class="img-circle" alt="Store Image">
                            <p>
                                <strong>{{ Auth::user()->store->name }}</strong>
                                <small>{{ Auth::user()->store->address }}</small><br/>
                                <small>{{ Auth::user()->store->tax_id }}</small>
                            </p>
                        </li>
                        <li class="user-body">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <a href="{{ route('db.user.profile.show', Auth::user()->hId()) }}">{{ Auth::user()->name }}<br><small>@lang('lookup.'.Auth::user()->userDetail->type)</small></a>
                                </div>
                            </div>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('db.user.profile.show', Auth::user()->hId()) }}" class="btn btn-default btn-flat">@lang('buttons.profile_button')</a>
                            </div>
                            <div class="pull-right">
                                <a href="/logout" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">@lang('buttons.logout_button')</a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST">{{ csrf_field() }}</form>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="hidden-xs">
                    <a href="/front"><span class="fa fa-external-link fa-fw" title="Back To Frontpage"></span></a>
                </li>
                <li class="hidden-xs">
                    <a href="/dashboard/start/tour"><span class="fa fa-question fa-fw" title="Help/Tour"></span></a>
                </li>
                <li>
                    <a href="/logout" class="btn" onclick="event.preventDefault(); if (typeof(Storage) != 'undefined') { localStorage.removeItem('pushMenu'); }; document.getElementById('logout-form').submit();" title="Logout">
                        <span class="glyphicon glyphicon-log-out"></span>
                    </a>
                </li>
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i>&nbsp;&nbsp;&nbsp;&nbsp;</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
