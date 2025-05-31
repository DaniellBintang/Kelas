"use client";

import { useEffect, useState } from "react";
import useGet from "../Hook/useGet";
import axios from "../../Axios/link";
import "../css/DetailStyle.css";

function DetailMenuPage() {
  const [isi, reload] = useGet("/detail");
  const [filtered, setFiltered] = useState([]);
  const [tglAwal, setTglAwal] = useState("");
  const [tglAkhir, setTglAkhir] = useState("");
  const [pesan, setPesan] = useState("");
  const [isSuccess, setIsSuccess] = useState(false);

  const handleFilter = async () => {
    if (!tglAwal || !tglAkhir) {
      setPesan("Silakan pilih tanggal awal dan akhir");
      setIsSuccess(false);
      return;
    }

    try {
      const res = await axios.get(`/detail/${tglAwal}/${tglAkhir}`);
      setFiltered(res.data.data);
      setPesan(
        res.data.message ||
          `Ditemukan ${res.data.data.length} detail order pada periode tersebut`
      );
      setIsSuccess(true);
    } catch (err) {
      setFiltered([]);
      setPesan("Data tidak ditemukan pada periode tersebut");
      setIsSuccess(false);
    }
  };

  const clearFilter = () => {
    setFiltered([]);
    setTglAwal("");
    setTglAkhir("");
    setPesan("Filter berhasil dihapus");
    setIsSuccess(true);
  };

  useEffect(() => {
    if (pesan) {
      const timer = setTimeout(() => setPesan(""), 3000);
      return () => clearTimeout(timer);
    }
  }, [pesan]);

  const dataTampil = filtered.length > 0 ? filtered : isi.data || [];

  // Calculate statistics
  const totalItems = dataTampil.reduce(
    (sum, item) => sum + (Number.parseInt(item.jumlah) || 0),
    0
  );
  const totalRevenue = dataTampil.reduce(
    (sum, item) => sum + (Number.parseInt(item.subtotal) || 0),
    0
  );
  const uniqueOrders = [...new Set(dataTampil.map((item) => item.idorder))]
    .length;
  const paidOrders = dataTampil.filter(
    (item) => item.status === "Lunas"
  ).length;
  const unpaidOrders = dataTampil.filter(
    (item) => item.status === "Belum Bayar"
  ).length;

  // Group data by order for better visualization
  const groupedData = dataTampil.reduce((acc, item) => {
    const orderId = item.idorder;
    if (!acc[orderId]) {
      acc[orderId] = {
        orderInfo: {
          idorder: item.idorder,
          tglorder: item.tglorder,
          nama_pelanggan: item.nama_pelanggan,
          alamat_pelanggan: item.alamat_pelanggan,
          total: item.total,
          bayar: item.bayar,
          kembali: item.kembali,
          status: item.status,
        },
        items: [],
      };
    }
    acc[orderId].items.push({
      nama_menu: item.nama_menu,
      harga: item.harga,
      jumlah: item.jumlah,
      subtotal: item.subtotal,
    });
    return acc;
  }, {});

  useEffect(() => {
    const toggleButtons = document.querySelectorAll(".toggle-btn");
    const groupedView = document.querySelector(".grouped-view");
    const detailedView = document.querySelector(".detailed-view");

    toggleButtons.forEach((button) => {
      button.addEventListener("click", () => {
        const view = button.getAttribute("data-view");

        // Update active button
        toggleButtons.forEach((btn) => btn.classList.remove("active"));
        button.classList.add("active");

        // Toggle views
        if (view === "grouped") {
          groupedView.style.display = "block";
          detailedView.style.display = "none";
        } else {
          groupedView.style.display = "none";
          detailedView.style.display = "block";
        }
      });
    });

    return () => {
      toggleButtons.forEach((button) => {
        button.removeEventListener("click", () => {});
      });
    };
  }, []);

  return (
    <div className="detail-menu-page">
      <div className="container-fluid px-4 py-4">
        {/* Header */}
        <div className="page-header mb-4">
          <div className=" mx-3 d-flex align-items-center justify-content-between">
            <div className="d-flex align-items-center">
              <div className="header-icon me-3">
                <i className="fas fa-clipboard-list"></i>
              </div>
              <div>
                <h2 className="page-title mb-1">Detail Order Menu</h2>
                <p className="page-subtitle mb-0">
                  Laporan detail pesanan dan menu
                </p>
              </div>
            </div>
            <div className="header-stats">
              <div className="stat-card items">
                <div className="stat-number">{totalItems}</div>
                <div className="stat-label">Total Item</div>
              </div>
              <div className="stat-card revenue">
                <div className="stat-number">
                  Rp {totalRevenue.toLocaleString()}
                </div>
                <div className="stat-label">Total Revenue</div>
              </div>
              <div className="stat-card orders">
                <div className="stat-number">{uniqueOrders}</div>
                <div className="stat-label">Total Order</div>
              </div>
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

        {/* Filter Section */}
        <div className="filter-card mb-4">
          <div className="filter-header">
            <h5 className="filter-title">
              <i className="fas fa-filter me-2"></i>
              Filter Berdasarkan Tanggal
            </h5>
          </div>
          <div className="filter-body">
            <div className="row g-3 align-items-end">
              <div className="col-md-3">
                <label className="form-label-custom">Tanggal Awal</label>
                <input
                  type="date"
                  className="form-input"
                  value={tglAwal}
                  onChange={(e) => setTglAwal(e.target.value)}
                />
              </div>
              <div className="col-md-3">
                <label className="form-label-custom">Tanggal Akhir</label>
                <input
                  type="date"
                  className="form-input"
                  value={tglAkhir}
                  onChange={(e) => setTglAkhir(e.target.value)}
                />
              </div>
              <div className="col-md-6">
                <div className="filter-actions">
                  <button className="btn-filter" onClick={handleFilter}>
                    <i className="fas fa-search me-2"></i>
                    Cari Detail Order
                  </button>
                  {filtered.length > 0 && (
                    <button className="btn-clear" onClick={clearFilter}>
                      <i className="fas fa-times me-2"></i>
                      Hapus Filter
                    </button>
                  )}
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* View Toggle */}
        <div className="view-toggle mb-4">
          <div className="toggle-buttons">
            <button className="toggle-btn active" data-view="grouped">
              <i className="fas fa-layer-group me-2"></i>
              Tampilan Grup
            </button>
            <button className="toggle-btn" data-view="detailed">
              <i className="fas fa-list me-2"></i>
              Tampilan Detail
            </button>
          </div>
        </div>

        {/* Grouped View */}
        <div className="grouped-view">
          {Object.entries(groupedData).length > 0 ? (
            Object.entries(groupedData).map(([orderId, orderData]) => (
              <div key={orderId} className="order-card mb-4">
                <div className="order-header">
                  <div className="order-info">
                    <div className="order-id" style={{ color: "black" }}>
                      <i className="fas fa-receipt me-2"></i>
                      Order #{orderData.orderInfo.idorder}
                    </div>
                    <div className="order-date" style={{ color: "black" }}>
                      <i className="fas fa-calendar me-2"></i>
                      {new Date(
                        orderData.orderInfo.tglorder
                      ).toLocaleDateString("id-ID")}
                    </div>
                  </div>
                  <div className="order-status">
                    <span
                      className={`status-badge ${
                        orderData.orderInfo.status === "Lunas"
                          ? "paid"
                          : "unpaid"
                      }`}
                    >
                      <i
                        className={`fas ${
                          orderData.orderInfo.status === "Lunas"
                            ? "fa-check-circle"
                            : "fa-clock"
                        } me-1`}
                      ></i>
                      {orderData.orderInfo.status === "Lunas"
                        ? "Lunas"
                        : "Belum Bayar"}
                    </span>
                  </div>
                </div>

                <div className="order-body">
                  <div className="customer-section">
                    <div className="customer-info">
                      <div className="customer-avatar">
                        <i className="fas fa-user"></i>
                      </div>
                      <div className="customer-details">
                        <div className="customer-name">
                          {orderData.orderInfo.nama_pelanggan}
                        </div>
                        <div className="customer-address">
                          <i className="fas fa-map-marker-alt me-1"></i>
                          {orderData.orderInfo.alamat_pelanggan}
                        </div>
                      </div>
                    </div>
                  </div>

                  <div className="items-section">
                    <h6 className="items-title">
                      <i className="fas fa-utensils me-2"></i>
                      Item Pesanan ({orderData.items.length} item)
                    </h6>
                    <div className="items-grid">
                      {orderData.items.map((item, idx) => (
                        <div key={idx} className="item-card">
                          <div className="item-info">
                            <div className="item-name">{item.nama_menu}</div>
                            <div className="item-price">
                              Rp {Number.parseInt(item.harga).toLocaleString()}
                            </div>
                          </div>
                          <div className="item-quantity">
                            <span className="quantity-badge">
                              x{item.jumlah}
                            </span>
                          </div>
                          <div className="item-subtotal">
                            <span className="subtotal-amount">
                              Rp{" "}
                              {Number.parseInt(item.subtotal).toLocaleString()}
                            </span>
                          </div>
                        </div>
                      ))}
                    </div>
                  </div>

                  <div className="payment-section">
                    <div className="payment-summary">
                      <div className="payment-row">
                        <span className="payment-label">Total:</span>
                        <span className="payment-value total">
                          Rp{" "}
                          {Number.parseInt(
                            orderData.orderInfo.total
                          ).toLocaleString()}
                        </span>
                      </div>
                      <div className="payment-row">
                        <span className="payment-label">Bayar:</span>
                        <span className="payment-value">
                          {orderData.orderInfo.bayar
                            ? `Rp ${Number.parseInt(
                                orderData.orderInfo.bayar
                              ).toLocaleString()}`
                            : "-"}
                        </span>
                      </div>
                      <div className="payment-row">
                        <span className="payment-label">Kembali:</span>
                        <span className="payment-value">
                          {orderData.orderInfo.kembali
                            ? `Rp ${Number.parseInt(
                                orderData.orderInfo.kembali
                              ).toLocaleString()}`
                            : "-"}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            ))
          ) : (
            <div className="empty-state">
              <div className="empty-content">
                <i className="fas fa-clipboard-list fa-3x mb-3"></i>
                <h5 className="mb-2">Belum Ada Detail Order</h5>
                <p className="mb-0 text-muted">
                  {filtered.length === 0 && tglAwal && tglAkhir
                    ? "Tidak ada detail order pada periode yang dipilih"
                    : "Belum ada data detail order yang tersedia"}
                </p>
              </div>
            </div>
          )}
        </div>

        {/* Detailed Table View (Hidden by default) */}
        <div className="detailed-view" style={{ display: "none" }}>
          <div className="table-card">
            <div className="table-header">
              <h5 className="table-title">
                <i className="fas fa-table me-2"></i>
                {filtered.length > 0
                  ? `Detail Order - Hasil Filter (${dataTampil.length} item)`
                  : `Detail Order - Semua Data (${dataTampil.length} item)`}
              </h5>
              <div className="table-actions">
                <button
                  className="btn-refresh"
                  onClick={reload}
                  title="Refresh data"
                >
                  <i className="fas fa-sync-alt"></i>
                </button>
              </div>
            </div>

            <div className="table-body">
              <div className="table-responsive">
                <table className="custom-table">
                  <thead>
                    <tr>
                      <th width="8%">ID Order</th>
                      <th width="10%">Tanggal</th>
                      <th width="12%">Pelanggan</th>
                      <th width="15%">Alamat</th>
                      <th width="12%">Menu</th>
                      <th width="8%">Harga</th>
                      <th width="6%">Qty</th>
                      <th width="8%">Subtotal</th>
                      <th width="8%">Total</th>
                      <th width="7%">Bayar</th>
                      <th width="7%">Kembali</th>
                      <th width="9%">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    {dataTampil.length > 0 ? (
                      dataTampil.map((val, idx) => (
                        <tr key={idx}>
                          <td>
                            <span className="order-badge">{val.idorder}</span>
                          </td>
                          <td>
                            <div className="date-cell">
                              {new Date(val.tglorder).toLocaleDateString(
                                "id-ID"
                              )}
                            </div>
                          </td>
                          <td>
                            <div className="customer-cell">
                              {val.nama_pelanggan}
                            </div>
                          </td>
                          <td>
                            <div className="address-cell">
                              {val.alamat_pelanggan}
                            </div>
                          </td>
                          <td>
                            <div className="menu-cell">{val.nama_menu}</div>
                          </td>
                          <td>
                            <span className="price-cell">
                              Rp {Number.parseInt(val.harga).toLocaleString()}
                            </span>
                          </td>
                          <td>
                            <span className="qty-badge">{val.jumlah}</span>
                          </td>
                          <td>
                            <span className="subtotal-cell">
                              Rp{" "}
                              {Number.parseInt(val.subtotal).toLocaleString()}
                            </span>
                          </td>
                          <td>
                            <span className="total-cell">
                              Rp {Number.parseInt(val.total).toLocaleString()}
                            </span>
                          </td>
                          <td>
                            <span className="payment-cell">
                              {val.bayar
                                ? `Rp ${Number.parseInt(
                                    val.bayar
                                  ).toLocaleString()}`
                                : "-"}
                            </span>
                          </td>
                          <td>
                            <span className="change-cell">
                              {val.kembali
                                ? `Rp ${Number.parseInt(
                                    val.kembali
                                  ).toLocaleString()}`
                                : "-"}
                            </span>
                          </td>
                          <td>
                            <span
                              className={`status-badge ${
                                val.status === "Lunas" ? "paid" : "unpaid"
                              }`}
                            >
                              <i
                                className={`fas ${
                                  val.status === "Lunas"
                                    ? "fa-check-circle"
                                    : "fa-clock"
                                } me-1`}
                              ></i>
                              {val.status === "Lunas" ? "Lunas" : "Belum Bayar"}
                            </span>
                          </td>
                        </tr>
                      ))
                    ) : (
                      <tr>
                        <td colSpan="12" className="empty-state">
                          <div className="empty-content">
                            <i className="fas fa-clipboard-list fa-2x mb-2"></i>
                            <p className="mb-0">
                              Tidak ada data detail order yang ditemukan
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
  );
}

export default DetailMenuPage;
