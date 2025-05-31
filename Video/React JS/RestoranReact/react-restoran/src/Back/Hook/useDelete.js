import { useState } from "react";
import link from "../../Axios/link";

const useDelete = (url, reloadCallback) => {
  const [pesan, setPesan] = useState("");

  const handleDelete = async (id) => {
    if (window.confirm("Yakin ingin menghapus data ini?")) {
      try {
        const res = await link.delete(`${url}/${id}`);
        setPesan(res.data.pesan || "Data berhasil dihapus");
        if (reloadCallback) reloadCallback(); // refresh data
      } catch (error) {
        setPesan("Gagal menghapus data!");
      }
    }
  };

  return { handleDelete, pesan, setPesan };
};

export default useDelete;
