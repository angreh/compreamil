<?php

class Login_Admin_Controller extends Controller
{
    public function index()
    {
        if(
            isset( $_POST['usuario'] ) &&
            !empty( $_POST['usuario'] ) &&
            isset( $_POST['senha'] ) &&
            !empty( $_POST['senha'] )
        ){
            $data = array(
                'user' => $_POST['usuario'],
                'pass' => md5( $_POST['senha'] )
            );
            $userDao = new User_Site_Dao();
            $user = $userDao->get( $data );

            if( $user->ID != null )
            {
                Instances::getInstance()->Session()->setVar( 'login', serialize($user) );
                Instances::getInstance()->Request()->redirect( '/adm' );
            }
            else
            {
                Instances::getInstance()->Alerts()->error('Combinação <strong>usuário/senha</strong> não existe.');
            }
        }
        elseif ( isset( $_POST['usuario'] ) && !empty($_POST['usuario']) && empty( $_POST['senha'] ) )
        {
            Instances::getInstance()->Alerts()->error('Por favor insira uma <strong>senha</strong>');
        }
        elseif ( isset( $_POST['usuario'] ) && empty( $_POST['usuario'] ) )
        {
            Instances::getInstance()->Alerts()->error('Por favor insira um <strong>usuário</strong>');
        }

        View::make( 'login.index', array(), 'login' );
    }

    public function logout()
    {
        Instances::getInstance()->Session()->unsetVar( 'login' );
        Instances::getInstance()->Request()->redirect( '/adm' );
    }
}