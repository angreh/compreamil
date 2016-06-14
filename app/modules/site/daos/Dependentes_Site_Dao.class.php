<?php

class Dependentes_Site_Dao extends Dao
{
    /**
     * @var Dependentes_Site_Bo
     */
    public $bo;

    public function __construct()
    {
        $this->bo = new Dependentes_Site_Bo();
    }

}