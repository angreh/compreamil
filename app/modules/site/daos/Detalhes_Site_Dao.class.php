<?php

class Detalhes_Site_Dao extends Dao
{
    /**
     * @var Detalhes_Site_Bo
     */
    public $bo;

    public function __construct()
    {
        $this->bo = new Detalhes_Site_Bo();
    }

}