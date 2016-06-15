<?php

class Slip_Site_Dao extends Dao
{
    /**
     * @var Slip_Site_Bo
     */
    public $bo;

    public function __construct()
    {
        $this->bo = new Slip_Site_Bo();
    }

}