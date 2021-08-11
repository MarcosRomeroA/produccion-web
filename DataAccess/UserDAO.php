<?php

require_once __DIR__.'/DAO.php';
require_once __DIR__.'/RolDAO.php';
require_once __DIR__.'/../Modelos/UserEntity.php';


class UserDAO extends DAO
{
    protected $rolDAO;

    public function __construct($con)
    {
        parent::__construct($con);
        $this->table = 'users';
        $this->rolDAO = new RolDAO($con);
    }

    public function getOne($id)
    {
        $sql = "SELECT user_id, rol_id, first_name, last_name, email, password FROM $this->table WHERE user_id = $id";

        $resultado = $this->con->query($sql, PDO::FETCH_CLASS, 'UserEntity')->fetch();

        $resultado->setRol($this->rolDAO->getOne($resultado->getRolId()));

        return $resultado;
    }

    public function getAll($where = array())
    {
        $sql = "SELECT user_id, rol_id, first_name, last_name, email, password FROM $this->table";
        
        $resultado = $this->con->query($sql, PDO::FETCH_CLASS, 'UserEntity')->fetchAll();
        
        foreach ($resultado as $index => $user) {
            $resultado[$index]->setRol($this->rolDAO->getOne($user->getRolId()));
        }

        return $resultado;
    }

    public function login($datos = array())
    {
        $sql = "SELECT user_id, rol_id, first_name, last_name, email, password FROM $this->table WHERE email = '".$datos['email']."' AND password = '".md5($datos['password'])."'";
        
        $resultado = $this->con->query($sql, PDO::FETCH_CLASS, 'UserEntity')->fetch();

        if ($resultado) {
            $rol = $this->rolDAO->getOne($resultado->getRolId());
            $resultado->setRol($rol);

            session_start();

            $_SESSION["fullname"] = $resultado->getFirstName(). " " . $resultado->getLastName();
            $_SESSION["rol"] = $resultado->getRol()->getName();


            $sql = "SELECT user_id, rol_id, first_name, last_name, email, password FROM $this->table WHERE email = '".$datos['email']."' AND password = '".md5($datos['password'])."'";

            return $resultado;
        }

        return null;
    }

    public function logout()
    {
    }
}
