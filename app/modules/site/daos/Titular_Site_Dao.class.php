<?php

class Titular_Site_Dao extends Dao
{
    /**
     * @var Titular_Site_Bo
     */
    public $bo;

    public function __construct()
    {
        $this->bo = new Titular_Site_Bo();
    }

}