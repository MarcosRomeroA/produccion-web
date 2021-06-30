<?php

require_once __DIR__.'/DAO.php';
require_once __DIR__.'/../Modelos/CategoryEntity.php';

class CategoryDAO extends DAO
{
    public function __construct($con)
    {
        parent::__construct($con);
        $this->table = 'categories';
    }

    public function getOne($id)
    {
        $sql = "SELECT category_id,name,deleted_at FROM $this->table WHERE category_id = $id";
        $resultado = $this->con->query($sql, PDO::FETCH_CLASS, 'CategoryEntity')->fetch();
        return $resultado;
    }

    public function getAll($where = array())
    {
        $sql = "SELECT category_id,name,deleted_at FROM $this->table WHERE deleted_at IS NULL";
        $resultado = $this->con->query($sql, PDO::FETCH_CLASS, 'CategoryEntity')->fetchAll();
        return $resultado;
    }
}
