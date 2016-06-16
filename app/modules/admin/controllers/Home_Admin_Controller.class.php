<?php

class Home_Admin_Controller extends Secure_Admin_Controller
{

    public function index()
    {
        Instances::getInstance()->Request()->redirect('/adm/pedidos');

        View::make('home.index', array(
            'PAGE_TITLE' => 'Seja bem-vindo(a)!'
        ));

//        echo 'opaweow<br>';
//        echo MD5('admin') . '<br>';
//        echo $this->instances->Security()->encrypt('admin') . '<br>';
//        echo $this->instances->Security()->decrypt('YWRtaW4=');

    }

}