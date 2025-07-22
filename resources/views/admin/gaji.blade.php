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
                <i class="uil uil-tachometer-fast-alt"></i>
                <span class="text">Gaji dan Bonus Pegawai</span>                
            </div>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pegawai</th>
                        <th>Gaji Pokok</th>
                        <th>Bonus (Rp)</th>
                        <th>Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->pegawai->nama }}</td>
                        <td>Rp {{ number_format($item->gaji_pokok, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->bonus, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
