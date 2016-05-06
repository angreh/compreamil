<?php

class Home_Site_Controller extends Controller
{
    public function index()
    {
        View::make('site.home.index');
    }

    public function form()
    {
        View::make(
            'site.home.form',
            array(
                'ESTADOS_BLOCK' => $this->getEstados()
            )
        );
    }

    public function wizard()
    {
        View::make(
            'site.home.wizard',
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