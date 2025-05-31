import React from "react";
import Side from "./side";
import { Outlet } from "react-router-dom";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Main from "./main";
import Nav from "./nav";
import Footer from "./footer";
import { useEffect } from "react";
import { useNavigate } from "react-router-dom";

function Back() {
  const navigate = useNavigate();

  useEffect(() => {
    const token = localStorage.getItem("api_token");

    // Kalau token tidak ada, redirect ke /login
    if (!token) {
      navigate("/login");
    }
  }, []);
  return (
    <Container fluid className="d-flex flex-column min-vh-100 p-0">
      <Nav />
      <Row className="flex-grow-1 w-100 m-0">
        <Col
          md={3}
          className="bg-light p-0"
          style={{
            height: "100vh",
            position: "sticky",
            top: 0,
            overflowY: "auto",
          }}
        >
          <Side />
        </Col>

        <Col md={9} className="p-4 d-flex flex-column">
          <Main />
          <Outlet />
        </Col>
      </Row>
      <Row className="w-100 m-0">
        <Col className="p-0">
          <Footer />
        </Col>
      </Row>
    </Container>
  );
}

export default Back;
