var HTMLitemlist = document.getElementById("itemlist");
var HTMLkategoriak = document.getElementById("kategoriak");

// modal
function openModal() {
  document.getElementById("myModal").style.display = "flex";
}

function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

// COG ACTIONS
//COG megnyitasa
function cog_showActions(id) {
  var item = document.getElementById(id);
  item.classList.toggle("actions-opened");
}

//termek szerkesztese
function cog_modify_showWindow(id) {
  var item = document.getElementById(id);
  console.log("Elojon a szerkesztes ablak"); //nincs kesz
}

//termek torlese
function cog_delete_showConfirm(id) {
  var item = document.getElementById(id);
  let text = "Valóban szeretnéd törölni?";
  if (confirm(text) == true) {
    console.log(id + " torlesre kerul");
    delete_product(id);
    // fridge.splice(index, 1);
  } else {
    console.log("megse");
  }
}

function filter() {
  var selectedCategory = document.getElementById("filtration").value;
  console.log(selectedCategory);
  //Ajax keres
  filtered_products(selectedCategory);
}

function sendProductData() {
  var productName = document.getElementById("productName").value;
  var date = document.getElementById("date").value;
  var comment = document.getElementById("comment").value;
  var category = document.getElementById("categoryTitle").innerText; // Itt a kategória nevét kellene kinyerni, a jelenlegi implementáció alapján.

  var data = {
    productName: productName,
    category: category,
    date: date,
    comment: comment,
  };
  console.log(productName);
  console.log(date);
  console.log(comment);
  console.log(category);
  // AJAX kérés elküldése
  add_products(data);

  closeModal();
}
