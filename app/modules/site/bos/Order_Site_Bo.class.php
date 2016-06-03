<?php

class Order_Site_Bo
{
    public $table = 'gp_qf';

    public $ID;

    public $map;

    // mh
    public $method;

    // st
    public $status;

    // lc
    public $location;

    // vi
    public $userID;

    public function __construct()
    {
        $this->map = array
        (
            'ID' => 'qf_id',
            'method' => 'qf_mh',
            'status' => 'qf_st',
            'location' => 'qf_lc',
            'userID' => 'qf_vt_id',
        );
    }
}