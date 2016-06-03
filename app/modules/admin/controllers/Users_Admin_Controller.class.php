<?php

class Users_Admin_Controller extends Secure_Admin_Controller
{
    public function index()
    {
        $usersModel = new Users_Admin_Model();
        $users = $usersModel->getAllUsers();
        View::make(
            'users.index',
            array(
                'PAGE_TITLE' => 'Usuários',
                'USERS_BLOCK' => $users,
            )
        );
    }

    public function add()
    {
        if( isset($_POST['user']) )
        {
            $userModel = new Users_Admin_Model();
            $data = array(
                'user' => $_POST['user'],
                'pass' => $_POST['senha'],
                'nivel' => $_POST['nivel']
            );

            $userModel->addUser( $data );
        }

        View::make('users.add',array(
            'PAGE_TITLE' => 'Usuários'
        ));
    }

    public function edit()
    {
        $id = Instances::getInstance()->Request()->getDataValue('id');

        $userModel = new Users_Admin_Model();
        $user = $userModel->getUser($id);

        View::make('users.edit',array(
            'PAGE_TITLE' => 'Usuários',
            'ID' => $user->ID,
            'USER' => $user->user,
            'NIVEL' => $user->nivel
        ));
    }

    public function remove()
    {
        $id = Instances::getInstance()->Request()->getDataValue('id');

        $userModel = new Users_Admin_Model();
        $userModel->removeUser($id);

        Instances::getInstance()->Request()->redirect( '/adm/usuarios' );
    }
}