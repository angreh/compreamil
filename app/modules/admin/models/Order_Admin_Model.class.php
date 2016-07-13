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

    public function getDetails( $id )
    {
        $dao = new Detalhes_Site_Dao();
        $details = $dao->get(array('orderID'=>$id));

        if($details==false) return false;

        $details = $details[0];

        $dt = new DataTransform_Admin_Helper();
        $dataArr = $dt->boToArray( $details );
//        $dataArr['ONLINEOFFLINE'] = $dt->transformBusca($dataArr['ONLINEOFFLINE']);
        $dataArr['ONLINEOFFLINE'] = $dataArr['ONLINEOFFLINE'];

        return $dataArr;
    }

    public function alterProgress( $orderID, $progress )
    {
        if($progress == 1)
        {
            $userID = NULL;
        } else
        {
            $user = Instances::getInstance()->Session()->User();
            $userID = $user->ID;
        }

        //code
        $data = array(
            'ID' => $orderID,
            'progress' => $progress,
            'userID' => $userID
        );

        $dao = new Order_Site_Dao();
        $dao->alterOne($data);

        Instances::getInstance()->Alerts()->success('Pedido alterado com sucesso.');

        Instances::getInstance()->Request()->redirect( '/adm/pedidos' );
    }
}