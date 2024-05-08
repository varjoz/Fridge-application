<?php
require_once("./class/File.php");
require_once("./class/Category.php");
require_once("./class/Product.php");
require_once("./class/Request.php");

class Fridge
{
    public $products = [];
    public $categories = [];

    function addCategory(Category $category)
    {
        $this->categories[] = $category;
    }

    function getCategories()
    {
        return $this->categories;
    }

    function loadCategories($kategoriak)
    {
        $HTML = "";
        foreach ($kategoriak as $category) {
            $HTML .= "<div class='kategoria' onclick='openModal()'>
                        <img src='{$category->icon}' alt='{$category->name}'/>
                        <div class='kategoria_nev'>{$category->name}</div>
                    </div>";
        }
        echo $HTML;
    }

    
    function loadSelect($kategoriak)
    {
        $HTML = "<option value='nincs' selected>nincs szuro</option>";
        foreach ($kategoriak as $category) {
            $HTML .= "<option value='{$category->name}'>{$category->name}</option>";
        }
        echo $HTML;
    }
    
    function generateId($name)
    {
        return $name . "-" . uniqid();
    }

    function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    function getProducts()
    {
        return $this->products;
    }

    function deleteProducts()
    {
        return $this->products;
    }


    function loadProducts($lista)
    {
        $HTML = "";

        foreach ($lista as $item) {
            $additionalClasses = "";
            $expireDate = new DateTime($item->expiry);
            $nextweek = new DateTime();
            $nextweek->modify('+14 days');

            if ($nextweek >= $expireDate) {
                $additionalClasses .= "expiring";
            }

            $HTML .= "<div class='item $additionalClasses' id='{$item->id}'>
                <img src='{$item->category->icon}' alt='{$item->category->name}'/>   
                <div class='item-text'>
                    <h1>{$item->name}</h1>
                    <h2>{$item->expiry}</h2>
                    <h4>{$item->note}</h4>
                </div>
                <div class='actions'>
                    <img src='Icons/felkialtojel.png' class='warning' alt='felkialtojel' />
                    <img src='Icons/cog.png' class='cog' onclick=\"cog_showActions('{$item->id}')\" alt='cog' />
                    <div class='cogActions'>
                        <p class='modify' onclick=\"cog_modify_showWindow('{$item->id}')\">szerkesztés</p>
                        <p class='delete' onclick=\"cog_delete_showConfirm('{$item->id}')\">törlés</p>
                    </div>
                </div>
            </div>";
        }
        echo $HTML;
    }
}



