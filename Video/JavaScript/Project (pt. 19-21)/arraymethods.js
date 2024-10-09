//array -> string, number, object, function, campuran

let nilai = [
  { nama: "Angga", ipa: 85, bahasa: 96, matematika: 55 },
  { nama: "Aldo", ipa: 90, bahasa: 89, matematika: 80 },
  { nama: "Haqi", ipa: 92, bahasa: 97, matematika: 50 },
  { nama: "Tirta", ipa: 78, bahasa: 88, matematika: 65 },
];

let nama = ["Angga", "Aldo", "Haqi", "Tirta"];

// nama.push("aldo","angga");

// console.log(nama.shift());

// nama.unshift("raya","nathan");

// console.log(nama.slice(0,3))

let mapel = ["ipa", "bahasa", "matematika"];
// console.log(nama.concat(mapel));
// console.log(nama.concat(['ips','pkn','sejarah']))

// console.log(nama.splice(0,3))

// console.log(nama.pop());

// console.log(nilai);

// console.log(nama[0]);

// console.log(nama);

// for (let index = 0; index < nama.length; index++) {
//     console.log(nama[index]);
// }

// nama.forEach(function (a) {
//     console.log(a);
// })

// nama.forEach(a => console.log(a))

// nilai.filter(function (a) {
//     if (a.ipa > 80) {
//         console.log(a.nama);
//     }
// });

// console.log(nilai);

// nilai.filter((a) =>
//     a.ipa > 79 && a.matematika > 60 ? console.log(a.nama) : null
// );

// let siswa = nilai.map(function (b) {
//     return b.nama;
// });

// let siswa = nilai.map(a => [a.nama, a.ipa,a.bahasa]);

// console.log(siswa);

// mapel.sort();

// console.log(mapel);

// let hasil = nilai.reduce(function (a, b) {
//   return (a = a + b.ipa);
// }, 0);

let hasil = nilai.reduce((a, b) => (a = a + b.ipa), 0);

console.log(hasil);
