<?php

class Pedidos_Admin_Controller extends Secure_Admin_Controller
{
    public function index()
    {
        $pedidosDao = new Order_Site_Dao();
        $pedidos = $pedidosDao->getAllWithPre(1);
        $pedidosConcluidos = $pedidosDao->getAllWithPre(0);
        $pedidosDispensados = $pedidosDao->getAllWithPre();

        View::make(
            'pedidos.index',
            array(
                'PAGE_TITLE' => 'Pedidos',
                'PEDIDOS_BLOCK' => $pedidos,
                'PEDIDOSCONCLUIDOS_BLOCK' => $pedidosConcluidos,
                'PEDIDOSDISPENSADOS_BLOCK' => $pedidosDispensados
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
        $vars['ORDER_ID'] = $id;

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
        if($endereco != false)
            $vars = array_merge($vars, $endereco);

        //responsável financeiro
        $modelResp = new Resp_Admin_Model();
        $preDadosResp = $modelResp->get( $id );
        if($preDadosResp != false) {
            $dadosResp = array();
            foreach ($preDadosResp as $rKey => $value) $dadosResp['RESP_' . $rKey] = $value;

            $vars = array_merge($vars, $dadosResp);
        }

        //detalhes do pedido
        $dadosDetalhes = $modelOrder->getDetails( $id );
        if($dadosDetalhes!= false)
            $vars = array_merge($vars, $dadosDetalhes);

        //Dependentes
        $modelDependentes = new Dependents_Admin_Model();
        $dependentes = $modelDependentes->getAll( $id );
        if($dependentes!=false)
        {
            foreach($dependentes as $depKey => $dep)
            {
                $depData = array();
                foreach ($dep as $dKey => $dValue) $depData['DEP_' . $dKey] = $dValue;
                $dependentes[$depKey] = $depData;
            }
            $vars['DEPENDENTES_BLOCK'] = $dependentes;
        }

        //Forma de Pagamento
        $modelPag = new Payment_Admin_Model();
        $dadosPagamento = $modelPag->getPaymentData( $id );
        if($dadosPagamento==false) $dadosPagamento = array('NOPAY_BLOCK' => array(array()) );

        $vars = array_merge($vars,$dadosPagamento);

        View::make(
            'pedidos.show',
            $vars
        );
    }

    public function alterProgress()
    {
        $orderID = Instances::getInstance()->Request()->getDataValue('orderid');
        $status = Instances::getInstance()->Request()->getDataValue('progress');

        $model = new Order_Admin_Model();
        $model->alterProgress( $orderID, $status );
    }

    public function removerdependente()
    {
        $orderID = Instances::getInstance()->Request()->getDataValue('orderid');
        $depID= Instances::getInstance()->Request()->getDataValue('depid');

        $model = new Dependents_Admin_Model();
        $model->remove($depID);

        Instances::getInstance()->Request()->redirect( '/adm/pedido/' . $orderID );
    }

    public function autosave()
    {
        $data = $_POST;
        $autoSave = new AutoSave_Admin_Helper();
        $autoSave->save($data);
    }
}