<?php

class Alerts
{
    /**
     * guarda a instancia estatica dessa classe
     */
    private static $_instance = null;

    /**
     * @return Alerts
     */
    public static function getInstance()
    {
        if (self::$_instance == null)
            self::$_instance = new self();
        return self::$_instance;
    }

    public function __construct(){
        @ session_start();
    }

    public function error( $message )
    {
        if( !isset($_SESSION['ALERTS_ERRORS']) )
        {
            $_SESSION['ALERTS_ERRORS'] = array();
        }
        $_SESSION['ALERTS_ERRORS'][] = '<p>' . $message . '</p>';
    }

    public function showErrors()
    {
        if( isset($_SESSION['ALERTS_ERRORS']) )
        {
            $messages = '<div class="ALERTS_ERRORS">' . implode('', $_SESSION['ALERTS_ERRORS']) . '</div>';
            unset( $_SESSION['ALERTS_ERRORS'] );
            return $messages;
        }
    }
}