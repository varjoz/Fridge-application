<?php
class Request
{
    public $get;
    /**a get valtozonak adja a $_GET szuperglobalis valtozot */
    public function __construct()
    {
        $this->get = $_GET;
    }

    /** megallapitja, hogy a parameterket megadott kulcs letezik-e az URL-ben es nagyobb-e nullanal*/
    public function has($key)
    {
        return isset($this->get[$key]) && strlen($this->get[$key]) > 0;
    }

    /**visszater az URL adott kulcsanak ertekevel */
    public function get($key)
    {
        return $this->get[$key];
    }
}
