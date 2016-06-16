<?php

class DataTransform_Admin_Helper
{
    public function transformSexo( $data )
    {
        $val = false;
        switch($data)
        {
            case 1:
                $val = 'Masculino';
                break;
            case 2:
                $val = 'Feminino';
                break;
        }

        return $val;
    }

    public function transformEstadoCivil( $data )
    {
        $val = false;
        switch($data)
        {
            case 1:
                $val = 'Casado(a)';
                break;
            case 2:
                $val = 'Divorciado(a)';
                break;
            case 3:
                $val = 'Outros';
                break;
            case 4:
                $val = 'Separado(a)';
                break;
            case 5:
                $val = 'Solteiro(a)';
                break;
            case 6:
                $val = 'Viúvo(a)';
                break;
        }

        return $val;
    }

    public function transformMetodo( $data )
    {
        $val = false;
        switch($data)
        {
            case 1:
                $val = 'Wizard';
                break;
            case 2:
                $val = 'Formulário Inteirisso';
                break;
            case 3:
                $val = 'Orçamento';
                break;
        }

        return $val;
    }

    public function transformStatus( $data )
    {
        $val = false;
        switch($data)
        {
            case 1:
                $val = 'Incompleto';
                break;
            case 2:
                $val = 'Inválido';
                break;
            case 3:
                $val = 'Completo';
                break;
            case 4:
                $val = 'Simulação';
                break;
            case 5:
                $val = 'Solicitação de Ligação';
                break;
        }

        return $val;
    }

    public function transformParentesco( $data )
    {
        $val = false;
        switch($data)
        {
            case 1:
                $val = 'Cônjuge';
                break;
            case 2:
                $val = 'Filho(a)';
                break;
            case 3:
                $val = 'Irmão/Irmã';
                break;
            case 4:
                $val = 'Outro';
                break;
            case 5:
                $val = 'Pai/Mãe';
                break;
            case 6:
                $val = 'Sogro(a)';
                break;
        }

        return $val;
    }

    public function transformBusca( $data )
    {
        $val = false;
        switch($data)
        {
            case 1:
                $val = 'Online';
                break;
            case 2:
                $val = 'Offline';
                break;
        }

        return $val;
    }

    public function transformBandeira( $data )
    {
        $val = false;
        switch($data)
        {
            case 1:
                $val = 'Visa';
                break;
            case 2:
                $val = 'Mastercard';
                break;
        }

        return $val;
    }

    public function transformBoletoRecorrencia( $data )
    {
        $val = false;
        switch($data)
        {
            case 1:
                $val = 'Mensal';
                break;
            case 2:
                $val = 'Anual';
                break;
        }

        return $val;
    }

    public function boToArray( $obj )
    {
        $arr = array();
        foreach( $obj as $key => $value )
        {
            if (
                $key != 'table' &&
                $key != 'ID' &&
                $key != 'map' &&
                $key != 'orderID'
            ) {
                $arr[strtoupper($key)] = $value;
            }
        }
        return $arr;
    }

}