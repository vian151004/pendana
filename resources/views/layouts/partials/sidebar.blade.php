<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-lightblue elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link bg-lightblue">
        <img src="{{ asset('storage'. ($setting->path_image ?? '')) }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 bg-light" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ $setting->company_name }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (asset('storage'. (auth()->user()->path_image)))
                    <img src="{{ asset('storage'. (auth()->user()->path_image)) }}" alt="" class="img-circle elevation-2">
                @else
                    <img src="{{ asset('AdminLTE/dist/img/user1-128x128.jpg') }}" alt="" class="img-circle elevation-2">
                @endif
            </div>
            <div class="info">
                <a href="{{ route('profile.show') }}" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('donatur'))
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <p>
                            MASTER
                            <!-- <i class="right fas fa-angle-left"></i> -->
                        </p>
                    </a>
                    <!-- <ul class="nav nav-treeview "> -->
                        @if (auth()->user()->hasRole('admin'))
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}" class="nav-link {{ request()->is('category*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cube"></i>
                                <p>
                                    Kategori
                                </p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('campaign.index') }}" class="nav-link {{ request()->is('campaign*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th-large"></i>
                                <p>
                                    Projek
                                </p>
                            </a>
                        </li>
                    <!-- </ul> -->
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <p>
                            REFERENSI
                            <!-- <i class="right fas fa-angle-left"></i> -->
                        </p>
                    </a>
                    <!-- <ul class="nav nav-treeview"> -->
                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>
                                    Donatur
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                                <i class="nav-icon fas fa-donate"></i>
                                <p>
                                    Daftar Donasi
                                </p>
                            </a>
                        </li>
                    <!-- </ul> -->
                </li>
                @endif

                @if(auth()->user()->hasRole('admin'))
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <p>
                            INFORMASI
                            <!-- <i class="right fas fa-angle-left"></i> -->
                        </p>
                    </a>
                    <!-- <ul class="nav nav-treeview"> -->
                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                                <i class="nav-icon fas fa-envelope"></i>
                                <p>
                                    Kontak Masuk
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>
                                    Subscriber
                                </p>
                            </a>
                        </li>
                    <!-- </ul> -->
                </li>
                @endif

                @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('donatur'))
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <p>
                            REPORT
                            <!-- <i class="right fas fa-angle-left"></i> -->
                        </p>
                    </a>
                    <!-- <ul class="nav nav-treeview"> -->
                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>
                                    Laporan
                                </p>
                            </a>
                        </li>
                    <!-- </ul> -->
                </li>
                @endif

                @if(auth()->user()->hasRole('donatur'))
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <p>
                            LOG
                            <!-- <i class="right fas fa-angle-left"></i> -->
                        </p>
                    </a>
                    <!-- <ul class="nav nav-treeview"> -->
                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link">
                                <i class="nav-icon fas fa-info-circle"></i>
                                <p>
                                    Log Aktivitas
                                </p>
                            </a>
                        </li>
                    <!-- </ul> -->
                </li>
                @endif

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <p>
                            SISTEM
                            <!-- <i class="right fas fa-angle-left"></i> -->
                        </p>
                    </a>
                    @if(auth()->user()->hasRole('admin'))
                    <!-- <ul class="nav nav-treeview"> -->
                        <li class="nav-item">
                            <a href="{{ route('setting.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Pengaturan
                                </p>
                            </a>
                        </li>
                    <!-- </ul> -->
                    @endif
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>