import React, { useState, useEffect } from "react";
import {
  Container,
  Row,
  Col,
  Button,
  Table,
  Form,
  Modal,
} from "react-bootstrap";
import { useCart } from "./Context/Cart";
import { Minus, Plus, Trash2 } from "lucide-react";
import { Link, useNavigate } from "react-router-dom";
import axios from "../Axios/link";
import "./css/Cart.css";

function Cart() {
  const { cart, removeFromCart, updateQuantity, total, clearCart } = useCart();
  const navigate = useNavigate();
  const [showCheckout, setShowCheckout] = useState(false);
  const [customerInfo, setCustomerInfo] = useState({
    nama_pelanggan: "",
    alamat_pelanggan: "",
    no_telp: "",
  });
  const [isLoading, setIsLoading] = useState(false);
  const [error, setError] = useState("");

  // Add authentication check
  useEffect(() => {
    const token = localStorage.getItem("customer_token");
    if (!token) {
      navigate("/login", {
        state: { from: "/cart" },
        replace: true,
      });
    }
  }, [navigate]);

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setCustomerInfo((prev) => ({
      ...prev,
      [name]: value,
    }));
  };

  const handleCheckout = async (e) => {
    e.preventDefault();
    setIsLoading(true);
    setError("");

    // Check authentication before proceeding
    const token = localStorage.getItem("customer_token");
    if (!token) {
      navigate("/login", {
        state: { from: "/cart" },
        replace: true,
      });
      return;
    }

    try {
      // Create order data
      const orderData = {
        nama_pelanggan: customerInfo.nama_pelanggan,
        alamat_pelanggan: customerInfo.alamat_pelanggan,
        no_telp: customerInfo.no_telp,
        total: total,
        items: cart.map((item) => ({
          idmenu: item.idmenu,
          jumlah: item.quantity,
          harga: item.harga,
          subtotal: item.harga * item.quantity,
        })),
      };

      // Send order to backend
      const response = await axios.post("/order", orderData, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });

      if (response.data.status === 200) {
        clearCart();
        navigate(`/order-success/${response.data.idorder}`);
      } else {
        setError("Gagal memproses pesanan. Silakan coba lagi.");
      }
    } catch (error) {
      if (error.response?.status === 401) {
        navigate("/login", {
          state: { from: "/cart" },
          replace: true,
        });
      } else {
        setError("Terjadi kesalahan. Silakan coba lagi.");
        console.error("Checkout error:", error);
      }
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <Container className="py-4">
      <h2 className="mb-4">Keranjang Belanja</h2>
      {cart.length === 0 ? (
        <div className="text-center py-5">
          <div className="empty-cart-icon mb-3">
            <i className="bi bi-cart-x display-1 text-muted"></i>
          </div>
          <h4 className="text-muted">Keranjang Anda masih kosong</h4>
          <Link to="/menu" className="btn btn-primary mt-3">
            Mulai Belanja
          </Link>
        </div>
      ) : (
        <Row>
          <Col lg={8}>
            <Table responsive className="align-middle">
              <thead>
                <tr>
                  <th>Menu</th>
                  <th>Harga</th>
                  <th>Jumlah</th>
                  <th>Total</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                {cart.map((item) => (
                  <tr key={item.idmenu}>
                    <td>
                      <div className="d-flex align-items-center">
                        <img
                          src={item.gambar}
                          alt={item.menu}
                          className="cart-item-image me-3"
                        />
                        <span>{item.menu}</span>
                      </div>
                    </td>
                    <td>Rp {parseInt(item.harga).toLocaleString("id-ID")}</td>
                    <td>
                      <div className="quantity-control">
                        <Button
                          variant="outline-secondary"
                          size="sm"
                          onClick={() =>
                            updateQuantity(item.idmenu, item.quantity - 1)
                          }
                        >
                          <Minus size={14} />
                        </Button>
                        <span className="mx-2">{item.quantity}</span>
                        <Button
                          variant="outline-secondary"
                          size="sm"
                          onClick={() =>
                            updateQuantity(item.idmenu, item.quantity + 1)
                          }
                        >
                          <Plus size={14} />
                        </Button>
                      </div>
                    </td>
                    <td>
                      Rp {(item.harga * item.quantity).toLocaleString("id-ID")}
                    </td>
                    <td>
                      <Button
                        variant="link"
                        className="text-danger p-0"
                        onClick={() => removeFromCart(item.idmenu)}
                      >
                        <Trash2 size={18} />
                      </Button>
                    </td>
                  </tr>
                ))}
              </tbody>
            </Table>
          </Col>
          <Col lg={4}>
            <div className="cart-summary p-4 bg-light rounded">
              <h4 className="mb-4">Ringkasan Belanja</h4>
              <div className="d-flex justify-content-between mb-3">
                <span>Total ({cart.length} item)</span>
                <span>Rp {total.toLocaleString("id-ID")}</span>
              </div>
              <Button
                variant="primary"
                className="w-100"
                onClick={() => setShowCheckout(true)}
                disabled={cart.length === 0}
              >
                Lanjut ke Pembayaran
              </Button>
              <Link
                to="/menu"
                className="btn btn-link text-decoration-none w-100"
              >
                Lanjut Belanja
              </Link>
            </div>
          </Col>
        </Row>
      )}
      {/* Checkout Modal */}
      <Modal
        show={showCheckout}
        onHide={() => setShowCheckout(false)}
        size="lg"
      >
        <Modal.Header closeButton>
          <Modal.Title>Informasi Pengiriman</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          {error && <div className="alert alert-danger">{error}</div>}
          <Form onSubmit={handleCheckout}>
            <Form.Group className="mb-3">
              <Form.Label>Nama Lengkap</Form.Label>
              <Form.Control
                type="text"
                name="nama_pelanggan"
                value={customerInfo.nama_pelanggan}
                onChange={handleInputChange}
                required
              />
            </Form.Group>
            <Form.Group className="mb-3">
              <Form.Label>Alamat Pengiriman</Form.Label>
              <Form.Control
                as="textarea"
                rows={3}
                name="alamat_pelanggan"
                value={customerInfo.alamat_pelanggan}
                onChange={handleInputChange}
                required
              />
            </Form.Group>
            <Form.Group className="mb-3">
              <Form.Label>Nomor Telepon</Form.Label>
              <Form.Control
                type="tel"
                name="no_telp"
                value={customerInfo.no_telp}
                onChange={handleInputChange}
                required
              />
            </Form.Group>
            <div className="border-top pt-3 mt-3">
              <h5 className="mb-3">Detail Pesanan</h5>
              {cart.map((item) => (
                <div
                  key={item.idmenu}
                  className="d-flex justify-content-between mb-2"
                >
                  <span>
                    {item.menu} x {item.quantity}
                  </span>
                  <span>
                    Rp {(item.harga * item.quantity).toLocaleString("id-ID")}
                  </span>
                </div>
              ))}
              <div className="d-flex justify-content-between mt-3 pt-3 border-top">
                <strong>Total</strong>
                <strong>Rp {total.toLocaleString("id-ID")}</strong>
              </div>
            </div>
            <div className="d-flex justify-content-end gap-2 mt-4">
              <Button
                variant="secondary"
                onClick={() => setShowCheckout(false)}
              >
                Batal
              </Button>
              <Button variant="primary" type="submit" disabled={isLoading}>
                {isLoading ? "Memproses..." : "Konfirmasi Pesanan"}
              </Button>
            </div>
          </Form>
        </Modal.Body>
      </Modal>
    </Container>
  );
}

export default Cart;
