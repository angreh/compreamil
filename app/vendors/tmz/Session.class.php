<?php

class Session
{

    /**
     * guarda a instancia estatica dessa classe
     */
    private static $_instance = null;

    /**
     * @return Session
     */
    public static function getInstance()
    {
        if (self::$_instance == null)
            self::$_instance = new self();
        return self::$_instance;
    }

    public function setVar( $var, $varValue = null )
    {
        @ session_start();
        if( is_array($var) )
        {
            foreach( $var as $field => $value )
            {
                $_SESSION[$field] = $value;
            }
        }
        else
        {
            $_SESSION[$var] = $varValue;
        }
    }

    public function getVar( $var )
    {
        @ session_start();
        if( isset( $_SESSION[$var] ) && !empty( $_SESSION[$var] ) )
        {
            return $_SESSION[$var];
        }
        return false;
    }

    public function unsetVar( $var )
    {
        @ session_start();
        if( isset( $_SESSION[$var] ) && !empty( $_SESSION[$var] ) )
        {
            unset( $_SESSION[$var] );
        }
    }

    /**
     * @return User_Site_Bo
     */
    public function User()
    {
        @ session_start();
        return unserialize( $this->getVar( 'login' ) );
    }
}