import React, { useState } from "react";
import { useNavigate } from "react-router-dom"; // Add useNavigate
import { Card, Row, Col, Button } from "react-bootstrap";
import useGet from "../Back/Hook/useGet";
import "./css/MenuStyle.css";
import { useCart } from "./Context/Cart";
import { ShoppingCart } from "lucide-react";
import CartAlert from "./Context/CartAlert";

function AllMenu() {
  const navigate = useNavigate(); // Add this line
  const [menuItems] = useGet("/menu");
  const [showCart, setShowCart] = useState(false);
  const [alertItem, setAlertItem] = useState(null);
  const { addToCart } = useCart();

  const handleAddToCart = (item) => {
    const token = localStorage.getItem("customer_token");
    if (!token) {
      navigate("/login", {
        state: { from: "/menu" }, // Remove category reference
        replace: true,
      });
      return;
    }

    addToCart(item);
    setAlertItem(item);
  };

  const handleViewCart = () => {
    setShowCart(true);
    setAlertItem(null);
  };

  return (
    <div className="menu-page">
      <div className="container">
        <div className="page-header mb-4">
          <div className="mx-3 d-flex align-items-center">
            <div className="header-icon me-3">
              <i className="fas fa-utensils"></i>
            </div>
            <div>
              <h2 className="page-title mb-1">Semua Menu</h2>
              <p className="page-subtitle mb-0">
                Lihat semua menu yang tersedia
              </p>
            </div>
          </div>
        </div>

        <Row xs={1} md={2} lg={3} className="g-4">
          {menuItems.map((item) => (
            <Col key={item.idmenu}>
              <Card className="menu-card h-100 shadow-sm">
                {item.gambar && (
                  <div className="card-img-wrapper">
                    <Card.Img
                      variant="top"
                      src={item.gambar}
                      className="menu-image"
                    />
                  </div>
                )}
                <Card.Body className="d-flex flex-column">
                  <div className="category-badge mb-2">
                    <span className="badge bg-light text-primary">
                      {item.kategori}
                    </span>
                  </div>
                  <Card.Title className="menu-title">{item.menu}</Card.Title>
                  <Card.Text className="menu-price mb-3">
                    Rp {parseInt(item.harga).toLocaleString("id-ID")}
                  </Card.Text>
                  <Button
                    variant="primary"
                    className="mt-auto cart-button"
                    onClick={() => handleAddToCart(item)}
                  >
                    <ShoppingCart size={18} className="me-2" />
                    Masukkan Keranjang
                  </Button>
                </Card.Body>
              </Card>
            </Col>
          ))}
        </Row>
      </div>
      <CartAlert
        show={alertItem !== null}
        onHide={() => setAlertItem(null)}
        onViewCart={handleViewCart}
        item={alertItem}
      />
    </div>
  );
}

export default AllMenu;
