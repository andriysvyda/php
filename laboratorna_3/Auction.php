<?php

class Auction
{
    public $id;
    public $name;
    public $startlot;
    public $endlot;
    public $firstprice;
    public $lastprice;

    public function __construct($id, $array)
    {
        $this->id = $id;
        $this->name = $array['name'];
        $this->endlot = $array['startlot'];
        $this->startlot = $array['endlot'];
        $this->firstprice = $array['firstprice'];
        $this->lastprice = $array['lastprice'];
    }

    public static function validationDataAuctions($array)
    {
        return !(
            empty($array['name']) ||
            empty($array['startlot']) ||
            empty($array['endlot']) ||
            empty($array['firstprice']) ||
            empty($array['lastprice']) ||
            $array['firstprice'] > 0 ||
            $array['lastprice'] > 0 ||
            !isset($array)
        );
    }
}