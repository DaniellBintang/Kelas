"use client";

import { useState, useEffect } from "react";
import useGet from "../Hook/useGet";
import axios from "../../Axios/link";
import Modal from "react-modal";
import "../css/UserStyle.css";

function UserPage() {
  const [isi, reload] = useGet("/user");

  const customStyles = {
    content: {
      width: "450px",
      maxWidth: "90%",
      margin: "auto",
      borderRadius: "16px",
      padding: "0",
      inset: "50% auto auto 50%",
      transform: "translate(-50%, -50%)",
      border: "none",
      boxShadow: "0 10px 30px rgba(118, 75, 162, 0.2)",
      overflow: "hidden",
    },
    overlay: {
      backgroundColor: "rgba(0, 0, 0, 0.6)",
      backdropFilter: "blur(4px)",
      zIndex: 1000,
    },
  };

  const [modalIsOpen, setModalIsOpen] = useState(false);
  const [form, setForm] = useState({
    email: "",
    password: "",
    level: "admin",
    status: "1",
    relasi: "",
  });
  const [pesan, setPesan] = useState("");
  const [isSuccess, setIsSuccess] = useState(false);

  const handleOpenModal = () => setModalIsOpen(true);
  const handleCloseModal = () => {
    setModalIsOpen(false);
    setForm({
      email: "",
      password: "",
      level: "admin",
      status: "1",
      relasi: "",
    });
  };

  const handleChange = (e) => {
    const { name, value } = e.target;
    setForm({ ...form, [name]: value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const res = await axios.post("/register", form);
      setPesan(res.data.message || "User berhasil ditambahkan");
      setIsSuccess(true);
      handleCloseModal();
      reload();
    } catch (error) {
      setPesan("Gagal menambahkan user");
      setIsSuccess(false);
    }
  };

  const handleStatusChange = async (userId, status, email) => {
    const newStatus = status === "0" ? "1" : "0";
    const actionText = newStatus === "1" ? "mengaktifkan" : "menonaktifkan";

    if (
      window.confirm(`Apakah Anda yakin ingin ${actionText} user ${email}?`)
    ) {
      try {
        const res = await axios.put(`/user/${userId}`, {
          status: newStatus,
        });
        setPesan(
          res.data.message ||
            `Status user berhasil diubah menjadi ${
              newStatus === "1" ? "aktif" : "nonaktif"
            }`
        );
        setIsSuccess(true);
        reload();
      } catch (error) {
        setPesan("Gagal mengubah status user");
        setIsSuccess(false);
      }
    }
  };

  // Auto-hilangkan alert setelah 3 detik
  useEffect(() => {
    if (pesan) {
      const timer = setTimeout(() => setPesan(""), 3000);
      return () => clearTimeout(timer);
    }
  }, [pesan]);

  return (
    <div className="user-page">
      <div className="container-fluid px-4 py-4">
        {/* Header */}
        <div className="page-header mb-4">
          <div className="mx-3 d-flex align-items-center justify-content-between">
            <div className="d-flex align-items-center">
              <div className="header-icon me-3">
                <i className="fas fa-user-shield"></i>
              </div>
              <div>
                <h2 className="page-title mb-1">Manajemen Pengguna</h2>
                <p className="page-subtitle mb-0">
                  Kelola akun pengguna sistem
                </p>
              </div>
            </div>
            <div className="header-actions">
              <button className="btn-add-user" onClick={handleOpenModal}>
                <i className="fas fa-plus me-2"></i>
                Tambah User
              </button>
            </div>
          </div>
        </div>

        {/* Alert */}
        {pesan && (
          <div
            className={`custom-alert ${isSuccess ? "success" : "warning"} mb-4`}
          >
            <div className="alert-content">
              <i
                className={`fas ${
                  isSuccess ? "fa-check-circle" : "fa-exclamation-triangle"
                } me-2`}
              ></i>
              <span>{pesan}</span>
            </div>
            <button
              type="button"
              className="alert-close"
              onClick={() => setPesan("")}
            >
              <i className="fas fa-times"></i>
            </button>
          </div>
        )}

        {/* Table Section */}
        <div className="row">
          <div className="col-12">
            <div className="table-card">
              <div className="table-header">
                <h5 className="table-title">
                  <i className="fas fa-users-cog me-2"></i>
                  Daftar Pengguna Sistem
                </h5>
                <div className="table-info">
                  <span className="badge-info">
                    {isi.data ? isi.data.length : 0} pengguna
                  </span>
                </div>
              </div>

              <div className="table-body">
                <div className="table-responsive">
                  <table className="custom-table">
                    <thead>
                      <tr>
                        <th width="10%">ID</th>
                        <th width="35%">Email</th>
                        <th width="20%">Level</th>
                        <th width="20%">Status</th>
                        <th width="15%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      {isi.data && isi.data.length > 0 ? (
                        isi.data.map((user, idx) => (
                          <tr key={idx}>
                            <td>
                              <span className="id-badge">{user.id}</span>
                            </td>
                            <td>
                              <div className="user-info">
                                <div className="user-avatar">
                                  <i
                                    className={`fas ${
                                      user.level === "admin"
                                        ? "fa-user-tie"
                                        : user.level === "kasir"
                                        ? "fa-cash-register"
                                        : user.level === "koki"
                                        ? "fa-utensils"
                                        : "fa-user"
                                    }`}
                                  ></i>
                                </div>
                                <div className="user-email">{user.email}</div>
                              </div>
                            </td>
                            <td>
                              <span className={`role-badge ${user.level}`}>
                                <i
                                  className={`fas ${
                                    user.level === "admin"
                                      ? "fa-crown"
                                      : user.level === "kasir"
                                      ? "fa-cash-register"
                                      : user.level === "koki"
                                      ? "fa-utensils"
                                      : "fa-user"
                                  } me-1`}
                                ></i>
                                {user.level.charAt(0).toUpperCase() +
                                  user.level.slice(1)}
                              </span>
                            </td>
                            <td>
                              <span
                                className={`status-badge ${
                                  user.status === "1" ? "active" : "banned"
                                }`}
                              >
                                <i
                                  className={`fas ${
                                    user.status === "1"
                                      ? "fa-check-circle"
                                      : "fa-ban"
                                  } me-1`}
                                ></i>
                                {user.status === "1" ? "Active" : "Banned"}
                              </span>
                            </td>
                            <td>
                              <div className="action-buttons">
                                <button
                                  className={`btn-status ${
                                    user.status === "1"
                                      ? "btn-ban"
                                      : "btn-activate"
                                  }`}
                                  onClick={() =>
                                    handleStatusChange(
                                      user.id,
                                      user.status,
                                      user.email
                                    )
                                  }
                                  title={
                                    user.status === "1"
                                      ? "Ban user"
                                      : "Activate user"
                                  }
                                >
                                  <i
                                    className={`fas ${
                                      user.status === "1"
                                        ? "fa-ban"
                                        : "fa-check"
                                    }`}
                                  ></i>
                                </button>
                              </div>
                            </td>
                          </tr>
                        ))
                      ) : (
                        <tr>
                          <td colSpan="5" className="empty-state">
                            <div className="empty-content">
                              <i className="fas fa-user-slash fa-3x mb-3"></i>
                              <h5 className="mb-2">Belum Ada Pengguna</h5>
                              <p className="mb-0 text-muted">
                                Belum ada data pengguna yang terdaftar
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

      {/* Modal Tambah User */}
      <Modal
        isOpen={modalIsOpen}
        onRequestClose={handleCloseModal}
        style={customStyles}
        ariaHideApp={false}
      >
        <div className="modal-header">
          <h4 className="modal-title">
            <i className="fas fa-user-plus me-2"></i>
            Tambah User Baru
          </h4>
          <button className="modal-close" onClick={handleCloseModal}>
            <i className="fas fa-times"></i>
          </button>
        </div>
        <div className="modal-body">
          <form onSubmit={handleSubmit} className="user-form">
            <div className="input-group-custom mb-3">
              <label className="form-label-custom">
                Email <span className="required">*</span>
              </label>
              <div className="input-with-icon">
                <i className="fas fa-envelope icon-left"></i>
                <input
                  type="email"
                  name="email"
                  className="form-input"
                  placeholder="Masukkan email"
                  value={form.email}
                  onChange={handleChange}
                  required
                />
              </div>
            </div>

            <div className="input-group-custom mb-3">
              <label className="form-label-custom">
                Password <span className="required">*</span>
              </label>
              <div className="input-with-icon">
                <i className="fas fa-lock icon-left"></i>
                <input
                  type="password"
                  name="password"
                  className="form-input"
                  placeholder="Masukkan password"
                  value={form.password}
                  onChange={handleChange}
                  required
                />
              </div>
            </div>

            <div className="input-group-custom mb-3">
              <label className="form-label-custom">
                Level <span className="required">*</span>
              </label>
              <div className="input-with-icon">
                <i className="fas fa-user-tag icon-left"></i>
                <select
                  name="level"
                  className="form-input"
                  value={form.level}
                  onChange={handleChange}
                >
                  <option value="admin">Admin</option>
                  <option value="kasir">Kasir</option>
                  <option value="koki">Koki</option>
                </select>
              </div>
            </div>

            <div className="input-group-custom mb-4">
              <label className="form-label-custom">
                Status <span className="required">*</span>
              </label>
              <div className="input-with-icon">
                <i className="fas fa-toggle-on icon-left"></i>
                <select
                  name="status"
                  className="form-input"
                  value={form.status}
                  onChange={handleChange}
                >
                  <option value="1">Active</option>
                  <option value="0">Banned</option>
                </select>
              </div>
            </div>

            <div className="modal-actions">
              <button type="submit" className="btn-primary-custom">
                <i className="fas fa-save me-2"></i>
                Simpan
              </button>
              <button
                type="button"
                className="btn-secondary-custom"
                onClick={handleCloseModal}
              >
                <i className="fas fa-times me-2"></i>
                Batal
              </button>
            </div>
          </form>
        </div>
      </Modal>
    </div>
  );
}

export default UserPage;
