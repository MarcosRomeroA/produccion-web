<?php

abstract class DAO
{
    protected $con;
    protected $table;

    abstract public function getOne($id);
    abstract public function getAll($where = array());

    public function __construct($con)
    {
        $this->con = $con;
    }
    
    public function save($datos = array())
    {
        $column =array();
        $values = array();
        
        foreach ($datos as $key=>$value) {
            if (!empty($value)) {
                $column[] = $key;
                $values[] = $value;
            }
        }

        $sql = "INSERT INTO ".$this->table."(".implode(',', $column).") VALUES ('".implode("','", $values)."')";
         
        return $this->con->exec($sql);
    }

    public function modify($id, $datos = array(), ?string $id_field = null)
    {
        $set=array();
        foreach ($datos as $key=>$value) {
            if (!empty($value)) {
                $set[] = $key."='".$value."'";
            }
        }
        $sql = "UPDATE ".$this->table." SET ".implode(',', $set)." WHERE id = ".$id;

        if (isset($id_field)) {
            $sql = "UPDATE ".$this->table." SET ".implode(',', $set)." WHERE $id_field = ".$id;
        }

        return $this->con->exec($sql);
    }

    public function delete($id, $field = null)
    {
        $sql = "DELETE FROM $this->table WHERE id = $id";

        if (isset($field)) {
            $sql = "DELETE FROM $this->table WHERE $field = $id";
        }

        return $this->con->exec($sql);
    }

    public function count()
    {
        $sql = "SELECT count(*) FROM ".$this->table;

        return $this->con->exec($sql);
    }
}
