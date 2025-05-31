// styles.js - Object styles untuk React component
export const sidebarStyles = {
  container: {
    minHeight: "100vh",
    background: "linear-gradient(135deg, #667eea 0%, #764ba2 100%)",
    boxShadow: "4px 0 20px rgba(0, 0, 0, 0.1)",
    position: "relative",
    overflow: "hidden",
    display: "flex",
    flexDirection: "column",
    width: "280px",
    transition: "width 0.3s ease",
  },

  decorativeCircle1: {
    position: "absolute",
    width: "200px",
    height: "200px",
    borderRadius: "50%",
    background: "rgba(255, 255, 255, 0.05)",
    top: "-100px",
    right: "-100px",
    zIndex: 0,
  },

  decorativeCircle2: {
    position: "absolute",
    width: "150px",
    height: "150px",
    borderRadius: "50%",
    background: "rgba(255, 255, 255, 0.03)",
    bottom: "-75px",
    left: "-75px",
    zIndex: 0,
  },

  content: {
    position: "relative",
    zIndex: 1,
    flex: 1,
    display: "flex",
    flexDirection: "column",
  },

  header: {
    color: "white",
    fontWeight: "700",
    fontSize: "1.5rem",
    textAlign: "center",
    padding: "1.5rem 0",
    borderBottom: "2px solid rgba(255, 255, 255, 0.2)",
    background: "rgba(255, 255, 255, 0.05)",
    backdropFilter: "blur(10px)",
    marginBottom: "1rem",
  },

  nav: {
    padding: "0 12px",
    flex: 1,
  },

  navItem: {
    margin: "8px 0",
  },

  navLink: (isActive, isHovered) => ({
    padding: "12px 20px",
    borderRadius: "12px",
    transition: "all 0.3s cubic-bezier(0.4, 0, 0.2, 1)",
    display: "flex",
    alignItems: "center",
    textDecoration: "none",
    color: isActive ? "#1f2937" : "white",
    background: isActive
      ? "rgba(255, 255, 255, 0.95)"
      : isHovered
      ? "rgba(255, 255, 255, 0.15)"
      : "transparent",
    transform: isHovered
      ? "translateX(8px) scale(1.02)"
      : "translateX(0) scale(1)",
    boxShadow: isActive
      ? "0 8px 25px rgba(0, 0, 0, 0.15)"
      : isHovered
      ? "0 4px 15px rgba(0, 0, 0, 0.1)"
      : "none",
    border: isActive
      ? "2px solid rgba(255, 255, 255, 0.3)"
      : "2px solid transparent",
    position: "relative",
    overflow: "hidden",
  }),

  navIcon: (isActive, isHovered, color) => ({
    fontSize: "1.2rem",
    marginRight: "12px",
    color: isActive ? color : "white",
    transition: "all 0.3s ease",
    transform: isHovered ? "scale(1.1)" : "scale(1)",
    width: "20px",
    textAlign: "center",
  }),

  navLabel: (isActive) => ({
    fontSize: "0.95rem",
    fontWeight: isActive ? "600" : "500",
    letterSpacing: "0.025em",
    flex: 1,
  }),

  activeIndicator: (color) => ({
    width: "4px",
    height: "4px",
    borderRadius: "50%",
    background: color,
    boxShadow: `0 0 10px ${color}`,
    marginLeft: "auto",
  }),

  userInfo: {
    position: "sticky",
    bottom: 0,
    left: 0,
    right: 0,
    padding: "16px",
    background: "rgba(255, 255, 255, 0.1)",
    backdropFilter: "blur(10px)",
    borderTop: "1px solid rgba(255, 255, 255, 0.2)",
    zIndex: 2,
  },

  userProfile: {
    display: "flex",
    alignItems: "center",
    color: "white",
  },

  userAvatar: {
    width: "40px",
    height: "40px",
    borderRadius: "50%",
    background: "linear-gradient(45deg, #ff6b6b, #4ecdc4)",
    display: "flex",
    alignItems: "center",
    justifyContent: "center",
    marginRight: "12px",
    fontSize: "1.2rem",
    boxShadow: "0 2px 10px rgba(0, 0, 0, 0.2)",
  },

  userName: {
    fontSize: "0.9rem",
    fontWeight: "600",
    marginBottom: "2px",
  },

  userRole: {
    fontSize: "0.75rem",
    opacity: 0.8,
    textTransform: "uppercase",
    letterSpacing: "0.5px",
  },
};

// Media queries untuk responsive (gunakan dengan library seperti react-responsive atau custom hooks)
export const breakpoints = {
  mobile: "(max-width: 768px)",
  smallMobile: "(max-width: 480px)",
};

export const responsiveStyles = {
  mobile: {
    container: {
      width: "100%",
      position: "fixed",
      top: 0,
      left: 0,
      zIndex: 1000,
      transform: "translateX(-100%)",
      transition: "transform 0.3s ease",
    },
    containerOpen: {
      transform: "translateX(0)",
    },
    header: {
      fontSize: "1.3rem",
      padding: "1rem 0",
    },
    navLink: {
      padding: "10px 16px",
    },
  },
  smallMobile: {
    container: {
      width: "100vw",
    },
    header: {
      fontSize: "1.2rem",
    },
    navLabel: {
      fontSize: "0.9rem",
    },
    userAvatar: {
      width: "35px",
      height: "35px",
      fontSize: "1rem",
    },
    userName: {
      fontSize: "0.85rem",
    },
  },
};
