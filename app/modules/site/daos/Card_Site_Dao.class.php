<?php

class Card_Site_Dao extends Dao
{
    /**
     * @var Card_Site_Bo
     */
    public $bo;

    public function __construct()
    {
        $this->bo = new Card_Site_Bo();
    }

}