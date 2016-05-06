<?php

class Estados_Site_Model
{
    public function getAll($columns = '*')
    {
        $result = Database::getInstance()->query(
            array(
                'sql' => "SELECT $columns FROM estados"
            )
        );
        $estados = array();
        while ( $row = Database::getInstance()->fetchObject($result, 'stdClass' ) )
        {
            $estados[] = $row;
        }
        return $estados;
    }
}