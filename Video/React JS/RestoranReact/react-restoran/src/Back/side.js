import React, { useState } from "react";
import { Nav } from "react-bootstrap";
import { Link, useLocation } from "react-router-dom";
import "./css/SideStyle.css";

const Side = () => {
  const [hoveredItem, setHoveredItem] = useState(null);
  const location = useLocation();
  const level = localStorage.getItem("level");

  const getMenuItems = () => {
    const commonStyles = {
      "order-detail": {
        path: "/admin/order-detail",
        icon: "bi-card-list",
        label: "Order Detail",
        color: "#f59e0b",
      },
      order: {
        path: "/admin/order",
        icon: "bi-cart",
        label: "Order",
        color: "#10b981",
      },
    };

    switch (level) {
      case "admin":
        return [
          {
            path: "/admin/kategori",
            icon: "bi-tags",
            label: "Kategori",
            color: "#6366f1",
          },
          {
            path: "/admin/menu",
            icon: "bi-list-ul",
            label: "Menu",
            color: "#8b5cf6",
          },
          {
            path: "/admin/pelanggan",
            icon: "bi-people",
            label: "Pelanggan",
            color: "#06b6d4",
          },
          commonStyles.order,
          commonStyles["order-detail"],
          {
            path: "/admin/user-admin",
            icon: "bi-person-badge",
            label: "Admin",
            color: "#ef4444",
          },
        ];
      case "koki":
        return [commonStyles["order-detail"]];
      case "kasir":
        return [commonStyles.order, commonStyles["order-detail"]];
      default:
        return [];
    }
  };

  const menuItems = getMenuItems();
  const isActive = (path) => location.pathname === path;

  return (
    <aside
      style={{
        minHeight: "100vh",
        background: "linear-gradient(135deg, #667eea 0%, #764ba2 100%)",
        boxShadow: "4px 0 20px rgba(0, 0, 0, 0.1)",
        position: "relative",
        overflow: "hidden",
        display: "flex",
        flexDirection: "column",
      }}
    >
      {/* Decorative elements */}
      <div
        style={{
          position: "absolute",
          width: "200px",
          height: "200px",
          borderRadius: "50%",
          background: "rgba(255, 255, 255, 0.05)",
          top: "-100px",
          right: "-100px",
          zIndex: 0,
        }}
      />

      <div
        style={{
          position: "absolute",
          width: "150px",
          height: "150px",
          borderRadius: "50%",
          background: "rgba(255, 255, 255, 0.03)",
          bottom: "-75px",
          left: "-75px",
          zIndex: 0,
        }}
      />

      <div
        style={{
          position: "relative",
          zIndex: 1,
          flex: 1,
          display: "flex",
          flexDirection: "column",
        }}
      >
        {/* Header */}
        <div
          style={{
            color: "white",
            fontWeight: "700",
            fontSize: "1.5rem",
            textAlign: "center",
            padding: "1.5rem 0",
            borderBottom: "2px solid rgba(255, 255, 255, 0.2)",
            background: "rgba(255, 255, 255, 0.05)",
            backdropFilter: "blur(10px)",
          }}
        >
          <span className="bi bi-speedometer2 me-2"></span>
          Dashboard
        </div>

        <Nav className="flex-column" style={{ padding: "0 12px" }}>
          {menuItems.map((item, index) => (
            <Nav.Item key={item.path} style={{ margin: "8px 0" }}>
              <Nav.Link
                as={Link}
                to={item.path}
                style={{
                  padding: "12px 20px",
                  borderRadius: "12px",
                  transition: "all 0.3s cubic-bezier(0.4, 0, 0.2, 1)",
                  display: "flex",
                  alignItems: "center",
                  textDecoration: "none",
                  color: isActive(item.path) ? "#1f2937" : "white",
                  background: isActive(item.path)
                    ? "rgba(255, 255, 255, 0.95)"
                    : hoveredItem === index
                    ? "rgba(255, 255, 255, 0.15)"
                    : "transparent",
                  transform:
                    hoveredItem === index
                      ? "translateX(8px) scale(1.02)"
                      : "translateX(0) scale(1)",
                  boxShadow: isActive(item.path)
                    ? "0 8px 25px rgba(0, 0, 0, 0.15)"
                    : hoveredItem === index
                    ? "0 4px 15px rgba(0, 0, 0, 0.1)"
                    : "none",
                  border: isActive(item.path)
                    ? "2px solid rgba(255, 255, 255, 0.3)"
                    : "2px solid transparent",
                }}
                onMouseEnter={() => setHoveredItem(index)}
                onMouseLeave={() => setHoveredItem(null)}
              >
                {/* ...existing Nav.Link content... */}
                <span
                  className={`${item.icon} me-3`}
                  style={{
                    fontSize: "1.2rem",
                    color: isActive(item.path) ? item.color : "white",
                    transition: "all 0.3s ease",
                    transform:
                      hoveredItem === index ? "scale(1.1)" : "scale(1)",
                  }}
                />
                <span
                  style={{
                    fontSize: "0.95rem",
                    fontWeight: isActive(item.path) ? "600" : "500",
                    letterSpacing: "0.025em",
                  }}
                >
                  {item.label}
                </span>

                {isActive(item.path) && (
                  <div
                    style={{
                      marginLeft: "auto",
                      width: "4px",
                      height: "4px",
                      borderRadius: "50%",
                      background: item.color,
                      boxShadow: `0 0 10px ${item.color}`,
                    }}
                  />
                )}
              </Nav.Link>
            </Nav.Item>
          ))}
        </Nav>

        {/* User info section - now sticky */}
        <div
          style={{
            position: "sticky",
            bottom: 0,
            left: 0,
            right: 0,
            padding: "16px",
            background: "rgba(255, 255, 255, 0.1)",
            backdropFilter: "blur(10px)",
            borderTop: "1px solid rgba(255, 255, 255, 0.2)",
            zIndex: 2,
          }}
        >
          <div
            style={{
              display: "flex",
              alignItems: "center",
              color: "white",
            }}
          >
            <div
              style={{
                width: "40px",
                height: "40px",
                borderRadius: "50%",
                background: "linear-gradient(45deg, #ff6b6b, #4ecdc4)",
                display: "flex",
                alignItems: "center",
                justifyContent: "center",
                marginRight: "12px",
                fontSize: "1.2rem",
              }}
            >
              <span className="bi bi-person-circle"></span>
            </div>
            <div>
              <div style={{ fontSize: "0.9rem", fontWeight: "600" }}>
                Admin User
              </div>
              <div style={{ fontSize: "0.75rem", opacity: 0.8 }}>
                {level?.toUpperCase()}
              </div>
            </div>
          </div>
        </div>
      </div>
    </aside>
  );
};

export default Side;
