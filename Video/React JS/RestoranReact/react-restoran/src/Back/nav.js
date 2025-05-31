import React from "react";
import { useNavigate } from "react-router-dom";

function Nav() {
  const navigate = useNavigate();

  const handleLogout = () => {
    localStorage.clear(); // hapus token & user
    navigate("/login"); // redirect ke login
  };

  const email = localStorage.getItem("email");
  const level = localStorage.getItem("level");

  return (
    <nav className="navbar navbar-expand-lg navbar-dark bg-dark px-4">
      <a className="navbar-brand" href="/admin">
        MyApp
      </a>
      <div className="ms-auto d-flex align-items-center">
        <div className="me-3 text-white">
          <small>
            {email} ({level})
          </small>
        </div>
        <button className="btn btn-outline-light" onClick={handleLogout}>
          Logout
        </button>
      </div>
    </nav>
  );
}

export default Nav;
