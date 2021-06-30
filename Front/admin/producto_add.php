<?php

include "includes/header.php";
include __DIR__."/../helpers/functions.php";

require_once __DIR__."/../../helpers/connection.php";

require_once __DIR__.'/../../DataAccess/CategoryDAO.php';
require_once __DIR__.'/../../DataAccess/BrandDAO.php';
require_once __DIR__.'/../../DataAccess/ProductDAO.php';

$categoryDAO = new CategoryDAO($con);
$brandDAO = new BrandDAO($con);
$productDAO = new ProductDAO($con);

$categories = $categoryDAO->getAll();
$brands = $brandDAO->getAll();

// POST
if (isset($_POST['add'])) {
    $image = $_FILES['image']['name'];

    if (isset($archivo) && $archivo != "") {
        $tipo = $_FILES["image"]['type'];

        $tamano = $_FILES['image']['size'];

        $temp = $_FILES['image']["tmp_name"];

        if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
            echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/> - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
        } else {
            move_uploaded_file($temp, '../imagenes/'.$archivo);
        }
    }

    
    $datos =    [
        "name" => $_POST['nombre'],
        "description" => $_POST['descripcion'],
        "category_id" => $_POST['categoria'],
        "brand_id" => $_POST['marca'],
        "price" => $_POST['precio'],
        "stock" => $_POST['stock'],
        "image" => $image
    ];

    if (!empty($_GET['id'])) {
        unset($datos['image']);

        $productDAO->modify(
            $_GET['id'],
            $datos,
            'product_id'
        );
    } else {
        $productDAO->save($datos);        
    }

    redirect('productos.php');
}

if (!empty($_GET['id'])) {
    $producto = $productDAO->getOne($_GET['id']);
}

?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="w-auto" style="display: flex; flex-direction: row; align-items: center;">
                    <a class="btn btn-primary" href="productos.php"> <i class="fas fa-arrow-left"></i> </a>
                    <div class="text-primary" style="margin-left: 20px;">
                        Añadir Producto
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo !empty($producto) ? $producto->getNombre() : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Descripcion</label>
                        <textarea class="form-control" name="descripcion" ><?php echo !empty($producto) ? $producto->getDescripcion(): '' ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <select name="categoria" id="categoria" class="form-control">
                            <?php foreach ($categories as $categoria): ?>
                            <option value="<?php echo $categoria->getCategoryID(); ?>">
                                <?php echo $categoria->getNombre(); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="categoria">Marca</label>
                        <select name="marca" id="marca" class="form-control">
                            <?php foreach ($brands as $marca): ?>
                                <option value="<?php echo $marca->getBrandID()  ?>" >
                                    <?php echo $marca->getNombre()  ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Precio</label>
                        <input type="text" class="form-control" name="precio" value="<?php echo !empty($producto) ? $producto->getPrecio() : ''?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Stock</label>
                        <input type="text" class="form-control" name="stock" value="<?php echo !empty($producto) ? $producto->getStock() : ''?>">
                    </div>
                    <div class="form-group" style="display: flex; justify-content: space-between; align-items: center;">
                        <div  style="display: flex; flex-direction: column;">
                            <label for="archivo">Subir Imagen</label>
                            <input name="image" type="file">
                        </div>
                        <div>
                            <?php if (!empty($producto)): ?>
                                <img src="../imagenes/<?php echo $producto->getImage() ?>" width="150">
                            <?php endif; ?>
                        </div>
                    </div>
                    <button type="submit" name="add" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </div>

<?php include 'includes/footer.php'; ?>