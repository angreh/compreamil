<?php

class Card_Site_Bo
{
    public $table = 'gp_db';

    public $ID;

    public $map;

    public $parcelas;
    public $bandeira;
    public $nome;
    public $numero;
    public $codigo;
    public $validade;
    public $pagID;

    public function __construct()
    {
        $this->map = array
        (
            'ID' => 'db_id',
            'parcelas' => 'db_pc',
            'bandeira' => 'db_bn',
            'nome' => 'db_ne',
            'numero' => 'db_xo',
            'codigo' => 'db_mc',
            'validade' => 'db_dv',
            'pagID' => 'db_dd',
        );
    }
}