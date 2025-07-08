<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                {{-- menu admin --}}
                @if (auth()->check() && auth()->user()->role === 'admin')
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('dashboard') }}"
                    aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                    class="hide-menu">Dashboard</span></a>
                </li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Manajemen Data</span></li>

                <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('kategori.index') }}"
                    aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
                    class="hide-menu">Kategori</span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('produk-list.index') }}"
                    aria-expanded="false"><i data-feather="shopping-bag" class="feather-icon"></i><span
                    class="hide-menu">Produk</span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('user.index') }}"
                    aria-expanded="false"><i data-feather="user-plus" class="feather-icon"></i><span
                    class="hide-menu">User</span></a>
                </li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Penjualan</span></li>

                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('transaksi.index') }}"
                    aria-expanded="false"><i data-feather="shopping-cart" class="feather-icon"></i><span
                    class="hide-menu">Transaksi</span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                    href="{{ route('riwayat') }}" aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                    class="hide-menu">Riwayat Transaksi</span></a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="{{ route('laporan') }}"  aria-expanded="false"><i data-feather="file" class="feather-icon"></i><span
                class="hide-menu">Laporan</span></a>
                </li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Extra</span></li>

                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ url('settings/create') }}"
                    aria-expanded="false"><i data-feather="settings" class="feather-icon"></i><span
                    class="hide-menu">Setting</span></a></li>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ url('settings/create') }}"
                    aria-expanded="false"><i data-feather="settings" class="feather-icon"></i><span
                    class="hide-menu">Masukan</span></a></li>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('logout') }}"
                    aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                    class="hide-menu">Logout</span></a></li>
                </li>
                @endif
                {{-- Menu kasir --}}
                @if (auth()->check() && auth()->user()->role === 'kasir')
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('dashboard') }}"
                    aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                    class="hide-menu">Dashboard</span></a>
                </li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Penjualan</span></li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('transaksi.index') }}"
                    aria-expanded="false"><i data-feather="shopping-cart" class="feather-icon"></i><span
                    class="hide-menu">Transaksi
                    </span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                    href="{{ route('riwayat') }}" aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                        class="hide-menu">Riwayat Transaksi
                    </span></a>
                </li>
                <li class="list-divider"></li>
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('logout') }}"
                    aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                    class="hide-menu">Logout</span></a></li>
                </li>
            </ul>
            @endif
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>