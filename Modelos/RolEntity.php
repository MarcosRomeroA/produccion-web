<?php

require_once('BaseEntity.php');

class RolEntity extends BaseEntity
{
    const CLIENTE = 1;
    const VENTAS = 2;
    const ADMIN = 3;

    private $name;

    public function __construct()
    {
        parent::__construct();
    }

    public function getName()
    {
        return $this->name;
    }
   
    public function setName($name)
    {
        $this->setName = $name;
    }
}
