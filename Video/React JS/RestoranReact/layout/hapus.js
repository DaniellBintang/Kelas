import link from "./link.js";

export function hapus() {
  const id = prompt("Masukkan ID pelanggan yang akan dihapus:");
  if (!id) return;
  link
    .delete(`/pelanggan/${id}`)
    .then((res) => {
      document.getElementById(
        "result"
      ).innerHTML = `<div class="alert alert-success">Data dengan ID ${id} berhasil dihapus!</div>
        <pre>${JSON.stringify(res.data, null, 2)}</pre>`;
    })
    .catch((err) => {
      document.getElementById(
        "result"
      ).innerHTML = `<div class="alert alert-danger">Gagal menghapus data!</div>`;
      console.error(err);
    });
}
