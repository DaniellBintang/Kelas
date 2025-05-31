import React from "react";
import { Container, Button } from "react-bootstrap";
import { Link, useParams } from "react-router-dom";
import { CheckCircle } from "lucide-react";

function OrderSuccess() {
  const { orderId } = useParams();

  return (
    <Container className="py-5 text-center">
      <div className="success-icon mb-4">
        <CheckCircle size={64} className="text-success" />
      </div>
      <h2 className="mb-3">Pesanan Berhasil!</h2>
      <p className="text-muted mb-4">
        Terima kasih telah memesan. Nomor pesanan Anda adalah #{orderId}
      </p>
      <div className="d-flex justify-content-center gap-3">
        <Link to="/menu" className="btn btn-primary">
          Pesan Lagi
        </Link>
        <Link to="/order-history" className="btn btn-outline-secondary">
          Lihat Pesanan
        </Link>
      </div>
    </Container>
  );
}

export default OrderSuccess;
