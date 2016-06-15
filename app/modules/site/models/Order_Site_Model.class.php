<?php

class Order_Site_Model
{
    const CARD_VAL = 41.65;
    const SLIP_VAL = 49;

    public function getMainName($id)
    {
        $query = "
          SELECT  pre.ui_nm 'name'
          FROM 	  gp_qf orders, gp_ui pre
          WHERE   orders.qf_id=pre.ui_qf_id AND
		          orders.qf_id=" . $id;

        $result = Instances::getInstance()->Database()->query(array(
            'sql' => $query
        ));

        $name = Instances::getInstance()->Database()->fetchOne($result);
        return $name;
    }

    public function getDependentsNames($id)
    {
        $query = "SELECT eg_id as 'ID', eg_nm as 'nome' FROM compreamil.gp_eg WHERE eg_qf_id=" . $id;

        $db = Instances::getInstance()->Database()->getInstance();

        $result = $db->query(array(
            'sql' => $query
        ));

        $return = false;

        if( $db->num_rows($result) )
        {
            $nomes = array();
            while( $row = $db->fetch($result) )
            {
                $nomes[] = array(
                    'dependenteID' => $row['ID'],
                    'nome' => $row['nome']
                );
            }
            $return = $nomes;
        }

        return $return;
    }

    public function getMainValues($qtd)
    {
        return array(
            'CARD' => $qtd * self::CARD_VAL,
            'SLIP_M' => $qtd * self::SLIP_VAL,
            'SLIP_Y' => $qtd * self::CARD_VAL * 12
        );
    }
    
    public function getAllPagValues()
    {
        $db = Instances::getInstance()->Database()->getInstance();
        $id = Instances::getInstance()->Session()->getVar('site_order');

        $people = $db->query(array(
            'sql' => "SELECT COUNT(eg_qf_id) FROM compreamil.gp_eg WHERE eg_qf_id=" . $id
        ));
        $people = $db->fetchOne($people);

        $people++;

        $card1x = (int)$people * self::CARD_VAL * 12;
        $card1x = number_format( $card1x, 2, ',', '.' );

        $card2x = (int)$people * self::CARD_VAL * 6;
        $card2x = number_format( $card2x, 2, ',', '.' );

        $card3x = (int)$people * self::CARD_VAL * 4;
        $card3x = number_format( $card3x, 2, ',', '.' );

        $card4x = (int)$people * self::CARD_VAL * 3;
        $card4x = number_format( $card4x, 2, ',', '.' );

        $card6x = (int)$people * self::CARD_VAL * 2;
        $card6x = number_format( $card6x, 2, ',', '.' );

        $card12x = (int)$people * self::CARD_VAL * 1;
        $card12x = number_format( $card12x, 2, ',', '.' );

        $month = (int)$people * self::SLIP_VAL;
        $month = number_format($month, 2, ',', '.');

        $year = (int)$people * self::CARD_VAL * 12;
        $year = number_format($year, 2, ',', '.');

        return array(
            'card1x' => $card1x,
            'card2x' => $card2x,
            'card3x' => $card3x,
            'card4x' => $card4x,
            'card6x' => $card6x,
            'card12x' => $card12x,
            'slip' => $month,
            'slipYear' => $year
        );
    }

    public function persistSlip($parc)
    {
        $id = Instances::getInstance()->Session()->getVar('site_order');

        /* pagamento */
        $dataPersist = array(
            'slipOrCard' => 2,
            'orderID' => $id
        );

        $pagDao = new Pag_Site_Dao();
        $pag = $pagDao->insert($dataPersist);
        $pagID = $pag->ID;

        /* boleto */
        $sec = Instances::getInstance()->Security()->getInstance();

        $dataPersist = array(
            'parcelas' => $sec->encrypt( ($parc==1)?2:1 ),
            'pagID' => $sec->encrypt($pagID)
        );

        $bolDao = new Slip_Site_Dao();
        $bolDao->insert($dataPersist,false);

        Instances::getInstance()->Request()->redirect( '/sucesso' );
    }

    public function persistCard($data)
    {
        $id = Instances::getInstance()->Session()->getVar('site_order');

        /* pagamento */
        $dataPersist = array(
            'slipOrCard' => 1,
            'orderID' => $id
        );

        $pagDao = new Pag_Site_Dao();
        $pag = $pagDao->insert($dataPersist);
        $pagID = $pag->ID;

        /* cartao */
        $sec = Instances::getInstance()->Security()->getInstance();

        $dataPersist = array(
            'parcelas' => $sec->encrypt(substr($data['tmz-form-pag'],4)),
            'bandeira' => $sec->encrypt($data['tmz-bandeira']),
            'nome' => $sec->encrypt($data['name']),
            'numero' => $sec->encrypt($data['numCart']),
            'codigo' => $sec->encrypt($data['cod']),
            'validade' => $sec->encrypt($data['validade']),
            'pagID' => $sec->encrypt($pagID)
        );

        $cardDao = new Card_Site_Dao();
        $cardDao->insert($dataPersist);

        Instances::getInstance()->Request()->redirect( '/sucesso' );
    }
}