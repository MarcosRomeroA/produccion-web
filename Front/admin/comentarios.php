<?php

include "includes/header.php";
include "../helpers/dataHelper.php";
include "../helpers/functions.php";

require_once __DIR__."/../../helpers/connection.php";

require_once __DIR__.'/../../DataAccess/CommentDAO.php';
require_once __DIR__.'/../../DataAccess/ProductDAO.php';

$commentDAO = new CommentDAO($con);
$comments = $commentDAO->getAll();

$productDAO = new ProductDAO($con);
$products = $productDAO->getAll();


if(!empty($_GET['del'])){
    $commentDAO->delete($_GET['del'], 'comment_id');
    redirect('comentarios.php');
}
?>
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="display: flex; flex-direction: row; justify-content: space-between; align-items: center;">
                <h6 class="m-0 font-weight-bold text-primary">Comentarios</h6>
                <form class="d-flex flex-row" action="" method="get">
                    <select class="form-control mr-3" name="id_producto">
                        <option value="0">
                            Ver todos
                        </option>
                        <?php foreach ($products as $producto): ?>
                            <option value="<?php echo $producto->getId() ?>" <?php echo isset($_GET['id_producto']) && $_GET['id_producto'] == $producto['id'] ? 'selected' : '' ?>  >
                                <?php echo $producto->getNombre() ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class = "btn btn-primary">
                        Buscar
                    </button>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th style="width: 115px;">Producto</th>
                            <th>Comentario</th>
                            <th>Borrar</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach($comments as $comentario): ?>
                                <?php if($comentario->getVisibility() == ""): ?>
                                    <?php if( (isset($_GET['id_producto']) && ($comentario->getProductID() == $_GET['id_producto'] || $_GET['id_producto'] == 0)) || !isset($_GET['id_producto']) ):  ?>
                                        <tr>
                                            <td><?php echo $comentario->getCommentID() ?></td>
                                            <td><?php echo $comentario->getUser() ?></td>
                                            <td><?php echo $productDAO->getOne($comentario->getProductID())->getNombre() ?></td>
                                            <td><?php echo $comentario->getDescription() ?></td>
                                            <td><a class="btn btn-danger" href="comentarios.php?del=<?php echo $comentario->getCommentID() ?>"><i class="fas fa-trash-alt"></i></a></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php
include 'includes/footer.php';
?>