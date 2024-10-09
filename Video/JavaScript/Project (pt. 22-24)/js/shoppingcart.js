let tblmenu = [
  {
    idmenu: 1,
    idkategori: 1,
    menu: "Bakso",
    gambar: "bakso.jpg",
    harga: 20000,
  },
  {
    idmenu: 2,
    idkategori: 1,
    menu: "Soto",
    gambar: "soto.jpg",
    harga: 15000,
  },
  {
    idmenu: 3,
    idkategori: 1,
    menu: "Rujak Cingur",
    gambar: "rujakcingur.jpg",
    harga: 12000,
  },
  {
    idmenu: 4,
    idkategori: 1,
    menu: "Rujak Petis",
    gambar: "rujakpetis.jpg",
    harga: 15000,
  },
  {
    idmenu: 5,
    idkategori: 2,
    menu: "Jus Alpukat",
    gambar: "jusalpukat.jpg",
    harga: 10000,
  },
  {
    idmenu: 6,
    idkategori: 2,
    menu: "Es Teh",
    gambar: "esteh.png",
    harga: 5000,
  },
  {
    idmenu: 7,
    idkategori: 2,
    menu: "Jus Mangga",
    gambar: "jusmangga.jpg",
    harga: 5000,
  },
  {
    idmenu: 8,
    idkategori: 2,
    menu: "Es Jeruk",
    gambar: "esjeruk.png",
    harga: 7000,
  },
];

let tampil = tblmenu
  .map(function (kolom) {
    return ` <div class="product-content">
            <div class="image">
              <img src="images/${kolom.gambar}" alt="" />
            </div>
            <div class="title">
              <h2>${kolom.menu}</h2>
            </div>
            <div class="harga">
              <h2>Rp.${kolom.harga}</h2>
            </div>
  
            <div class="btn-beli">
              <button data-idmenu=${kolom.idmenu}>Beli</button>
            </div>
          </div>`;
  })
  .join("");

let isi = document.querySelector(".product");
isi.innerHTML = tampil;

let btnbeli = document.querySelectorAll(".btn-beli > button");

let cart = [];

for (let index = 0; index < btnbeli.length; index++) {
  btnbeli[index].onclick = function () {
    tblmenu.filter(function (a) {
      if (a.idmenu == btnbeli[index].dataset["idmenu"]) {
        cart.push(a);
        console.log(cart);
      }
    });
  };
}
