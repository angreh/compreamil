<?php

class Pedidos_Admin_Controller extends Secure_Admin_Controller
{
    public function index()
    {
        $pedidosDao = new Order_Site_Dao();
        $pedidos = $pedidosDao->getAllWithPre();

        View::make(
            'pedidos.index',
            array(
                'PAGE_TITLE' => 'Pedidos',
                'PEDIDOS_BLOCK' => $pedidos

            )
        );
    }
}