import React, { useState } from "react";
import { useParams, useNavigate } from "react-router-dom"; // Add useNavigate
import { Card, Row, Col, Button } from "react-bootstrap";
import useGet from "../Back/Hook/useGet";
import "./css/MenuStyle.css";
import { useCart } from "./Context/Cart";
import { ShoppingCart } from "lucide-react";
import CartAlert from "./Context/CartAlert";

function Menu() {
  const { category } = useParams();
  const navigate = useNavigate(); // Add this line
  const [menuItems] = useGet("/menu");
  const [showCart, setShowCart] = useState(false);
  const [alertItem, setAlertItem] = useState(null);
  const { addToCart } = useCart();

  const filteredMenu = menuItems.filter(
    (item) => item.kategori.toLowerCase() === category
  );

  const getCategoryIcon = (category) => {
    const lowerCategory = category.toLowerCase();
    switch (lowerCategory) {
      case "makanan":
        return "fas fa-utensils";
      case "minuman":
        return "fas fa-glass-martini-alt";
      case "buah-buahan":
        return "fas fa-apple-alt";
      default:
        return "fas fa-utensils";
    }
  };

  const handleAddToCart = (item) => {
    const token = localStorage.getItem("customer_token");
    if (!token) {
      navigate("/login", {
        state: { from: `/menu/${category}` },
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
              <i className={getCategoryIcon(category)}></i>
            </div>
            <div>
              <h2 className="page-title mb-1 text-capitalize">{category}</h2>
              <p className="page-subtitle mb-0">
                Daftar menu untuk kategori {category}
              </p>
            </div>
          </div>
        </div>

        <Row xs={1} md={2} lg={3} className="g-4">
          {filteredMenu.map((item) => (
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
          {filteredMenu.length === 0 && (
            <Col xs={12}>
              <div className="text-center empty-menu py-5">
                <i className="fas fa-utensils fa-2x mb-3"></i>
                <h4>Tidak ada menu dalam kategori ini</h4>
              </div>
            </Col>
          )}
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
export default Menu;
