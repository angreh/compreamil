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

    public function getAllWithPre($status = false)
    {
        $user = Instances::getInstance()->Session()->User();
        $userID = $user->ID;

        if($status === false)
        {
            $query = "SELECT	orders.qf_id as 'orderID',
                                orders.qf_mh as 'method',
                                orders.qf_st as 'status',
                                pre.ui_nm as 'name',
                                pre.ui_em as 'email',
                                pre.ui_tc as 'telephone'
                        FROM	gp_qf orders, gp_ui pre
                        WHERE 	orders.qf_id=pre.ui_qf_id
                        AND     orders.qf_vt_id=$userID
                        AND		orders.qf_ad<>0
                        AND		orders.qf_ad<>1";
        } else {
            if($status == 1)
            {
                $query =  "SELECT	orders.qf_id as 'orderID',
                                orders.qf_mh as 'method',
                                orders.qf_st as 'status',
                                pre.ui_nm as 'name',
                                pre.ui_em as 'email',
                                pre.ui_tc as 'telephone'
                        FROM	gp_qf orders, gp_ui pre
                        WHERE 	orders.qf_id=pre.ui_qf_id
                        AND		orders.qf_ad=" . $status;
            } else {
                $query =  "SELECT	orders.qf_id as 'orderID',
                                orders.qf_mh as 'method',
                                orders.qf_st as 'status',
                                pre.ui_nm as 'name',
                                pre.ui_em as 'email',
                                pre.ui_tc as 'telephone'
                        FROM	gp_qf orders, gp_ui pre
                        WHERE 	orders.qf_id=pre.ui_qf_id
                        AND     orders.qf_vt_id=$userID
                        AND		orders.qf_ad=" . $status;
            }
        }

        $result = Instances::getInstance()->Database()->query(array(
            'sql' => $query,
            'debug' => false
        ));

        $orders = array();
        while( $row = Instances::getInstance()->Database()->fetch($result) )
        {
            $orders[] = $row;
        }

        return $orders;
    }

    public function getOneWithPre($id)
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
              WHERE 	orders.qf_id=pre.ui_qf_id AND orders.qf_id=" . $id
        ));

        $classArr = Instances::getInstance()->Database()->fetch($result);

        return $classArr;
    }
}