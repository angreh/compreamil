<?php

class Order_Site_Dao extends Dao
{
    /**
     * @var Order_Site_Bo
     */
    public $bo;

    public function __construct()
    {
        $this->bo = new Order_Site_Bo();
    }

    public function getAllWithPre()
    {
        $result = Instances::getInstance()->Database()->query(array(
            'sql' => "
              SELECT    orders.qf_id as 'orderID',
		                orders.qf_mh as 'method',
                        orders.qf_st as 'status',
                        pre.ui_nm as 'name',
                        pre.ui_em as 'email',
                        pre.ui_tc as 'telephone'
              FROM	    gp_qf orders, gp_ui pre
              WHERE 	orders.qf_id=pre.ui_qf_id",
            'debug' => false
        ));

        $orders = array();
        while( $row = Instances::getInstance()->Database()->fetch($result) )
        {
            $orders[] = $row;
        }

        return $orders;
    }
}