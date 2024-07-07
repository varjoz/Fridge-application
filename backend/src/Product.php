<?php 

class Product {
    
    //- tombben tarol elemeket
    public $items = [];

    public function __construct()
    {
        $this->load();
    }

    public function load() 
    {
        //ha van beolvassa
        //beolvassa a fajl tartalmat
        $data = file_get_contents('termekek.txt');
        //van-e benne valami egyaltalan
        if (strlen($data) > 0) {
            //ha van beolvassa
            $this->items = json_decode($data);
        }
    }

    function getProducts()
    {
        echo json_encode($this->items);
    }

    function addProduct($name, $expiry,$category,$note) 
    {
        //a parameterkent megadott adatokat hozzaadom a tombhoz
        $this->items[] = [
            //letrehozza az id-t
            'id' => uniqid(),
            'name' => $name,
            'expiry' => $expiry,
            'category' => $category,
            'note' => $note,
        ];
        //lementi a fajlba
        file_put_contents('termekek.txt', json_encode($this->items));
    }

    function deleteProduct($id)
    {
        for ($i = 0; $i < sizeof($this->items); $i++) {
            //a beadott parameterrel megkeresi az adott idju termeket
            if ($this->items[$i]->id == $id) {
                //kiszedi a tombbol
                array_splice($this->items, $i, 1);
            }
        }
        //lementi a fajlba
        file_put_contents('termekek.txt', json_encode($this->items));

    }

    function editProduct($id, $name, $expiry, $category, $note)
    {
        //a beadott parameterrel megkeresi az adott idju termeket
        for ($i = 0; $i < sizeof($this->items); $i++) {
            //a beadott parameterrel megkeresi az adott idju termeket
            if ($this->items[$i]->id == $id) {
                //indexre vagyunk kivancsiak
                //felulirja a nevet, expiryt, categoryt, note-ot
                $this->items[$i] = [
                    //marad az id, minden mas valtozHAT!
                    'id' => $id,
                    'name' => $name,
                    'expiry' => $expiry,
                    'category' => $category,
                    'note' => $note,
                ];
            }
        }

        //ELMENTI FAJLBA
        file_put_contents('termekek.txt', json_encode($this->items));
    }


}