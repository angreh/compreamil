<?php

class Responsavel_Site_Dao extends Dao
{
    /**
     * @var Responsavel_Site_Bo
     */
    public $bo;

    public function __construct()
    {
        $this->bo = new Responsavel_Site_Bo();
    }

}