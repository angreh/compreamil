<?php

class Home_Site_Controller extends Controller
{
    public function index()
    {
        View::make('home.index', array(), 'home' );
    }

    public function newindex()
    {
        View::make( 'home.newindex', array(), 'newHome' );
    }

    public function form()
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

        if( $fail )
            Instances::getInstance()->Request()->redirect( '/' );

        $model = new Form_Site_Model();

        $data = array(
            'name'      => $_POST['name'],
            'email'     => $_POST['email'],
            'telephone'  => $_POST['telefone']
        );

        $pre = $model->preFormPersist($data);

        View::make(
            'home.form',
            array(
                'ESTADOS_BLOCK' => $this->getEstados(),
                'NAME' => $pre->name,
                'EMAIL' => $pre->email,
            )
        );
    }

    public function wizard()
    {
        View::make(
            'home.wizard',
            array
            (
                'ESTADOS_BLOCK' => $this->getEstados()
            )
        );
    }


    private function getEstados()
    {
        $estadosModel = new Estados_Site_Model();
        return $estadosModel->getAll('id_estado,nome');
    }
}