let a = 0;

naik.onclick = function name(params) {
  a++;
  document.querySelector("h1").innerHTML = a;
};

turun.onclick = function name(params) {
  if (a > 0) {
    a--;
    console.querySelector("h1").innerHTML = a;
  }
};
