import React from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Front from "./Front/front";
import Back from "./Back/back";
import Menu from "./Front/Menu";
import Login from "./Back/Login";
import Kategori from "./Back/pages/KategoriPage"; // contoh
import Order from "./Back/pages/OrderPage";
import Detail from "./Back/pages/OrderDetailPage";
import Pelanggan from "./Back/pages/PelangganPage";
import MenuBack from "./Back/pages/MenuPage";
import User from "./Back/pages/UserPage";
import { CartProvider } from "./Front/Context/Cart";
import Cart from "./Front/CartPage";
import AllMenu from "./Front/AllMenu";
import OrderSuccess from "./Front/Context/OrderSuccess";
import CustomerLogin from "./Front/auth/Login";
import CustomerRegister from "./Front/auth/Register";

import "bootstrap/dist/css/bootstrap.min.css";
import "./App.css";

function App() {
  return (
    <div className="App">
      <CartProvider>
        <Router>
          <Routes>
            <Route path="/login" element={<CustomerLogin />} />
            <Route path="/register" element={<CustomerRegister />} />
            <Route path="/admin/login" element={<Login />} />

            {/* FRONT (Public User Layout) */}
            <Route path="/" element={<Front />}>
              <Route path="/menu" element={<AllMenu />} />
              <Route path="menu/:category" element={<Menu />} />
              <Route path="/cart" element={<Cart />} />
              <Route
                path="/order-success/:orderId"
                element={<OrderSuccess />}
              />

              {/* bisa tambah page lain seperti /about, /contact, dll */}
            </Route>

            {/* BACK (Admin Layout) */}
            <Route path="/admin" element={<Back />}>
              <Route path="kategori" element={<Kategori />} />
              <Route path="order" element={<Order />} />
              <Route path="menu" element={<MenuBack />} />
              <Route path="pelanggan" element={<Pelanggan />} />
              <Route path="order-detail" element={<Detail />} />
              <Route path="user-admin" element={<User />} />
              {/* tambah halaman lain kalau ada */}
            </Route>

            {/* LOGIN di luar layout */}
            <Route path="/login" element={<Login />} />
          </Routes>
        </Router>
      </CartProvider>
    </div>
  );
}

export default App;
