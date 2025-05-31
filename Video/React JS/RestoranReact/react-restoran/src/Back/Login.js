import React, { useState } from "react";
import { useEffect } from "react";
import { useNavigate } from "react-router-dom"; // pastikan pakai React Router
import axios from "../Axios/link";

function LoginPage() {
  const [form, setForm] = useState({ email: "", password: "" });
  const [pesan, setPesan] = useState("");

  const handleChange = (e) => {
    const { name, value } = e.target;
    setForm({ ...form, [name]: value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const res = await axios.post("/login", form);

      console.log(res.data.log || res.data.message);

      if (res.data.status === "success") {
        setPesan("Login berhasil!");
        localStorage.setItem("api_token", res.data.api_token);
        localStorage.setItem("email", res.data.user.email);
        localStorage.setItem("level", res.data.user.level);
        window.location.reload(); // tambahkan kode ini
      }
    } catch (err) {
      const msg = err.response?.data?.message || "Login gagal!";
      const log = err.response?.data?.log;

      if (log) console.log("Log dari backend:", log);

      // Tambahan: handling akun banned
      if (msg === "Akun ini diBanned") {
        alert("Maaf, akun Anda telah dibanned. Silakan hubungi admin.");
      }

      setPesan(msg);
    }
  };

  const navigate = useNavigate();

  // Redirect jika token sudah ada
  useEffect(() => {
    const token = localStorage.getItem("api_token");
    if (token) {
      navigate("/admin");
    }
  }, []);

  return (
    <div className="container mt-5" style={{ maxWidth: "400px" }}>
      <h3 className="text-center mb-4">Login Admin / Kasir</h3>
      {pesan && (
        <div className="alert alert-warning text-center" role="alert">
          {pesan}
        </div>
      )}
      <form onSubmit={handleSubmit}>
        <div className="mb-3">
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
        <div className="mb-3">
          <label>Password</label>
          <input
            type="password"
            name="password"
            className="form-control"
            value={form.password}
            onChange={handleChange}
            required
          />
        </div>
        <button type="submit" className="btn btn-primary w-100">
          Login
        </button>
      </form>
    </div>
  );
}

export default LoginPage;
