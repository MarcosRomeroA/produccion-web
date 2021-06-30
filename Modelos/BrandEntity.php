<?php

require_once ('BaseEntity.php');

class BrandEntity extends BaseEntity
{
    private $brand_id;
    private $name;
    private $deleted_at;

    public function __construct()
    {
        parent::__construct();

    }
    /**
     * Defino los Getters
     * 
     */
     
    public function getNombre()
    {
        return $this->name;
    }
    public function getBrandID()
    {
        return $this->brand_id;
    }
    public function getDeleted()
    {
        return $this->deleted_at;
    }
   
    /**
     * Defino los Setters
     * 
     */
    
    public function setNombre($name)
    {
        $this->name = $name;
    }
    public function setBrandId($brand_id)
    {
        $this->brand_id = $brand_id;
    }
    public function setDeleted($deleted_at)
    {
        $this->deleted_at = $deleted_at;
    }
}
