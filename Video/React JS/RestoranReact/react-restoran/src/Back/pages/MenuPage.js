"use client";

import { useEffect, useState } from "react";
import useGet from "../Hook/useGet";
import useDelete from "../Hook/useDelete";
import axios from "../../Axios/link";
import "../css/MenuStyle.css"; // We'll create this CSS file

function MenuPage() {
  const [previewGambar, setPreviewGambar] = useState(null);
  const [isi, reload] = useGet("/menu");
  const [kategori] = useGet("/kategori");
  const { handleDelete, pesan, setPesan } = useDelete("/menu", reload);

  const [form, setForm] = useState({
    idkategori: "",
    menu: "",
    harga: "",
    gambar: null,
  });

  const [editMode, setEditMode] = useState(false);
  const [idmenuEdit, setIdmenuEdit] = useState(null);
  const [pesanForm, setPesanForm] = useState("");
  const [isSuccess, setIsSuccess] = useState(false);

  useEffect(() => {
    if (pesan || pesanForm) {
      const timer = setTimeout(() => {
        setPesan("");
        setPesanForm("");
      }, 3000);
      return () => clearTimeout(timer);
    }
  }, [pesan, pesanForm, setPesan]);

  const handleInput = (e) => {
    const { name, value, files } = e.target;
    if (name === "gambar") {
      setForm({ ...form, gambar: files[0] });

      // Preview gambar
      if (files[0]) {
        const reader = new FileReader();
        reader.onloadend = () => {
          setPreviewGambar(reader.result);
        };
        reader.readAsDataURL(files[0]);
      }
    } else {
      setForm({ ...form, [name]: value });
    }
  };

  const resetForm = () => {
    setForm({ idkategori: "", menu: "", harga: "", gambar: null });
    setEditMode(false);
    setIdmenuEdit(null);
    setPreviewGambar(null);
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    const data = new FormData();
    data.append("idkategori", form.idkategori);
    data.append("menu", form.menu);
    data.append("harga", form.harga);
    if (form.gambar) {
      data.append("gambar", form.gambar);
    }

    try {
      if (editMode && idmenuEdit) {
        // Mode update
        const res = await axios.post(`/menu/${idmenuEdit}?_method=PUT`, data);
        setPesanForm(res.data.pesan || "Menu berhasil diupdate");
      } else {
        // Mode tambah
        const res = await axios.post("/menu", data);
        setPesanForm(res.data.pesan || "Menu berhasil ditambahkan");
      }

      setIsSuccess(true);
      resetForm();
      reload();
    } catch (err) {
      setPesanForm("Gagal menyimpan menu");
      setIsSuccess(false);
    }
  };

  const handleEdit = (menuData) => {
    setEditMode(true);
    setIdmenuEdit(menuData.idmenu);
    setPreviewGambar(menuData.gambar || null); // tampilkan gambar lama
    setForm({
      idkategori: menuData.idkategori,
      menu: menuData.menu,
      harga: menuData.harga,
      gambar: null, // reset file input
    });
  };

  return (
    <div className="menu-page">
      <div className="container-fluid px-4 py-4">
        {/* Header */}
        <div className="page-header mb-4">
          <div className="mx-3 d-flex align-items-center">
            <div className="header-icon me-3">
              <i className="fas fa-utensils"></i>
            </div>
            <div>
              <h2 className="page-title mb-1">Manajemen Menu</h2>
              <p className="page-subtitle mb-0">Kelola menu restoran Anda</p>
            </div>
          </div>
        </div>

        <div className="row">
          {/* Form Section */}
          <div className="col-lg-4 col-md-5 mb-4">
            <div className="form-card">
              <div className="form-header">
                <h5 className="form-title">
                  <i
                    className={`fas ${editMode ? "fa-edit" : "fa-plus"} me-2`}
                  ></i>
                  {editMode ? "Edit Menu" : "Tambah Menu"}
                </h5>
              </div>

              <div className="form-body">
                {/* Alert */}
                {(pesan || pesanForm) && (
                  <div
                    className={`custom-alert ${
                      isSuccess ? "success" : "warning"
                    }`}
                  >
                    <div className="alert-content">
                      <i
                        className={`fas ${
                          isSuccess
                            ? "fa-check-circle"
                            : "fa-exclamation-triangle"
                        } me-2`}
                      ></i>
                      <span>{pesan || pesanForm}</span>
                    </div>
                    <button
                      type="button"
                      className="alert-close"
                      onClick={() => {
                        setPesan("");
                        setPesanForm("");
                      }}
                    >
                      <i className="fas fa-times"></i>
                    </button>
                  </div>
                )}

                <form onSubmit={handleSubmit} className="menu-form">
                  <div className="input-group-custom mb-3">
                    <label className="form-label-custom">
                      Kategori <span className="required">*</span>
                    </label>
                    <select
                      className="form-input"
                      name="idkategori"
                      value={form.idkategori}
                      onChange={handleInput}
                      required
                    >
                      <option value="">Pilih Kategori</option>
                      {kategori.map((k) => (
                        <option key={k.idkategori} value={k.idkategori}>
                          {k.kategori}
                        </option>
                      ))}
                    </select>
                  </div>

                  <div className="input-group-custom mb-3">
                    <label className="form-label-custom">
                      Nama Menu <span className="required">*</span>
                    </label>
                    <input
                      type="text"
                      name="menu"
                      className="form-input"
                      placeholder="Masukkan nama menu"
                      value={form.menu}
                      onChange={handleInput}
                      required
                    />
                  </div>

                  <div className="input-group-custom mb-3">
                    <label className="form-label-custom">
                      Harga <span className="required">*</span>
                    </label>
                    <input
                      type="number"
                      name="harga"
                      className="form-input"
                      placeholder="Masukkan harga"
                      value={form.harga}
                      onChange={handleInput}
                      required
                    />
                  </div>

                  <div className="input-group-custom mb-3">
                    <label className="form-label-custom">Gambar Menu</label>
                    <input
                      type="file"
                      name="gambar"
                      className="form-input file-input"
                      onChange={handleInput}
                    />
                  </div>

                  {/* Preview Gambar */}
                  {previewGambar && (
                    <div className="preview-container mb-3">
                      <label className="form-label-custom">
                        Preview Gambar:
                      </label>
                      <div className="image-preview">
                        <img
                          src={previewGambar || "/placeholder.svg"}
                          alt="Preview"
                          className="preview-image"
                        />
                      </div>
                    </div>
                  )}

                  <div className="form-actions">
                    <button type="submit" className="btn-primary-custom">
                      <i
                        className={`fas ${
                          editMode ? "fa-save" : "fa-plus"
                        } me-2`}
                      ></i>
                      {editMode ? "Update Menu" : "Tambah Menu"}
                    </button>
                    {editMode && (
                      <button
                        type="button"
                        className="btn-secondary-custom ms-2"
                        onClick={resetForm}
                      >
                        <i className="fas fa-times me-2"></i>
                        Batal
                      </button>
                    )}
                  </div>
                </form>
              </div>
            </div>
          </div>

          {/* Table Section */}
          <div className="col-lg-8 col-md-7">
            <div className="table-card">
              <div className="table-header">
                <h5 className="table-title">
                  <i className="fas fa-list me-2"></i>
                  Daftar Menu
                </h5>
                <div className="table-info">
                  <span className="badge-info">{isi.length} menu</span>
                </div>
              </div>

              <div className="table-body">
                <div className="table-responsive">
                  <table className="custom-table">
                    <thead>
                      <tr>
                        <th width="10%">ID</th>
                        <th width="15%">Kategori</th>
                        <th width="20%">Menu</th>
                        <th width="15%">Gambar</th>
                        <th width="15%">Harga</th>
                        <th width="15%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      {isi.length > 0 ? (
                        isi.map((val, index) => (
                          <tr
                            key={index}
                            className={
                              idmenuEdit === val.idmenu ? "selected" : ""
                            }
                          >
                            <td>
                              <span className="id-badge">{val.idmenu}</span>
                            </td>
                            <td>{val.kategori}</td>
                            <td>
                              <div className="menu-name">{val.menu}</div>
                            </td>
                            <td>
                              {val.gambar ? (
                                <div className="menu-image-container">
                                  <img
                                    src={val.gambar || "/placeholder.svg"}
                                    alt={val.menu}
                                    className="menu-image"
                                  />
                                </div>
                              ) : (
                                <span className="no-image">No Image</span>
                              )}
                            </td>
                            <td>
                              <span className="price-tag">Rp {val.harga}</span>
                            </td>
                            <td>
                              <div className="action-buttons">
                                <button
                                  className="btn-edit"
                                  onClick={() => handleEdit(val)}
                                  title="Edit menu"
                                >
                                  <i className="fas fa-edit"></i>
                                </button>
                                <button
                                  className="btn-delete"
                                  onClick={() => handleDelete(val.idmenu)}
                                  title="Hapus menu"
                                >
                                  <i className="fas fa-trash"></i>
                                </button>
                              </div>
                            </td>
                          </tr>
                        ))
                      ) : (
                        <tr>
                          <td colSpan="6" className="empty-state">
                            <div className="empty-content">
                              <i className="fas fa-utensils fa-2x mb-2"></i>
                              <p className="mb-0">
                                Belum ada menu yang ditambahkan
                              </p>
                            </div>
                          </td>
                        </tr>
                      )}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

export default MenuPage;
