@extends('layouts.main')
@section('content')
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>

            <img src="/images/profil.png" alt="">
        </div>
        <div class="dash-content">
            <div class="activity">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Fuzzifikasi</span>
                </div>
                <div class="row">
                    <div class="col-12" style="">
                        <table id="tabelFuzzifikasi" class="table table-hover table-striped border">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-center border">No</th>
                                    <th rowspan="2" class="text-center border">Nama Pegawai</th>
                                    <th colspan="3" class="text-center border">Jumlah Buah</th>
                                    <th colspan="3" class="text-center border">Jarak Lokasi</th>
                                    <th colspan="3" class="text-center border">Cuaca</th>
                                    <th colspan="3" class="text-center border">Kondisi Jalan</th>
                                </tr>
                                <tr class="border">
                                    <th class="text-center border">Rendah</th>
                                    <th class="text-center border">Sedang</th>
                                    <th class="text-center border">Banyak</th>

                                    <th class="text-center border">Dekat</th>
                                    <th class="text-center border">Sedang</th>
                                    <th class="text-center border">Jauh</th>

                                    <th class="text-center border">Hujan</th>
                                    <th class="text-center border">Mendung</th>
                                    <th class="text-center border">Cerah</th>

                                    <th class="text-center border">Buruk</th>
                                    <th class="text-center border">Sedang</th>
                                    <th class="text-center border">Baik</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fuzzifikasi as $data)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td class="border">
                                            {{ optional($data->pegawai)->nama ?? 'Tidak Ada Data' }}
                                        </td>

                                        {{-- Jumlah Buah --}}
                                        <td class="text-center border">{{ round($data->jumlah_rendah, 2) }}</td>
                                        <td class="text-center border">{{ round($data->jumlah_sedang, 2) }}</td>
                                        <td class="text-center border">{{ round($data->jumlah_banyak, 2) }}</td>

                                        {{-- Jarak Lokasi --}}
                                        <td class="text-center border">{{ round($data->jarak_dekat, 2) }}</td>
                                        <td class="text-center border">{{ round($data->jarak_sedang, 2) }}</td>
                                        <td class="text-center border">{{ round($data->jarak_jauh, 2) }}</td>

                                        {{-- Cuaca --}}
                                        <td class="text-center border">{{ round($data->cuaca_hujan, 2) }}</td>
                                        <td class="text-center border">{{ round($data->cuaca_mendung, 2) }}</td>
                                        <td class="text-center border">{{ round($data->cuaca_cerah, 2) }}</td>

                                        {{-- Jalan --}}
                                        <td class="text-center border">{{ round($data->jalan_buruk, 2) }}</td>
                                        <td class="text-center border">{{ round($data->jalan_sedang, 2) }}</td>
                                        <td class="text-center border">{{ round($data->jalan_baikk, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#tabelFuzzifikasi').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "lengthMenu": [5, 10, 25, 50, 100],
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Tidak ada data yang ditemukan",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Tidak ada data tersedia",
                    "search": "Cari:",
                    "paginate": {
                        "first": "Awal",
                        "last": "Akhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "columnDefs": [{
                    "orderable": false,
                    "targets": "_all"
                }]
            });
        });
    </script>
@endsection
