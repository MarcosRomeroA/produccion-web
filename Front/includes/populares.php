<?php

include('./../config/db.php');
include('./../helpers/connection.php');
include('./../LogicaNegocio/ProductBusiness.php');

$productB = new ProductBusiness($con);
$products = $productB->getProducts();
$destacados = $productB->getDestacados();
?> 

<section class="new-product-area pt-70">
    <div class="container">
        <!-- Section tittle -->
        <div class="row">
            <div class="col-xl-12">
                <div class="section-tittle mb-70">
                    <h2>Destacados</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($destacados as $new_arrival) { ?>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                <div class="single-new-pro mb-30 text-center">
                    <div class="product-img">
                        <img src="imagenes/<?php echo $new_arrival->getImage() ?>" alt="">
                    </div>
                    <div class="product-caption">
                        <h3><a href="#"></a><?php echo $new_arrival->getNombre() ?></h3>

                        <span><?php echo $new_arrival->getPrecio() ?></span>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</section>

<!--? Popular Items Start -->
<div class="popular-items section-padding30">
    <div class="container">
        <!-- Section tittle -->
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-10">
                <div class="section-tittle mb-70 text-center">
                    <h2>Clasicos</h2>
                    <p>Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Quis ipsum suspendisse ultrices gravida.</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row" style="display: flex; align-items:baseline">
                <?php
                foreach ($products as $prod) {
                    ?>
                    <div class="single-popular-items mb-50 text-center col-md-3" >
                        <div class="popular-img">
                            <img src="imagenes/<?php echo $prod->getImage() ?>" alt="iteracion de relojes">
                            <div class="img-cap">
                                <span>Añadir al carrito</span>
                            </div>
                            <div class="favorit-items">
                                <span class="flaticon-heart"></span>
                            </div>
                        </div>
                        <div class="popular-caption">
                            <h3><a href="product_details.php?prodId=<?php echo $prod->getId()?>"><?php echo $prod->getNombre() ?></a></h3>
                            <span>$ <?php echo number_format($prod->getPrecio(), 2, ",", ".") ?></span>
                        </div>
                    </div>
                <?php
                } ?>
            </div>
        </div>
        <!-- Button -->
        <div class="row justify-content-center">
            <div class="room-btn pt-70">
                <a href="shop.php" class="btn view-btn1">Ver mas relojes</a>
            </div>
        </div>
    </div>
</div>
<!-- Popular Items End -->