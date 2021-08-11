<?php

require_once('../DataAccess/ProductDAO.php');

class ProductBusiness
{
    protected $ProductDAO;

    public function __construct($con)
    {
        $this->ProductDAO = new ProductDAO($con);
    }

    public function getProducts($where = [])
    {
        $products = $this->ProductDAO->getAll($where);

        return $products;
    }

    public function getProduct($id)
    {
        $product = $this->ProductDAO->getOne($id);

        return $product;
    }

    public function getDestacados()
    {
        $products = $this->ProductDAO->getDestacados();

        return $products;
    }
}
