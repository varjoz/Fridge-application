<?php
class Category
{
    public $items = [];

    function add($name, $icon)
    {
        $this->items[] = [
            'id' => uniqid(),
            'name' => $name,
            'icon' => $icon . ".png"
        ];
        // fajlba ir - json formatumban
        file_put_contents('kategoriak.txt', json_encode($this->items));
    }

    function getCategories()
    {
        //beolvassa a fajl tartalmat
        $data = file_get_contents('kategoriak.txt');
        //van-e benne valami egyaltalan
        if (strlen($data) == 0) {
            //ha nincs akkor a manualisan beirt kategoriakat belerakja, 
            //aztan ELMENTI FAJLBA, HOGY LEGKOZELEBB LEGYEN
            //manualisan beirt kategoriak - alapertelmezett, megadott lista
            $this->add("Pekaru", "pekaru");
            $this->add("Husok", "husok");
            $this->add("Zoldseg-Gyumolcs", "zoldsegek");
            $this->add("Olaj-Zsir", "olaj-zsir");
            $this->add("Gabonafelek", "gabonafelek");
            $this->add("Teszta", "teszta");
            $this->add("Halak", "halak");
            $this->add("Szoszok", "szoszok");
            $this->add("Keszetelek", "keszetelek");
            $this->add("Koretek", "koretek");
            $this->add("Fuszerek", "fuszerek");
            $this->add("Vitaminok", "vitaminok");
            $this->add("Uditok", "uditok");
            $this->add("Konzervek", "konzerv");
            $this->add("Nasik", "nasik");
            $this->add("Edessegek", "edessegek");
        } else {
            //ha van beolvassa
            $this->items = json_decode($data);
        }

        echo json_encode($this->items);
    }
}