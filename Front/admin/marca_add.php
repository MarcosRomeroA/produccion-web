<?php

include "includes/header.php";
include "../helpers/functions.php";


require_once __DIR__."/../../helpers/connection.php";


// POST
if (isset($_POST['add'])) {
    $name = $_POST['nombre'];
    $is_available = $_POST['is_available'];

    if (!empty($_GET['id'])) {
        $sql = "UPDATE brands SET name = '$name', is_available = '$is_available' WHERE brand_id = ".$_GET['id'];
        $con->query($sql);
    } else {
        $sql = "INSERT INTO brands(name, is_available) VALUES ('$name', '$is_available')";
        $con->query($sql);
    }

    // setDataJSON('marcas', $marcas);

    redirect('marcas.php');
}

if (!empty($_GET['id'])) {
    $sql = "SELECT * FROM brands WHERE brand_id = ".$_GET['id'];
   
    $categoria = $con->query($sql);
    foreach ($categoria as $row) {
        $name = $row['name'];
        $is_available = $row['is_available'];
    }
}

?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="w-auto" style="display: flex; flex-direction: row; align-items: center;">
                    <a class="btn btn-primary" href="marcas.php"> <i class="fas fa-arrow-left"></i> </a>
                    <div class="text-primary" style="margin-left: 20px;">
                       Añadir Marcas
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