<?php

class Dependents_Admin_Model
{
    public function getAll( $orderID )
    {
        $dao = new Dependentes_Site_Dao();
        $dependents = $dao->get( array( 'orderID' => $orderID ) );

        if($dependents == false) return false;

        $dt = new DataTransform_Admin_Helper();

        $dependentsArr = array();
        foreach($dependents as $obj)
        {
            $objArr = $dt->boToArray($obj);
            $objArr['SEXO'] = $dt->transformSexo($objArr['SEXO']);
            $objArr['PARENTESCO'] = $dt->transformParentesco($objArr['PARENTESCO']);
            $objArr['ESTADOCIVIL'] = $dt->transformEstadoCivil($objArr['ESTADOCIVIL']);
            $dependentsArr[] = $objArr;
        }

        return $dependentsArr;
    }
}