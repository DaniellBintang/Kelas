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

document.addEventListener("DOMContentLoaded", () => {
  const tabButtons = document.querySelectorAll(".tab-button");
  const tabContents = document.querySelectorAll(".tab-content");

  tabButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const targetTab = button.getAttribute("data-tab");

      // Reset active states
      tabButtons.forEach((btn) => btn.classList.remove("active"));
      tabContents.forEach((content) => content.classList.remove("active"));

      // Activate the clicked tab and corresponding content
      button.classList.add("active");
      document.getElementById(targetTab).classList.add("active");
    });
  });
});

// Add this to a new file named 'slider.js'
document.addEventListener("DOMContentLoaded", function () {
  let slideIndex = 0;
  const slides = document.getElementsByClassName("slide");
  const dots = document.getElementsByClassName("dot");
  const prev = document.querySelector(".prev");
  const next = document.querySelector(".next");

  // Automatically advance slides every 5 seconds
  setInterval(function () {
    nextSlide(1);
  }, 5000);

  // Show initial slide
  showSlides(slideIndex);

  // Add click events to prev/next buttons
  prev.addEventListener("click", function () {
    nextSlide(-1);
  });

  next.addEventListener("click", function () {
    nextSlide(1);
  });

  // Add click events to dots
  for (let i = 0; i < dots.length; i++) {
    dots[i].addEventListener("click", function () {
      currentSlide(i);
    });
  }

  function nextSlide(n) {
    showSlides((slideIndex += n));
  }

  function currentSlide(n) {
    showSlides((slideIndex = n));
  }

  function showSlides(n) {
    if (n >= slides.length) {
      slideIndex = 0;
    }
    if (n < 0) {
      slideIndex = slides.length - 1;
    }

    // Hide all slides
    for (let i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
      dots[i].className = dots[i].className.replace(" active", "");
    }

    // Show current slide
    slides[slideIndex].style.display = "block";
    dots[slideIndex].className += " active";
  }
});

let currentSlide = 0;
const slides = document.querySelectorAll(".banner");
const dots = document.querySelector(".banner-dots");
let autoSlideInterval;
let isTransitioning = false;

// Create dots
slides.forEach((_, index) => {
  const dot = document.createElement("span");
  dot.classList.add("dot");
  dot.onclick = () => goToSlide(index);
  dots.appendChild(dot);
});

function updateSlideClasses(direction) {
  slides.forEach((slide, index) => {
    slide.classList.remove("active", "prev", "next");

    if (index === currentSlide) {
      slide.classList.add("active");
    } else if (
      direction === 1 &&
      index === (currentSlide + 1) % slides.length
    ) {
      slide.classList.add("next");
    } else if (
      direction === -1 &&
      index === (currentSlide - 1 + slides.length) % slides.length
    ) {
      slide.classList.add("prev");
    }
  });
}

function changeSlide(direction) {
  if (isTransitioning) return;
  isTransitioning = true;

  slides[currentSlide].classList.remove("active");
  document.querySelectorAll(".dot")[currentSlide].classList.remove("active");

  currentSlide = (currentSlide + direction + slides.length) % slides.length;

  updateSlideClasses(direction);
  document.querySelectorAll(".dot")[currentSlide].classList.add("active");

  // Reset transition lock after animation completes
  setTimeout(() => {
    isTransitioning = false;
  }, 800);
}

function goToSlide(n) {
  if (isTransitioning || n === currentSlide) return;

  const direction = n > currentSlide ? 1 : -1;
  currentSlide = n;
  updateSlideClasses(direction);

  document.querySelectorAll(".dot").forEach((dot, index) => {
    dot.classList.toggle("active", index === n);
  });
}

// Auto-advance slides with reset on user interaction
function startAutoSlide() {
  autoSlideInterval = setInterval(() => changeSlide(1), 5000);
}

function resetAutoSlide() {
  clearInterval(autoSlideInterval);
  startAutoSlide();
}

// Event listeners for user interaction
document
  .querySelector(".banner-container")
  .addEventListener("mouseenter", () => {
    clearInterval(autoSlideInterval);
  });

document
  .querySelector(".banner-container")
  .addEventListener("mouseleave", startAutoSlide);

// Initialize slider
updateSlideClasses(1);
document.querySelectorAll(".dot")[0].classList.add("active");
startAutoSlide();

// Optional: Add touch support for mobile devices
let touchStartX = 0;
let touchEndX = 0;

document
  .querySelector(".banner-container")
  .addEventListener("touchstart", (e) => {
    touchStartX = e.touches[0].clientX;
  });

document
  .querySelector(".banner-container")
  .addEventListener("touchend", (e) => {
    touchEndX = e.changedTouches[0].clientX;
    handleSwipe();
  });

function handleSwipe() {
  const swipeThreshold = 50;
  const difference = touchStartX - touchEndX;

  if (Math.abs(difference) > swipeThreshold) {
    if (difference > 0) {
      // Swipe left
      changeSlide(1);
    } else {
      // Swipe right
      changeSlide(-1);
    }
  }
}
