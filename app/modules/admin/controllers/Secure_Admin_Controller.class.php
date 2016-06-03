<?php

class Secure_Admin_Controller extends Controller
{
    public function init()
    {
        parent::init();

        if( Instances::getInstance()->Session()->getVar( 'login' ) === false )
        {
            Instances::getInstance()->Request()->redirect( '/adm/login' );
        }
    }
}