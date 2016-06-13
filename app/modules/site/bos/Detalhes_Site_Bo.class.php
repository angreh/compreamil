<?php

class Detalhes_Site_Bo
{
    public $table = 'gp_ef';

    public $ID;

    public $map;

    public $onlineOffline;
    public $senha;
    public $aceito;

    public $orderID;

    public function __construct()
    {
        $this->map = array
        (
            'ID' => 'ef_id',

            'onlineOffline' => 'ef_ce',
            'senha' => 'ef_ps',
            'aceito' => 'ef_ac',

            'orderID' => 'ef_qf_id',
        );
    }
}