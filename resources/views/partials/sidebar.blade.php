<nav>
    <div class="logo-name">
        <div class="logo-image">
            <img src="/images/logo.jpg"  alt="">
        </div>

        <span class="logo_name">Sawit Zuheri</span>
    </div>

    <div class="menu-items">
        <ul class="nav-links">
            <li >
                <a href="/admin" class="{{ Request::is('/admin') ? 'active' : '' }}">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Beranda</span>
                </a>
            </li>
            <li >
                <a href="/admin/data-pegawai" class="{{ Request::is('/admin/data-pegawai') ? 'active' : '' }}">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Data Pegawai</span>
                </a>
            </li>
             <li >
                <a href="/admin/data-pemasukan" class="{{ Request::is('/admin/data-pemasukan') ? 'active' : '' }}">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Data Pemasukan</span>
                </a>
            </li>
            <li >
                <a href="/admin/fuzzifikasi" class="{{ Request::is('/admin/fuzzifikasi') ? 'active' : '' }}">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">Fuzzifikasi</span>
                </a>
            </li>
            <li >
                <a href="/admin/gaji-bonus" class="{{ Request::is('/admin/gaji-bonus') ? 'active' : '' }}">
                    <i class="uil uil-thumbs-up"></i>
                    <span class="link-name">Gaji & Bonus</span>
                </a>
            </li>
        </ul>
        

        <ul class="logout-mode">
            <li><a href="/">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>

            <li class="mode">
                <a href="#">
                    <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                    <span class="switch"></span>
                </div>
            </li>
        </ul>
    </div>
</nav>
