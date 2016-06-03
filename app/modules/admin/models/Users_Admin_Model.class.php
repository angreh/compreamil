<?php

class Users_Admin_Model
{
    public function getAllUsers()
    {
        $usersDao = new User_Site_Dao();
        $users = $usersDao->getAll(array(
            'fetch'=>'array',
            'columns' => array(
                'user',
                'nivel',
                'ID'
            )
        ));

        return $users;
    }

    public function addUser($data)
    {
        $data['pass'] = md5($data['pass']);
        $usersDao = new User_Site_Dao();
        $usersDao->insert($data);

        Instances::getInstance()->Request()->redirect('/adm/usuarios');
    }

    /**
     * @param $id
     * @return User_Site_Bo
     */
    public function getUser($id)
    {
        $userDao = new User_Site_Dao();
        $user = $userDao->get($id);

        return $user;
    }

    public function removeUser($id)
    {
        $userDao = new User_Site_Dao();
        $userDao->remove($id);
    }
}