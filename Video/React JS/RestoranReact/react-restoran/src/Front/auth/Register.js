import React, { useState } from "react";
import { useNavigate, Link } from "react-router-dom";
import axios from "../../Axios/link";
import "../css/Auth.css";

function CustomerRegister() {
  const navigate = useNavigate();
  const [form, setForm] = useState({
    email: "",
    password: "",
    level: "pelanggan",
    nama_pelanggan: "",
    alamat_pelanggan: "",
    no_telp: "",
  });
  const [pesan, setPesan] = useState("");

  const handleChange = (e) => {
    const { name, value } = e.target;
    setForm({ ...form, [name]: value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post("/register", {
        email: form.email,
        password: form.password,
        level: "pelanggan",
        relasi: "Front", // Add this to match backend requirements
        status: 1,
      });

      if (response.data.user) {
        setPesan("Registrasi berhasil! Silahkan login.");
        setTimeout(() => {
          navigate("/login");
        }, 2000);
      }
    } catch (err) {
      console.error("Registration error:", err.response?.data);
      const errorMessage =
        err.response?.data?.email?.[0] ||
        err.response?.data?.message ||
        "Registrasi gagal!";
      setPesan(errorMessage);
    }
  };

  return (
    <div className="auth-container">
      <div className="auth-card">
        <h3 className="auth-title">Daftar Akun</h3>
        {pesan && (
          <div
            className={`alert ${
              pesan.includes("berhasil") ? "alert-success" : "alert-danger"
            } text-center`}
            role="alert"
          >
            {pesan}
          </div>
        )}
        <form onSubmit={handleSubmit} className="auth-form">
          <div className="form-group mb-3">
            <label>Email</label>
            <input
              type="email"
              name="email"
              className="form-control"
              value={form.email}
              onChange={handleChange}
              required
            />
          </div>
          <div className="form-group mb-3">
            <label>Password</label>
            <input
              type="password"
              name="password"
              className="form-control"
              value={form.password}
              onChange={handleChange}
              minLength="6"
              required
            />
            <small className="text-muted">Minimal 6 karakter</small>
          </div>
          <div className="form-group mb-3">
            <label>Nama Lengkap</label>
            <input
              type="text"
              name="nama_pelanggan"
              className="form-control"
              value={form.nama_pelanggan}
              onChange={handleChange}
              required
            />
          </div>
          <div className="form-group mb-3">
            <label>Alamat</label>
            <textarea
              name="alamat_pelanggan"
              className="form-control"
              value={form.alamat_pelanggan}
              onChange={handleChange}
              required
            />
          </div>
          <div className="form-group mb-4">
            <label>No. Telepon</label>
            <input
              type="tel"
              name="no_telp"
              className="form-control"
              value={form.no_telp}
              onChange={handleChange}
              required
            />
          </div>
          <button type="submit" className="btn btn-primary w-100">
            Daftar
          </button>
          <p className="text-center mt-3">
            Sudah punya akun?{" "}
            <Link to="/login" className="text-decoration-none">
              Login disini
            </Link>
          </p>
        </form>
      </div>
    </div>
  );
}

export default CustomerRegister;
