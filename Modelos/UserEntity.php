<?php

require_once('BaseEntity.php');

class UserEntity extends BaseEntity
{
    private $user_id;
    private $first_name;
    private $last_name;
    private $email;
    private $password;
    private $rol_id;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Defino los Getters
     */
    public function getId()
    {
        return $this->user_id;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getEmail()
    {
        return $this->email;
    }
 

    public function getPassword()
    {
        return $this->password;
    }

    public function getRolId()
    {
        return $this->rol_id;
    }
    
    public function getRol()
    {
        return $this->rol;
    }
    
    /**
     * Defino los Setters
     *
     */
    public function setNombre($first_name)
    {
        $this->$first_name = $first_name;
    }

    public function setApellido($last_name)
    {
        $this->last_name = $last_name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = md5($password);
    }

    public function setRolId($rolId)
    {
        $this->rol_id = $rolId;
    }
    
    public function setRol($rol)
    {
        $this->rol = $rol;
    }
}
