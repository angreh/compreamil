<?php

class End_Site_Dao extends Dao
{
    /**
     * @var Endereco_Site_Bo
     */
    public $bo;

    public function __construct()
    {
        $this->bo = new Endereco_Site_Bo();
    }

}