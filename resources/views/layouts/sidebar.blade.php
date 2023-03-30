
<section class="sidebar">
    
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    
    @if (Auth::user()->hasRole('superadmin'))
        
    <li class="{{ (request()->is('superadmin')) ? 'active' : '' }}"><a href="/superadmin"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
    
    <li class="{{ (request()->is('superadmin/sk*')) ? 'active' : '' }}"><a href="/superadmin/sk"><i class="fa fa-file-o"></i> <span>Surat Kematian</span></a></li>
    <li class="{{ (request()->is('superadmin/rt*')) ? 'active' : '' }}"><a href="/superadmin/rt"><i class="fa fa-users"></i> <span>Akun RT</span></a></li>
    <li class="{{ (request()->is('superadmin/gp*')) ? 'active' : '' }}"><a href="/superadmin/gp"><i class="fa fa-key"></i> <span>Ganti Password</span></a></li>
    <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
    @else
        
    <li class="{{ (request()->is('rt')) ? 'active' : '' }}"><a href="/rt"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
    <li class="{{ (request()->is('rt/sk*')) ? 'active' : '' }}"><a href="/rt/sk"><i class="fa fa-file-o"></i> <span>Surat Kematian</span></a></li>
    <li class="{{ (request()->is('rt/gp*')) ? 'active' : '' }}"><a href="/rt/gp"><i class="fa fa-key"></i> <span>Ganti Password</span></a></li>
    <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
    {{-- <li class="{{ (request()->is('pemohon/daftar-layanan*')) ? 'active' : '' }}"><a href="/pemohon/daftar-layanan"><i class="fa fa-list"></i> <span>Daftar Layanan</span></a></li> --}}
    @endif
    </ul>
    <!-- /.sidebar-menu -->
</section>