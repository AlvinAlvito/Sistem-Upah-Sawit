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
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="text">Total Pegawai</span>
                        <span class="number">340</span>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-comments"></i>
                        <span class="text">Total Mandor</span>
                        <span class="number">43</span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-share"></i>
                        <span class="text">Total Sektor</span>
                        <span class="number">16</span>
                    </div>
                </div>
            </div>

            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Grafik Diagram</span>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <span class="h5 d-block text-center mb-2">Jumlah Buah per Sektor</span>
                        <canvas id="chartSektor"></canvas>
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <span class="h5 d-block text-center mb-2">Jumlah Buah per Pegawai</span>
                        <canvas id="chartPegawai"></canvas>
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <span class="h5 d-block text-center mb-2">Jumlah Buah per Cuaca</span>
                        <canvas id="chartCuaca"></canvas>
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-4">
                        <span class="h5 d-block text-center mb-2">Top 5 Pegawai dengan Pendapatan Tertinggi</span>
                        <canvas id="chartPendapatan"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        async function fetchChartData(url) {
            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return await response.json();
            } catch (error) {
                console.error("Error fetching data from " + url + ": ", error);
                return {
                    labels: [],
                    data: []
                };
            }
        }

        async function renderCharts() {
            // 1. Buah per sektor
            const sektor = await fetchChartData('/chart/sektor');
            new Chart(document.getElementById('chartSektor'), {
                type: 'doughnut',
                data: {
                    labels: sektor.labels,
                    datasets: [{
                        data: sektor.data,
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#8BC34A']
                    }]
                }
            });

            // 2. Buah per pegawai
            const pegawai = await fetchChartData('/chart/pegawai');
            new Chart(document.getElementById('chartPegawai'), {
                type: 'doughnut',
                data: {
                    labels: pegawai.labels,
                    datasets: [{
                        data: pegawai.data,
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#009688', '#9C27B0']
                    }]
                }
            });

            // 3. Buah per cuaca
            const cuaca = await fetchChartData('/chart/cuaca');
            new Chart(document.getElementById('chartCuaca'), {
                type: 'doughnut',
                data: {
                    labels: cuaca.labels,
                    datasets: [{
                        data: cuaca.data,
                        backgroundColor: ['#03A9F4', '#FF5722', '#8BC34A']
                    }]
                }
            });

            // 4. Pendapatan tertinggi
            const pendapatan = await fetchChartData('/chart/pendapatan-tertinggi');
            new Chart(document.getElementById('chartPendapatan'), {
                type: 'bar',
                data: {
                    labels: pendapatan.labels,
                    datasets: [{
                        label: 'Total Pendapatan',
                        data: pendapatan.data,
                        backgroundColor: '#4CAF50'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Jalankan saat halaman siap
        document.addEventListener('DOMContentLoaded', renderCharts);
    </script>
@endsection
