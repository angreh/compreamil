<?php

class Endereco_Site_Bo
{
    public $table = 'gp_fo';

    public $ID;

    public $map;

    public $cep;
    public $logradouro;
    public $numero;
    public $complemento;
    public $bairro;
    public $cidade;
    public $estado;

    public $orderID;

    public function __construct()
    {
        $this->map = array
        (
            'ID' => 'fo_id',

            'cep' => 'fo_cp',
            'logradouro' => 'fo_lg',
            'numero' => 'fo_nu',
            'complemento' => 'fo_co',
            'bairro' => 'fo_br',
            'cidade' => 'fo_mn',
            'estado' => 'fo_uf',

            'orderID' => 'fo_qf_id',
        );
    }
}