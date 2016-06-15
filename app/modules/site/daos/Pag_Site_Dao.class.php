<?php

class Pag_Site_Dao extends Dao
{
    /**
     * @var Pag_Site_Bo
     */
    public $bo;

    public function __construct()
    {
        $this->bo = new Pag_Site_Bo();
    }

}