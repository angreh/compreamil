<?php

class Pre_Site_Bo
{
    public $table = 'gp_ui';

    public $ID;

    // nm
    public $name;

    // em
    public $email;

    // tc
    public $telephone;

    // ui_qp
    public $people;

    // qf_id
    public $orderID;

    public $map;

    public function __construct()
    {
        $this->map = array
        (
            'ID' => 'ui_id',
            'name' => 'ui_nm',
            'email' => 'ui_em',
            'telephone' => 'ui_tc',
            'people' => 'ui_qp',
            'orderID' => 'ui_qf_id'
        );
    }
}