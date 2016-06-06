<?php

$routes = array
(
    //site
    ''                  => 'site/home/index',
    'cadastro'          => 'site/home/form',
    'wizard'            => 'site/home/wizard',
    'new'               => 'site/home/newindex',

    'orcamento'         => 'site/orcamento/index',
    'orcamento/calc'         => 'site/orcamento/calc',


    //site actions
    'compre'            => 'site/actions/compre',

    //Páginas
    'conheca'           => 'site/pages/conheca',
    'redecredenciada'   => 'site/pages/redecredenciada',
    'amildental'        => 'site/pages/amildental',
    'diferencial'       => 'site/pages/diferencial',

    //contato
    'contato'           => 'site/contato/index',

    //admin
    'adm/login'         => 'admin/login/index',
    'adm/logout'        => 'admin/login/logout',
    'adm'               => 'admin/home/index',

    //pedidos
    'adm/pedidos'       => 'admin/pedidos/index',

    //usuários
    'adm/usuarios'              => 'admin/users/index',
    'adm/usuarios/add'          => 'admin/users/add',
    'adm/usuarios/edit/{id}'    => 'admin/users/edit',
    'adm/usuarios/remove/{id}'  => 'admin/users/remove',
);