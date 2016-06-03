<?php
/**
 * Created by PhpStorm.
 * User: Angreh
 * Date: 7/26/2015
 * Time: 10:47 AM
 */
class View
{
    /**
     * @var Template
     */
    private static $tpl;

    /**
     * Carrega o layout, define blocos e variável que serão usados para o layout
     *
     * @param string $view
     * @param array $vars
     * @param mixed $layout
     */
    public static function make( $view, $vars = array(), $layout = true )
    {
        $module = Request::getInstance()->getModule();

        /*
         * Separando as partes informadas nas views
         */
        $aux = explode( '.', $view );

        $view_parts = array
        (
            'controller' => $aux[0],
            'function' => $aux[1]
        );

        self::setLayout( $module, $layout );

        /*
         * Carrega o arquivo de layout
         */
        $file_view = realpath( MODULES_PATH . $module . '/views/' . $view_parts['controller'] . '/' . $view_parts['function'] . '.html' );

        if( self::$tpl->exists( 'MENU' ) )
        {
            $file = realpath( MODULES_PATH . $module . '/views/menus/' . Instances::getInstance()->Session()->User()->nivel . '.html');
            self::$tpl->addFile('MENU', $file );
        }

        /*
         * Define CONTENT como variável padrão para conteudo das views
         */
        self::$tpl->addFile('CONTENT', $file_view);

        self::inView();

        self::setVars($vars);

        self::show();
    }

    public static function setLayout( $module = false, $layout = true )
    {
        $module = ($module)?$module:Request::getInstance()->getModule();

        /*
         * Decide se vai ter layout e qual vai ser usado
         */
        if ( $layout === false )
        {
            self::$tpl = Template::getInstance( MODULES_PATH . $module . '/views/layouts/no-layout.html');
        }
        else
        {
            $layout = ( $layout === true )? 'index' : $layout;
            self::$tpl = Template::getInstance( MODULES_PATH . $module . '/views/layouts/' . $layout . '.html');
        }
    }

    public static function show()
    {
        /*
         * Carrega o template
         */
        self::$tpl->show();
    }

    /**
     * Não utilizada ainda
     */
    public static function inView() {
        if (self::$tpl->exists('ALERT_ERRORS')) {
            self::$tpl->ALERT_ERRORS = Instances::getInstance()->Alerts()->showErrors();
        }
        if (self::$tpl->exists('ALERT_WARNINGS')) {
            //self::$tpl->ALERT_WARNINGS = $this->instances->Alerts()->showWarnings();
        }
        if (self::$tpl->exists('ALERT_SUCCESS')) {
            //self::$tpl->ALERT_SUCCESS = $this->instances->Alerts()->showSuccess();
        }
    }

    /**
     * Define variaveis e bloco de variáveis
     *
     * @param $vars
     */
    public static function setVars($vars)
    {
        if (!empty($vars)) {
            foreach ($vars as $var => $value) {
                if (is_array($value)) {
                    foreach ($value as $object) {
                        foreach ($object as $bvar => $bvalue) {
                            $bvar = strtoupper($bvar);
                            self::$tpl->$bvar = $bvalue;
                        }
                        self::$tpl->block($var);
                    }
                } else {
                    if(self::$tpl->exists($var))
                    {
                        self::$tpl->$var = $value;
                    }
                }
            }
        }
    }
}