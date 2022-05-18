<?php 
require_once('../app/connect.php');
require_once('../app/function.php');
$suppliers = getAllSuppliers($conn);
?>
<div class="col-sm-3">
    <div class="left-sidebar">
        
        <!--/category-products-->

        <div class="brands_products">
            <!--brands_products-->
            <h2>Brands</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    <?php foreach($suppliers as $supplier): ?>
                    <li><a href="/app/product.php?supplier=<?=$supplier['supplier_id'] ?>"> <?=$supplier['supplier_name'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <!--/brands_products-->

       

        <div class="shipping text-center">
            <!--shipping-->
            <img src="/images/home/shipping.jpg" alt="" />
        </div>
        <!--/shipping-->

    </div>
</div>