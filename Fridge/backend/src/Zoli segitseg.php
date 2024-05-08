<?php
//2 lehetoseged van.
// (a) a kategoria meg a termek csak egy objektum, van neve, a termeknek pluszban kategoriaja es ennyi.
// A szurest, listazast ez esetben a fridge csinalja
// (b) ezek az osztalyok azokat a muveleteket, amiket veluk vegzunk, tudjak onmaguktol. Mit ertek ezalatt?

// Mindket megkozelites helyes 
//a) valtozat, 1-2 dolgot tud magarol
class Category1 {
    public $name;
    public $icon;
    public function __construct($name, $icon) 
    {
        $this->name = $name;
        $this->icon = "images/".$icon.".png";
    }
}
//az a) valtozat onmagaban sokmindent nem csinal, kell valami ami az uzleti logika reszet kezeli
//pl: a huto fogja kezelni

class Fridge {
    public $categories=[];

    function addCategory(Category1 $category)
    {
        $this->categories[] = $category;
    }

    function getCategories()
    {
        return $this->categories;
    }
}

$pekaru = new Category1("Pekaru", "kifli"); //Pekaru nevu, a kifli.png keppel
$tejtermek = new Category1("Tejtermek", "tej");
$huto = new Fridge();
$huto->addCategory($pekaru);
$huto->addCategory($tejtermek);
echo $huto->getCategories();

//++++++++++++++++++++++++++++++++++++++++++++++
//b) valtozat
class Category2 {
    public $categories= [];
    
    function add($name, $icon)
    {
        $this->categories[] = [ //objektumot hasznal
            "name" => $name,
            "icon" => "images/".$icon.".png"
        ];
    }

    function getAll()
    {
        return $this->categories;
    }
}

$kategoriak = new Category2();
$kategoriak->add("Pekaru", "kifli");
$kategoriak->add("Tejtermek", "tej");
echo $kategoriak->getAll();