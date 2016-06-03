<?php

class Form_Site_Model
{
    public function preFormPersist( $data )
    {
        $orderDao = new Order_Site_Dao();

        $orderData = array
        (
            'method' => 2,
            'status' => 1,
        );
        $order = $orderDao->insert( $orderData );

        $preDao = new Pre_Site_Dao();
        $data['orderID'] = $order->ID;
        $pre = $preDao->insert( $data );

        return $pre;

    }
}