import { Navigate } from "react-router-dom";

const ProtectedRouteByLevel = ({ children, allow }) => {
  const level = localStorage.getItem("level");

  // Jika level user tidak termasuk dalam yang diizinkan, redirect
  if (!allow.includes(level)) {
    return <Navigate to="/login" />;
  }

  return children;
};

export default ProtectedRouteByLevel;
