<footer class="main-footer">
    <div class="pull-right hidden-xs">
        @if(Entrust::hasRole(['r_admin', 'r_user']))
        <a href="{{ route('db.logs') }}" target="_blank"><span class="fa fa-code fa-fw"></span></a>
        @endif
    </div>
    <strong>Copyright &copy; 2016 <a href="#">GitzJoey</a>.</strong> All rights reserved. Powered By Coffee &amp; Curiosity.
</footer>