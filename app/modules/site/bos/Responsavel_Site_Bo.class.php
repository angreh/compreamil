<?php

class Responsavel_Site_Bo
{
    public $table = 'gp_sg';

    public $ID;

    public $map;

    public $nome;
    public $cpf;
    public $nascimento;
    public $sexo;
    public $estadoCivil;
    public $email;
    public $parentesco;

    public $orderID;

    public function __construct()
    {
        $this->map = array
        (
            'ID' => 'sg_id',
            'nome' => 'sg_nm',
            'cpf' => 'sg_cp',
            'nascimento' => 'sg_dn',
            'sexo' => 'sg_sx',
            'estadoCivil' => 'sg_ec',
            'email' => 'sg_em',
            'parentesco' => 'sg_gr',
            'orderID' => 'sg_qf_id',
        );
    }
}