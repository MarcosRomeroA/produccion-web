<?php

include "includes/header.php";
include "../helpers/dataHelper.php";
include "../helpers/functions.php";

require_once __DIR__."/../../helpers/connection.php";
require_once __DIR__.'/../../DataAccess/ProductDAO.php';

$productDAO = new ProductDAO($con);

$products = $productDAO->getAll();

if (!empty($_GET['del'])) {
    $productDAO->delete($_GET['del'], 'product_id');

    redirect('productos.php');
}

?>
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="display: flex; flex-direction: row; justify-content: space-between; align-items: center;">
                <h6 class="m-0 font-weight-bold text-primary">Productos</h6>
                <?php if ($_SESSION['rol'] != 'VENTAS'): ?>
                <a class="btn btn-primary" href="producto_add.php">+</a>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Visible</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Categoria</th>
                            <th>Imagen</th>
                            <?php if ($_SESSION['rol'] != 'VENTAS'): ?>
                            <th style="width: 115px;">Modificar</th>
                            <?php endif; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($products as $producto): ?>
                        
                        <tr>
                            <td><?php echo $producto->getId(); ?></td>
                            <td><?php echo $producto->getNombre(); ?></td>
                            <td><?php echo $producto->getDescripcion() ?></td>
                            <td><?php echo $producto->getVisible() ?></td>
                            <td><?php echo "$".number_format($producto->getPrecio(), 2, ',', '.') ?></td>
                            <td><?php echo $producto->getStock(); ?></td>
                            <td><?php echo $producto->getCategoria()->getNombre(); ?></td>
                            <td style="padding:3px;">
                                <div class="d-flex justify-content-center align-items-center" style="height: 100%; width: 100%;">
                                    <?php if (!empty($producto->getImage())): ?>
                                        <img src="../imagenes/<?php echo $producto->getImage(); ?>" width="70">
                                    <?php endif; ?>
                                </div>
                            </td>
                            <?php if ($_SESSION['rol'] != 'VENTAS'): ?>
                            <td style="width: 115px;">
                                <a class="btn btn-info" href="producto_add.php?id=<?php echo $producto->getId(); ?>"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-danger" href="productos.php?del=<?php echo $producto->getId()?>"><i class="fas fa-trash-alt"></i></a>
                            </td>
                            <?php endif; ?>
                        </tr>
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