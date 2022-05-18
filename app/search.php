<?php
include_once('./includes/header.php');
include_once 'connect.php';
include_once 'function.php';
if (!isset($_GET['page'])) {
	$_GET['page'] = 1;
}

if(isset($_GET['s'])){
    $search = $_GET['s'];
}else{
    header('location:app/');
}
$page = $_GET['page'];
$limit = 6;
$start = ($page - 1) * $limit;


$sqlProduct = "SELECT * FROM products WHERE is_available = 1 AND product_name LIKE '%$search%'" .  "  LIMIT $start,$limit";

// die($sqlProduct);

$totalProductQuery = mysqli_query($conn, "SELECT COUNT(product_id) as countId FROM products WHERE is_available = 1 AND product_name LIKE '%$search%'");
// $totalProduct = 0;
while ($row = mysqli_fetch_assoc($totalProductQuery)) {
	$totalProduct = $row['countId'];
}

$totalPage = ceil($totalProduct / $limit);
if ($totalPage > 0) {
	if ($page < 1) {
		$page = 1;
	}
	if ($page > $totalPage) {
		header('location:search.php');
	}
} else {
	$message = 'No product available';
}



$query = mysqli_query($conn, $sqlProduct);

$sqlProductType = "SELECT * FROM product_types";
$productTypes = [];
$productTypeQuery = mysqli_query($conn, $sqlProductType);

while ($row = mysqli_fetch_assoc($productTypeQuery)) {
	$productTypes[] = $row;
}


include_once './includes/menu.php';
// echo $totalProduct;
?>



<!-- <section id="advertisement">
	<div class="container">
		<img src="images/shop/advertisement.jpg" alt="" />
	</div>
</section> -->

<section>
	<div class="container">
		<div class="row">
			<?php include_once "../app/includes/sidebar.php" ?>

			<div class="col-sm-9 padding-right">
				

				<div class="features_items">
					<!--features_items-->
					<h2 class="title text-center">Products</h2>

					<?php if (isset($message)) : ?>
						<span><?php echo $message; ?></span>
					<?php else : ?>
						<?php while ($product = mysqli_fetch_assoc($query)) : ?>
							<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<a href="product-details.php?id=<?php echo $product['product_id']; ?>">
											<div class="productinfo text-center">
												<img src="https://us.louisvuitton.com/images/is/image/lv/1/PP_VP_L/louis-vuitton-bow-detail-a-line-dress-ready-to-wear--FMDR41UVF631_PM2_Front%20view.png?wid=216&hei=216 216w, https://us.louisvuitton.com/imageshttps://us.louisvuitton.com/images/is/image/lv/1/PP_VP_L/louis-vuitton-bow-detail-a-line-dress-ready-to-wear--FMDR41UVF631_PM2_Front%20view.png?wid=216&hei=216 216w, https://us.louisvuitton.com/images/is/image/lv/1/PP_VP_L/louis-vuitton-bow-detail-a-line-dress-ready-to-wear--FMDR41UVF631_PM2_Front%20view.png?wid=320&hei=320 320w, https://us.louisvuitton.com/images/is/image/lv/1/PP_VP_L/louis-vuitton-bow-detail-a-line-dress-ready-to-wear--FMDR41UVF631_PM2_Front%20view.png?wid=456&hei=456 456w, https://us.louisvuitton.com/images/is/image/lv/1/PP_VP_L/louis-vuitton-bow-detail-a-line-dress-ready-to-wear--FMDR41UVF631_PM2_Front%20view.png?wid=656&hei=656 656w, https://us.louisvuitton.com/images/is/image/lv/1/PP_VP_L/louis-vuitton-bow-detail-a-line-dress-ready-to-wear--FMDR41UVF631_PM2_Front%20v" alt="" />
												<h2>$<?php echo $product['price']; ?></h2>
												<p style="height:40px; text-wrap:hidden;"><?php echo mb_strimwidth($product['product_name'], 0, 35, '...'); ?></p>
											</div>
										</a>
										<!-- <div class="text-center">
										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

									</div> -->

									</div>
									<!-- <div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div> -->
								</div>
							</div>

						<?php endwhile; ?>
					<?php endif; ?>
				</div>
				<!--features_items-->
				<div class="row d-flex" style="display: flex; justify-content:center;">
					<ul class="pagination">
						<?php if ($totalPage == 1) : ?>
							<li class="paginate" id="page<?php echo $page; ?>"><a href="search.php?page=<?php echo $page . "&$paramUrl"; ?>">1</a></li>
						<?php elseif ($totalPage < 1) : ?>

						<?php else : ?>
							<?php if ($page > 1) : ?>
								<li><a href="search.php?s=<?=$search ?>&page=1&">&laquo;</a></li>

								<li><a href='search.php?s=<?=$search ?>&page=<?php $prePage = $page - 1;
																echo $prePage ; ?>'>&lsaquo; Previous</a></li>
							<?php endif; ?>
							<?php for ($i = 1; $i <= $totalPage; $i++) : ?>

								<?php if ($i == $page) : ?>
									<?php if ($page == 1) : ?>
										<li class="paginate" id="page<?php echo $page; ?>"><a href="search.php?s=<?=$search ?>&page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
										<li class="paginate" id="page<?php echo $page + 1; ?>"><a href="search.php?s=<?=$search ?>&page=<?php echo ($page + 1); ?>"><?php echo $page + 1; ?></a></li>

									<?php elseif ($page == $totalPage) : ?>
										<li class="paginate" id='page<?php echo $page - 1; ?>'><a href="search.php?s=<?=$search ?>&page=<?php echo ($page - 1); ?>"><?php echo $page - 1; ?></a></li>
										<li class="paginate" id="page<?php echo $page; ?>"><a href="search.php?s=<?=$search ?>&page=<?php echo $page; ?>"><?php echo $page; ?></a></li>



									<?php else : ?>
										<li class="paginate" id='page<?php echo $page - 1; ?>'><a href="search.php?s=<?=$search ?>&page=<?php echo ($page - 1); ?>"><?php echo $page - 1; ?></a></li>
										<li class="paginate" id="page<?php echo $page; ?>"><a href="search.php?s=<?=$search ?>&page=<?php echo $page; ?>"><?php echo $page; ?></a></li>
										<li class="paginate" id="page<?php echo $page + 1; ?>"><a href="search.php?s=<?=$search ?>&page=<?php echo ($page + 1); ?>"><?php echo $page + 1; ?></a></li>
									<?php endif; ?>

								<?php endif; ?>

							<?php endfor; ?>

							<?php if ($page < $totalPage) {
								$nextPage = $page + 1;
								$href = "search.php?pag";
								echo "<li><a href='search.php?s=<?=$search ?>&page=$nextPage'>Next &rsaquo;</a></li>
							<li><a href='search.php?s=<?=$search ?>&page=$totalPage'>&raquo;</a></li>";
							} ?>
						<?php endif; ?>
					</ul>

				</div>
			</div>

		</div>
	</div>
</section>



<script>
	// console.log(window.location.href);
	const url = new URL(window.location.href);
	let page = url.searchParams.get("page");
	if (page == null) {
		page = 1;
	}

	let pages = document.querySelectorAll('.paginate');
	pages.forEach(function(page) {
		page.classList.remove('active');
	})

	document.getElementById('page' + page).setAttribute('class', 'active')

	let type = url.searchParams.get('type');
	let supplier = url.searchParams.get('supplier');
	let price = url.searchParams.get('price');

	let typeOptions = document.querySelectorAll('#type option');
	typeOptions.forEach(function(option) {
		if (option.value == type) {
			option.setAttribute('selected', "");
		}
	})

	let supplierOptions = document.querySelectorAll('#supplier option');
	supplierOptions.forEach(function(option) {
		if (option.value == supplier) {
			option.setAttribute('selected', "");
		}
	})

	let priceOptions = document.querySelectorAll('#price option');
	priceOptions.forEach(function(option) {
		if (option.value == price) {
			option.setAttribute('selected', "");
		}
	})
</script>
<?php include_once "./includes/footer.php"; ?>