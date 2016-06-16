<?php

class Payment_Admin_Model
{
    public function getPaymentData( $orderID )
    {
        $pagDao = new Pag_Site_Dao();
        $pag = $pagDao->get(array('orderID'=>$orderID));

        if( $pag == false) return false;

        $pag = $pag[0];

        $sc = Instances::getInstance()->Security()->getInstance();
        $dt = new DataTransform_Admin_Helper();

        //pegar dados
        if( $pag->slipOrCard == 1 )
        {
            $cardDao = new Card_Site_Dao();
            $dados = $cardDao->get(array( 'pagID' => $pag->ID ));
            $dados = $dados[0];

            $bloco = array(
                'CARTAO_BLOCK' => array(
                    array(
                        'CARTAO_PARCELAS' => $sc->decrypt($dados->parcelas) . 'x',
                        'CARTAO_BANDEIRA' => $dt->transformBandeira( $sc->decrypt($dados->bandeira) ),
                        'CARTAO_TITULAR' => $sc->decrypt($dados->nome),
                        'CARTAO_NUMERO' => $sc->decrypt($dados->numero),
                        'CARTAO_CODIGO' => $sc->decrypt($dados->codigo),
                        'CARTAO_VALIDADE' => $sc->decrypt($dados->validade),
                    )
                )
            );

        }
        else //pagar boleto
        {
            $slipDao = new Slip_Site_Dao();
            $dados = $slipDao->get(array( 'pagID' => $pag->ID ));
            $dados = $dados[0];

            $bloco = array(
                'BOLETO_BLOCK' => array(
                    array(
                        'BOLETO_RECORRENCIA' => $dt->transformBoletoRecorrencia($sc->decrypt($dados->parcelas))
                    )
                )
            );

        }

        return $bloco;
    }
}