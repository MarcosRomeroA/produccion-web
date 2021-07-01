<?php

include "includes/header.php";
include "../helpers/functions.php";

require_once __DIR__."/../../helpers/connection.php";
require_once __DIR__.'/../../DataAccess/UserDAO.php';
require_once __DIR__.'/../../DataAccess/RolDAO.php';

$userDAO = new UserDAO($con);
$rolDAO = new RolDAO($con);

$roles = $rolDAO->getAll();

// POST
if (isset($_POST['add'])) {
    if (!empty($_GET['id'])) {
        if (empty($_POST['password'])) {
            unset($_POST['password']);
        }

        $userDAO->modify(
            $_GET['id'],
            $_POST,
            'user_id'
        );
    } else {
        $userDAO->save($_POST);
    }

    redirect('usuarios.php');
}

if (!empty($_GET['id'])) {
    $user = $userDAO->getOne($_GET['id']);
}

?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="w-auto" style="display: flex; flex-direction: row; align-items: center;">
                    <a class="btn btn-primary" href="usuarios.php"> <i class="fas fa-arrow-left"></i> </a>
                    <div class="text-primary" style="margin-left: 20px;">
                       Añadir Usuario
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" class="form-control" name="first_name" value="<?php echo isset($user) ? $user->getFirstName() : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Apellido</label>
                        <input type="text" class="form-control" name="last_name" value="<?php echo !empty($user) ?  $user->getLastName() : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" class="form-control" name="email" value="<?php echo isset($user) ? $user->getEmail() : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="rol">Rol</label>
                        <select name="rol_id" id="rol" class="form-control">
                            <?php foreach ($roles as $rol): ?>
                            <option selected="<?php echo $rol->getName() ?? '' ?>" value="<?php echo $rol->getId(); ?>">
                                <?php echo $rol->getName(); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <button type="submit" name="add" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>

    </div>

<?php include 'includes/footer.php'; ?>