<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            @if (Auth::check())
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/dashboard" title="Dashboard"><span class="fa fa-dashboard fa-fw"></span></a></li>
                    <li class="mright">
                        <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Logout"><span class="glyphicon glyphicon-log-out"></span></a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST">{{ csrf_field() }}</form>
                    </li>
                </ul>
            @else
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown mright">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-log-in" title="Login"></span></a>
                        <ul class="dropdown-menu dropdown-lr animated slideInRight" role="menu">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <h4><span class="glyphicon glyphicon-log-in"></span></h4>
                                </div>
                                <form id="loginForm" action="{{ url('/login') }}" method="post" role="form" autocomplete="off" data-parsley-validate="parsley">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="email">@lang('login.frontweb.topnav.email')</label>
                                        <input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" data-parsley-required="true" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">@lang('login.frontweb.topnav.password')</label>
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" data-parsley-required="true" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-7">
                                                <input type="checkbox" tabindex="3" name="remember" id="remember">
                                                <label for="remember"> @lang('login.frontweb.topnav.remember_me')</label>
                                            </div>
                                            <div class="col-xs-5 pull-right">
                                                <button type="submit" tabindex="4" class="form-control btn btn-xs btn-success">@lang('buttons.login_button')</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <a href="#" tabindex="5" class="forgot-password">@lang('login.frontweb.topnav.forgot_password')</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </ul>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</nav>
