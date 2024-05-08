<?php
//cors miatt
header('Access-Control-Allow-Origin: *');

require_once("./class/Fridge.php");

$huto = new Fridge();

//kategoriak letrehozasa
$pekaru = new Category("Pekaru", "pekaru");
$husok = new Category("Husok", "husok");
$zoldseg_gyumolcs = new Category("Zoldseg-Gyumolcs", "zoldsegek");
$olaj_zsir = new Category("Olaj-Zsir", "olaj-zsir");
$gabonafelek = new Category("Gabonafelek", "gabonafelek");
$teszta = new Category("Teszta", "teszta");
$halak = new Category("Halak", "halak");
$szoszok = new Category("Szoszok", "szoszok");
$keszetelek = new Category("Keszetelek", "keszetelek");
$koretek = new Category("Koretek", "koretek");
$fuszerek = new Category("Fuszerek", "fuszerek");
$vitaminok = new Category("Vitaminok", "vitaminok");
$uditok = new Category("Uditok", "uditok");
$konzervek = new Category("Konzervek", "konzerv");
$nasik = new Category("Nasik", "nasik");
$edessegek = new Category("Edessegek", "edessegek");

$category_list_file = new File("kategoriak.txt");
//kategorialista elkeszites fajlbol
$category_list = $category_list_file->read_from_file();
if (empty($category_list)) {
    // Hozzáadás a categories[] tombhoz
    $huto->addCategory($pekaru);
    $huto->addCategory($husok);
    $huto->addCategory($zoldseg_gyumolcs);
    $huto->addCategory($olaj_zsir);
    $huto->addCategory($gabonafelek);
    $huto->addCategory($teszta);
    $huto->addCategory($halak);
    $huto->addCategory($szoszok);
    $huto->addCategory($keszetelek);
    $huto->addCategory($koretek);
    $huto->addCategory($fuszerek);
    $huto->addCategory($vitaminok);
    $huto->addCategory($uditok);
    $huto->addCategory($konzervek);
    $huto->addCategory($nasik);
    $huto->addCategory($edessegek);

    // A kategóriákat mentese a fájlba
    $category_list_file->save_to_file($huto->getCategories());
}

//termekek letrehozasa 
$termek1 = new Product("tonhal", $halak, "2024-05-17", "tesco", $huto->generateId("tonhal"));
$termek2 = new Product("paradicsom", $zoldseg_gyumolcs, "2024-05-06", "Lidl", $huto->generateId("paradicsom"));
$termek3 = new Product("so", $fuszerek, "2028-12-12", "Aldi", $huto->generateId("so"));
$termek4 = new Product("liszt", $gabonafelek, "2024-06-12", "tesco", $huto->generateId("liszt"));
$termek5 = new Product("lazac", $halak, "2024-06-17", "CBA", $huto->generateId("lazac"));

$product_list_file = new File("termekek.txt");
//termeklista elkeszites fajlbol
$product_list = $product_list_file->read_from_file();

if (empty($product_list)) {
    // termekek hozzaadasa a products[] tombhoz
    $huto->addProduct($termek1);
    $huto->addProduct($termek2);
    $huto->addProduct($termek3);
    $huto->addProduct($termek4);
    $huto->addProduct($termek5);

    //termekek mentese fajlba
    $product_list_file->save_to_file($huto->getProducts());
}

//keresek
$request = new Request();
$action = '';
if ($request->has('action')) {
    $action = $request->get('action');

    switch ($action) {
        case "categories": //kategoriak betoltese
            $huto->loadCategories($category_list);
            break;
        case "select": //kategoriak betoltese a selectbe
            $huto->loadSelect($category_list);
            break;
        case "products": //termekek betoltese 
            $huto->loadProducts($product_list);
            break;
        case "filter": //termekek szurese
            if (isset($_GET['category'])) {
                $filtered_products = [];
                $category_value = $_GET['category'];
                if ($category_value == "nincs") {
                    $huto->loadProducts($product_list);
                } else {
                    foreach ($product_list as $product) {
                        if ($product->category->name == $category_value) {
                            $filtered_products[] = $product;
                        }
                    }
                    $huto->loadProducts($filtered_products);
                }
            }
            break;
        case "delete": //termek toreles
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                // itt végezd el a termék törlését
            }
            break;
        case "addproducts": //termek hozzaadasa
            // Adatok megerkezesenek ellenorzese
            if (isset($_GET['productName']) && isset($_GET['category']) && isset($_GET['date']) && isset($_GET['comment'])) {
                $productName = $_GET['productName'];
                $category = $_GET['category']; //?????????????????????????
                $date = $_GET['date'];
                $comment = $_GET['comment'];

                // $termek = new Product($productName, $category, $date, $comment, $huto->generateId($productName));
                // $huto->addCategory($this->termek);

                echo "A termék sikeresen hozzá lett adva!";
            } else {
                echo "Hiba: Hiányzó adatok!";
            }
            break;
        default:
            // Ha az action értéke nem felel meg egyik esetnek sem
            break;
    }
}
