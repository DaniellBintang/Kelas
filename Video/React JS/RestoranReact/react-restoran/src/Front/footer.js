import React from "react";
import { Container, Row, Col } from "react-bootstrap";
import { Link } from "react-router-dom";
import useGet from "../Back/Hook/useGet";
import "./css/Footer.css";

function Footer() {
  const [kategori] = useGet("/kategori");

  return (
    <footer className="footer mt-auto py-5 bg-dark text-light">
      <Container>
        <Row>
          <Col md={4}>
            <h5 className="mb-4">Restoran React</h5>
            <p>Jl. React Router No. 123</p>
            <p>Jakarta, Indonesia</p>
            <p>Email: info@restoranreact.com</p>
            <p>Telp: (021) 123-4567</p>
          </Col>
          <Col md={4}>
            <h5 className="mb-4">Menu Kategori</h5>
            <ul className="list-unstyled">
              <li className="mb-2">
                <Link to="/menu" className="text-light text-decoration-none">
                  Semua Menu
                </Link>
              </li>
              {kategori.map((item) => (
                <li key={item.idkategori} className="mb-2">
                  <Link
                    to={`/menu/${item.kategori.toLowerCase()}`}
                    className="text-light text-decoration-none"
                  >
                    {item.kategori}
                  </Link>
                </li>
              ))}
            </ul>
          </Col>
          <Col md={4}>
            <h5 className="mb-4">Jam Operasional</h5>
            <p>Senin - Jumat: 10:00 - 22:00</p>
            <p>Sabtu - Minggu: 10:00 - 23:00</p>
            <div className="mt-4">
              <h5 className="mb-3">Ikuti Kami</h5>
              <div className="social-links">
                <a href="#" className="text-light me-3">
                  <i className="fab fa-facebook"></i>
                </a>
                <a href="#" className="text-light me-3">
                  <i className="fab fa-instagram"></i>
                </a>
                <a href="#" className="text-light me-3">
                  <i className="fab fa-twitter"></i>
                </a>
              </div>
            </div>
          </Col>
        </Row>
        <hr className="my-4" />
        <div className="text-center">
          <p className="mb-0">
            &copy; {new Date().getFullYear()} Restoran React. All rights
            reserved.
          </p>
        </div>
      </Container>
    </footer>
  );
}

export default Footer;
