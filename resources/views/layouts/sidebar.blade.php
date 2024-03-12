<ul class="nav">
    @role('admin')
    <li class="nav-item ">
        <a class="nav-link" href="{{url('/home')}}">
            <i class="menu-icon mdi mdi-television"></i>
            <span class="menu-title">Dashboard</span>
        </a>
    </li>

    <li class="nav-item ">
        <a class="nav-link" href="{{url('/mobil')}}">
            <i class="menu-icon mdi mdi-account"></i>
            <span class="menu-title">Tambah Mobil</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-laporan" aria-expanded="false" aria-controls="ui-laporan">
            <i class="menu-icon mdi mdi-table"></i>
            <span class="menu-title">Laporan</span>
            <i class="menu-arrow"></i>
        </a>

    <li class="nav-item ">
        <a class="nav-link" href="{{url('register')}}">
            <i class="menu-icon mdi mdi-account"></i>
            <span class="menu-title">Tambah User</span>
        </a>
    </li>

    @endrole
    @role('anggota')
    <li class="nav-item ">
        <a class="nav-link" href="{{url('/sewa')}}">
            <i class="menu-icon mdi mdi-account"></i>
            <span class="menu-title">Peminjaman Anggota</span>
        </a>
    </li>
    @endrole

</ul>
