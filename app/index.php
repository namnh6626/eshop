<?php
include_once('./includes/header.php');

include_once 'connect.php';
include_once 'function.php';
$products = getIndexProduct(12, $conn);

include_once './includes/menu.php';


?>

<section id="menu">
	<div class="container">
		<div class="menu-area">
			<!-- Navbar -->
			
		</div>
	</div>
</section>

<section id="slider">
	<!--slider-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="slider-carousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
						<li data-target="#slider-carousel" data-slide-to="1"></li>
						<li data-target="#slider-carousel" data-slide-to="2"></li>
					</ol>

					<div class="carousel-inner">
						<div class="item active">
							<div class="col-sm-6">
								<h1><span>E</span>-SHOPPER</h1>
								<!-- <h2>Free E-Commerce Template</h2> -->
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
								<a href="product.php"  class="btn btn-default get">Get it now</a>
							</div>
							<div class="col-sm-6">
								<img src="/images/home/girl1.jpg" class="girl img-responsive" alt="" />
								<img src="/images/home/pricing.png" class="pricing" alt="" />
							</div>
						</div>
						<div class="item">
							<div class="col-sm-6">
								<h1><span>E</span>-SHOPPER</h1>
								<h2>100% Responsive Design</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
								<button type="button" class="btn btn-default get">Get it now</button>
							</div>
							<div class="col-sm-6">
								<img src="/images/home/girl2.jpg" class="girl img-responsive" alt="" />
								<img src="/images/home/pricing.png" class="pricing" alt="" />
							</div>
						</div>

						<div class="item">
							<div class="col-sm-6">
								<h1><span>E</span>-SHOPPER</h1>
								<h2>Free Ecommerce Template</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
								<button type="button" class="btn btn-default get">Get it now</button>
							</div>
							<div class="col-sm-6">
								<img src="/images/home/girl3.jpg" class="girl img-responsive" alt="" />
								<img src="/images/home/pricing.png" class="pricing" alt="" />
							</div>
						</div>

					</div>

					<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>
				</div>

			</div>
		</div>
	</div>
</section>
<!--/slider-->

<section>
	<div class="container">
		<div class="row">
			
			<div class="col-sm-12 padding-right">
				<div class="features_items">
					<!--features_items-->
					<h2 class="title text-center">NEW PRODUCTS</h2>
					<?php foreach ($products as $product) : ?>
						<div class="col-sm-3">
							<div class="product-image-wrapper">
								<div class="single-products">
									<a href="product-details.php?id=<?php echo $product['product_id']; ?>">
										<div class="productinfo text-center">
											<img src="/images/home/product1.jpg" alt="" />
											<h2>$<?php echo number_format($product['price']); ?></h2>
											<p><?php echo $product['product_name']; ?></p>
										</div>
									</a>
								</div>

							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<!--features_items-->
				<div class="row" style="display: flex; justify-content:center; padding-bottom: 40px;">
					<div class="col">
						<a class="btn btn-lg btn-primary" style="border-radius: 10px;" href="product.php">All products</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php include_once './includes/footer.php'; ?>
<!--/Footer-->



