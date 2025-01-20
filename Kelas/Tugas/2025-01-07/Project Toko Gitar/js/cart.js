document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("success-modal");
  const closeButton = document.querySelector(".close-button");
  const showModal = modal.getAttribute("data-show-modal") === "true";

  if (showModal) {
    modal.style.display = "flex";
  }

  closeButton.addEventListener("click", () => {
    modal.style.display = "none";
  });

  window.addEventListener("click", (event) => {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  });
});

document.addEventListener("DOMContentLoaded", () => {
  // Tombol Remove
  document.querySelectorAll(".remove-from-cart").forEach((button) => {
    button.addEventListener("click", function () {
      const itemId = this.getAttribute("data-id");

      fetch("crud/remove_from_cart.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
          item_id: itemId,
        }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            // Refresh halaman untuk memperbarui daftar cart
            location.reload();
          } else {
            alert("Failed to remove item from cart.");
          }
        })
        .catch((error) => console.error("Error:", error));
    });
  });

  // Tombol Clear Cart (opsional)
  const clearCartButton = document.getElementById("clear-cart-button");
  if (clearCartButton) {
    clearCartButton.addEventListener("click", () => {
      fetch("clear_cart.php", {
        method: "POST",
      })
        .then(() => location.reload())
        .catch((error) => console.error("Error:", error));
    });
  }
});

document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".add-to-cart").forEach((button) => {
    button.addEventListener("click", function () {
      const guitarId = this.getAttribute("data-id");
      const guitarName = this.getAttribute("data-name");
      const guitarPrice = this.getAttribute("data-price");
      const guitarImage = this.getAttribute("data-image"); // Ambil jalur gambar

      fetch("crud/add_to_cart.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
          add_to_cart: true,
          guitar_id: guitarId,
          guitar_name: guitarName,
          guitar_price: guitarPrice,
          guitar_image: guitarImage, // Kirim jalur gambar
        }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            // Perbarui tampilan jumlah item di cart
            const cartCountElement = document.getElementById("cart-count");
            if (cartCountElement) {
              const currentCount =
                parseInt(cartCountElement.textContent, 10) || 0;
              cartCountElement.textContent = currentCount + 1;
            }
            alert("Item added to cart!");
          } else {
            alert("Failed to add item to cart.");
          }
        })
        .catch((error) => console.error("Error:", error));
    });
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const updateCart = (id, action) => {
    fetch("crud/update_cart.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams({
        item_id: id,
        action: action,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          location.reload();
        } else {
          alert("Failed to update cart.");
        }
      })
      .catch((error) => console.error("Error:", error));
  };

  document.querySelectorAll(".increment").forEach((button) => {
    button.addEventListener("click", () => {
      const itemId = button.getAttribute("data-id");
      updateCart(itemId, "increment");
    });
  });

  document.querySelectorAll(".decrement").forEach((button) => {
    button.addEventListener("click", () => {
      const itemId = button.getAttribute("data-id");
      const quantityElement = button
        .closest(".quantity-controls")
        .querySelector(".quantity");
      const quantity = parseInt(quantityElement.textContent, 10);

      if (quantity === 1) {
        // Jika kuantitas 1, hapus item dari cart
        fetch("crud/remove_from_cart.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: new URLSearchParams({
            item_id: itemId,
          }),
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              location.reload();
            } else {
              alert("Failed to remove item from cart.");
            }
          })
          .catch((error) => console.error("Error:", error));
      } else {
        // Jika kuantitas lebih dari 1, kurangi kuantitas
        updateCart(itemId, "decrement");
      }
    });
  });
});
