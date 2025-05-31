import React from "react";
import { Nav } from "react-bootstrap";
import { Link } from "react-router-dom";
import useGet from "../Back/Hook/useGet";

function Side() {
  const [kategori] = useGet("/kategori");

  const getIconForCategory = (categoryName) => {
    // Add more icons as needed
    const icons = {
      makanan: "bi-egg-fried",
      minuman: "bi-cup-straw",
      dessert: "bi-cupcake",
      default: "bi-tag", // Default icon
    };

    const lowercaseCategory = categoryName.toLowerCase();
    return icons[lowercaseCategory] || icons.default;
  };

  return (
    <aside
      className="d-flex flex-column align-items-start p-3 bg-white rounded shadow-sm"
      style={{ minHeight: "100vh", borderRight: "1px solid #eee" }}
    >
      <h4 className="mb-4 text-primary">Menu Kategori</h4>
      <Nav className="flex-column w-100">
        <Nav.Item className="mb-2">
          <Nav.Link
            as={Link}
            to="/menu"
            className="d-flex align-items-center text-dark"
            style={{ fontWeight: 500 }}
          >
            <span className="me-2 bi bi-grid"></span>
            Semua Menu
          </Nav.Link>
        </Nav.Item>
        {kategori.map((item) => (
          <Nav.Item key={item.idkategori} className="mb-2">
            <Nav.Link
              as={Link}
              to={`/menu/${item.kategori.toLowerCase()}`}
              className="d-flex align-items-center text-dark"
              style={{ fontWeight: 500 }}
            >
              <span
                className={`me-2 bi ${getIconForCategory(item.kategori)}`}
              ></span>
              {item.kategori}
            </Nav.Link>
          </Nav.Item>
        ))}
      </Nav>
    </aside>
  );
}

export default Side;
