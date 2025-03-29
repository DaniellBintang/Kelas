@extends('layouts.app1')

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-4">Order</h1>
        <form>
            <!-- Nama -->
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" placeholder="Masukkan nama Anda" required>
            </div>

            <!-- Nomor Telepon -->
            <div class="mb-3">
                <label class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" placeholder="Masukkan nomor telepon Anda" required>
            </div>

            <!-- Alamat -->
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <input type="text" class="form-control" placeholder="Masukkan alamat lengkap Anda" required>
            </div>

            <!-- Provinsi -->
            <div class="mb-3">
                <label class="form-label">Provinsi</label>
                <select class="form-select" required>
                    <option value="" disabled selected>Pilih Provinsi</option>
                    <option value="Jawa Barat">Jawa Barat</option>
                    <option value="Jawa Tengah">Jawa Tengah</option>
                    <option value="Jawa Timur">Jawa Timur</option>
                    <option value="DKI Jakarta">DKI Jakarta</option>
                </select>
            </div>

            <!-- Kota -->
            <div class="mb-3">
                <label class="form-label">Kota</label>
                <select class="form-select" required>
                    <option value="" disabled selected>Pilih Kota</option>
                    <option value="Bandung">Bandung</option>
                    <option value="Semarang">Semarang</option>
                    <option value="Surabaya">Surabaya</option>
                    <option value="Jakarta">Jakarta</option>
                </select>
            </div>

            <!-- Kecamatan -->
            <div class="mb-3">
                <label class="form-label">Kecamatan</label>
                <select class="form-select" required>
                    <option value="" disabled selected>Pilih Kecamatan</option>
                    <option value="Cibaduyut">Cibaduyut</option>
                    <option value="Tembalang">Tembalang</option>
                    <option value="Wonokromo">Wonokromo</option>
                    <option value="Kebayoran Baru">Kebayoran Baru</option>
                </select>
            </div>

            <!-- Metode Pembayaran -->
            <div class="mb-3">
                <label class="form-label">Metode Pembayaran</label>
                <select class="form-select" required>
                    <option value="" disabled selected>Pilih Metode Pembayaran</option>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="COD (Bayar di Tempat)">COD (Bayar di Tempat)</option>
                    <option value="E-Wallet">E-Wallet (OVO, GoPay, Dana)</option>
                </select>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary w-100">Pesan Sekarang</button>
        </form>
    </div>
@endsection
