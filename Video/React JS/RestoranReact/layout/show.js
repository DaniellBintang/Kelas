import link from "./link.js";

export function show() {
  const id = prompt("Masukkan ID pelanggan:");
  if (!id) return;
  link
    .get(`/pelanggan/${id}`)
    .then((res) => {
      const p = res.data;
      if (!p) {
        document.getElementById("result").textContent = "Data tidak ditemukan";
        return;
      }
      let html = `<table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Telp</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>${p.idpelanggan}</td>
            <td>${p.nama}</td>
            <td>${p.alamat}</td>
            <td>${p.telp}</td>
          </tr>
        </tbody>
      </table>`;
      document.getElementById("result").innerHTML = html;
    })
    .catch((err) => {
      document.getElementById("result").textContent = "Data tidak ditemukan";
      console.error(err);
    });
}
