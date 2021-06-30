<?php

require_once __DIR__.'/DAO.php';
require_once __DIR__.'/../Modelos/BrandEntity.php';

class BrandDAO extends DAO
{
    public function __construct($con)
    {
        parent::__construct($con);
        $this->table = 'brands';
    }

    public function getOne($id)
    {
        $sql = "SELECT brand_id,name,deleted_at FROM $this->table WHERE brand_id = $id";
        $resultado = $this->con->query($sql, PDO::FETCH_CLASS, 'BrandEntity')->fetch();
        return $resultado;
    }

    public function getAll($where = array())
    {
        $sql = "SELECT brand_id,name,deleted_at FROM $this->table WHERE deleted_at IS NULL";
        $resultado = $this->con->query($sql, PDO::FETCH_CLASS, 'BrandEntity')->fetchAll();
        return $resultado;
    }
}
