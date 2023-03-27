
<section class="sidebar">
    <div class="user-panel text-center">
    <div class=" image">
    </div>
    {{-- <div class="pull-left info">
        <!-- Status -->
    </div> --}}
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    
    @if (Auth::user()->hasRole('superadmin'))
        
    <li class="{{ (request()->is('superadmin')) ? 'active' : '' }}"><a href="/superadmin"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
    
    <li class="{{ (request()->is('superadmin/sk*')) ? 'active' : '' }}"><a href="/superadmin/sk"><i class="fa fa-file-o"></i> <span>Surat Kematian</span></a></li>
    <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
    @else
        
    <li class="{{ (request()->is('pemohon')) ? 'active' : '' }}"><a href="/pemohon"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
    <li class="{{ (request()->is('pemohon/profil*')) ? 'active' : '' }}"><a href="/pemohon/profil"><i class="fa fa-user"></i> <span>Profil</span></a></li>
    {{-- <li class="{{ (request()->is('pemohon/daftar-layanan*')) ? 'active' : '' }}"><a href="/pemohon/daftar-layanan"><i class="fa fa-list"></i> <span>Daftar Layanan</span></a></li> --}}
    @endif
    </ul>
    <!-- /.sidebar-menu -->
</section>