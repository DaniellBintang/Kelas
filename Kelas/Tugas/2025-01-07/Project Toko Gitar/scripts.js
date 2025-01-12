document.addEventListener("DOMContentLoaded", () => {
  const guitarCards = document.querySelectorAll(".card");
  const orderSummary = document.getElementById("order-summary");
  const orderDetailsInput = document.getElementById("order_details");
  const totalPriceInput = document.getElementById("total_price");
  const displayTotalPrice = document.getElementById("display-total-price");

  let selectedGuitars = {};

  guitarCards.forEach((card) => {
    const incrementButton = card.querySelector(".increment");
    const decrementButton = card.querySelector(".decrement");
    const quantityDisplay = card.querySelector(".quantity");
    const guitarName = card.getAttribute("data-guitar-name");
    const guitarPrice = parseFloat(card.getAttribute("data-guitar-price"));

    card.addEventListener("click", () => {
      const quantityControl = card.querySelector(".quantity-control");

      if (!selectedGuitars[guitarName]) {
        selectedGuitars[guitarName] = { quantity: 1, price: guitarPrice };
        quantityControl.style.display = "flex";
        card.classList.add("selected");
      } else {
        delete selectedGuitars[guitarName];
        quantityControl.style.display = "none";
        card.classList.remove("selected");
      }

      updateForm();
    });

    incrementButton.addEventListener("click", (e) => {
      e.stopPropagation();
      selectedGuitars[guitarName].quantity++;
      quantityDisplay.textContent = selectedGuitars[guitarName].quantity;
      updateForm();
    });

    decrementButton.addEventListener("click", (e) => {
      e.stopPropagation();
      if (selectedGuitars[guitarName].quantity > 1) {
        selectedGuitars[guitarName].quantity--;
        quantityDisplay.textContent = selectedGuitars[guitarName].quantity;
      } else {
        delete selectedGuitars[guitarName];
        card.querySelector(".quantity-control").style.display = "none";
        card.classList.remove("selected");
      }
      updateForm();
    });
  });

  function updateForm() {
    orderSummary.innerHTML = "";
    let totalPrice = 0;

    Object.entries(selectedGuitars).forEach(([name, { quantity, price }]) => {
      const item = document.createElement("div");
      item.textContent = `${name} x${quantity} - $${(quantity * price).toFixed(
        2
      )}`;
      orderSummary.appendChild(item);
      totalPrice += quantity * price;
    });

    orderDetailsInput.value = JSON.stringify(selectedGuitars);
    totalPriceInput.value = totalPrice.toFixed(2);
    displayTotalPrice.textContent = totalPrice.toFixed(2);
  }
});

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
