<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT SAWIT ZUHERI</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap"
        rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <link href="css/templatemo-topic-listing.css" rel="stylesheet">

</head>

<body id="top">

    <main>

        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    <i class="bi-back"></i>
                    <span>PT SAWIT ZUHERI</span>
                </a>

                <div class="d-lg-none ms-auto me-4">
                    <a href="#top" class="navbar-icon bi-person smoothscroll"></a>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Modal -->
                <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="/" class="modal-content">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Login Admin</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                @if ($errors->has('login'))
                                    <div class="alert alert-danger">{{ $errors->first('login') }}</div>
                                @endif
                                <div class="mb-3">
                                    <label>Username:</label>
                                    <input type="text" name="username" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Password:</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-lg-5 me-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_1">Beranda</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_2">Tentang Kami</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_3">Fitur</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_4">Hasil Perhitungan</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_5">Kontak</a>
                        </li>
                    </ul>

                    <div class="d-none d-lg-block">
                        <a href="#top" data-bs-toggle="modal" data-bs-target="#loginModal"
                            class="navbar-icon bi-person smoothscroll"></a>
                    </div>
                </div>
            </div>
        </nav>


        <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
            <div class="container">
                <div class="row">

                    <div class="col-lg-10 col-12 mx-auto text-center">
                        <h1 class="text-white">Sistem Gaji & Bonus Otomatis Pegawai Sawit</h1>

                        <h6 class="text-white mt-3">PT SAWIT ZUHERI - Efisiensi dalam Manajemen Tenaga Kerja Perkebunan
                        </h6>

                        <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn-light btn-lg mt-4">Masuk Dashboard</a>
                    </div>

                </div>
            </div>
        </section>



        <section class="featured-section">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-lg-4 col-12 mb-4 mb-lg-0">
                        <div class="custom-block bg-white shadow-lg">
                            <div class="d-flex">
                                <div>
                                    <h5 class="mb-2">Manajemen Pegawai</h5>
                                    <p class="mb-0">Sistem ini memungkinkan admin untuk menambahkan data pegawai
                                        seperti nama, usia, dan alamat dengan cepat dan mudah.</p>
                                </div>
                                <span class="badge bg-success rounded-pill ms-auto">✓</span>
                            </div>

                            <img src="images/topics/undraw_Educator_re_ju47.png" class="custom-block-image img-fluid"
                                alt="Add User">
                        </div>
                    </div>

                    <div class="col-lg-4 col-12 mb-4 mb-lg-0">
                        <div class="custom-block bg-white shadow-lg">
                            <div class="d-flex">
                                <div>
                                    <h5 class="mb-2">Input Data Pemasukan</h5>
                                    <p class="mb-0">Catat pemasukan harian seperti jumlah buah, sektor, jarak, cuaca,
                                        dan kondisi jalan dengan antarmuka yang praktis.</p>
                                </div>
                                <span class="badge bg-warning rounded-pill ms-auto">✓</span>
                            </div>

                            <img src="images/topics/colleagues-working-cozy-office-medium-shot.png" class="custom-block-image img-fluid"
                                alt="Input Data">
                        </div>
                    </div>

                    <div class="col-lg-4 col-12">
                        <div class="custom-block bg-white shadow-lg">
                            <div class="d-flex">
                                <div>
                                    <h5 class="mb-2">Perhitungan Gaji & Bonus</h5>
                                    <p class="mb-0">Gaji pokok dan bonus dihitung otomatis berdasarkan data lapangan
                                        dengan logika sistem fuzzy.</p>
                                </div>
                                <span class="badge bg-info rounded-pill ms-auto">✓</span>
                            </div>

                            <img src="images/topics/undraw_Finance_re_gnv2.png" class="custom-block-image img-fluid"
                                alt="Finance">
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <section class="timeline-section section-padding mt-5" id="section_3">
            <div class="section-overlay"></div>

            <div class="container">
                <div class="row">

                    <div class="col-12 text-center">
                        <h2 class="text-white mb-4">Bagaimana Sistem Ini Bekerja?</h2>
                    </div>

                    <div class="col-lg-10 col-12 mx-auto">
                        <div class="timeline-container">
                            <ul class="vertical-scrollable-timeline" id="vertical-scrollable-timeline">
                                <div class="list-progress">
                                    <div class="inner"></div>
                                </div>

                                <li>
                                    <h4 class="text-white mb-3">1. Tambahkan Data Pegawai</h4>
                                    <p class="text-white">
                                        Admin dapat menambahkan data pegawai perusahaan PT SAWIT ZUHERI yang meliputi
                                        nama, usia, dan alamat.
                                        Data ini menjadi dasar dalam penghitungan pemasukan dan penggajian.
                                    </p>
                                    <div class="icon-holder">
                                        <i class="bi-person-plus"></i>
                                    </div>
                                </li>

                                <li>
                                    <h4 class="text-white mb-3">2. Input Data Pemasukan</h4>
                                    <p class="text-white">
                                        Selanjutnya admin menginput data pemasukan buah sawit berdasarkan hasil panen
                                        pegawai, seperti nama pegawai, sektor, tanggal, jumlah buah (Kg), jarak lokasi,
                                        kondisi cuaca, dan kondisi jalan.
                                    </p>
                                    <div class="icon-holder">
                                        <i class="bi-pencil-square"></i>
                                    </div>
                                </li>

                                <li>
                                    <h4 class="text-white mb-3">3. Sistem Hitung Gaji & Bonus Otomatis</h4>
                                    <p class="text-white">
                                        Sistem akan secara otomatis menghitung <strong>Gaji Pokok</strong> dan
                                        <strong>Bonus</strong> berdasarkan data yang diinput.
                                        Hasil perhitungan mempertimbangkan faktor cuaca, kondisi jalan, dan jumlah buah
                                        yang dipanen dengan metode fuzzy sederhana.
                                    </p>
                                    <div class="icon-holder">
                                        <i class="bi-calculator"></i>
                                    </div>
                                </li>

                                <li>
                                    <h4 class="text-white mb-3">4. Hasil Gaji & Bonus Ditampilkan</h4>
                                    <p class="text-white">
                                        Output dari sistem berupa daftar gaji dan bonus pegawai secara rinci.
                                        Total pendapatan dapat langsung dilihat, memudahkan perusahaan dalam manajemen
                                        keuangan pegawai.
                                    </p>
                                    <div class="icon-holder">
                                        <i class="bi-cash-stack"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-12 text-center mt-5">
                        <p class="text-white">
                            Ingin tahu lebih lanjut?
                            <a href="#" class="btn custom-btn custom-border-btn ms-3">Hubungi Kami</a>
                        </p>
                    </div>

                </div>
            </div>
        </section>



    </main>

    <footer class="site-footer section-padding">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-12 mb-4 pb-2">
                    <a class="navbar-brand mb-2" href="/">
                        <i class="bi bi-tree-fill"></i>
                        <span>PT SAWIT ZUHERI</span>
                    </a>
                    <p class="text-white">Sistem manajemen pemasukan harian, gaji, dan bonus pegawai berbasis data
                        produksi sawit.</p>
                </div>

                <div class="col-lg-3 col-md-4 col-6">
                    <h6 class="site-footer-title mb-3">Menu</h6>
                    <ul class="site-footer-links">
                        <li class="site-footer-link-item"><a href="/" class="site-footer-link">Beranda</a></li>
                        <li class="site-footer-link-item"><a href="/pegawai" class="site-footer-link">Data
                                Pegawai</a></li>
                        <li class="site-footer-link-item"><a href="/pemasukan" class="site-footer-link">Data
                                Pemasukan</a></li>
                        <li class="site-footer-link-item"><a href="/riwayat-kerja" class="site-footer-link">Riwayat
                                Kerja</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-4 col-6 mb-4 mb-lg-0">
                    <h6 class="site-footer-title mb-3">Kontak</h6>
                    <p class="text-white d-flex mb-1">
                        <a href="tel:081234567890" class="site-footer-link">0812-3456-7890</a>
                    </p>
                    <p class="text-white d-flex">
                        <a href="mailto:admin@sawitzuheri.co.id" class="site-footer-link">admin@sawitzuheri.co.id</a>
                    </p>
                </div>

                <div class="col-lg-3 col-md-4 col-12 mt-4 mt-lg-0 ms-auto">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Bahasa Indonesia
                        </button>
                        <ul class="dropdown-menu">
                            <li><button class="dropdown-item" type="button">English</button></li>
                            <li><button class="dropdown-item" type="button">Melayu</button></li>
                        </ul>
                    </div>

                    <p class="copyright-text mt-lg-5 mt-4">
                        © 2025 PT SAWIT ZUHERI. All rights reserved.<br><br>
                        Dev by <a rel="nofollow" href="https://avinto.my.id" target="_blank">Alvin Alvito</a>
                    </p>
                </div>

            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous">
    </script>
    <!-- JAVASCRIPT FILES -->
    <script src="script/jquery.min.js"></script>
    <script src="script/bootstrap.bundle.min.js"></script>
    <script src="script/jquery.sticky.js"></script>
    <script src="script/click-scroll.js"></script>
    <script src="script/custom.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</body>

</html>
