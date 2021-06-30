<?php

require_once __DIR__.'/DAO.php';
require_once __DIR__.'/../Modelos/CommentEntity.php';

class CommentDAO extends DAO
{
    public function __construct($con)
    {
        parent::__construct($con);
        $this->table = 'comments';
    }

    public function getOne($id)
    {
        $sql = "SELECT comment_id,user,product_id,description,stars,is_visible,created_at FROM $this->table WHERE product_id = $id";
        $resultado = $this->con->query($sql, PDO::FETCH_CLASS, 'CommentEntity')->fetch();
        return $resultado;
    }

    public function getAll($where = array())
    {
        $sql = "SELECT comment_id,user,product_id,description,stars,is_visible,created_at FROM $this->table";
        $resultado = $this->con->query($sql, PDO::FETCH_CLASS, 'CommentEntity')->fetchAll();
        return $resultado;
    }

    public function save($datos = array())
    {
        $productID = $datos['product_id'];
        $user = $datos['user'];
        $description = $datos['description'];
        
        $sql = "INSERT INTO $this->table (product_id, user, description, created_at)
            VALUES('$productID','$user','$description', NOW());";
        
        $this->con->exec($sql);
    }
}
