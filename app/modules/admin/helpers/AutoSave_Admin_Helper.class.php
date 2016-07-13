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

        $this->dao = new $dao();

        $result = $this->dao->get(array('orderID' => $orderID));
        if( empty($result) )
        {
            $this->dao->insert(array(
                'orderID' => $orderID
            ));
        }
        $this->dao->alterOne(array(
            'SET' => array(
                $field => $value
            ),
            'WHERE' => array(
                'orderID' => $orderID
            )
        ));
    }
}