<?php

class Orcamento_Site_Controller extends Controller
{
    const CARD_VAL = 41.65;
    const SLIP_VAL = 49;

    public function index()
    {
        View::make( 'orcamento.index' );
    }

    public function calc()
    {
        $fail = false;
        if( !Instances::getInstance()->Validator()->null($_POST['name']) )
        {
            $fail = true;
            Instances::getInstance()->Alerts()->error('Nome inválido');
        }

        if( !Instances::getInstance()->Validator()->email($_POST['email']) )
        {
            $fail = true;
            Instances::getInstance()->Alerts()->error('Email inválido.');
        }

        if( !Instances::getInstance()->Validator()->phone($_POST['telefone']) )
        {
            $fail = true;
            Instances::getInstance()->Alerts()->error('Telefone inválido.');
        }

        if( empty($_POST['numero']) )
        {
            $fail = true;
            Instances::getInstance()->Alerts()->error('É necessário informar o número de pessoas.');
        }


        if( $fail )
            exit( 'redirect' );

        $dataPre = array(
            'name'      => $_POST['name'],
            'email'     => $_POST['email'],
            'telephone'  => $_POST['telefone'],
            'people'    => isset($_POST['numero'])?$_POST['numero']:0
        );

        $model = new Form_Site_Model();
        $model->orcamento( $dataPre );

        $data = $_POST;
        if( $data['pag'] == 'cartao' )
        {
            $this->cartao($data);
        }
        else
        {
            $this->boleto($data);
        }
    }

    private function cartao($data)
    {
        $people = $data['numero'];

        $card1x = (int)$people * self::CARD_VAL * 12;
        $card1x = 'R$ ' . number_format( $card1x, 2, ',', '.' );

        $card2x = (int)$people * self::CARD_VAL * 6;
        $card2x = 'R$ ' . number_format( $card2x, 2, ',', '.' );

        $card3x = (int)$people * self::CARD_VAL * 4;
        $card3x = 'R$ ' . number_format( $card3x, 2, ',', '.' );

        $card4x = (int)$people * self::CARD_VAL * 3;
        $card4x = 'R$ ' . number_format( $card4x, 2, ',', '.' );

        $card6x = (int)$people * self::CARD_VAL * 2;
        $card6x = 'R$ ' . number_format( $card6x, 2, ',', '.' );

        $card12x = (int)$people * self::CARD_VAL * 1;
        $card12x = 'R$ ' . number_format( $card12x, 2, ',', '.' );

        View::make('orcamento.cartao',array(
            'CARD_1X' => $card1x,
            'CARD_2X' => $card2x,
            'CARD_3X' => $card3x,
            'CARD_4X' => $card4x,
            'CARD_6X' => $card6x,
            'CARD_12X' => $card12x,
            'PLAN_DETAIL' => ($people>1)?'FAMÍLIA':'INDIVIDUAL'
        ),false);
    }

    private function boleto($data)
    {
        $people = $data['numero'];

        $month = (int)$people * self::SLIP_VAL;
        $month = 'R$ ' . number_format($month, 2, ',', '.');

        $year = (int)$people * self::CARD_VAL * 12;
        $year = 'R$ ' . number_format($year, 2, ',', '.');

        View::make('orcamento.boleto',array(
            'MONTH_PRICE' => $month,
            'YEAR_PRICE' => $year,
            'PLAN_DETAIL' => ($people>1)?'FAMÍLIA':'INDIVIDUAL'
        ), false);
    }

}