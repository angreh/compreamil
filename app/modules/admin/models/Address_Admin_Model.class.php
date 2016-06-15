<?php

class Address_Admin_Model
{
    public function get( $id )
    {
        $dao = new End_Site_Dao();
        $address = $dao->get( array( 'orderID' => $id ) );

        $dt = new DataTransform_Admin_Helper();
        $var = $dt->boToArray($address);

        return $var;
    }
}