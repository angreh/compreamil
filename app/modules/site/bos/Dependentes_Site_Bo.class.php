<?php

class Dependentes_Site_Bo
{
    public $table = 'gp_eg';

    public $ID;

    public $map;

    public $nome;
    public $cpf;
    public $nascimento;
    public $sexo;
    public $parentesco;
    public $estadoCivil;
    public $mae;

    public $orderID;

    public function __construct()
    {
        $this->map = array
        (
            'ID' => 'eg_id',
            'nome' => 'eg_nm',
            'cpf' => 'eg_cp',
            'nascimento' => 'eg_dn',
            'sexo' => 'eg_sx',
            'parentesco' => 'eg_gr',
            'estadoCivil' => 'eg_ec',
            'mae' => 'eg_ma',
            'orderID' => 'eg_qf_id',
        );
    }
}