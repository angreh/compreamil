<?php

class User_Site_Bo
{
    public $table = 'tz_vt';

    public $ID;

    public $map;

    public $user;
    public $pass;
    public $nivel;
    public $name;

    public function __construct()
    {
        $this->map = array
        (
            'ID' => 'vt_id',
            'user' => 'vt_em',
            'pass' => 'vt_ps',
            'nivel' => 'vt_nv',
            'name' => 'vt_nm',
        );
    }
}