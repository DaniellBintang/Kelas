import React from "react";
import { Container, Row, Col } from "react-bootstrap";
import Nav from "./nav";
import Side from "./side";
import Footer from "./footer";
import { Outlet } from "react-router-dom";

const Front = () => {
  return (
    <div className="d-flex flex-column min-vh-100">
      <Nav />
      <Container fluid className="flex-grow-1">
        <Row>
          <Col md={3} className="p-0">
            <Side />
          </Col>
          <Col md={9} className="p-4">
            <Outlet />
          </Col>
        </Row>
      </Container>
      <Footer />
    </div>
  );
};

export default Front;
