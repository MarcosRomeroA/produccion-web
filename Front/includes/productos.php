<?php

include('./../config/db.php');
include('./../helpers/connection.php');
include('./../LogicaNegocio/ProductBusiness.php');
include('./../LogicaNegocio/BrandBusiness.php');
include('./../LogicaNegocio/CategoryBusiness.php');

$categoryB = new CategoryBusiness($con);
$brandB = new BrandBusiness($con);
$productB = new ProductBusiness($con);

$categories = $categoryB->getCategories();
$brands = $brandB->getBrands();
$products = $productB->getProducts();
?>
        
<!-- Latest Products Start -->
<section id="productos" class="popular-items latest-padding" style="padding-top: 50px!important;">
    <div class="container">
        <div class="row product-btn justify-content-between mb-40">
            <div class="properties__button w-100" >
                <!--Nav Button  -->
                <nav style="display: flex; justify-content: space-around">
                    <div>
                        <h3>Categorias</h3>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link <?php if(empty($_GET['categoria'])) echo "active"; ?>"  href="shop.php?#productos">Todos</a>

                            <?php foreach($categories as $categoria): ?>
                                <a class="nav-item nav-link <?php if(!empty($_GET['categoria']) && $_GET['categoria'] == $categoria->getCategoryID()) echo "active"; ?>"
                                   href="shop.php?categoria=<?php echo $categoria->getCategoryID() ?><?php echo !empty($_GET['marca']) ? "&marca=".$_GET['marca'] : '' ?>#productos">
                                    <?php echo $categoria->getNombre(); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div>
                        <h3>Marcas</h3>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link <?php if(empty($_GET['marca'])) echo "active"; ?>"  href="shop.php?#productos">Todos</a>

                            <?php foreach($brands as $marca): ?>
                                <a class="nav-item nav-link <?php if(!empty($_GET['marca']) && $_GET['marca'] == $marca->getBrandID()) echo "active"; ?>"
                                   href="shop.php?<?php echo !empty($_GET['categoria']) ? 'categoria='.$_GET['categoria'].'&' : '' ?>marca=<?php echo $marca->getBrandID() ?>#productos">
                                    <?php echo $marca->getNombre() ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </nav>
                <!--End Nav Button  -->
            </div>
        </div>
        <!-- Nav Card -->
        <div class="tab-content" id="nav-tabContent">
            <!-- card one -->
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="row">

                    <?php foreach($products as $producto){ ?>
                        
                        <?php if(
                                ( isset($_GET['categoria']) && $producto->getCategoria() == $_GET['categoria'] ) &&
                                ( isset($_GET['marca']) && $producto->getBrand() == $_GET['marca'] )
                            ):
                        ?>

                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                                <div class="single-popular-items mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="imagenes/<?php echo $producto->getImage() ?>" alt="" style="width: 120px !important;">
                                        <div class="img-cap">
                                            <span>Añadir al carrito</span>
                                        </div>
                                        <div class="favorit-items">
                                            <span class="flaticon-heart"></span>
                                        </div>
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.php?prodId=<?php echo $producto->getId()?>"><?php echo $producto->getNombre() ?></a></h3>
                                        <span>$ <?php echo number_format($producto->getPrecio(), 2, ",", ".")  ?></span>
                                    </div>
                                </div>
                            </div>

                        <?php elseif( (isset($_GET['categoria']) && $producto->getCategoria() == $_GET['categoria']) && !isset($_GET['marca'])    ): ?>

                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                                <div class="single-popular-items mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="imagenes/<?php echo $producto->getImage() ?>" alt="" style="width: 120px !important;">
                                        <div class="img-cap">
                                            <span>Añadir al carrito</span>
                                        </div>
                                        <div class="favorit-items">
                                            <span class="flaticon-heart"></span>
                                        </div>
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.php?prodId=<?php echo $producto->getId()?>"><?php echo $producto->getNombre() ?></a></h3>
                                        <span>$ <?php echo number_format($producto->getPrecio(), 2, ",", ".")  ?></span>
                                    </div>
                                </div>
                            </div>

                        <?php elseif( (isset($_GET['marca']) && $producto->getBrand() == $_GET['marca']) && !isset($_GET['categoria'])   ): ?>

                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                                <div class="single-popular-items mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="imagenes/<?php echo $producto->getImage() ?>" alt="" style="width: 120px !important;">
                                        <div class="img-cap">
                                            <span>Añadir al carrito</span>
                                        </div>
                                        <div class="favorit-items">
                                            <span class="flaticon-heart"></span>
                                        </div>
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.php?prodId=<?php echo $producto->getId()?>"><?php echo $producto->getNombre() ?></a></h3>
                                        <span>$ <?php echo number_format($producto->getPrecio(), 2, ",", ".")  ?></span>
                                    </div>
                                </div>
                            </div>

                        <?php elseif( !isset($_GET['marca']) && !isset($_GET['categoria'])): ?>

                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                                <div class="single-popular-items mb-50 text-center">
                                    <div class="popular-img">
                                        <img src="imagenes/<?php echo $producto->getImage() ?>" alt="" style="width: 120px !important;">
                                        <div class="img-cap">
                                            <span>Añadir al carrito</span>
                                        </div>
                                        <div class="favorit-items">
                                            <span class="flaticon-heart"></span>
                                        </div>
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.php?prodId=<?php echo $producto->getId()?>"><?php echo $producto->getNombre() ?></a></h3>
                                        <span>$ <?php echo number_format($producto->getPrecio(), 2, ",", ".")  ?></span>
                                    </div>
                                </div>
                            </div>                            
                        <?php endif; ?>
                    <?php } ?>                    
                </div>
            </div>
        </div>
        <!-- End Nav Card -->
    </div>
</section>