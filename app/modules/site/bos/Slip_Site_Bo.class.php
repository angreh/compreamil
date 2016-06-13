<?php

class Slip_Site_Bo
{
    public $table = 'gp_cp';

    public $ID;

    public $map;

    public $parcelas;

    public $pagID;

    public function __construct()
    {
        $this->map = array
        (
            'ID' => 'cp_id',
            'parcelas' => 'cp_rp',
            'pagID' => 'cp_jk',
        );
    }
}