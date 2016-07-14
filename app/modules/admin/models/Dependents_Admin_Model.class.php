<?php

class Dependents_Admin_Model
{
    public function getAll( $orderID, $debug = false )
    {
        $dao = new Dependentes_Site_Dao();
        $dependents = $dao->get( array( 'orderID' => $orderID ), $debug );

        if($dependents == false) return false;

        $dt = new DataTransform_Admin_Helper();

        $dependentsArr = array();
        foreach($dependents as $obj)
        {
            $objArr = $dt->boToArray($obj);
            $objArr['ID'] = $obj->ID;
            $objArr['SEXO'] = $objArr['SEXO'];
            $objArr['PARENTESCO'] = $objArr['PARENTESCO'];
            $objArr['ESTADOCIVIL'] = $objArr['ESTADOCIVIL'];
            $dependentsArr[] = $objArr;
        }

        return $dependentsArr;
    }

    public function remove($id)
    {
        $dao = new Dependentes_Site_Dao();
        $dao->remove($id);
    }
}