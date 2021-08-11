<?php

require_once('BaseEntity.php');

class ProductEntity extends BaseEntity
{
    private $name;
    private $product_id;
    private $description;
    private $is_available;
    private $category_id;
    private $brand_id;
    private $comentarios;
    private $price;
    private $stock;
    private $image;

    public function __construct()
    {
        parent::__construct();
        $this->comentarios = array();
    }
    /**
     * Defino los Getters
     *
     */
    public function getBrand()
    {
        return $this->brand_id;
    }
    public function getId()
    {
        return $this->product_id;
    }
    public function getNombre()
    {
        return $this->name;
    }
    public function getDescripcion()
    {
        return $this->description;
    }
    public function getVisible()
    {
        return $this->is_available;
    }
    public function getCategoria()
    {
        return $this->category_id;
    }
    public function getComentarios()
    {
        return $this->comentarios;
    }
    public function getPrecio()
    {
        return $this->price;
    }
    public function getStock()
    {
        return $this->stock;
    }
    public function getImage()
    {
        return $this->image;
    }
    /**
     * Defino los Setters
     *
     */
    
    public function setNombre($name)
    {
        $this->name = $name;
    }
    public function setDescripcion($description)
    {
        $this->description = $description;
    }
    public function setVisible($is_available)
    {
        $this->is_available = $is_available;
    }
    public function setBrand($brand_id)
    {
        $this->brand_id = $brand_id;
    }
    public function setProduct($product_id)
    {
        $this->product_id = $product_id;
    }
    public function setCategoria($category_id)
    {
        $this->category_id = $category_id;
    }
    public function setComentarios($comentarios)
    {
        $this->comentarios = $comentarios;
    }
    public function setPrecio($price)
    {
        $this->price = $price;
    }
    public function setStock($stock)
    {
        $this->stock = $stock;
    }
    public function setImage($image)
    {
        $this->image = $image;
    }
}
