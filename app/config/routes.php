<?php

$routes = array
(
    //site
    ''                      => 'site/home/index',
    'cadastro'              => 'site/home/form',
    'dependentes'           => 'site/home/dependents',
    'dependentes/rem/{id}'  => 'site/home/depremove',
    'contratar'             => 'site/home/hire',
    'sucesso'               => 'site/home/success',
    'solicitada'            => 'site/home/successCall',
    'wizard'                => 'site/home/wizard',
    'new'                   => 'site/home/newindex',

    'orcamento'             => 'site/orcamento/index',
    'orcamento/calc'        => 'site/orcamento/calc',
    'ajaxestimate'          => 'site/orcamento/presave',
    'orcamento/preset'      => 'site/orcamento/preset',


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
    'adm/pedidos'                                       => 'admin/pedidos/index',
    'adm/dependente/remover/{orderid}/{depid}'          => 'admin/pedidos/removerdependente',
    'adm/pedido/progresso/{orderid}/{progress}'         => 'admin/pedidos/alterProgress',
    'adm/pedido/{id}'                                   => 'admin/pedidos/show',
    'adm/autosave'                                      => 'admin/pedidos/autosave',

    //usuários
    'adm/usuarios'              => 'admin/users/index',
    'adm/usuarios/add'          => 'admin/users/add',
    'adm/usuarios/edit/{id}'    => 'admin/users/edit',
    'adm/usuarios/remove/{id}'  => 'admin/users/remove',

    //Testes
    'adm/testes/datatable'      => 'admin/testes/datatable',
);