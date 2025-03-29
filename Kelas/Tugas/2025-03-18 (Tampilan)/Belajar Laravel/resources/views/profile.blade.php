@extends('layouts.app')

@section('content')
    <div class="card">
        <h2 class="card-title">Profile SMK Negeri</h2>
        <div class="profile-content">
            <div class="school-image">
                <!-- Placeholder untuk gambar sekolah -->
                <img src="{{ asset('images/school-building.jpg') }}" alt="SMK Negeri Building"
                    onerror="this.src='https://via.placeholder.com/600x400?text=SMK+Negeri+Building';">
            </div>

            <div class="profile-text">
                <h3>Sejarah Singkat</h3>
                <p>SMK Negeri didirikan pada tahun 1985 dengan visi menjadi pusat pendidikan kejuruan terdepan di Indonesia.
                    Berawal dari hanya 3 jurusan dan 150 siswa, kini SMK Negeri telah berkembang menjadi institusi
                    pendidikan kejuruan unggulan dengan 8 jurusan dan lebih dari 1500 siswa.</p>

                <h3>Visi</h3>
                <p>Menjadi lembaga pendidikan kejuruan terkemuka yang menghasilkan lulusan berkompeten, berkarakter, dan
                    siap bersaing di dunia kerja global.</p>

                <h3>Misi</h3>
                <ul class="mission-list">
                    <li>Menyelenggarakan pendidikan kejuruan berbasis teknologi dan industri</li>
                    <li>Mengembangkan kurikulum yang relevan dengan kebutuhan dunia kerja</li>
                    <li>Membangun kemitraan strategis dengan dunia usaha dan industri</li>
                    <li>Membentuk karakter siswa yang disiplin, jujur, dan bertanggung jawab</li>
                    <li>Menciptakan lingkungan belajar yang inovatif dan kreatif</li>
                </ul>

                <h3>Fasilitas</h3>
                <div class="facilities">
                    <div class="facility-item">
                        <i class="fas fa-school"></i>
                        <p>Gedung 4 Lantai</p>
                    </div>
                    <div class="facility-item">
                        <i class="fas fa-laptop-code"></i>
                        <p>Lab Komputer</p>
                    </div>
                    <div class="facility-item">
                        <i class="fas fa-tools"></i>
                        <p>Bengkel Praktik</p>
                    </div>
                    <div class="facility-item">
                        <i class="fas fa-book"></i>
                        <p>Perpustakaan</p>
                    </div>
                    <div class="facility-item">
                        <i class="fas fa-futbol"></i>
                        <p>Lapangan Olahraga</p>
                    </div>
                    <div class="facility-item">
                        <i class="fas fa-wifi"></i>
                        <p>Wi-Fi Area</p>
                    </div>
                </div>

                <h3>Prestasi</h3>
                <ul class="achievement-list">
                    <li>Juara 1 Lomba Kompetensi Siswa Tingkat Nasional 2023</li>
                    <li>Sekolah Adiwiyata Nasional 2022</li>
                    <li>Juara Umum Olimpiade Sains Terapan 2022</li>
                    <li>Best Innovation Award di Kompetisi Robotik Internasional 2021</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="card">
        <h2 class="card-title">Tenaga Pendidik</h2>
        <p>SMK Negeri memiliki 75 tenaga pendidik berkualifikasi S1 dan S2 dari berbagai universitas terkemuka. Para guru
            secara rutin mengikuti pelatihan dan sertifikasi untuk memastikan kualitas pembelajaran yang selalu up-to-date
            dengan perkembangan industri.</p>

        <div class="staff-highlight">
            <div class="staff-card">
                <img src="{{ asset('images/char2.png') }}" alt="Kepala Sekolah"
                    onerror="this.src='https://via.placeholder.com/150?text=Kepala+Sekolah';">
                <h4>Drs. Ahmad Sulaiman, M.Pd</h4>
                <p class="staff-position">Kepala Sekolah</p>
            </div>
            <div class="staff-card">
                <img src="{{ asset('images/char1.png') }}" alt="Waka Kurikulum"
                    onerror="this.src='https://via.placeholder.com/150?text=Waka+Kurikulum';">
                <h4>Hj. Siti Rahmawati, M.Pd</h4>
                <p class="staff-position">Waka Kurikulum</p>
            </div>
            <div class="staff-card">
                <img src="{{ asset('images/char3.png') }}" alt="Waka Kesiswaan"
                    onerror="this.src='https://via.placeholder.com/150?text=Waka+Kesiswaan';">
                <h4>Budi Santoso, S.Pd</h4>
                <p class="staff-position">Waka Kesiswaan</p>
            </div>
        </div>
    </div>
@endsection
