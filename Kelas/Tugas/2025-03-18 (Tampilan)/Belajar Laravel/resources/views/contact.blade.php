@extends('layouts.app')

@section('content')
    <div class="card">
        <h2 class="card-title">Hubungi Kami</h2>
        <p class="contact-intro">Kami terbuka untuk pertanyaan, kritik, dan saran yang membangun. Silakan hubungi kami
            melalui salah satu kontak di bawah ini atau menggunakan formulir yang tersedia.</p>

        <div class="contact-container">
            <div class="contact-info">
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div class="info-details">
                        <h4>Alamat</h4>
                        <p>Jl. Pendidikan No. 123, Kecamatan Maju Jaya, Kota Sejahtera, 12345</p>
                    </div>
                </div>

                <div class="info-item">
                    <i class="fas fa-phone-alt"></i>
                    <div class="info-details">
                        <h4>Telepon/Fax</h4>
                        <p>+62 123 4567 890 / +62 123 4567 891</p>
                    </div>
                </div>

                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <div class="info-details">
                        <h4>Email</h4>
                        <p>info@smknegeri.sch.id</p>
                    </div>
                </div>

                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <div class="info-details">
                        <h4>Jam Operasional</h4>
                        <p>Senin - Jumat: 07.00 - 16.00 WIB</p>
                        <p>Sabtu: 07.00 - 12.00 WIB</p>
                    </div>
                </div>

                <div class="social-contact">
                    <h4>Media Sosial</h4>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <h3>Kirim Pesan</h3>
                <form action="{{ url('/send-message') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Lengkap <span class="required">*</span></label>
                        <input type="text" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email <span class="required">*</span></label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="phone">No. Telepon</label>
                        <input type="tel" id="phone" name="phone">
                    </div>

                    <div class="form-group">
                        <label for="subject">Subjek <span class="required">*</span></label>
                        <input type="text" id="subject" name="subject" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Pesan <span class="required">*</span></label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-submit">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </div>

    <div class="card">
        <h2 class="card-title">Lokasi Kami</h2>
        <div class="map-container">
            <!-- Di sini Anda bisa menambahkan embedded Google Maps -->
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15861.223455477485!2d106.82715565!3d-6.175392349999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f436b8c94d63%3A0x6ea6d5398b7c42f2!2sMonumen%20Nasional!5e0!3m2!1sid!2sid!4v1647850821702!5m2!1sid!2sid"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>

    <div class="card">
        <h2 class="card-title">Informasi Pendaftaran</h2>
        <div class="enrollment-info">
            <div class="enrollment-item">
                <h4><i class="fas fa-user-plus"></i> Pendaftaran Siswa Baru</h4>
                <p>Untuk informasi mengenai pendaftaran siswa baru, silakan hubungi bagian Humas di (021) 1234-5678 atau
                    email ke psb@smknegeri.sch.id</p>
            </div>

            <div class="enrollment-item">
                <h4><i class="fas fa-calendar-alt"></i> Jadwal Pendaftaran</h4>
                <p>Pendaftaran dibuka setiap tahun pada bulan April - Mei. Pengumuman hasil seleksi biasanya diumumkan pada
                    bulan Juni.</p>
            </div>

            <div class="enrollment-item">
                <h4><i class="fas fa-info-circle"></i> Informasi Lebih Lanjut</h4>
                <p>Kunjungi halaman <a href="#">Penerimaan Siswa Baru</a> untuk informasi lengkap tentang prosedur
                    pendaftaran dan persyaratan.</p>
            </div>
        </div>
    </div>
@endsection
