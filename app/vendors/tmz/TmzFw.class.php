<?php

/**
 * Núcleo funcional do CaraFW
 *
 * @autor Angreh - angreh@gmail.com
 */
class TmzFw {

    //Atalho para reduzir linha de código no index.php
    public function __construct() {
        $this->init();
    }

    /**
     * O Init é a função que faz o framework rodar carregando todas as diretrizes
     * e chamando todas as funções necessárias
     */
    private function init() {

        // Includes Necessários
        require LIBRARY_PATH . 'tmz/Instances.class.php';
        require LIBRARY_PATH . 'tmz/AutoLoader.class.php';

        // Instaciando Helpers para uso do sistema
        $instances = Instances::getInstance();

        /**
         * Carregando Autoloader
         *
         * O AutoLoader faz executa a função require para as classes
         * automaticamente
         */
        $instances->AutoLoader()->register();

        /**
         * Inicializa as configurações do banco de dados
         */



        $instances->Database()->init();

        $instances->Request()->init();


        // Instancia o controller e chama actions definidas pelo request
        $file_object = $instances->Request()->getControllerPath();
        if (file_exists($file_object)) {
            // Instacia a classe do controller;
            $class = $instances->Request()->getControllerClassName();
            $object = new $class($instances);

            // Carrega ação chamada;
            $action = $instances->Request()->getAction();
            $object->action($action);
        } else {
            exit('Controller não encontrado!' . " ($file_object)");
        }
    }

}