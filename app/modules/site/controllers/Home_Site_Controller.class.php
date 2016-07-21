<?php

class Home_Site_Controller extends Controller
{
    public function index()
    {
        View::make('home.index', array(), 'home' );
    }

    public function newindex()
    {
        View::make( 'home.newindex', array(), 'newHome' );
    }

    public function form()
    {
//        exit(var_dump($_POST));

        if( isset($_POST['form']) && !empty($_POST['form']) )
        {
            $formType = $_POST['form'];
            unset($_POST['form']);
            switch ($formType) {
                case 'fullform':
                    $this->persistFullForm($_POST);
                    break;
                case 'pre':
                    $this->persistPreForm($_POST);
                    break;
            }
        }

        $id = Instances::getInstance()->Session()->getVar('site_order');

        if( empty($id) || $id == false )
            Instances::getInstance()->Request()->redirect( '/' );

        $dao = new Order_Site_Dao();
        $order = (object) $dao->getOneWithPre( $id );

        View::make(
            'home.form',
            array(
                'ESTADOS_BLOCK' => $this->getEstados(),
                'NAME' => $order->name,
                'EMAIL' => $order->email,
                'ID' => ''
            )
        );
    }

    public function wizard()
    {
        View::make(
            'home.wizard',
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

    private function persistFullForm($data)
    {
        $id = Instances::getInstance()->Session()->getVar('site_order');

        /* titular */
        $dataResp['orderID'] = $id;
        $dataResp['cpf'] = $data['cpf'];
        $dataResp['rg'] = $data['rg'] . ' ' . $data['emissor'];
        $dataResp['nascimento'] = $data['dataNascimento'];
        $dataResp['sexo'] = $data['sexo'];
        $dataResp['estadoCivil'] = $data['estadoCivil'];
        $dataResp['telRes'] = $data['telefoneResidencial'];
        $dataResp['telCel'] = $data['telefoneCelular'];
        $dataResp['mae'] = $data['nomeMae'];

        $titularDao = new Titular_Site_Dao();
        $titular = $titularDao->insert($dataResp);

        /* endereço */
        $dataEnd['logradouro'] = $data['logradouro'];
        $dataEnd['numero'] = $data['numero'];
        $dataEnd['complemento'] = $data['complemento'];
        $dataEnd['bairro'] = $data['bairro'];
        $dataEnd['cidade'] = $data['cidade'];
        $dataEnd['estado'] = $data['estado'];
        $dataEnd['cep'] = $data['cep'];
        $dataEnd['orderID'] = $id;

        $endDao = new End_Site_Dao();
        $endereco = $endDao->insert($dataEnd);

        /* responsavel financeiro */
        if($data['responsavel'] == 'false') {
            $dataRespFin['nome'] = $data['resp_nome'];
            $dataRespFin['cpf'] = $data['resp_cpf'];
            $dataRespFin['nascimento'] = $data['resp_dataNascimento'];
            $dataRespFin['sexo'] = $data['resp_sexo'];
            $dataRespFin['estadoCivil'] = $data['resp_estadoCivil'];
            $dataRespFin['email'] = $data['resp_email'];
            $dataRespFin['parentesco'] = $data['resp_grauParentesco'];
            $dataRespFin['orderID'] = $id;

            $finDao = new Responsavel_Site_Dao();
            $fin = $finDao->insert($dataRespFin);
        }

        /* detalhes */
        $dataDetails['onlineOffline'] = $data['busca_rede'];
        $dataDetails['aceito'] = $data['aceito'];
        $dataDetails['orderID'] = $id;

        $detalhesDao = new Detalhes_Site_Dao();
        $detalhes = $detalhesDao->insert($dataDetails);

        Instances::getInstance()->Request()->redirect( '/dependentes' );
    }

    private function persistPreForm($data)
    {
        if( isset( $data['name'] ) )
        {
            $fail = false;
            if (!Instances::getInstance()->Validator()->null($data['name'])) {
                $fail = true;
                Instances::getInstance()->Alerts()->error('Nome inválido');
            }

            if (!Instances::getInstance()->Validator()->email($data['email'])) {
                $fail = true;
                Instances::getInstance()->Alerts()->error('Email inválido.');
            }

            if (!Instances::getInstance()->Validator()->phone($data['telephone'])) {
                $fail = true;
                Instances::getInstance()->Alerts()->error('Telefone inválido.');
            }

            if ($fail)
                Instances::getInstance()->Request()->redirect('/');
        }

//        exit(var_dump($_POST));

        $model = new Form_Site_Model();
        $model->preFormPersist($data);

        if($data['solicitaLigacao']=='sim')
        {
            Instances::getInstance()->Request()->redirect('solicitada');
        }
    }

    public function dependents()
    {
        $id = Instances::getInstance()->Session()->getVar('site_order');

        if( isset($_POST['nome']) && !empty($_POST['nome']) )
        {
            $_POST['orderID'] = $id;
            $this->addDependent($_POST);
        }

        $model = new Order_Site_Model();
        $titular = $model->getMainName($id);

        $dependentes = $model->getDependentsNames($id);

        $vars = array(
            'TITULAR_NOME' => $titular
        );

        $people = 1;
        if( $dependentes != false )
        {
            $vars['BLOCK_DEPENDENTES'] = $dependentes;
            $people += sizeof($dependentes);
        }

        $pagValues = $model->getMainValues($people);

        $vars['CARTAO'] = number_format($pagValues['CARD'],2,',','.');
        $vars['BOL'] = number_format($pagValues['SLIP_M'],2,',','.');
        $vars['BOLANUAL'] = number_format($pagValues['SLIP_Y'],2,',','.');

        View::make(
            'home.dependents',
            $vars
        );
    }

    public function addDependent($data)
    {
        $dataInsert['nome'] = $data['nome'];
        $dataInsert['cpf'] = $data['cpf'];
        $dataInsert['nascimento'] = $data['dataNascimento'];
        $dataInsert['sexo'] = $data['sexo'];
        $dataInsert['parentesco'] = $data['parentensco'];
        $dataInsert['mae'] = $data['nomeMae'];
        $dataInsert['estadoCivil'] = $data['estadoCivil'];
        $dataInsert['orderID'] = $data['orderID'];

        $depDao = new Dependentes_Site_Dao();
        $dependete = $depDao->insert($dataInsert);
    }

    public function depremove()
    {
        $id = Instances::getInstance()->Request()->getDataValue('id');

        $dao = new Dependentes_Site_Dao();
        $dao->remove($id);

        Instances::getInstance()->Request()->redirect( '/dependentes' );
    }

    public function hire()
    {
        if( isset( $_POST['tmz-form-pag'] ) && !empty( $_POST['tmz-form-pag'] ) )
        {
            $model = new Order_Site_Model();

            $method = substr($_POST['tmz-form-pag'],0,4);
            $parc = substr($_POST['tmz-form-pag'],4);

            if( $method == 'slip' )
            {
                $model->persistSlip( $parc );
            }
            else //insere os dados do cartão
            {
                $model->persistCard( $_POST );
            }
        }

        $model = new Order_Site_Model();
        $values = $model->getAllPagValues();

        $orcType = Instances::getInstance()->Session()->getVar('orcamentoType');
        if( $orcType != false )
        {
            $orcType .= '_' . Instances::getInstance()->Session()->getVar('orcamentoQtd');
            $values['PRESET'] = $orcType;
        }
        else
        {
            $values['PRESET'] = 'none';
        }

        View::make('home.contratar',$values);
    }

    public function success()
    {
        $id = Instances::getInstance()->Session()->getVar('site_order');

        $alterData = array(
            'ID' => $id,
            'status' => 3
        );

        $orderDao = new Order_Site_Dao();
        $orderDao->alterOne($alterData);
        View::make('home.success');
    }

    public function successCall()
    {
        View::make('home.successCall');
    }
}