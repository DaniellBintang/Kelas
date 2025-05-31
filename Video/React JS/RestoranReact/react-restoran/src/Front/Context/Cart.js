import React, { createContext, useContext, useState, useEffect } from "react";

const CartContext = createContext();

export const CartProvider = ({ children }) => {
  const [cart, setCart] = useState(() => {
    const savedCart = sessionStorage.getItem("cart");
    return savedCart ? JSON.parse(savedCart) : [];
  });

  const [total, setTotal] = useState(0);

  useEffect(() => {
    sessionStorage.setItem("cart", JSON.stringify(cart));
    calculateTotal();
  }, [cart]);

  const addToCart = (item) => {
    setCart((prevCart) => {
      const existingItem = prevCart.find(
        (cartItem) => cartItem.idmenu === item.idmenu
      );
      if (existingItem) {
        return prevCart.map((cartItem) =>
          cartItem.idmenu === item.idmenu
            ? { ...cartItem, quantity: cartItem.quantity + 1 }
            : cartItem
        );
      }
      return [...prevCart, { ...item, quantity: 1 }];
    });
  };

  const removeFromCart = (idmenu) => {
    setCart((prevCart) => prevCart.filter((item) => item.idmenu !== idmenu));
  };

  const updateQuantity = (idmenu, quantity) => {
    if (quantity < 1) return;
    setCart((prevCart) =>
      prevCart.map((item) =>
        item.idmenu === idmenu ? { ...item, quantity } : item
      )
    );
  };

  const calculateTotal = () => {
    const newTotal = cart.reduce(
      (sum, item) => sum + item.harga * item.quantity,
      0
    );
    setTotal(newTotal);
  };

  const clearCart = () => {
    setCart([]);
    sessionStorage.removeItem("cart");
  };

  return (
    <CartContext.Provider
      value={{
        cart,
        total,
        addToCart,
        removeFromCart,
        updateQuantity,
        clearCart,
      }}
    >
      {children}
    </CartContext.Provider>
  );
};

export const useCart = () => useContext(CartContext);
