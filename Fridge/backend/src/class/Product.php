<?php
class Product
{
    public $name;
    public $category;
    public $expiry;
    public $note;
    public $id;

    public function __construct($name, Category $category, $expiry, $note, $id)
    {
        $this->name = $name;
        $this->category = $category;
        $this->expiry = $expiry;
        $this->note = $note;
        $this->id = $id;
    }
}
