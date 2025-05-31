import React, { useState } from "react";
import { useForm } from "react-hook-form";
import link from "../../Axios/link";
import useGet from "../Hook/useGet";
import "bootstrap/dist/css/bootstrap.min.css";
import "../css/KategoriStyle.css"; // Import CSS khusus

function KategoriPage() {
  const [isi, reload] = useGet("/kategori");

  const [warning, setWarning] = useState("");
  const [isSuccess, setIsSuccess] = useState(false);
  const [editMode, setEditMode] = useState(false);
  const [selectedId, setSelectedId] = useState(null);

  const {
    register,
    handleSubmit,
    reset,
    formState: { errors },
  } = useForm();

  const onSubmit = async (data) => {
    try {
      setWarning("");
      setIsSuccess(false);

      if (editMode) {
        await link.put(`/kategori/${selectedId}`, data);
        setWarning("Data berhasil diubah!");
      } else {
        const response = await link.post("/kategori", data);
        if (response.data.error === "duplicate") {
          setWarning(`Kategori "${data.kategori}" sudah ada dalam database!`);
          setIsSuccess(false);
          return;
        }
        setWarning("Data berhasil ditambahkan!");
      }

      setIsSuccess(true);
      reload();
      reset();
      setEditMode(false);
      setSelectedId(null);
    } catch (error) {
      setIsSuccess(false);
      setWarning(error.response?.data?.message || "Terjadi kesalahan!");
    }
  };

  const handleDelete = async (id) => {
    if (window.confirm("Apakah Yakin ingin Menghapus?")) {
      try {
        await link.delete(`/kategori/${id}`);
        setWarning("Data berhasil dihapus!");
        setIsSuccess(true);
        reload();
      } catch (error) {
        setWarning("Gagal menghapus data!");
        setIsSuccess(false);
      }
    }
  };

  const handleEdit = async (id) => {
    try {
      const response = await link.get(`/kategori/${id}`);
      setEditMode(true);
      setSelectedId(id);
      reset({
        kategori: response.data.kategori,
        keterangan: response.data.keterangan,
      });
    } catch (error) {
      setWarning("Gagal mengambil data kategori!");
      setIsSuccess(false);
    }
  };

  const handleCancel = () => {
    setEditMode(false);
    setSelectedId(null);
    reset({ kategori: "", keterangan: "" });
    setWarning("");
    setIsSuccess(false);
  };

  return (
    <div className="kategori-page">
      <div className="container-fluid px-4 py-4">
        {/* Header */}
        <div className="page-header mb-4">
          <div className="mx-3 d-flex align-items-center">
            <div className="header-icon me-3">
              <i className="fas fa-tags"></i>
            </div>
            <div>
              <h2 className="page-title mb-1">Manajemen Kategori</h2>
              <p className="page-subtitle mb-0">
                Kelola kategori menu restoran
              </p>
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
                  {editMode ? "Edit Kategori" : "Tambah Kategori"}
                </h5>
              </div>

              <div className="form-body">
                {/* Alert */}
                {warning && (
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
                      <span>{warning}</span>
                    </div>
                    <button
                      type="button"
                      className="alert-close"
                      onClick={() => {
                        setWarning("");
                        setIsSuccess(false);
                      }}
                    >
                      <i className="fas fa-times"></i>
                    </button>
                  </div>
                )}

                <form
                  onSubmit={handleSubmit(onSubmit)}
                  className="kategori-form"
                >
                  <div className="input-group-custom mb-3">
                    <label className="form-label-custom">
                      Nama Kategori <span className="required">*</span>
                    </label>
                    <input
                      type="text"
                      className={`form-input ${errors.kategori ? "error" : ""}`}
                      placeholder="Masukkan nama kategori"
                      {...register("kategori", {
                        required: "Kategori harus diisi",
                        minLength: {
                          value: 3,
                          message: "Kategori minimal 3 karakter",
                        },
                      })}
                    />
                    {errors.kategori && (
                      <div className="error-message">
                        <i className="fas fa-exclamation-circle me-1"></i>
                        {errors.kategori.message}
                      </div>
                    )}
                  </div>

                  <div className="input-group-custom mb-4">
                    <label className="form-label-custom">
                      Keterangan <span className="required">*</span>
                    </label>
                    <textarea
                      className={`form-input ${
                        errors.keterangan ? "error" : ""
                      }`}
                      placeholder="Masukkan keterangan kategori"
                      rows="3"
                      {...register("keterangan", {
                        required: "Keterangan harus diisi",
                        minLength: {
                          value: 5,
                          message: "Keterangan minimal 5 karakter",
                        },
                      })}
                    />
                    {errors.keterangan && (
                      <div className="error-message">
                        <i className="fas fa-exclamation-circle me-1"></i>
                        {errors.keterangan.message}
                      </div>
                    )}
                  </div>

                  <div className="form-actions">
                    <button type="submit" className="btn-primary-custom">
                      <i
                        className={`fas ${
                          editMode ? "fa-save" : "fa-plus"
                        } me-2`}
                      ></i>
                      {editMode ? "Update" : "Simpan"}
                    </button>
                    {editMode && (
                      <button
                        type="button"
                        className="btn-secondary-custom ms-2"
                        onClick={handleCancel}
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
                  Daftar Kategori
                </h5>
                <div className="table-info">
                  <span className="badge-info">{isi.length} kategori</span>
                </div>
              </div>

              <div className="table-body">
                <div className="table-responsive">
                  <table className="custom-table">
                    <thead>
                      <tr>
                        <th width="10%">ID</th>
                        <th width="25%">Kategori</th>
                        <th width="45%">Keterangan</th>
                        <th width="20%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      {isi.length > 0 ? (
                        isi.map((val, index) => (
                          <tr
                            key={index}
                            className={
                              selectedId === val.idkategori ? "selected" : ""
                            }
                          >
                            <td>
                              <span className="id-badge">{val.idkategori}</span>
                            </td>
                            <td>
                              <div className="kategori-name">
                                {val.kategori}
                              </div>
                            </td>
                            <td>
                              <div className="keterangan-text">
                                {val.keterangan}
                              </div>
                            </td>
                            <td>
                              <div className="action-buttons">
                                <button
                                  className="btn-edit"
                                  onClick={() => handleEdit(val.idkategori)}
                                  title="Edit kategori"
                                >
                                  <i className="fas fa-edit"></i>
                                </button>
                                <button
                                  className="btn-delete"
                                  onClick={() => handleDelete(val.idkategori)}
                                  title="Hapus kategori"
                                >
                                  <i className="fas fa-trash"></i>
                                </button>
                              </div>
                            </td>
                          </tr>
                        ))
                      ) : (
                        <tr>
                          <td colSpan="4" className="empty-state">
                            <div className="empty-content">
                              <i className="fas fa-inbox fa-2x mb-2"></i>
                              <p className="mb-0">
                                Belum ada kategori yang ditambahkan
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

export default KategoriPage;
