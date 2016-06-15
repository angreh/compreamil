<?php

class Main_Admin_Model
{
    public function getAllData( $id )
    {
        $query = "SELECT 	ui_nm as 'NOME',
                            uh_cp as 'CPF',
                            uh_rg as 'RG',
                            uh_dn as 'NASCIMENTO',
                            uh_sx as 'SEXO',
                            uh_ec as 'ESTADOCIVIL',
                            ui_em as 'EMAIL',
                            ui_tc as 'TELEFONE',
                            uh_tr AS 'TELRES',
                            uh_ma as 'MAE'
                    FROM 	gp_ui pre, gp_uh titular
                    WHERE	pre.ui_qf_id=titular.uh_qf_id AND
                            pre.ui_qf_id=" . $id;

        $result = Instances::getInstance()->Database()->query(array(
            'sql' => $query
        ));

        $numRows = Instances::getInstance()->Database()->num_rows($result);
        if($numRows == 0) return false;

        $data = Instances::getInstance()->Database()->fetch( $result );

        $dt = new DataTransform_Admin_Helper();

        $data['SEXO'] = $dt->transformSexo($data['SEXO']);
        $data['ESTADOCIVIL'] = $dt->transformEstadoCivil($data['ESTADOCIVIL']);

        return $data;
    }

    public function getPreData( $id )
    {
        $dao = new Pre_Site_Dao();
        $data = $dao->get( array( 'orderID' => $id ) );
        $data = $data[0];

        $dataArr = array();

        $dataArr['NOME'] = $data->name;
        $dataArr['EMAIL'] = $data->email;
        $dataArr['TELEFONE'] = $data->telephone;

        return $dataArr;
    }
}