@extends('layouts.app')

@section('content')
    <div class="card">
        <h2 class="card-title">Program Keahlian</h2>
        <p class="major-intro">SMK Negeri menawarkan berbagai program keahlian yang dirancang sesuai dengan kebutuhan dunia
            industri. Semua jurusan dilengkapi dengan fasilitas praktik modern dan dibimbing oleh guru-guru berpengalaman.
        </p>
    </div>

    <div class="majors-container">
        <div class="major-card">
            <div class="major-icon">
                <i class="fas fa-laptop-code"></i>
            </div>
            <h3>Rekayasa Perangkat Lunak</h3>
            <p>Program keahlian yang fokus pada pengembangan software, pemrograman web, mobile app development, dan database
                management.</p>
            <div class="major-details">
                <div class="major-detail-item">
                    <span class="detail-label">Prospek Kerja:</span>
                    <span class="detail-value">Software Developer, Web Programmer, Mobile App Developer, Database
                        Administrator</span>
                </div>
                <div class="major-detail-item">
                    <span class="detail-label">Mitra Industri:</span>
                    <span class="detail-value">Google Indonesia, Tokopedia, Gojek, Microsoft Indonesia</span>
                </div>
            </div>
            <a href="#" class="btn major-btn">Detail Jurusan</a>
        </div>

        <div class="major-card">
            <div class="major-icon">
                <i class="fas fa-network-wired"></i>
            </div>
            <h3>Teknik Komputer dan Jaringan</h3>
            <p>Program keahlian yang mempelajari sistem jaringan komputer, konfigurasi server, keamanan jaringan, dan
                infrastruktur IT.</p>
            <div class="major-details">
                <div class="major-detail-item">
                    <span class="detail-label">Prospek Kerja:</span>
                    <span class="detail-value">Network Administrator, IT Support, System Administrator, Network Security
                        Specialist</span>
                </div>
                <div class="major-detail-item">
                    <span class="detail-label">Mitra Industri:</span>
                    <span class="detail-value">Cisco Indonesia, Telkom Indonesia, IBM, Huawei</span>
                </div>
            </div>
            <a href="#" class="btn major-btn">Detail Jurusan</a>
        </div>

        <div class="major-card">
            <div class="major-icon">
                <i class="fas fa-cogs"></i>
            </div>
            <h3>Teknik Pemesinan</h3>
            <p>Program keahlian yang mempelajari proses produksi, desain mesin, pengoperasian CNC, dan Quality Control.</p>
            <div class="major-details">
                <div class="major-detail-item">
                    <span class="detail-label">Prospek Kerja:</span>
                    <span class="detail-value">Drafter, CNC Operator, Quality Control, Production Supervisor</span>
                </div>
                <div class="major-detail-item">
                    <span class="detail-label">Mitra Industri:</span>
                    <span class="detail-value">Astra International, United Tractors, Toyota Manufacturing, Mitsubishi
                        Motors</span>
                </div>
            </div>
            <a href="#" class="btn major-btn">Detail Jurusan</a>
        </div>

        <div class="major-card">
            <div class="major-icon">
                <i class="fas fa-car"></i>
            </div>
            <h3>Teknik Kendaraan Ringan</h3>
            <p>Program keahlian yang mempelajari perawatan dan perbaikan kendaraan ringan, sistem kelistrikan, dan teknologi
                otomotif modern.</p>
            <div class="major-details">
                <div class="major-detail-item">
                    <span class="detail-label">Prospek Kerja:</span>
                    <span class="detail-value">Teknisi Otomotif, Service Advisor, Kepala Bengkel, Quality Control</span>
                </div>
                <div class="major-detail-item">
                    <span class="detail-label">Mitra Industri:</span>
                    <span class="detail-value">Honda Prospect Motor, Suzuki Indonesia, Daihatsu, Yamaha Motor</span>
                </div>
            </div>
            <a href="#" class="btn major-btn">Detail Jurusan</a>
        </div>

        <div class="major-card">
            <div class="major-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <h3>Akuntansi dan Keuangan</h3>
            <p>Program keahlian yang mempelajari pembukuan, akuntansi keuangan, perpajakan, dan aplikasi keuangan digital.
            </p>
            <div class="major-details">
                <div class="major-detail-item">
                    <span class="detail-label">Prospek Kerja:</span>
                    <span class="detail-value">Staff Akuntansi, Tax Officer, Auditor Junior, Finance Administrator</span>
                </div>
                <div class="major-detail-item">
                    <span class="detail-label">Mitra Industri:</span>
                    <span class="detail-value">Bank Mandiri, BCA, Deloitte Indonesia, PWC Indonesia</span>
                </div>
            </div>
            <a href="#" class="btn major-btn">Detail Jurusan</a>
        </div>

        <div class="major-card">
            <div class="major-icon">
                <i class="fas fa-bullhorn"></i>
            </div>
            <h3>Pemasaran Digital</h3>
            <p>Program keahlian yang mempelajari strategi pemasaran modern, digital marketing, social media management, dan
                content creation.</p>
            <div class="major-details">
                <div class="major-detail-item">
                    <span class="detail-label">Prospek Kerja:</span>
                    <span class="detail-value">Digital Marketer, Social Media Specialist, Content Creator, SEO
                        Specialist</span>
                </div>
                <div class="major-detail-item">
                    <span class="detail-label">Mitra Industri:</span>
                    <span class="detail-value">Unilever Indonesia, Bukalapak, Shopee, Ogilvy Indonesia</span>
                </div>
            </div>
            <a href="#" class="btn major-btn">Detail Jurusan</a>
        </div>
    </div>

    <div class="card">
        <h2 class="card-title">Pengembangan Kompetensi</h2>
        <p>Selain program keahlian utama, SMK Negeri juga menyediakan berbagai pelatihan tambahan dan sertifikasi untuk
            meningkatkan kompetensi siswa:</p>
        <ul class="certification-list">
            <li><i class="fas fa-certificate"></i> Sertifikasi Internasional (Cisco, Microsoft, Oracle, AutoCAD)</li>
            <li><i class="fas fa-certificate"></i> Pelatihan Soft Skills (Leadership, Communication, Problem Solving)</li>
            <li><i class="fas fa-certificate"></i> Program Magang di Perusahaan Nasional dan Multinasional</li>
            <li><i class="fas fa-certificate"></i> Kelas Industri dengan Praktisi Profesional</li>
        </ul>
    </div>
@endsection
