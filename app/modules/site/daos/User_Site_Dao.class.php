<?php

class User_Site_Dao extends Dao
{
    /**
     * @var User_Site_Bo
     */
    public $bo;

    public function __construct()
    {
        $this->bo = new User_Site_Bo();
    }
}