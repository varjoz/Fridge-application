<?php
class File
{
    public $filename;

    public function __construct($file_name)
    {
        $this->filename = $file_name;
    }

    public function read_from_file()
    {
        $returnData = [];
        $data = file_get_contents($this->filename);
        //ha ez nagyobb mint 0, akkor visszalakitja olvashatobb formatumba a tombot
        if (strlen($data) > 0) {
            $returnData = unserialize($data);
        }
        return $returnData;
    }

    public function save_to_file($categ)
    {
        file_put_contents($this->filename, serialize($categ));
    }
}
