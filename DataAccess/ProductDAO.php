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
        $sqlWhereStr = ' WHERE 1=1 ';

        if (!empty($where['cat'])) {
            $sqlWhereStr .= ' AND category_id = '.$where['cat'];
        }

        if (!empty($where['brand'])) {
            $sqlWhereStr .= ' AND brand_id = '.$where['brand'];
        }
 
        /*
                $sqlWhere = array();

                if(!empty($where['autor'])){
                    $sqlWhere[] = ' AND autor = '.$where['autor'];
                }
                if(!empty($where['cat'])){
                    $sqlWhere[]= ' AND categoria = '.$where['cat'];
                }
                $sqlWhereStr = '';
                if(!empty($sqlWhere)) $sqlWhereStr = ' WHERE 1=1 '.implode('',$sqlWhere);
        */
        $sql = "SELECT DISTINCT 
                    product_id,
                    category_id,
                    brand_id,
                    name,
                    description,
                    price,
                    stock,
                    image 
                FROM $this->table 
                WHERE deleted_at IS NULL";
        // .$sqlWhereStr;

        $resultado = $this->con->query($sql, PDO::FETCH_CLASS, 'ProductEntity')->fetchAll();

        foreach ($resultado as $index=>$res) {
            $resultado[$index]->setCategoria($this->CategoryDao->getOne($res->getCategoria()));
        }

        return $resultado;
    }
}
