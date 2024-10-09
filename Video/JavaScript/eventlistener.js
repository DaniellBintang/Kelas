function coba() {
  a = document.querySelector(".isi");
  a.innerHTML = "Belajar EventListener";
  console.log("Coba EventListener");
}

// judul.addEventListener("click", coba);

// judul.onmouseover = coba;

judul.onmouseover = function () {
  console.log("Coba Function Anonymous");
};
