<?php
include('../helpers/connection.php');
include('./../LogicaNegocio/ProductBusiness.php');
include('./../LogicaNegocio/CommentBusiness.php');

$productB = new ProductBusiness($con);
$product = $productB->getProduct($_GET['prodId']);

$commentB = new CommentBusiness($con);
$comments = $commentB->getComments();

if(isset($_POST['add'])){
        $id_producto=$_GET['prodId'];
        $nombre=$_POST['nombre'];
        $comentario=$_POST['comentario'];
        
        $datos = array('product_id'=>$id_producto, 'user'=>$nombre, 'description'=>$comentario, 'created_at'=>date("Y.m.d"));
        $comment = $commentB->saveComment($datos);
        header("Refresh:0");
}
?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Time Zones Relojes</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include('includes/navbar.php'); ?>

    <main>
        <?php include('includes/header.php') ?>
        <div class="product_image_area">
            <div class="container">
                <div class="row justify-content-center">
                    
                    <img src="imagenes/<?php echo $product->getImage(); ?>" alt="Gato">
                </div>
                <div class="col-lg-12">
                    <div class="single_product_text text-center">
                        <h3><?php echo $product->getNombre(); ?> </h3>
                        <p><?php echo $product->getDescripcion(); ?>
                        </p>
                        <div class="card_area">
                            <div class="product_count_area">
                                <?php echo "$" . number_format($product->getPrecio(), 2, ',', '.') ?>
                            </div>
                            <div class="add_to_cart">
                                <a href="#" class="btn_3">Añadir al carrito</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <h3>Añadir un comentario</h3>
            <form action="" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" class="form-control" name="nombre">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Comentarios</label>
                    <textarea class="form-control" name="comentario" rows="6" ></textarea>
                </div>

                <button type="submit" name="add" class="btn btn-primary" style="float: right">Enviar</button>
                <br><br>
            </form>
            <br>
            <br>
            <h3>Comentarios</h3>
            <?php $i = 0; foreach ($comments as $comentario): ?>
                <?php if($comentario->getProductID() == $_GET['prodId'] && $comentario->getVisibility() == ""): ?>
                    <?php $i++; ?>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="name"><?php echo $comentario->getUser(); ?> ha comentado:</div>
                            <div class="fecha"><?php echo $comentario->getCreationDate(); ?></div>
                        </div>
                        <div class="card-body"><?php echo $comentario->getDescription(); ?></div>
                    </div>
                    <br>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php echo $i == 0 ? "Este producto no contiene comentarios" : ""  ?>
        </div>

    </main>

    <?php include('includes/footer.php') ?>
</body>

</html>