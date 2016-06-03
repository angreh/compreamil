<?php

class Pre_Site_Dao extends Dao
{
    /**
     * @var Pre_Site_Bo
     */
    public $bo;

    public function __construct()
    {
        $this->bo = new Pre_Site_Bo();
    }

}