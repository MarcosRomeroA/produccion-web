<?php

include "includes/header.php";
// include "../helpers/dataHelper.php";
include "../helpers/functions.php";

require_once __DIR__."/../../helpers/connection.php";
require_once __DIR__.'/../../DataAccess/CategoryDAO.php';

$categoryDao = new CategoryDAO($con);

// POST
if (isset($_POST['add'])) {
    $name = $_POST['nombre'];
    $is_available = $_POST['is_available'];

    if (!empty($_GET['id'])) {
        $categoryDao->modify($_GET['id'], $datos=["name"=>$name, "is_available"=> $is_available], 'category_id');
    } else {
        $sql = "INSERT INTO categories(name, is_available) VALUES ('$name', '$is_available')";
        $con->query($sql);
    }
    redirect('categorias.php');
}

if (!empty($_GET['id'])) {
    $sql = "SELECT * FROM categories WHERE category_id = ".$_GET['id'];
   
    $categoria = $con->query($sql);
    foreach ($categoria as $row) {
        $name = $row['name'];
        $is_available = $row['is_available'];
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
                    <div class="form-group">
                        <label for="is_available">¿Esta visible?</label>
                        <select name="is_available" id="is_available" class="form-control">
                            <option value="N" <?php echo (!empty($is_available) && $is_available == 'N') ? 'selected' : '' ?> >
                                No
                            </option>
                            <option value="S" <?php echo (!empty($is_available) && $is_available == 'S') ? 'selected' : '' ?> >  
                                Si
                            </option>
                        </select>
                    </div>
                    <button type="submit" name="add" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>

    </div>

<?php include 'includes/footer.php'; ?>