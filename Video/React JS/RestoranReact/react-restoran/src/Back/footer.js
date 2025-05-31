import React from "react";
import { Container, Row, Col } from "react-bootstrap";
import "./css/FooterStyle.css"; // Import CSS for footer styles

const Footer = () => {
  const currentYear = new Date().getFullYear();
  const level = localStorage.getItem("level");

  const renderQuickMenuItems = () => {
    switch (level) {
      case "admin":
        return (
          <>
            <a
              href="/admin/kategori"
              style={footerStyles.link}
              onMouseEnter={(e) => handleLinkHover(e, true)}
              onMouseLeave={(e) => handleLinkHover(e, false)}
            >
              <i className="bi bi-tags" style={footerStyles.icon}></i>
              Kategori
            </a>
            <a
              href="/admin/menu"
              style={footerStyles.link}
              onMouseEnter={(e) => handleLinkHover(e, true)}
              onMouseLeave={(e) => handleLinkHover(e, false)}
            >
              <i className="bi bi-list-ul" style={footerStyles.icon}></i>
              Menu
            </a>
            <a
              href="/admin/pelanggan"
              style={footerStyles.link}
              onMouseEnter={(e) => handleLinkHover(e, true)}
              onMouseLeave={(e) => handleLinkHover(e, false)}
            >
              <i className="bi bi-people" style={footerStyles.icon}></i>
              Pelanggan
            </a>
            <a
              href="/admin/order"
              style={footerStyles.link}
              onMouseEnter={(e) => handleLinkHover(e, true)}
              onMouseLeave={(e) => handleLinkHover(e, false)}
            >
              <i className="bi bi-cart" style={footerStyles.icon}></i>
              Order
            </a>
            <a
              href="/admin/order-detail"
              style={footerStyles.link}
              onMouseEnter={(e) => handleLinkHover(e, true)}
              onMouseLeave={(e) => handleLinkHover(e, false)}
            >
              <i className="bi bi-card-list" style={footerStyles.icon}></i>
              Detail Order
            </a>
            <a
              href="/admin/user-admin"
              style={footerStyles.link}
              onMouseEnter={(e) => handleLinkHover(e, true)}
              onMouseLeave={(e) => handleLinkHover(e, false)}
            >
              <i className="bi bi-person-badge" style={footerStyles.icon}></i>
              Admin
            </a>
          </>
        );
      case "koki":
        return (
          <a
            href="/admin/order-detail"
            style={footerStyles.link}
            onMouseEnter={(e) => handleLinkHover(e, true)}
            onMouseLeave={(e) => handleLinkHover(e, false)}
          >
            <i className="bi bi-card-list" style={footerStyles.icon}></i>
            Detail Order
          </a>
        );
      case "kasir":
        return (
          <>
            <a
              href="/admin/order"
              style={footerStyles.link}
              onMouseEnter={(e) => handleLinkHover(e, true)}
              onMouseLeave={(e) => handleLinkHover(e, false)}
            >
              <i className="bi bi-cart" style={footerStyles.icon}></i>
              Order
            </a>
            <a
              href="/admin/order-detail"
              style={footerStyles.link}
              onMouseEnter={(e) => handleLinkHover(e, true)}
              onMouseLeave={(e) => handleLinkHover(e, false)}
            >
              <i className="bi bi-card-list" style={footerStyles.icon}></i>
              Detail Order
            </a>
          </>
        );
      default:
        return null;
    }
  };

  const footerStyles = {
    footer: {
      backgroundColor: "#2c3e50",
      color: "#ecf0f1",
      padding: "2rem 0 1rem 0",
      marginTop: "auto",
      borderTop: "1px solid rgba(255, 255, 255, 0.1)",
    },

    container: {
      maxWidth: "1200px",
    },

    section: {
      marginBottom: "1.5rem",
    },

    title: {
      fontSize: "1.1rem",
      fontWeight: "600",
      marginBottom: "1rem",
      color: "#ffffff",
      borderBottom: "2px solid #3498db",
      paddingBottom: "0.5rem",
      display: "inline-block",
    },

    text: {
      fontSize: "0.9rem",
      lineHeight: "1.6",
      color: "#bdc3c7",
      marginBottom: "0.5rem",
    },

    link: {
      color: "#3498db",
      textDecoration: "none",
      fontSize: "0.9rem",
      display: "block",
      marginBottom: "0.3rem",
      transition: "color 0.3s ease, padding-left 0.3s ease",
    },

    linkHover: {
      color: "#5dade2",
      paddingLeft: "5px",
    },

    contactItem: {
      display: "flex",
      alignItems: "center",
      marginBottom: "0.1rem",
      marginLeft: "1.7rem",
      fontSize: "0.9rem",
      color: "#bdc3c7",
    },

    icon: {
      marginRight: "0.5rem",
      fontSize: "1rem",
      color: "#3498db",
      width: "20px",
      textAlign: "center",
    },

    socialLinks: {
      display: "flex",
      gap: "1rem",
      marginTop: "1rem",
    },

    socialLink: {
      color: "#bdc3c7",
      fontSize: "1.2rem",
      transition: "color 0.3s ease, transform 0.3s ease",
      textDecoration: "none",
    },

    bottomSection: {
      borderTop: "1px solid rgba(255, 255, 255, 0.1)",
      paddingTop: "1rem",
      marginTop: "1.5rem",
      textAlign: "center",
    },

    copyright: {
      fontSize: "0.85rem",
      color: "#95a5a6",
      margin: 0,
    },

    divider: {
      color: "#7f8c8d",
      margin: "0 0.5rem",
    },

    bottomLinks: {
      display: "flex",
      justifyContent: "center",
      alignItems: "center",
      gap: "1rem",
      marginTop: "0.5rem",
      flexWrap: "wrap",
    },

    bottomLink: {
      color: "#95a5a6",
      textDecoration: "none",
      fontSize: "0.85rem",
      transition: "color 0.3s ease",
    },
  };

  const handleLinkHover = (e, isHover) => {
    if (isHover) {
      e.target.style.color = footerStyles.linkHover.color;
      e.target.style.paddingLeft = footerStyles.linkHover.paddingLeft;
    } else {
      e.target.style.color = footerStyles.link.color;
      e.target.style.paddingLeft = "0";
    }
  };

  const handleSocialHover = (e, isHover) => {
    if (isHover) {
      e.target.style.color = "#3498db";
      e.target.style.transform = "translateY(-2px)";
    } else {
      e.target.style.color = footerStyles.socialLink.color;
      e.target.style.transform = "translateY(0)";
    }
  };

  const handleBottomLinkHover = (e, isHover) => {
    e.target.style.color = isHover ? "#bdc3c7" : footerStyles.bottomLink.color;
  };

  return (
    <footer style={footerStyles.footer}>
      <Container fluid style={footerStyles.container}>
        <Row>
          {/* Company Info */}
          <Col md={4} style={footerStyles.section}>
            <h5 style={footerStyles.title}>Tentang Kami</h5>
            <p style={footerStyles.text}>
              Sistem manajemen restoran yang membantu mengelola menu, pesanan,
              dan operasional bisnis Anda dengan mudah dan efisien.
            </p>
            <div style={footerStyles.socialLinks}>
              <a
                href="#"
                style={footerStyles.socialLink}
                onMouseEnter={(e) => handleSocialHover(e, true)}
                onMouseLeave={(e) => handleSocialHover(e, false)}
                aria-label="Facebook"
              >
                <i className="bi bi-facebook"></i>
              </a>
              <a
                href="#"
                style={footerStyles.socialLink}
                onMouseEnter={(e) => handleSocialHover(e, true)}
                onMouseLeave={(e) => handleSocialHover(e, false)}
                aria-label="Instagram"
              >
                <i className="bi bi-instagram"></i>
              </a>
              <a
                href="#"
                style={footerStyles.socialLink}
                onMouseEnter={(e) => handleSocialHover(e, true)}
                onMouseLeave={(e) => handleSocialHover(e, false)}
                aria-label="Twitter"
              >
                <i className="bi bi-twitter"></i>
              </a>
              <a
                href="#"
                style={footerStyles.socialLink}
                onMouseEnter={(e) => handleSocialHover(e, true)}
                onMouseLeave={(e) => handleSocialHover(e, false)}
                aria-label="LinkedIn"
              >
                <i className="bi bi-linkedin"></i>
              </a>
            </div>
          </Col>

          {/* Quick Links */}
          <Col md={3} style={footerStyles.section}>
            <h5 style={footerStyles.title}>Menu Cepat</h5>
            {renderQuickMenuItems()}
          </Col>

          {/* Support Links */}
          <Col md={2} style={footerStyles.section}>
            <h5 style={footerStyles.title}>Bantuan</h5>
            <a
              href="#"
              style={footerStyles.link}
              onMouseEnter={(e) => handleLinkHover(e, true)}
              onMouseLeave={(e) => handleLinkHover(e, false)}
            >
              Panduan
            </a>
            <a
              href="#"
              style={footerStyles.link}
              onMouseEnter={(e) => handleLinkHover(e, true)}
              onMouseLeave={(e) => handleLinkHover(e, false)}
            >
              FAQ
            </a>
            <a
              href="#"
              style={footerStyles.link}
              onMouseEnter={(e) => handleLinkHover(e, true)}
              onMouseLeave={(e) => handleLinkHover(e, false)}
            >
              Dukungan
            </a>
            <a
              href="#"
              style={footerStyles.link}
              onMouseEnter={(e) => handleLinkHover(e, true)}
              onMouseLeave={(e) => handleLinkHover(e, false)}
            >
              Kontak
            </a>
          </Col>

          {/* Contact Info */}
          <Col md={3} style={footerStyles.section}>
            <h5 style={footerStyles.title}>Kontak</h5>
            <div style={footerStyles.contactItem}>
              <i className="bi bi-geo-alt" style={footerStyles.icon}></i>
              <span>Jl. Contoh No. 123, Jakarta</span>
            </div>
            <div style={footerStyles.contactItem}>
              <i className="bi bi-telephone" style={footerStyles.icon}></i>
              <span>+62 812-3456-7890</span>
            </div>
            <div style={footerStyles.contactItem}>
              <i className="bi bi-envelope" style={footerStyles.icon}></i>
              <span>info@restaurant.com</span>
            </div>
            <div style={footerStyles.contactItem}>
              <i className="bi bi-clock" style={footerStyles.icon}></i>
              <span>Senin - Minggu: 09:00 - 22:00</span>
            </div>
          </Col>
        </Row>

        {/* Bottom Section */}
        <div style={footerStyles.bottomSection}>
          <p style={footerStyles.copyright}>
            © {currentYear} Restaurant Management System. All rights reserved.
          </p>
          <div style={footerStyles.bottomLinks}>
            <a
              href="#"
              style={footerStyles.bottomLink}
              onMouseEnter={(e) => handleBottomLinkHover(e, true)}
              onMouseLeave={(e) => handleBottomLinkHover(e, false)}
            >
              Kebijakan Privasi
            </a>
            <span style={footerStyles.divider}>|</span>
            <a
              href="#"
              style={footerStyles.bottomLink}
              onMouseEnter={(e) => handleBottomLinkHover(e, true)}
              onMouseLeave={(e) => handleBottomLinkHover(e, false)}
            >
              Syarat & Ketentuan
            </a>
            <span style={footerStyles.divider}>|</span>
            <a
              href="#"
              style={footerStyles.bottomLink}
              onMouseEnter={(e) => handleBottomLinkHover(e, true)}
              onMouseLeave={(e) => handleBottomLinkHover(e, false)}
            >
              Sitemap
            </a>
          </div>
        </div>
      </Container>
    </footer>
  );
};

export default Footer;
