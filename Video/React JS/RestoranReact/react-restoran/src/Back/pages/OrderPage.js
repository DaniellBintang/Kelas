"use client";

import { useEffect, useState } from "react";
import useGet from "../Hook/useGet";
import useDelete from "../Hook/useDelete";
import axios from "../../Axios/link";
import Modal from "react-modal";
import "../css/OrderStyle.css";

function OrderPage() {
  const [isi, reload] = useGet("/order");
  const { handleDelete, pesan, setPesan } = useDelete("/order", reload);

  const [editData, setEditData] = useState(null);
  const [formUpdate, setFormUpdate] = useState({
    total: "",
    bayar: "",
    kembali: 0,
  });

  const [modalIsOpen, setModalIsOpen] = useState(false);
  const [tglAwal, setTglAwal] = useState("");
  const [tglAkhir, setTglAkhir] = useState("");
  const [filtered, setFiltered] = useState([]);
  const [isSuccess, setIsSuccess] = useState(false);

  const customStyles = {
    content: {
      width: "500px",
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

  const handleEditOpen = (order) => {
    setEditData(order);
    setFormUpdate({
      total: order.total,
      bayar: order.bayar,
      kembali: order.kembali,
    });
    setModalIsOpen(true);
  };

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    const newForm = {
      ...formUpdate,
      [name]: value,
    };

    // Hitung kembali otomatis
    if (name === "bayar" || name === "total") {
      const total = Number.parseInt(newForm.total) || 0;
      const bayar = Number.parseInt(newForm.bayar) || 0;
      newForm.kembali = bayar - total;
    }

    setFormUpdate(newForm);
  };

  const handleUpdate = async (e) => {
    e.preventDefault();

    try {
      const res = await axios.put(`/order/${editData.idorder}`, {
        bayar: formUpdate.bayar,
        kembali: formUpdate.kembali,
        status: "Lunas",
      });

      setPesan(res.data.message || "Pembayaran berhasil diproses");
      setIsSuccess(true);
      handleCloseModal();
      reload();
    } catch (error) {
      setPesan("Gagal memproses pembayaran");
      setIsSuccess(false);
    }
  };

  const handleCloseModal = () => {
    setModalIsOpen(false);
    setEditData(null);
  };

  const handleFilter = async () => {
    if (!tglAwal || !tglAkhir) {
      setPesan("Silakan pilih tanggal awal dan akhir");
      setIsSuccess(false);
      return;
    }

    try {
      const res = await axios.get(`/order/${tglAwal}/${tglAkhir}`);
      setFiltered(res.data.data);
      setPesan(`Ditemukan ${res.data.data.length} order pada periode tersebut`);
      setIsSuccess(true);
    } catch (err) {
      setFiltered([]);
      setPesan("Gagal memfilter data order");
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
  }, [pesan, setPesan]);

  const dataTampil = filtered.length > 0 ? filtered : isi;
  const totalRevenue = dataTampil.reduce(
    (sum, order) => sum + (Number.parseInt(order.total) || 0),
    0
  );
  const paidOrders = dataTampil.filter(
    (order) => order.status === "Lunas"
  ).length;
  const unpaidOrders = dataTampil.filter(
    (order) => order.status === "Belum Bayar"
  ).length;

  return (
    <div className="order-page">
      <div className="container-fluid px-4 py-4">
        {/* Header */}
        <div className="page-header mb-4">
          <div className="mx-4 d-flex align-items-center justify-content-between">
            <div className="d-flex align-items-center">
              <div className="header-icon me-3">
                <i className="fas fa-receipt"></i>
              </div>
              <div>
                <h2 className="page-title mb-1">Manajemen Order</h2>
                <p className="page-subtitle mb-0">
                  Kelola pesanan dan pembayaran
                </p>
              </div>
            </div>
            <div className="header-stats">
              <div className="stat-card revenue">
                <div className="stat-number">
                  Rp {totalRevenue.toLocaleString()}
                </div>
                <div className="stat-label">Total Revenue</div>
              </div>
              <div className="stat-card paid">
                <div className="stat-number">{paidOrders}</div>
                <div className="stat-label">Lunas</div>
              </div>
              <div className="stat-card unpaid">
                <div className="stat-number">{unpaidOrders}</div>
                <div className="stat-label">Belum Bayar</div>
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
                    Cari Order
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

        {/* Table Section */}
        <div className="row">
          <div className="col-12">
            <div className="table-card">
              <div className="table-header">
                <h5 className="table-title">
                  <i className="fas fa-list me-2"></i>
                  {filtered.length > 0
                    ? `Hasil Filter (${filtered.length} order)`
                    : `Daftar Order (${dataTampil.length} order)`}
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
                        <th width="12%">Faktur</th>
                        <th width="18%">Pelanggan</th>
                        <th width="20%">Alamat</th>
                        <th width="12%">Tanggal</th>
                        <th width="12%">Total</th>
                        <th width="10%">Bayar</th>
                        <th width="10%">Kembali</th>
                        <th width="6%">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      {dataTampil.length > 0 ? (
                        dataTampil.map((val, idx) => (
                          <tr key={idx}>
                            <td>
                              <span className="invoice-badge">
                                {val.idorder}
                              </span>
                            </td>
                            <td>
                              <div className="customer-info">
                                <div className="customer-avatar">
                                  <i className="fas fa-user"></i>
                                </div>
                                <div className="customer-name">
                                  {val.nama_pelanggan}
                                </div>
                              </div>
                            </td>
                            <td>
                              <div className="address-text">
                                <i className="fas fa-map-marker-alt me-2 text-muted"></i>
                                {val.alamat_pelanggan}
                              </div>
                            </td>
                            <td>
                              <div className="date-text">
                                <i className="fas fa-calendar me-2 text-muted"></i>
                                {new Date(val.tglorder).toLocaleDateString(
                                  "id-ID"
                                )}
                              </div>
                            </td>
                            <td>
                              <span className="price-tag">
                                Rp {Number.parseInt(val.total).toLocaleString()}
                              </span>
                            </td>
                            <td>
                              <span className="payment-amount">
                                {val.bayar
                                  ? `Rp ${Number.parseInt(
                                      val.bayar
                                    ).toLocaleString()}`
                                  : "-"}
                              </span>
                            </td>
                            <td>
                              <span className="change-amount">
                                {val.kembali
                                  ? `Rp ${Number.parseInt(
                                      val.kembali
                                    ).toLocaleString()}`
                                  : "-"}
                              </span>
                            </td>
                            <td>
                              {val.status === "Belum Bayar" ? (
                                <button
                                  className="status-btn unpaid"
                                  onClick={() => handleEditOpen(val)}
                                  title="Proses pembayaran"
                                >
                                  <i className="fas fa-credit-card me-1"></i>
                                  Bayar
                                </button>
                              ) : (
                                <span className="status-badge paid">
                                  <i className="fas fa-check-circle me-1"></i>
                                  Lunas
                                </span>
                              )}
                            </td>
                          </tr>
                        ))
                      ) : (
                        <tr>
                          <td colSpan="8" className="empty-state">
                            <div className="empty-content">
                              <i className="fas fa-receipt fa-3x mb-3"></i>
                              <h5 className="mb-2">Belum Ada Order</h5>
                              <p className="mb-0 text-muted">
                                {filtered.length === 0 && tglAwal && tglAkhir
                                  ? "Tidak ada order pada periode yang dipilih"
                                  : "Belum ada data order yang tersedia"}
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

      {/* Modal Update Pembayaran */}
      <Modal
        isOpen={modalIsOpen}
        onRequestClose={handleCloseModal}
        style={customStyles}
        ariaHideApp={false}
      >
        <div className="modal-header">
          <h4 className="modal-title">
            <i className="fas fa-credit-card me-2"></i>
            Proses Pembayaran
          </h4>
          <button className="modal-close" onClick={handleCloseModal}>
            <i className="fas fa-times"></i>
          </button>
        </div>
        <div className="modal-body">
          {editData && (
            <>
              <div className="order-info mb-4">
                <div className="info-row">
                  <span className="info-label">Faktur:</span>
                  <span className="info-value">{editData.idorder}</span>
                </div>
                <div className="info-row">
                  <span className="info-label">Pelanggan:</span>
                  <span className="info-value">{editData.nama_pelanggan}</span>
                </div>
                <div className="info-row">
                  <span className="info-label">ID Pelanggan:</span>
                  <span className="info-value">{editData.idpelanggan}</span>
                </div>
              </div>

              <form onSubmit={handleUpdate} className="payment-form">
                <div className="input-group-custom mb-3">
                  <label className="form-label-custom">
                    Total Tagihan <span className="required">*</span>
                  </label>
                  <div className="input-with-icon">
                    <i className="fas fa-tag icon-left"></i>
                    <input
                      type="number"
                      name="total"
                      value={formUpdate.total}
                      onChange={handleInputChange}
                      className="form-input"
                      required
                    />
                  </div>
                </div>

                <div className="input-group-custom mb-3">
                  <label className="form-label-custom">
                    Jumlah Bayar <span className="required">*</span>
                  </label>
                  <div className="input-with-icon">
                    <i className="fas fa-money-bill icon-left"></i>
                    <input
                      type="number"
                      name="bayar"
                      value={formUpdate.bayar}
                      onChange={handleInputChange}
                      className="form-input"
                      required
                    />
                  </div>
                </div>

                <div className="input-group-custom mb-4">
                  <label className="form-label-custom">Kembalian</label>
                  <div className="input-with-icon">
                    <i className="fas fa-coins icon-left"></i>
                    <input
                      type="number"
                      name="kembali"
                      value={formUpdate.kembali}
                      className={`form-input ${
                        formUpdate.kembali < 0 ? "error" : ""
                      }`}
                      readOnly
                    />
                  </div>
                  {formUpdate.kembali < 0 && (
                    <div className="error-message">
                      <i className="fas fa-exclamation-circle me-1"></i>
                      Jumlah bayar kurang dari total tagihan
                    </div>
                  )}
                </div>

                <div className="modal-actions">
                  <button
                    type="submit"
                    className="btn-primary-custom"
                    disabled={formUpdate.kembali < 0}
                  >
                    <i className="fas fa-check me-2"></i>
                    Proses Pembayaran
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
            </>
          )}
        </div>
      </Modal>
    </div>
  );
}

export default OrderPage;
