<?php

class AutoSave_Admin_Helper
{
    /**
     * @var Dao
     */
    private $dao;
    public function save($data)
    {
        $dao = $data['table'] . '_Site_Dao';
        $value = $data['value'];
        $field = $data['id'];
        $orderID = $data['orderID'];
        $fieldID = isset($data['fieldID'])?$data['fieldID']:false;

        $this->dao = new $dao();

        //Verifica se existe registro na tabela antes de alterá-lo
        $result = $this->dao->get(array('orderID' => $orderID));
        if( empty($result) )
        {
            $this->dao->insert(array(
                'orderID' => $orderID
            ));
        }

        if($fieldID === false)
        {
            $this->dao->alterOne(array(
                'SET' => array(
                    $field => $value
                ),
                'WHERE' => array(
                    'orderID' => $orderID
                )
            ));
        }
        else
        {
            $dataAux = array(
                $field => $value,
                'ID' => $fieldID
            );
            $this->dao->alterOne( $dataAux );
        }
    }
}