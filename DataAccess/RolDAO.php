<?php

require_once __DIR__.'/DAO.php';
require_once __DIR__.'/../Modelos/RolEntity.php';

class RolDAO extends DAO
{
    public function __construct($con)
    {
        parent::__construct($con);
        $this->table = 'roles';
    }

    public function getAll($where = array())
    {
        $sql = "SELECT id, name FROM ".$this->table;

        $result = $this->con->query($sql, PDO::FETCH_CLASS, 'RolEntity');
        
        return $result;
    }

    public function getOne($id)
    {
        $sql = "SELECT id, name FROM $this->table WHERE id = $id";

        return $this->con->query($sql, PDO::FETCH_CLASS, 'RolEntity')->fetch();
    }

    public function save($data = array())
    {
        $sql = "INSERT INTO permissions(id, name) VALUES ('".$data['id']."','".$data['name']."')";
        return $this->con->exec($sql);
    }
}
