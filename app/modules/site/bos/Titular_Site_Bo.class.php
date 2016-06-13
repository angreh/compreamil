<?php

class Titular_Site_Bo
{
    public $table = 'gp_uh';

    public $ID;

    public $map;

    public $cpf;
    public $rg;
    public $nascimento;
    public $sexo;
    public $estadoCivil;
    public $telRes;
    public $telCel;
    public $mae;

    public $orderID;

    public function __construct()
    {
        $this->map = array
        (
            'ID' => 'uh_id',
            'cpf' => 'uh_cp',
            'rg' => 'uh_rg',
            'nascimento' => 'uh_dn',
            'sexo' => 'uh_sx',
            'estadoCivil' => 'uh_ec',
            'telRes' => 'uh_tr',
            'telCel' => 'uh_tc',
            'mae' => 'uh_ma',
            'orderID' => 'uh_qf_id',
        );
    }
}