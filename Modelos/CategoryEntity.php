<?php

require_once ('BaseEntity.php');

class CategoryEntity extends BaseEntity
{
    private $category_id;
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
    public function getCategoryID()
    {
        return $this->category_id;
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
    public function setCategoryID($category_id)
    {
        $this->category_id = $category_id;
    }
    public function setDeleted($deleted_at)
    {
        $this->deleted_at = $deleted_at;
    }
}
