<?php

class Pag_Site_Bo
{
    public $table = 'gp_gq';

    public $ID;

    public $map;

    public $slipOrCard;

    public $orderID;

    public function __construct()
    {
        $this->map = array
        (
            'ID' => 'gq_id',
            'slipOrCard' => 'gq_bc',
            'orderID' => 'gq_qf_id',
        );
    }
}