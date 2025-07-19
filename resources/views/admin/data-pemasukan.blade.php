@extends('layouts.main')
@section('content')
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>

            <img src="/images/profile.jpg" alt="">
        </div>
        <div class="dash-content">
            <div class="activity">
                <div class="title">
                    <i class="uil uil-clipboard-notes"></i>
                    <span class="text">Data Pemasukan Pegawai</span>
                </div>

                @if (session('success'))
                    <div class="alert alert-success mt-2">{{ session('success') }}</div>
                @endif

                <div class="row justify-content-end mb-3">
                    <div class="col-lg-3 col-md-4 col-sm-6 text-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPemasukan"><i
                                class="uil uil-plus"></i> Tambah Data</button>
                    </div>
                </div>

                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <th>Sektor</th>
                            <th>Tanggal</th>
                            <th>Jumlah Buah (Kg)</th>
                            <th>Jarak Lokasi (Km)</th>
                            <th>Cuaca</th>
                            <th>Kondisi Jalan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pemasukan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->pegawai->nama }}</td>
                                <td>{{ $item->sektor }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->jumlah_buah }}</td>
                                <td>{{ $item->jarak_lokasi }}</td>
                                <td>{{ $item->tampilkanCuaca() }}</td>
                                <td>{{ $item->tampilkanKondisiJalan() }}</td>
                                <td>
                                    <form action="{{ route('pemasukan.destroy', $item->id) }}" method="POST"
                                        style="display:inline-block"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0 m-0"><i
                                                class="uil uil-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Belum ada data pemasukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </section>

    <!-- Modal Tambah Pemasukan -->
    <div class="modal fade" id="modalTambahPemasukan" tabindex="-1" aria-labelledby="modalTambahPemasukanLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('pemasukan.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahPemasukanLabel">Tambah Data Pemasukan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama Pegawai</label>
                            <select name="pegawai_id" class="form-select" required>
                                <option disabled selected>Pilih Pegawai</option>
                                @foreach ($pegawais as $pegawai)
                                    <option value="{{ $pegawai->id }}">{{ $pegawai->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Sektor</label>
                            <select name="sektor" class="form-select" required>
                                <option disabled selected>Pilih Sektor</option>
                                <option value="Sektor Timur">Sektor Timur</option>
                                <option value="Sektor Selatan">Sektor Selatan</option>
                                <option value="Sektor Utara">Sektor Utara</option>
                                <option value="Sektor Barat">Sektor Barat</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Jumlah Buah (Kg)</label>
                            <input type="number" name="jumlah_buah" class="form-control" min="1" required>
                        </div>
                        <!-- Jarak Lokasi -->
                        <div class="mb-3">
                            <label>Jarak Lokasi</label>
                            <input type="range" name="jarak_lokasi" class="form-range" min="0" max="5"
                                step="1" value="0" required>
                            <div class="d-flex justify-content-between px-1 mt-1">
                                <small>0 km</small>
                                <small>1 km</small>
                                <small>2 km</small>
                                <small>3 km</small>
                                <small>4 km</small>
                                <small>5 km</small>
                            </div>
                        </div>

                        <!-- Cuaca -->
                        <div class="mb-3">
                            <label>Cuaca</label>
                            <div class="d-flex justify-content-between px-1 mb-1">
                                <small>Hujan</small>
                                <small>Mendung</small>
                                <small>Cerah</small>
                            </div>
                            <input type="range" name="cuaca" class="form-range" min="0" max="20"
                                step="1" value="0" required>
                        </div>

                        <!-- Kondisi Jalan -->
                        <div class="mb-3">
                            <label>Kondisi Jalan</label>
                            <div class="d-flex justify-content-between px-1 mb-1">
                                <small>Buruk</small>
                                <small>Sedang</small>
                                <small>Baik</small>
                            </div>
                            <input type="range" name="kondisi_jalan" class="form-range" min="0" max="20"
                                step="1" value="0" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
