<?php
//cors miatt
header('Access-Control-Allow-Origin: *');
require_once('Category.php');
require_once('Product.php');
//get parameter
$category = new Category();
$product = new Product();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
            // visszaadja az osszes kategoriat
        case 'getCategories':
            $category->getCategories();
            break;
            // visszaadja az osszes termeket ami a hutoben van
        case 'getProducts':
            $product->getProducts();
            break;
            // hozzaadunk egy termeket
        case 'addProduct':
            $name = $_GET['name'];
            $expiry = $_GET['expiry'];
            $category = $_GET['category'];
            $note = $_GET['note'];
            $product->addProduct($name, $expiry, $category, $note);
            break;
            //torlunk egy adott termeket
        case 'deleteProduct':
            $id = $_GET['id'];
            $product->deleteProduct($id);
            break;
            //szerkesztunk egy termeket
        case 'editProduct':
            $id = $_GET['id'];
            $name = $_GET['name'];
            $expiry = $_GET['expiry'];
            $category = $_GET['category'];
            $note = $_GET['note'];
            $product->editProduct($id, $name, $expiry, $category, $note);
            break;
    }
}
