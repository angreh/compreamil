
<?php

class Security {

    const SALT = 'EF20EE0E31E0EA2E6153DF3C6A7C131757C7C986';

    /**
     * guarda a instancia estatica dessa classe
     */
    private static $_instance = null;

    /**
     * Pega a instancia ativa da classe ou cria uma caso nao exista e a retorna
     *
     * @return Security
     */
    public static function getInstance() {
        if (self::$_instance == null)
            self::$_instance = new self();
        return self::$_instance;
    }

    public function encrypt($plain)
    {
        return str_rot13( base64_encode( gzdeflate( $plain . self::SALT ) ) );
    }

    public function decrypt($cipher)
    {
        $cipher = gzinflate( base64_decode( str_rot13(  $cipher ) ) );
        return str_replace(self::SALT,'',$cipher);
    }

}