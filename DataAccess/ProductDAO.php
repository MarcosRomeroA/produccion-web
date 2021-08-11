<?php

require_once __DIR__.'/DAO.php';
require_once __DIR__.'/CategoryDAO.php';
require_once __DIR__.'/BrandDAO.php';
require_once __DIR__.'/UserDAO.php';
require_once __DIR__.'/../Modelos/ProductEntity.php';

class ProductDAO extends DAO
{
    protected $UserDao;
    protected $CategoryDao;
    protected $BrandDao;
    // protected $TagsDao;

    public function __construct($con)
    {
        parent::__construct($con);
        $this->table = 'products';
        $this->UserDao = new UserDAO($con);
        $this->CategoryDao = new CategoryDAO($con);
        $this->BrandDao = new BrandDAO($con);
        // $this->TagsDao = new TagDAO($con);
    }

    public function getOne($id)
    {
        $sql = "SELECT 
                product_id,
                category_id,
                brand_id,
                is_available,
                name,
                description,
                price,stock,
                image 
                FROM $this->table WHERE deleted_at IS NULL and product_id = $id";

        $resultado = $this->con->query($sql, PDO::FETCH_CLASS, 'ProductEntity')->fetch();

        // if($resultado){
        //     $resultado->setCategoria($this->CategoryDao->getOne($resultado->getCategoria()));
        //     $resultado->setBrand($this->BrandDAO->getOne($resultado->getProduct()));
        // }else{
        //     $resultado = new ProductEntity();
        // }
                
        return $resultado;
    }

    public function getAll($where = array())
    {
        $sqlWhereStr = ' WHERE deleted_at IS NULL';

        if (!empty($where['cat'])) {
            $sqlWhereStr .= ' AND category_id = '.$where['cat'];
        }

        if (!empty($where['brand'])) {
            $sqlWhereStr .= ' AND brand_id = '.$where['brand'];
        }

        if (!empty($where['visible'])) {
            $visible = $where['visible'];

            $sqlWhereStr .= " AND is_available = '$visible'";
        }
 
 
        $sql = "SELECT DISTINCT 
                    *
                FROM $this->table 
        ";

        $sql .= $sqlWhereStr;

        $resultado = $this->con->query($sql, PDO::FETCH_CLASS, 'ProductEntity')->fetchAll();

        foreach ($resultado as $index=>$res) {
            $resultado[$index]->setCategoria($this->CategoryDao->getOne($res->getCategoria()));
        }

        return $resultado;
    }

    public function getDestacados()
    {
        $sql = "SELECT p.*, AVG(c.stars) stars
                FROM products p
                INNER JOIN comments c ON p.product_id = c.product_id
                WHERE deleted_at IS NULL AND is_available = 'S'
                GROUP BY p.product_id
                ORDER BY stars DESC
                LIMIT 3
            ";

        $resultado = $this->con->query($sql, PDO::FETCH_CLASS, 'ProductEntity')->fetchAll();

        foreach ($resultado as $index=>$res) {
            $resultado[$index]->setCategoria($this->CategoryDao->getOne($res->getCategoria()));
        }

        return $resultado;
    }
}
