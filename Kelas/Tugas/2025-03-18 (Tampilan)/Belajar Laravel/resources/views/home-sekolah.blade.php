@extends('layouts.app')

@section('content')
    <div class="card">
        <h2 class="card-title">Selamat Datang di SMK Negeri</h2>
        <p>SMK Negeri adalah sekolah menengah kejuruan unggulan yang fokus pada pengembangan keterampilan praktis dan
            teoritis untuk mempersiapkan siswa memasuki dunia kerja profesional.</p>
        <br>
        <a href="{{ url('/profile') }}" class="btn">Pelajari Lebih Lanjut</a>
    </div>

    <div class="card">
        <h2 class="card-title">Berita Terbaru</h2>
        <div class="news-item">
            <h3>Pendaftaran Tahun Ajaran 2025/2026 Telah Dibuka</h3>
            <p>Pendaftaran untuk tahun ajaran baru telah dibuka. Segera daftarkan diri Anda untuk mendapatkan kesempatan
                belajar di SMK terbaik di kota.</p>
        </div>
    </div>
@endsection
