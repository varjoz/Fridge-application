// var kategoriak = [];
// var fridge = [];

// - frontend oldalon ajaxot hasznalj az alabbiakra
// -- termek hozzaadasa
// -- termekek lekerese (szuresi feltetellel vagy anelkul)
// -- termek torlese
load_categories();
load_select();
load_products();

/**AJAX keres - Lekeri a kategoriak listajat, majd kirajzolja a jobb oldalra */
function load_categories() {
  $.get(`http://localhost/?action=categories`, function (response) {
    $("#kategoriak").html(response);
  });
}

/**AJAX keres - Lekeri a kategoriak listajat, majd kirajzolja a SELECT-be */
function load_select() {
  $.get(`http://localhost/?action=select`, function (response) {
    $("#filtration").html(response);
  });
}

function add_products(details) {
  $.get(`http://localhost/?action=addproducts&productName=${details.productName}&category=${details["category"]}&date=${details["date"]}&comment=${details["comment"]}`, function (response) {
    
  });
}
// localhost/?action=addproducts&productName=termek_neve&category=kategoria&date=2024-05-09&comment=megjegyzes

/**AJAX keres - Lekeri a termekek listajat, majd kirajzolja a bal oldalra */
function load_products() {
  $.get(`http://localhost/?action=products`, function (response) {
    $("#termekek").html(response);
  });
}

// AJAX kérés a szűrt termékek lekérdezésére
function filtered_products(category) {
  $.get(`http://localhost/?action=filter&category=${category}`, function (response) {
    $("#termekek").html(response);
  });
}

/**AJAX keres - Torli az adott termeket a listabol
 *  - majd ujra betolti a termekek listajat  */
function delete_product(id) {
  $.get(`http://localhost/?action=delete&id=${id}`, function (response) {
    $("#termekek").html(response);
  });
}

