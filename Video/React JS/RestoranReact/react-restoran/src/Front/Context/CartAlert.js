import React from "react";
import { Modal, Button } from "react-bootstrap";
import { ShoppingBag, ArrowRight } from "lucide-react";
import { useNavigate } from "react-router-dom";
import "../css/AlertCart.css"; // Import your custom CSS for styling

function CartAlert({ show, onHide, onViewCart, item }) {
  const navigate = useNavigate();

  const handleViewCart = () => {
    onHide();
    navigate("/cart");
  };
  return (
    <Modal show={show} onHide={onHide} centered className="cart-alert-modal">
      <Modal.Body className="text-center p-4">
        <div className="mb-3">
          <div className="success-icon mb-3">
            <ShoppingBag size={40} className="text-success" />
          </div>
          <h5 className="mb-2">Berhasil Ditambahkan!</h5>
          <p className="text-muted mb-0">
            {item?.menu} telah ditambahkan ke keranjang
          </p>
        </div>
        <div className="d-flex gap-2">
          <Button
            variant="outline-secondary"
            className="flex-grow-1"
            onClick={onHide}
          >
            Lanjut Belanja
          </Button>
          <Button
            variant="primary"
            className="flex-grow-1 d-flex align-items-center justify-content-center"
            onClick={handleViewCart}
          >
            Lihat Keranjang
            <ArrowRight size={18} className="ms-2" />
          </Button>
        </div>
      </Modal.Body>
    </Modal>
  );
}

export default CartAlert;
