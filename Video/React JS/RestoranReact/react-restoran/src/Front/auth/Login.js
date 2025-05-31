import React, { useState, useEffect } from "react";
import { useLocation, useNavigate, Link } from "react-router-dom";
import axios from "../../Axios/link";
import "../css/Auth.css";

function CustomerLogin() {
  const [form, setForm] = useState({ email: "", password: "" });
  const [pesan, setPesan] = useState("");
  const navigate = useNavigate();
  const location = useLocation();

  const handleChange = (e) => {
    const { name, value } = e.target;
    setForm({ ...form, [name]: value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post("/login", form);

      if (response.data.status === "success") {
        localStorage.setItem("customer_token", response.data.api_token);
        localStorage.setItem("customer_email", response.data.user.email);
        localStorage.setItem("customer_id", response.data.user.id);

        // Redirect to the page they were trying to access, or to menu
        const redirectTo = location.state?.from || "/menu";
        navigate(redirectTo, { replace: true });
      }
    } catch (err) {
      setPesan(err.response?.data?.message || "Login gagal!");
    }
  };

  useEffect(() => {
    const token = localStorage.getItem("customer_token");
    if (token) {
      navigate("/menu");
    }
  }, [navigate]);

  return (
    <div className="auth-container">
      <div className="auth-card">
        <h3 className="auth-title">Login Customer</h3>
        {pesan && (
          <div className="alert alert-warning text-center" role="alert">
            {pesan}
          </div>
        )}
        <form onSubmit={handleSubmit} className="auth-form">
          <div className="form-group">
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
          <div className="form-group">
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
          <p className="text-center mt-3">
            Belum punya akun?{" "}
            <Link to="/register" className="text-decoration-none">
              Daftar disini
            </Link>
          </p>
        </form>
      </div>
    </div>
  );
}

export default CustomerLogin;
