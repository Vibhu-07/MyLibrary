// alert("Hello");

function search() {
  let filter = document.getElementById("find").value.toUpperCase();
  let item = document.querySelectorAll(".product");
  let l = document.getElementsByTagName("h6");
  for (var i = 0; i <= l.length; i++) {
    let a = item[i].getElementsByTagName("h6")[0];
    let value = a.innerHTML || a.innerText || a.textContent;
    if (value.toUpperCase().indexOf(filter) > -1) {
      item[i].style.display = "";
    } else {
      item[i].style.display = "none";
    }
  }
}
