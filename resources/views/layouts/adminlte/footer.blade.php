<footer class="main-footer">
    <div id='goTop'></div>
    <div class="pull-right hidden-xs">
        @if(Laratrust::hasRole(['admin', 'owner']) ||
            Auth::user()->userDetail->type == 'USERTYPE.A')
        <a href="{{ route('db.logs') }}" target="_blank"><span class="fa fa-code fa-fw"></span> <small>{{ round(microtime(true) - LARAVEL_START, 2) }}s</small></a>
        @endif
    </div>
    <strong>Copyright &copy; {{ \Carbon\Carbon::today()->format('Y') }} <a href="https://www.github.com/GitzJoey">GitzJoey</a>&nbsp;&amp;&nbsp;<a href="{{ route('db.contrib') }}">Contributors</a>.</strong> All rights reserved. Powered By Coffee &amp; Curiosity.
</footer>