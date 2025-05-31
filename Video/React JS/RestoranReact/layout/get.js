// Contoh di file lain, misal: e:\xampp\htdocs\RestoranReact\layout\get.js
import link from "./link.js";

export function get() {
  link
    .get("/pelanggan")
    .then((res) => {
      // Ambil data array dari response
      const data = res.data;
      // Buat tabel HTML
      let html = `<table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Telp</th>
          </tr>
        </thead>
        <tbody>`;
      data.forEach((p) => {
        html += `<tr>
          <td>${p.idpelanggan}</td>
          <td>${p.nama}</td>
          <td>${p.alamat}</td>
          <td>${p.telp}</td>
        </tr>`;
      });
      html += `</tbody></table>`;
      // Tampilkan ke elemen <pre id="result">
      document.getElementById("result").innerHTML = html;
    })
    .catch((err) => {
      document.getElementById("result").textContent = err;
      console.error(err);
    });
}
