import React from "react";
import { Navbar, Container, Nav, Button } from "react-bootstrap";
import { Link, useNavigate } from "react-router-dom";
import { ShoppingCart } from "lucide-react";
import "./css/NavStyles.css"; // Import your custom CSS for styling

function NavigationBar() {
  const navigate = useNavigate();
  const customerEmail = localStorage.getItem("customer_email");
  const isLoggedIn = !!localStorage.getItem("customer_token");

  const handleLogout = () => {
    localStorage.removeItem("customer_token");
    localStorage.removeItem("customer_email");
    localStorage.removeItem("customer_id");
    navigate("/menu");
  };

  return (
    <Navbar bg="white" expand="lg" className="shadow-sm">
      <Container>
        <Navbar.Brand as={Link} to="/" className="fw-bold">
          Restoran React
        </Navbar.Brand>
        <Navbar.Toggle aria-controls="basic-navbar-nav" />
        <Navbar.Collapse id="basic-navbar-nav">
          <Nav className="ms-auto align-items-center">
            {isLoggedIn ? (
              <>
                <Nav.Link as={Link} to="/cart" className="me-3">
                  <ShoppingCart size={20} />
                </Nav.Link>
                <span className="me-3 text-muted">{customerEmail}</span>
                <Button
                  variant="outline-danger"
                  size="sm"
                  onClick={handleLogout}
                >
                  Logout
                </Button>
              </>
            ) : (
              <>
                <Nav.Link as={Link} to="/login" className="me-2">
                  Login
                </Nav.Link>
                <Nav.Link as={Link} to="/register">
                  <Button variant="primary" size="sm">
                    Register
                  </Button>
                </Nav.Link>
              </>
            )}
          </Nav>
        </Navbar.Collapse>
      </Container>
    </Navbar>
  );
}

export default NavigationBar;
