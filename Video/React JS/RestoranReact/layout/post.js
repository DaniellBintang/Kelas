import link from "./link.js";

export function post() {
  const data = {
    nama: "Pelanggan Baru",
    alamat: "Jl. Contoh No. 123",
    telp: "081234567890",
  };

  link
    .post("/pelanggan", data)
    .then((res) => {
      document.getElementById(
        "result"
      ).innerHTML = `<div class="alert alert-success">Data berhasil ditambahkan!</div>
        <pre>${JSON.stringify(res.data, null, 2)}</pre>`;
    })
    .catch((err) => {
      document.getElementById(
        "result"
      ).innerHTML = `<div class="alert alert-danger">Gagal menambahkan data!</div>`;
      console.error(err);
    });
}
