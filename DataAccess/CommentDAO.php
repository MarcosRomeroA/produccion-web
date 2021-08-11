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
        $sql = "SELECT * FROM $this->table WHERE product_id = $id";
        $resultado = $this->con->query($sql, PDO::FETCH_CLASS, 'CommentEntity')->fetch();
        return $resultado;
    }

    public function getAll($where = array())
    {
        $sql = "SELECT c.*
                FROM $this->table c
                INNER JOIN products p ON c.product_id = p.product_id 
                WHERE p.deleted_at IS NULL
                ";

        $resultado = $this->con->query($sql, PDO::FETCH_CLASS, 'CommentEntity')->fetchAll();

        return $resultado;
    }

    public function save($datos = array())
    {
        $productID = $datos['product_id'];
        $user = $datos['user'];
        $description = $datos['description'];
        $stars = $datos['stars'];
        
        $sql = "INSERT INTO $this->table (product_id, user, description, stars, created_at)
            VALUES('$productID','$user','$description', '$stars', NOW());";
        
        $this->con->exec($sql);
    }
}
