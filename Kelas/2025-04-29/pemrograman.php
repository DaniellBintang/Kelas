<?php
/*
 * DASAR PEMROGRAMAN PHP
 * File ini berisi materi dasar pemrograman PHP
 */

// 1. PENGENALAN PHP
echo "<h1>Dasar Pemrograman PHP</h1>";
echo "<p>PHP (PHP: Hypertext Preprocessor) adalah bahasa pemrograman server-side yang dirancang khusus untuk pengembangan web.</p>";

// 2. SINTAKS DASAR
echo "<h2>Sintaks Dasar</h2>";
echo "<p>Kode PHP ditulis di antara tag &lt;?php dan ?&gt;</p>";
echo "<p>Setiap pernyataan PHP diakhiri dengan titik koma (;)</p>";

// 3. VARIABEL
echo "<h2>Variabel</h2>";
echo "<p>Variabel dalam PHP dimulai dengan tanda $ diikuti dengan nama variabel.</p>";
echo "<p>Contoh: \$nama = \"John\";</p>";
echo "<p>PHP adalah bahasa dengan tipe data dinamis, yang berarti tidak perlu mendeklarasikan tipe data saat membuat variabel.</p>";

// 4. TIPE DATA
echo "<h2>Tipe Data</h2>";
echo "<ul>
    <li>String - urutan karakter, seperti \"Hello World\"</li>
    <li>Integer - bilangan bulat, seperti 5, -3, 0</li>
    <li>Float - bilangan desimal, seperti 3.14</li>
    <li>Boolean - nilai true atau false</li>
    <li>Array - menyimpan beberapa nilai dalam satu variabel</li>
    <li>Object - instance dari class</li>
    <li>NULL - variabel tanpa nilai</li>
</ul>";

// 5. OPERATOR
echo "<h2>Operator</h2>";
echo "<h3>Operator Aritmatika</h3>";
echo "<ul>
    <li>+ (Penjumlahan)</li>
    <li>- (Pengurangan)</li>
    <li>* (Perkalian)</li>
    <li>/ (Pembagian)</li>
    <li>% (Modulus - sisa pembagian)</li>
    <li>** (Eksponensial)</li>
</ul>";

echo "<h3>Operator Perbandingan</h3>";
echo "<ul>
    <li>== (Sama dengan)</li>
    <li>=== (Identik - nilai dan tipe data sama)</li>
    <li>!= (Tidak sama dengan)</li>
    <li>!== (Tidak identik)</li>
    <li>< (Kurang dari)</li>
    <li>> (Lebih dari)</li>
    <li><= (Kurang dari atau sama dengan)</li>
    <li>>= (Lebih dari atau sama dengan)</li>
</ul>";

echo "<h3>Operator Logika</h3>";
echo "<ul>
    <li>and / && (Dan)</li>
    <li>or / || (Atau)</li>
    <li>! (Tidak)</li>
    <li>xor (Atau eksklusif)</li>
</ul>";

// 6. STRUKTUR KONTROL
echo "<h2>Struktur Kontrol</h2>";

echo "<h3>Percabangan (Conditional)</h3>";
echo "<p>Percabangan memungkinkan eksekusi kode yang berbeda untuk kondisi yang berbeda.</p>";
echo "<p>Jenis percabangan: if, if-else, if-elseif-else, switch</p>";

echo "<h3>Perulangan (Loop)</h3>";
echo "<p>Perulangan memungkinkan eksekusi kode berulang kali.</p>";
echo "<p>Jenis perulangan: for, while, do-while, foreach</p>";

// 7. FUNGSI
echo "<h2>Fungsi</h2>";
echo "<p>Fungsi adalah blok kode yang dapat digunakan kembali.</p>";
echo "<p>PHP memiliki lebih dari 1000 fungsi bawaan dan juga memungkinkan pembuatan fungsi sendiri.</p>";
echo "<p>Sintaks dasar fungsi:</p>";
echo "<pre>
function namaFungsi(\$parameter1, \$parameter2) {
    // kode yang akan dijalankan
    return nilai; // opsional
}
</pre>";

// 8. ARRAY
echo "<h2>Array</h2>";
echo "<p>Array adalah variabel khusus yang dapat menyimpan lebih dari satu nilai.</p>";
echo "<h3>Jenis Array:</h3>";
echo "<ul>
    <li>Array Terindeks - array dengan indeks numerik</li>
    <li>Array Asosiatif - array dengan kunci bernama</li>
    <li>Array Multidimensi - array yang berisi array lain</li>
</ul>";

// 9. FORM HANDLING
echo "<h2>Form Handling</h2>";
echo "<p>PHP dapat mengumpulkan data formulir HTML.</p>";
echo "<p>Metode pengumpulan data:</p>";
echo "<ul>
    <li>\$_GET - mengumpulkan data yang dikirim dengan metode GET</li>
    <li>\$_POST - mengumpulkan data yang dikirim dengan metode POST</li>
    <li>\$_REQUEST - mengumpulkan data dari kedua metode GET dan POST</li>
</ul>";

// 10. DATABASE
echo "<h2>Database</h2>";
echo "<p>PHP dapat bekerja dengan berbagai database, termasuk MySQL, PostgreSQL, dan lainnya.</p>";
echo "<p>PHP menyediakan beberapa cara untuk berinteraksi dengan database:</p>";
echo "<ul>
    <li>MySQLi (untuk MySQL)</li>
    <li>PDO (PHP Data Objects) - untuk berbagai database</li>
</ul>";

// 11. SESSION DAN COOKIE
echo "<h2>Session dan Cookie</h2>";
echo "<p>Session dan cookie digunakan untuk menyimpan informasi tentang pengguna.</p>";
echo "<p>Session disimpan di server, sedangkan cookie disimpan di browser pengguna.</p>";
echo "<p>Session dimulai dengan session_start() dan data disimpan dalam array \$_SESSION.</p>";
echo "<p>Cookie dibuat dengan fungsi setcookie() dan diakses melalui array \$_COOKIE.</p>";

// 12. PENANGANAN FILE
echo "<h2>Penanganan File</h2>";
echo "<p>PHP dapat membaca, menulis, dan memanipulasi file di server.</p>";
echo "<p>Fungsi umum untuk penanganan file:</p>";
echo "<ul>
    <li>fopen() - membuka file</li>
    <li>fread() - membaca file</li>
    <li>fwrite() - menulis ke file</li>
    <li>fclose() - menutup file</li>
    <li>file_get_contents() - membaca seluruh isi file</li>
    <li>file_put_contents() - menulis data ke file</li>
</ul>";

// 13. PENANGANAN ERROR
echo "<h2>Penanganan Error</h2>";
echo "<p>PHP menyediakan beberapa cara untuk menangani error:</p>";
echo "<ul>
    <li>try-catch - menangkap exception</li>
    <li>set_error_handler() - menentukan fungsi untuk menangani error</li>
    <li>error_reporting() - mengatur level pelaporan error</li>
</ul>";

// 14. KEAMANAN
echo "<h2>Keamanan</h2>";
echo "<p>Praktik keamanan penting dalam PHP:</p>";
echo "<ul>
    <li>Validasi input - memeriksa semua input pengguna</li>
    <li>Prepared statements - mencegah SQL injection</li>
    <li>Sanitasi output - mencegah XSS (Cross-Site Scripting)</li>
    <li>Enkripsi password - menggunakan fungsi password_hash()</li>
</ul>";

// 15. TIPS PENGEMBANGAN
echo "<h2>Tips Pengembangan</h2>";
echo "<ul>
    <li>Gunakan editor kode atau IDE yang mendukung PHP</li>
    <li>Aktifkan pelaporan error selama pengembangan</li>
    <li>Gunakan komentar untuk mendokumentasikan kode</li>
    <li>Ikuti standar penulisan kode</li>
    <li>Gunakan framework PHP untuk proyek besar</li>
</ul>";

echo "<p><strong>Selamat belajar PHP!</strong></p>";
?>