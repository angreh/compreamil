<?php

class Resp_Admin_Model
{
    public function get( $id )
    {
        $dao = new Responsavel_Site_Dao();
        $resp = $dao->get(array('orderID'=>$id));

        $dt = new DataTransform_Admin_Helper();
        $arr = $dt->boToArray($resp);

        $arr['SEXO'] = $dt->transformSexo($arr['SEXO']);
        $arr['ESTADOCIVIL'] = $dt->transformEstadoCivil($arr['ESTADOCIVIL']);
        $arr['PARENTESCO'] = $dt->transformParentesco($arr['PARENTESCO']);

        return $arr;
    }
}