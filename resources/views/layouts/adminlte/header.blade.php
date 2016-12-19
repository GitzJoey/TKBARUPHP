<header class="main-header">
    <a href="/dashboard" class="logo">
        <span class="logo-mini"><i class="fa fa-home"></i></span>
        <span class="logo-lg"><b>TK</b>BARU</span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li>
                    <a class="disabled" id="timeoutCount" title="Timeout Remaining"></a>
                </li>
                <li>
                    <a href="/front"><span class="fa fa-external-link fa-fw" title="Back To Frontpage"></span></a>
                </li>
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-globe"></i>
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
                        <img src="{{ asset('images/blank.png') }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ Auth::user()->store->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{ asset('images/blank.png') }}" class="img-circle" alt="User Image">
                            <p>
                                {{ Auth::user()->store->name }}
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
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i>&nbsp;&nbsp;&nbsp;&nbsp;</a>
                </li>
            </ul>
        </div>
    </nav>
</header>