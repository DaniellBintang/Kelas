"use client";

import { useEffect } from "react";
import useGet from "../Hook/useGet";
import useDelete from "../Hook/useDelete";
import "../css/PelangganStyle.css";

function PelangganPage() {
  const [isi, reload] = useGet("/pelanggan");
  const { handleDelete, pesan, setPesan } = useDelete("/pelanggan", reload);

  // Auto-hilangkan alert setelah 3 detik
  useEffect(() => {
    if (pesan) {
      const timer = setTimeout(() => setPesan(""), 3000);
      return () => clearTimeout(timer);
    }
  }, [pesan, setPesan]);

  const confirmDelete = (id, nama) => {
    if (
      window.confirm(`Apakah Anda yakin ingin menghapus pelanggan "${nama}"?`)
    ) {
      handleDelete(id);
    }
  };

  return (
    <div className="pelanggan-page">
      <div className="container-fluid px-4 py-4">
        {/* Header */}
        <div className="page-header mb-4">
          <div className="mx-3 d-flex align-items-center justify-content-between">
            <div className="d-flex align-items-center">
              <div className="header-icon me-3">
                <i className="fas fa-users"></i>
              </div>
              <div>
                <h2 className="page-title mb-1">Manajemen Pelanggan</h2>
                <p className="page-subtitle mb-0">
                  Kelola data pelanggan restoran
                </p>
              </div>
            </div>
            <div className="header-stats">
              <div className="stat-card">
                <div className="stat-number">{isi.length}</div>
                <div className="stat-label">Total Pelanggan</div>
              </div>
            </div>
          </div>
        </div>

        {/* Alert */}
        {pesan && (
          <div className="custom-alert success mb-4">
            <div className="alert-content">
              <i className="fas fa-check-circle me-2"></i>
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
                  <i className="fas fa-list me-2"></i>
                  Daftar Pelanggan
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
                        <th width="15%">ID Pelanggan</th>
                        <th width="25%">Nama Pelanggan</th>
                        <th width="35%">Alamat</th>
                        <th width="15%">No. Telepon</th>
                        <th width="10%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      {isi.length > 0 ? (
                        isi.map((val, idx) => (
                          <tr key={idx}>
                            <td>
                              <span className="id-badge">
                                {val.idpelanggan}
                              </span>
                            </td>
                            <td>
                              <div className="customer-info">
                                <div className="customer-avatar">
                                  <i className="fas fa-user"></i>
                                </div>
                                <div className="customer-name">{val.nama}</div>
                              </div>
                            </td>
                            <td>
                              <div className="address-text">
                                <i className="fas fa-map-marker-alt me-2 text-muted"></i>
                                {val.alamat}
                              </div>
                            </td>
                            <td>
                              <div className="phone-text">
                                <i className="fas fa-phone me-2 text-muted"></i>
                                {val.telp}
                              </div>
                            </td>
                            <td>
                              <div className="action-buttons">
                                <button
                                  className="btn-delete"
                                  onClick={() =>
                                    confirmDelete(val.idpelanggan, val.nama)
                                  }
                                  title="Hapus pelanggan"
                                >
                                  <i className="fas fa-trash"></i>
                                </button>
                              </div>
                            </td>
                          </tr>
                        ))
                      ) : (
                        <tr>
                          <td colSpan="5" className="empty-state">
                            <div className="empty-content">
                              <i className="fas fa-users fa-3x mb-3"></i>
                              <h5 className="mb-2">Belum Ada Pelanggan</h5>
                              <p className="mb-0 text-muted">
                                Belum ada data pelanggan yang terdaftar
                              </p>
                            </div>
                          </td>
                        </tr>
                      )}
                    </tbody>
                  </table>
                </div>
              </div>

              {/* Table Footer */}
              {isi.length > 0 && (
                <div className="table-footer">
                  <div className="footer-info">
                    <span className="text-muted">
                      Menampilkan {isi.length} pelanggan
                    </span>
                  </div>
                </div>
              )}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

export default PelangganPage;
