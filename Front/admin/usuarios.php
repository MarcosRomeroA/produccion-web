<?php

require_once __DIR__."/../../helpers/connection.php";
include "includes/header.php";
include "../helpers/dataHelper.php";
include "../helpers/functions.php";

require_once __DIR__.'/../../DataAccess/userDAO.php';

$userDAO = new UserDAO($con);

$users = $userDAO->getAll();

if (!empty($_GET['del'])) {
    $userDAO->delete($_GET['del'], 'user_id');
    redirect('usuarios.php');
}

?>
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3"
            style="display: flex; flex-direction: row; justify-content: space-between; align-items: center;">
            <h6 class="m-0 font-weight-bold text-primary">Usuarios</h6>
            <a class="btn btn-primary" href="usuarios_add.php">+</a> 
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Rol</th>
                            <th>Email</th>
                            <th style="width: 115px;">Modificar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?php echo $user->getId() ?></td>
                                    <td><?php echo $user->getFirstName() ?></td>
                                    <td><?php echo $user->getLastName() ?></td>
                                    <td><?php echo $user->getRol()->getName() ?></td>
                                    <td><?php echo $user->getEmail() ?></td>
                                    <td style="display: flex; justify-content: space-around; width: 115px;">
                                        <!-- boton de editar -->
                                        <a class="btn btn-info"
                                            href="usuarios_add.php?id=<?php echo $user->getId() ?>"><i
                                                class="fas fa-edit"></i></a>
                                        <!-- boton de borrar -->
                                        <a class="btn btn-danger"
                                            href="usuarios.php?del=<?php echo $user->getId() ?>"><i
                                                class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
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