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

    public function show()
    {
        // id do pedido
        $id = Instances::getInstance()->Request()->getDataValue('id');

        //inicia a coleta de dados para exibição
        $vars = array();
        $vars['PAGE_TITLE'] = "Pedidos";

        //dados gerais
        $modelOrder = new Order_Admin_Model();
        $dadosPedido = $modelOrder->getAll( $id );

        $vars = array_merge($vars,$dadosPedido);

        //dados do titular
        $modelTitular = new Main_Admin_Model();
        $dadosTitular = $modelTitular->getAllData( $id );

        if($dadosTitular == false){
            $dadosTitular = $modelTitular->getPreData( $id );
        }

        $vars = array_merge($vars,$dadosTitular);

        //endereço
        $modelEndereco = new Address_Admin_Model();
        $endereco = $modelEndereco->get( $id );

        $vars = array_merge($vars, $endereco);

        //responsável financeiro
        $modelResp = new Resp_Admin_Model();
        $preDadosResp = $modelResp->get( $id );
        $dadosResp = array();

        foreach($preDadosResp as $rKey => $value) $dadosResp['RESP_'.$rKey] = $value;

        $vars = array_merge($vars, $dadosResp);

        View::make(
            'pedidos.show',
            $vars
        );
    }
}