<?php

include "includes/header.php";
// include "../helpers/dataHelper.php";
include "../helpers/functions.php";

require_once __DIR__."/../../helpers/connection.php";
require_once __DIR__.'/../../DataAccess/CategoryDAO.php';

$categoryDao = new CategoryDAO($con);

// POST
if(isset($_POST['add'])){

    $name = $_POST['nombre'];

    if(!empty($_GET['id'])){
        $categoryDao->modify($_GET['id'], $datos=["name"=>$name], 'category_id');
    }
    else
    {
        $sql = "INSERT INTO categories(name) VALUES ('$name')";        
        $con->query($sql);
    }
    redirect('categorias.php');
}

if(!empty($_GET['id'])){
    $sql = "SELECT * FROM categories WHERE category_id = ".$_GET['id'];
   
    $categoria = $con->query($sql);
    foreach($categoria as $row) {
        $name = $row['name'];
    }
}

// $categorias = getDataFromJSON('categorias');

?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="w-auto" style="display: flex; flex-direction: row; align-items: center;">
                    <a class="btn btn-primary" href="categorias.php"> <i class="fas fa-arrow-left"></i> </a>
                    <div class="text-primary" style="margin-left: 20px;">
                       Añadir Categoria
                    </div>
                </div>

            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="<?php echo $name ?? '' ?>">
                    </div>
                    <button type="submit" name="add" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>

    </div>

<?php include 'includes/footer.php'; ?>