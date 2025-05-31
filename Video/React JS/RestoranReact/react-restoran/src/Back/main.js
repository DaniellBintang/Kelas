import React, { useEffect } from "react";
import { useParams } from "react-router-dom";
import KategoriPage from "./pages/KategoriPage";
import MenuPage from "./pages/MenuPage";
import PelangganPage from "./pages/PelangganPage";
import OrderPage from "./pages/OrderPage";
import OrderDetailPage from "./pages/OrderDetailPage";
import UserPage from "./pages/UserPage";
import ProtectedRouteByLevel from "./components/ProtectedRouteByLevel";

function Main() {
  const { page } = useParams();

  // Fungsi untuk memformat string: "order-detail" => "Order Detail"
  const formatTitle = (str) => {
    if (!str) return "Content";
    return str
      .split("-")
      .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
      .join(" ");
  };

  const renderPage = () => {
    switch (page) {
      case "kategori":
        return <KategoriPage />;
      case "menu":
        return <MenuPage />;
      case "pelanggan":
        return <PelangganPage />;
      case "order":
        return (
          <ProtectedRouteByLevel allow={["admin", "kasir"]}>
            <OrderPage />
          </ProtectedRouteByLevel>
        );
      case "order-detail":
        return (
          <ProtectedRouteByLevel allow={["admin", "kasir", "koki"]}>
            <OrderDetailPage />
          </ProtectedRouteByLevel>
        );
      case "user-admin":
        return (
          <ProtectedRouteByLevel allow={["admin"]}>
            <UserPage />
          </ProtectedRouteByLevel>
        );
      default:
        return (
          <div className="dashboard-page">
            <div className="container-fluid px-4 py-4">
              {/* Header */}
              <div className="page-header mb-4">
                <div className="row align-items-center">
                  <div className="col-auto">
                    <div className="header-icon mx-3">
                      <i className="fas fa-tags"></i>
                    </div>
                  </div>
                  <div className="col">
                    <h4 className="page-title mb-0">Dashboard Admin</h4>
                    <p className="page-subtitle">
                      Selamat datang di panel kontrol admin
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        );
    }
  };

  return <main>{renderPage()}</main>;
}

export default Main;
