function tampil(b) {
  a = document.querySelector("p").innerText = "Belajar Event JavaScript " + b;
  // a.innerText = "Belajar Event JavaScript";
  console.log("Belajar Event JavaScript");
}

judul.onclick = function () {
  // console.log("Belajar Event JavaScript menggunakan id");
  document.querySelector(".isi").innerHTML =
    "Belajar Event JavaScript menggunakan id";
};
