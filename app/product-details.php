<?php

include_once 'connect.php';

if (!isset($_GET['id'])) {
	$_GET['id'] = 1;
}
$id = $_GET['id'];
$sql = "SELECT * FROM products, suppliers, product_types WHERE is_available = 1 AND product_id = $id AND 
products." . "product_type_id = product_types.product_type_id AND suppliers.supplier_id = products.supplier_id";
// echo $sql;
$sqlSize = "SELECT size_name, product_size_quantities.size_id FROM product_size_quantities,sizes WHERE sizes.size_id = product_size_quantities.size_id AND product_id = $id and product_size_quantity > 0";

$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) < 1) {
	header('location:product.php');
} else {
	$product = mysqli_fetch_assoc($query);
}
$sizes = [];

$querySizes = mysqli_query($conn, $sqlSize);
while ($row = mysqli_fetch_assoc($querySizes)) {
	$sizes[] = $row;
}
// print_r($sizes);
// die();

include_once('./includes/header.php');
include_once './includes/menu.php';


?>

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="left-sidebar">
					<h2>Category</h2>
					<div class="panel-group category-products" id="accordian">
						<!--category-productsr-->
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
										<span class="badge pull-right"><i class="fa fa-plus"></i></span>
										Sportswear
									</a>
								</h4>
							</div>
							<div id="sportswear" class="panel-collapse collapse">
								<div class="panel-body">
									<ul>
										<li><a href="">Nike </a></li>
										<li><a href="">Under Armour </a></li>
										<li><a href="">Adidas </a></li>
										<li><a href="">Puma</a></li>
										<li><a href="">ASICS </a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordian" href="#mens">
										<span class="badge pull-right"><i class="fa fa-plus"></i></span>
										Mens
									</a>
								</h4>
							</div>
							<div id="mens" class="panel-collapse collapse">
								<div class="panel-body">
									<ul>
										<li><a href="">Fendi</a></li>
										<li><a href="">Guess</a></li>
										<li><a href="">Valentino</a></li>
										<li><a href="">Dior</a></li>
										<li><a href="">Versace</a></li>
										<li><a href="">Armani</a></li>
										<li><a href="">Prada</a></li>
										<li><a href="">Dolce and Gabbana</a></li>
										<li><a href="">Chanel</a></li>
										<li><a href="">Gucci</a></li>
									</ul>
								</div>
							</div>
						</div>

						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordian" href="#womens">
										<span class="badge pull-right"><i class="fa fa-plus"></i></span>
										Womens
									</a>
								</h4>
							</div>
							<div id="womens" class="panel-collapse collapse">
								<div class="panel-body">
									<ul>
										<li><a href="">Fendi</a></li>
										<li><a href="">Guess</a></li>
										<li><a href="">Valentino</a></li>
										<li><a href="">Dior</a></li>
										<li><a href="">Versace</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title"><a href="#">Kids</a></h4>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title"><a href="#">Fashion</a></h4>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title"><a href="#">Households</a></h4>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title"><a href="#">Interiors</a></h4>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title"><a href="#">Clothing</a></h4>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title"><a href="#">Bags</a></h4>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title"><a href="#">Shoes</a></h4>
							</div>
						</div>
					</div>
					<!--/category-products-->

					<div class="brands_products">
						<!--brands_products-->
						<h2>Brands</h2>
						<div class="brands-name">
							<ul class="nav nav-pills nav-stacked">
								<li><a href=""> <span class="pull-right">(50)</span>Acne</a></li>
								<li><a href=""> <span class="pull-right">(56)</span>Grüne Erde</a></li>
								<li><a href=""> <span class="pull-right">(27)</span>Albiro</a></li>
								<li><a href=""> <span class="pull-right">(32)</span>Ronhill</a></li>
								<li><a href=""> <span class="pull-right">(5)</span>Oddmolly</a></li>
								<li><a href=""> <span class="pull-right">(9)</span>Boudestijn</a></li>
								<li><a href=""> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
							</ul>
						</div>
					</div>
					<!--/brands_products-->



					<div class="shipping text-center">
						<!--shipping-->
						<img src="../images/home/shipping.jpg" alt="" />
					</div>
					<!--/shipping-->

				</div>
			</div>

			<div class="col-sm-9 padding-right">
				<div class="product-details">
					<!--product-details-->
					<div class="col-sm-5">
						<div class="view-product">
							<img src="../images/product-details/1.jpg" alt="" />
							<h3>ZOOM</h3>
						</div>
						<div id="similar-product" class="carousel slide" data-ride="carousel">

							<!-- Wrapper for slides -->
							<div class="carousel-inner">
								<div class="item active">
									<a href=""><img src="../images/product-details/similar1.jpg" alt=""></a>
									<a href=""><img src="../images/product-details/similar2.jpg" alt=""></a>
									<a href=""><img src="../images/product-details/similar3.jpg" alt=""></a>
								</div>
								<div class="item">
									<a href=""><img src="../images/product-details/similar1.jpg" alt=""></a>
									<a href=""><img src="../images/product-details/similar2.jpg" alt=""></a>
									<a href=""><img src="../images/product-details/similar3.jpg" alt=""></a>
								</div>
								<div class="item">
									<a href=""><img src="../images/product-details/similar1.jpg" alt=""></a>
									<a href=""><img src="../images/product-details/similar2.jpg" alt=""></a>
									<a href=""><img src="../images/product-details/similar3.jpg" alt=""></a>
								</div>

							</div>

							<!-- Controls -->
							<a class="left item-control" href="#similar-product" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							</a>
							<a class="right item-control" href="#similar-product" data-slide="next">
								<i class="fa fa-angle-right"></i>
							</a>
						</div>

					</div>
					<div class="col-sm-7">
						<div class="product-information">
							<!--/product-information-->
							<img src="../images/product-details/new.jpg" class="newarrival" alt="" />
							<h2>
								<?php echo strtoupper($product['product_name']); ?>
							</h2>

							<form action="add-cart.php" method="post">
								<span style="width: 100%;">
									<div class="row" style="margin: 0;">
										<span style="width:100%;">
											<?php echo '$' . number_format($product['price']); ?>
										</span>
									</div>
									<?php if (count($sizes) > 0) : ?>
										<div class="row" style="margin: 0; padding:16px 0; display:flex;">
											<label style="width: 100px;">Size:</label>

											<div class="row" style="margin: 0;">
												<select class="form-select" name="size" id="">
													<?php foreach ($sizes as $size) : ?>
														<option value="<?php echo $size['size_id'] ?>"><?php echo $size['size_name'] ?></option>

													<?php endforeach; ?>
												</select>
											</div>

										</div>
										<div class="row" style="margin: 0; padding:16px 0;">
											<label style="width: 100px; margin:0;">Quantity:</label>
											<input type="hidden" name="product" value="<?php echo $product['product_id']; ?>">
											<input type="number" step="1" min="1" value="1" name="quantity" />
										</div>

										<button style="margin: 0;" type="submit" class="btn btn-fefault cart">
											<i class="fa fa-shopping-cart"></i>
											Add to cart
										</button>
									<?php else : ?>
										<strong>Out of stock now</strong>
									<?php endif; ?>
								</span>
							</form>
							<p><b>Category:</b> <?php echo $product['product_type_name']; ?></p>
							<p><b>Brand:</b> <?php echo $product['supplier_name']; ?></p>
							<p><b>Description:</b> <?php echo $product['description']; ?></p>

						</div>
						<!--/product-information-->
					</div>
				</div>
				<!--/product-details-->


				<div class="recommended_items">
					<!--recommended_items-->
					<h2 class="title text-center">recommended items</h2>

					<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="../images/home/recommend1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="../images/home/recommend2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="../images/home/recommend3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="../images/home/recommend1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="../images/home/recommend2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="../images/home/recommend3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
				</div>
				<!--/recommended_items-->

			</div>
		</div>
	</div>
</section>

<?php include_once "./includes/footer.php"; ?>