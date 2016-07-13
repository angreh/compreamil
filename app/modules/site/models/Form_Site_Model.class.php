<?php

class Form_Site_Model
{
    public function preFormPersist( $data, $debug = false )
    {
        //exit(var_dump($data));


        $orderDao = new Order_Site_Dao();

        if($data['solicitaLigacao']=='sim')
        {
            $orderData = array
            (
                'method' => 2,
                'status' => 5,
            );
        }
        else
        {
            $orderData = array
            (
                'method' => 2,
                'status' => 1,
            );
        }
        unset($data['solicitaLigacao']);

        $order = $orderDao->insert( $orderData, $debug );

        $preDao = new Pre_Site_Dao();
        $data['orderID'] = $order->ID;
        $pre = $preDao->insert( $data, $debug );

        Instances::getInstance()->Session()->setVar( 'site_order', $order->ID );

        return $pre;

    }

    public function orcamento( $data )
    {
        $orderDao = new Order_Site_Dao();

        $orderData = array(
            'method' => 3,
            'status' => 4
        );
        $order = $orderDao->insert( $orderData );

        $preDao = new Pre_Site_Dao();
        $data['orderID'] = $order->ID;
        $pre = $preDao->insert( $data );

        Instances::getInstance()->Session()->setVar( 'site_order', $order->ID );

        return $pre;
    }
}