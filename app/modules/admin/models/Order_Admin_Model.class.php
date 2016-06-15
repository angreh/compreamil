<?php

class Order_Admin_Model
{
    public function getAll( $id )
    {
        $dao = new Order_Site_Dao();

        $order = $dao->get( $id );

        $dt = new DataTransform_Admin_Helper();

        $dataArr = array(
            'METODO' => $dt->transformMetodo($order->method),
            'STATUS' => $dt->transformStatus($order->status)
        );

        return $dataArr;
    }
}