<?php

/**
 * Responsável por chamar a funções do controlador e contruir as páginas através
 * da classe template
 *
 * @author Angreh (angreh@gmail.com)
 * @version 2.0
 */
abstract class Controller {

    /**
     * Armazena a instancia do instances, para maiores informações veja a
     * classe Instances.class.php
     * @var Instances
     */
    protected $instances;

    /**
     * Classe
     * @var DefaultMapper
     */
    protected $mapper;

    /**
     * Instancia o instances e chama a função init
     * @param instancess $instances
     */
    public function __construct($instances = NULL) {
        if ($instances != NULL) {
            $this->instances = $instances;
        }
        $this->init();

        include 'View.class.php';
    }

    /**
     * método criado para ser reescrito caso seja necessário alguma inicialização
     * pré-action
     */
    protected function init() {

    }

    /**
     * Verifica se o método chamado existe e em caso positivo o chama, verifica
     * também se foi ativado a classe template e a carrega
     *
     * @param string $action
     * @throws Exception
     */
    public function action($action) {
        if (method_exists($this, $action))
        {
            $this->$action();
        }
        else
        {
            exit(var_dump('Método ' . $action . ' não encontrado.'));
        }
    }

}