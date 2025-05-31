import link from "./link.js";

export function update() {
  const id = prompt("Masukkan ID pelanggan yang akan diupdate:");
  if (!id) return;

  const data = {
    nama: "Nama Update",
    alamat: "Alamat Update",
    telp: "089999999999",
  };

  link
    .put(`/pelanggan/${id}`, data)
    .then((res) => {
      document.getElementById(
        "result"
      ).innerHTML = `<div class="alert alert-success">Data dengan ID ${id} berhasil diupdate!</div>
        <pre>${JSON.stringify(res.data, null, 2)}</pre>`;
    })
    .catch((err) => {
      document.getElementById(
        "result"
      ).innerHTML = `<div class="alert alert-danger">Gagal mengupdate data!</div>`;
      console.error(err);
    });
}
