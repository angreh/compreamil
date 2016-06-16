<?php

class Dao
{
    public $bo;

    public function insert($data, $debug = false)
    {
        $columnsArr = $valuesArr = array();

        $data = $this->preFormatValue($data);
        foreach( $data as $field => $value )
        {
            $columnsArr[] = $this->bo->map[$field];
            $valuesArr[] = $value;
        }
        $columns = implode( ',', $columnsArr );
        $values = implode( ',', $valuesArr );

        Instances::getInstance()->Database()->query
        (
            array
            (
                'sql' => "INSERT INTO " .$this->bo->table . " ($columns) VALUES ($values)",
                'debug' => $debug
            )
        );

        $id = Instances::getInstance()->Database()->last_insert_id();
        $bo = $this->get($id);

        return $bo;
    }

    public function get($data,$debug = false)
    {
        //exit(var_dump($data));
        if( is_array($data) )
        {
            $data = $this->preFormatValue($data);

            $where = array();
            foreach( $data as $field => $value )
            {
                $where[] = $this->bo->map[$field] . "=" . $value;
            }

            $result = Instances::getInstance()->Database()->query( array(
                'sql' => "SELECT * FROM " . $this->bo->table . " WHERE " . implode( ' AND ', $where ),
                'debug' => $debug
            ));

            $numRows = Instances::getInstance()->Database()->num_rows($result);
            if($numRows < 1) return false;

            $inverseMap = array_flip($this->bo->map);
            $class = get_class($this->bo);
            $list = array();

            while($row = Instances::getInstance()->Database()->fetch($result))
            {
                if( is_array($row) )
                {
                    $bo = new $class();

                    foreach ( $row as $field => $value )
                    {
                        $bo->{$inverseMap[$field]} = $value;
                    }
                }

                $list[] = $bo;
            }

            return $list;
        }
        else // $data nessa caso é referente ao ID
        {
            $result = Instances::getInstance()->Database()->query( array(
                'sql' => "SELECT * FROM " . $this->bo->table . " WHERE " . $this->bo->map['ID'] . "=" . $data,
                'debug' => $debug
            ));

            $inverseMap = array_flip($this->bo->map);
            $classArr = Instances::getInstance()->Database()->fetch($result);

            if( is_array($classArr) )
            {
                foreach ( $classArr as $field => $value )
                {
                    $this->bo->{$inverseMap[$field]} = $value;
                }
            }

            return $this->bo;
        }

    }

    public function getAll( $options = array() )
    {
        $default = array(
            'columns' => '*',
            'fetch' => 'object'
        );

        $options = (object) array_merge($default, $options);

        if( $options->columns != '*' )
        {
            $columnsArr = array();
            foreach( $options->columns as $fd )
            {
                $columnsArr[] = $this->bo->map[$fd];
            }
            $options->columns = implode( ',', $columnsArr );
        }

        $result = Instances::getInstance()->Database()->query( array(
            'sql' => "SELECT " . $options->columns . " FROM " . $this->bo->table
        ));

        $inverseMap = array_flip($this->bo->map);

        $arr = array();
        while( $row = Instances::getInstance()->Database()->fetch($result) )
        {
            if( $options->fetch == 'array' )
            {
                $it = array();
                foreach ( $row as $field => $value )
                {
                    $it[$inverseMap[$field]] = $value;
                }
                $arr[] = $it;
            }
            else
            {
                foreach ( $row as $field => $value )
                {
                    $this->bo->{$inverseMap[$field]} = $value;
                }
                $arr[] = $this->bo;
            }
        }
        return $arr;

    }

    public function alterOne($data, $debug = false)
    {
        $id = $data['ID'];
        unset( $data['ID'] );

        if( empty($data['pass']) )
            unset($data['pass']);
        else
            $data['pass'] = md5($data['pass']);

        $data = $this->preFormatValue($data);

        $fieldsArr = array();
        foreach( $data as  $field => $value )
        {
            $fieldsArr[] = $this->bo->map[$field] . '=' . $value;
        }
        $fields = implode( ',', $fieldsArr );

        $result = Instances::getInstance()->Database()->query(array(
            'sql'   => "UPDATE " . $this->bo->table . " SET $fields WHERE " . $this->bo->map['ID'] . '=' . $id,
            'debug' => $debug
        ));
    }

    public function remove ($id)
    {
        $result = Instances::getInstance()->Database()->query(array(
            'sql' => 'DELETE FROM ' . $this->bo->table . ' WHERE ' . $this->bo->map['ID'] . '=' . $id,
            'debug' => false
        ));
        return $result;
    }

    public function preFormatValue( $dataArr )
    {
        $formatedArr = array();
        foreach ( $dataArr as $field => $value )
        {
            if(
                ( !is_numeric($value) && $value !== null ) ||
                $field == 'telephone'
            )
            {
                $formatedArr[$field] = "'" . $value . "'";
            } elseif( $value === null )
            {
                $formatedArr[$field] = 'NULL';
            }
            else
            {
                $formatedArr[$field] = $value;
            }

        }

        return $formatedArr;
    }
}