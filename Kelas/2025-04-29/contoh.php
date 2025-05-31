<?php
/*
 * CONTOH KODE PHP
 * File ini berisi contoh-contoh kode PHP
 */

// Menampilkan judul
echo "<h1>Contoh Kode PHP</h1>";

// 1. VARIABEL DAN TIPE DATA
echo "<h2>1. Variabel dan Tipe Data</h2>";

// String
$nama = "Budi Santoso";
$alamat = "Jalan Merdeka No. 123";

// Integer
$umur = 25;
$tahunLahir = 1998;

// Float
$tinggi = 175.5;
$berat = 68.7;

// Boolean
$aktif = true;
$menikah = false;

// Menampilkan variabel
echo "<h3>Data Pribadi:</h3>";
echo "Nama: " . $nama . "<br>";
echo "Alamat: " . $alamat . "<br>";
echo "Umur: " . $umur . " tahun<br>";
echo "Tahun Lahir: " . $tahunLahir . "<br>";
echo "Tinggi: " . $tinggi . " cm<br>";
echo "Berat: " . $berat . " kg<br>";
echo "Status Aktif: " . ($aktif ? "Ya" : "Tidak") . "<br>";
echo "Status Menikah: " . ($menikah ? "Ya" : "Tidak") . "<br>";

// 2. ARRAY
echo "<h2>2. Array</h2>";

// Array terindeks
$buah = ["Apel", "Jeruk", "Mangga", "Pisang", "Anggur"];

echo "<h3>Array Terindeks:</h3>";
echo "Buah ke-1: " . $buah[0] . "<br>";
echo "Buah ke-2: " . $buah[1] . "<br>";
echo "Buah ke-3: " . $buah[2] . "<br>";

// Array asosiatif
$mahasiswa = [
    "nama" => "Andi Wijaya",
    "nim" => "12345",
    "jurusan" => "Teknik Informatika",
    "ipk" => 3.75
];

echo "<h3>Array Asosiatif:</h3>";
echo "Nama: " . $mahasiswa["nama"] . "<br>";
echo "NIM: " . $mahasiswa["nim"] . "<br>";
echo "Jurusan: " . $mahasiswa["jurusan"] . "<br>";
echo "IPK: " . $mahasiswa["ipk"] . "<br>";

// Array multidimensi
$siswa = [
    ["Rudi", "10001", "IPA", 85],
    ["Siti", "10002", "IPS", 90],
    ["Dodi", "10003", "IPA", 78],
    ["Nina", "10004", "IPS", 88]
];

echo "<h3>Array Multidimensi:</h3>";
echo "<table border='1' cellpadding='5'>
    <tr>
        <th>Nama</th>
        <th>NIS</th>
        <th>Jurusan</th>
        <th>Nilai</th>
    </tr>";

foreach ($siswa as $data) {
    echo "<tr>
        <td>" . $data[0] . "</td>
        <td>" . $data[1] . "</td>
        <td>" . $data[2] . "</td>
        <td>" . $data[3] . "</td>
    </tr>";
}

echo "</table>";

// 3. OPERATOR
echo "<h2>3. Operator</h2>";

// Operator aritmatika
$a = 10;
$b = 3;

echo "<h3>Operator Aritmatika:</h3>";
echo "$a + $b = " . ($a + $b) . "<br>";
echo "$a - $b = " . ($a - $b) . "<br>";
echo "$a * $b = " . ($a * $b) . "<br>";
echo "$a / $b = " . ($a / $b) . "<br>";
echo "$a % $b = " . ($a % $b) . "<br>";
echo "$a ** $b = " . ($a ** $b) . "<br>";

// Operator perbandingan
echo "<h3>Operator Perbandingan:</h3>";
echo "$a == $b: " . ($a == $b ? "true" : "false") . "<br>";
echo "$a === $b: " . ($a === $b ? "true" : "false") . "<br>";
echo "$a != $b: " . ($a != $b ? "true" : "false") . "<br>";
echo "$a > $b: " . ($a > $b ? "true" : "false") . "<br>";
echo "$a < $b: " . ($a < $b ? "true" : "false") . "<br>";
echo "$a >= $b: " . ($a >= $b ? "true" : "false") . "<br>";
echo "$a <= $b: " . ($a <= $b ? "true" : "false") . "<br>";

// 4. STRUKTUR KONTROL
echo "<h2>4. Struktur Kontrol</h2>";

// If-else
echo "<h3>If-Else:</h3>";
$nilai = 85;

echo "Nilai: $nilai<br>";
if ($nilai >= 90) {
    echo "Grade: A<br>";
} elseif ($nilai >= 80) {
    echo "Grade: B<br>";
} elseif ($nilai >= 70) {
    echo "Grade: C<br>";
} elseif ($nilai >= 60) {
    echo "Grade: D<br>";
} else {
    echo "Grade: E<br>";
}

// Switch case
echo "<h3>Switch Case:</h3>";
$hari = "Senin";

echo "Hari: $hari<br>";
switch ($hari) {
    case "Senin":
        echo "Hari pertama dalam seminggu<br>";
        break;
    case "Selasa":
        echo "Hari kedua dalam seminggu<br>";
        break;
    case "Rabu":
        echo "Hari ketiga dalam seminggu<br>";
        break;
    case "Kamis":
        echo "Hari keempat dalam seminggu<br>";
        break;
    case "Jumat":
        echo "Hari kelima dalam seminggu<br>";
        break;
    case "Sabtu":
    case "Minggu":
        echo "Akhir pekan<br>";
        break;
    default:
        echo "Hari tidak valid<br>";
}

// For loop
echo "<h3>For Loop:</h3>";
echo "Menampilkan angka 1 sampai 5:<br>";
for ($i = 1; $i <= 5; $i++) {
    echo "$i ";
}
echo "<br>";

// While loop
echo "<h3>While Loop:</h3>";
echo "Menampilkan angka 5 sampai 1:<br>";
$j = 5;
while ($j >= 1) {
    echo "$j ";
    $j--;
}
echo "<br>";

// Do-while loop
echo "<h3>Do-While Loop:</h3>";
echo "Menampilkan angka 1 sampai 5:<br>";
$k = 1;
do {
    echo "$k ";
    $k++;
} while ($k <= 5);
echo "<br>";

// Foreach loop
echo "<h3>Foreach Loop:</h3>";
$warna = ["Merah", "Hijau", "Biru", "Kuning", "Ungu"];

echo "Daftar warna:<br>";
foreach ($warna as $index => $nama_warna) {
    echo ($index + 1) . ". $nama_warna<br>";
}

// 5. FUNGSI
echo "<h2>5. Fungsi</h2>";

// Fungsi tanpa parameter
function sapa() {
    echo "Halo, selamat datang!<br>";
}

echo "<h3>Fungsi Tanpa Parameter:</h3>";
sapa();

// Fungsi dengan parameter
function sapaOrang($nama) {
    echo "Halo, $nama!<br>";
}

echo "<h3>Fungsi Dengan Parameter:</h3>";
sapaOrang("Budi");
sapaOrang("Siti");

// Fungsi dengan parameter default
function hitungLuas($panjang, $lebar = 10) {
    $luas = $panjang * $lebar;
    return $luas;
}

echo "<h3>Fungsi Dengan Parameter Default:</h3>";
echo "Luas persegi panjang (5 x 10): " . hitungLuas(5) . "<br>";
echo "Luas persegi panjang (5 x 8): " . hitungLuas(5, 8) . "<br>";

// Fungsi dengan return value
function tambah($a, $b) {
    return $a + $b;
}

function kurang($a, $b) {
    return $a - $b;
}

function kali($a, $b) {
    return $a * $b;
}

function bagi($a, $b) {
    if ($b == 0) {
        return "Error: Pembagian dengan nol";
    }
    return $a / $b;
}

echo "<h3>Fungsi Dengan Return Value:</h3>";
echo "5 + 3 = " . tambah(5, 3) . "<br>";
echo "5 - 3 = " . kurang(5, 3) . "<br>";
echo "5 * 3 = " . kali(5, 3) . "<br>";
echo "5 / 3 = " . bagi(5, 3) . "<br>";
echo "5 / 0 = " . bagi(5, 0) . "<br>";

// 6. FORM HANDLING
echo "<h2>6. Form Handling</h2>";
?>

<h3>Contoh Form:</h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div style="margin-bottom: 10px;">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama">
    </div>
    <div style="margin-bottom: 10px;">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">
    </div>
    <div style="margin-bottom: 10px;">
        <label>Jenis Kelamin:</label>
        <input type="radio" id="laki" name="jenis_kelamin" value="Laki-laki">
        <label for="laki">Laki-laki</label>
        <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan">
        <label for="perempuan">Perempuan</label>
    </div>
    <div style="margin-bottom: 10px;">
        <label>Hobi:</label>
        <input type="checkbox" id="membaca" name="hobi[]" value="Membaca">
        <label for="membaca">Membaca</label>
        <input type="checkbox" id="olahraga" name="hobi[]" value="Olahraga">
        <label for="olahraga">Olahraga</label>
        <input type="checkbox" id="musik" name="hobi[]" value="Musik">
        <label for="musik">Musik</label>
    </div>
    <div style="margin-bottom: 10px;">
        <label for="kota">Kota:</label>
        <select id="kota" name="kota">
            <option value="">Pilih Kota</option>
            <option value="Jakarta">Jakarta</option>
            <option value="Bandung">Bandung</option>
            <option value="Surabaya">Surabaya</option>
            <option value="Yogyakarta">Yogyakarta</option>
        </select>
    </div>
    <div style="margin-bottom: 10px;">
        <label for="pesan">Pesan:</label>
        <textarea id="pesan" name="pesan" rows="4" cols="30"></textarea>
    </div>
    <div>
        <input type="submit" name="submit" value="Kirim">
    </div>
</form>

<?php
// Proses form jika sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    echo "<h3>Data yang Dikirim:</h3>";
    
    // Validasi dan tampilkan data
    if (!empty($_POST["nama"])) {
        echo "Nama: " . htmlspecialchars($_POST["nama"]) . "<br>";
    } else {
        echo "<span style='color: red;'>Nama harus diisi!</span><br>";
    }
    
    if (!empty($_POST["email"])) {
        echo "Email: " . htmlspecialchars($_POST["email"]) . "<br>";
    } else {
        echo "<span style='color: red;'>Email harus diisi!</span><br>";
    }
    
    if (isset($_POST["jenis_kelamin"])) {
        echo "Jenis Kelamin: " . htmlspecialchars($_POST["jenis_kelamin"]) . "<br>";
    } else {
        echo "<span style='color: red;'>Jenis Kelamin harus dipilih!</span><br>";
    }
    
    if (isset($_POST["hobi"]) && is_array($_POST["hobi"])) {
        echo "Hobi: " . implode(", ", array_map('htmlspecialchars', $_POST["hobi"])) . "<br>";
    } else {
        echo "<span style='color: red;'>Minimal satu hobi harus dipilih!</span><br>";
    }
    
    if (!empty($_POST["kota"])) {
        echo "Kota: " . htmlspecialchars($_POST["kota"]) . "<br>";
    } else {
        echo "<span style='color: red;'>Kota harus dipilih!</span><br>";
    }
    
    if (!empty($_POST["pesan"])) {
        echo "Pesan: " . htmlspecialchars($_POST["pesan"]) . "<br>";
    } else {
        echo "<span style='color: red;'>Pesan harus diisi!</span><br>";
    }
}

// 7. DATE DAN TIME
echo "<h2>7. Date dan Time</h2>";

// Menampilkan tanggal dan waktu
echo "<h3>Tanggal dan Waktu:</h3>";
echo "Tanggal sekarang: " . date("d-m-Y") . "<br>";
echo "Waktu sekarang: " . date("H:i:s") . "<br>";
echo "Hari ini: " . date("l") . "<br>";
echo "Bulan ini: " . date("F") . "<br>";
echo "Tahun ini: " . date("Y") . "<br>";
echo "Timestamp sekarang: " . time() . "<br>";

// Format tanggal
echo "<h3>Format Tanggal:</h3>";
$timestamp = time();
echo "Format 1: " . date("d/m/Y", $timestamp) . "<br>";
echo "Format 2: " . date("l, d F Y", $timestamp) . "<br>";
echo "Format 3: " . date("d-m-Y H:i:s", $timestamp) . "<br>";
echo "Format 4: " . date("D, d M Y", $timestamp) . "<br>";

// 8. STRING FUNCTIONS
echo "<h2>8. String Functions</h2>";

$teks = "Belajar Pemrograman PHP";

echo "<h3>Manipulasi String:</h3>";
echo "Teks asli: $teks<br>";
echo "Panjang teks: " . strlen($teks) . " karakter<br>";
echo "Jumlah kata: " . str_word_count($teks) . " kata<br>";
echo "Teks terbalik: " . strrev($teks) . "<br>";
echo "Posisi kata 'PHP': " . strpos($teks, "PHP") . "<br>";
echo "Ganti 'PHP' dengan 'JavaScript': " . str_replace("PHP", "JavaScript", $teks) . "<br>";
echo "Huruf kecil: " . strtolower($teks) . "<br>";
echo "Huruf besar: " . strtoupper($teks) . "<br>";
echo "Kapital setiap kata: " . ucwords(strtolower($teks)) . "<br>";

// 9. MATH FUNCTIONS
echo "<h2>9. Math Functions</h2>";

echo "<h3>Fungsi Matematika:</h3>";
echo "Nilai absolut dari -5: " . abs(-5) . "<br>";
echo "Akar kuadrat dari 16: " . sqrt(16) . "<br>";
echo "Pembulatan 3.7: " . round(3.7) . "<br>";
echo "Pembulatan ke atas 3.1: " . ceil(3.1) . "<br>";
echo "Pembulatan ke bawah 3.9: " . floor(3.9) . "<br>";
echo "Nilai minimum (2, 8, 3, 5, 1): " . min(2, 8, 3, 5, 1) . "<br>";
echo "Nilai maksimum (2, 8, 3, 5, 1): " . max(2, 8, 3, 5, 1) . "<br>";
echo "Bilangan acak antara 1 dan 10: " . rand(1, 10) . "<br>";
echo "Nilai PI: " . pi() . "<br>";

// 10. FILE HANDLING
echo "<h2>10. File Handling</h2>";

echo "<h3>Contoh Operasi File:</h3>";
echo "Catatan: Kode di bawah ini hanya contoh dan tidak dijalankan untuk menghindari modifikasi file.<br>";

echo "<pre>
// Menulis ke file
\$file = fopen('test.txt', 'w');
fwrite(\$file, 'Halo, ini adalah contoh teks yang ditulis ke file.');
fclose(\$file);

// Membaca dari file
\$file = fopen('test.txt', 'r');
\$content = fread(\$file, filesize('test.txt'));
fclose(\$file);
echo \$content;

// Cara singkat menulis file
file_put_contents('test.txt', 'Ini adalah contoh teks baru.');

// Cara singkat membaca file
\$content = file_get_contents('test.txt');
echo \$content;

// Memeriksa apakah file ada
if (file_exists('test.txt')) {
    echo 'File ada';
} else {
    echo 'File tidak ada';
}

// Menghapus file
unlink('test.txt');
</pre>";

echo "<p><strong>Selamat mencoba contoh-contoh kode PHP di atas!</strong></p>";
?>