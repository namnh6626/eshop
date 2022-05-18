<?php
include_once('./includes/header.php');
include_once 'connect.php';
include_once 'function.php';
if (!isset($_GET['page'])) {
	$_GET['page'] = 1;
}

$page = $_GET['page'];
$limit = 6;
$start = ($page - 1) * $limit;

$typeUrl = '';
$supplierUrl = '';
$priceUrl = '';
if (isset($_GET['type'])) {
	$typeId = $_GET['type'];
	$typeUrl = "&type=$typeId";
} else {
	$typeId = 0;
}

if ($typeId == 0) {
	$typeSql = '';
} else {
	$typeSql = " (products.product_type_id = $typeId )";
}
if (isset($_GET['supplier'])) {
	$supplierId = $_GET['supplier'];
	$supplierUrl = "&supplier=$supplierId";

} else {
	$supplierId = 0;
}
if ($supplierId == 0) {
	$supplierSql = '';
} else {
	$supplierSql = "  supplier_id = $supplierId";
}

if ($typeId == 0 && $supplierId == 0) {
	$subSql = '';
} elseif ($typeId == 0 && $supplierId != 0) {
	$subSql = " AND supplier_id = $supplierId";
} elseif ($typeId != 0 && $supplierId == 0) {
	$subSql =  " AND products.product_type_id = $typeId ";
} else {
	$subSql = " AND products.product_type_id = $typeId  AND supplier_id = $supplierId";
}

if (isset($_GET['price'])) {
	$price = $_GET['price'];
	$priceUrl = "&price=$price";
} else {
	$price = 0;
}
if ($price == 0) {
	$priceSql = '';
} else {
	$priceSql = " ORDER BY price $price";
}

$sqlProduct = "SELECT * FROM products,product_types WHERE is_available = 1 AND products.product_type_id = product_types.product_type_id " . $subSql . $priceSql . "  LIMIT $start,$limit";

// die($sqlProduct);

$totalProductQuery = mysqli_query($conn, "SELECT COUNT(product_id) as countId FROM products,product_types WHERE is_available = 1 AND products.product_type_id = product_types.product_type_id" . $subSql . $priceSql);
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
		header('location:product.php');
	}
} else {
	$message = 'No product available';
}



$paramUrl = $typeUrl.$supplierUrl.$priceUrl;
// echo $paramUrl;
$query = mysqli_query($conn, $sqlProduct);

$sqlProductType = "SELECT * FROM product_types";
$productTypes = [];
$productTypeQuery = mysqli_query($conn, $sqlProductType);

while ($row = mysqli_fetch_assoc($productTypeQuery)) {
	$productTypes[] = $row;
}

// $productTypeMultiLevel = productTypeMultiLevel($productTypes, 0);
// echo "<pre>";
// print_r($productTypeMultiLevel);
// echo '</pre>';
$types = getAllProductTypes($conn);


$sqlSupplier = "SELECT * FROM suppliers";
$querySupplier = mysqli_query($conn, $sqlSupplier);


$suppliers = getAllSuppliers($conn);
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
				<form action="product.php" method="get">
					<div class="row">
						<div class="col-sm-3">
							<select id="type" class="form-select" name="type">
								<option value="0">All product</option>
								<?php foreach ($types as $productType) : ?>
									<option value="<?php echo $productType['product_type_id'] ?>"><?php echo $productType['product_type_name'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="col-sm-3">
							<select id="supplier" class="form-select" aria-label="Default select example" name="supplier">
								<option value="0">All supplier</option>
								<?php foreach ($suppliers as $supplier) : ?>
									<option value="<?php echo $supplier['supplier_id'] ?>"><?php echo ($supplier['supplier_name']) ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="col-sm-3 ">
							<select id="price" class="form-select d-inline-flex" aria-label="Default select example" name="price">
								<option value="0">Price</option>
								<option value="ASC">Ascending</option>
								<option value="DESC">Descending</option>

							</select>
						</div>
						<div class="col-sm-3">
							<button class="btn btn-primary" style="margin: 0;" type="submit">Filter</button>
						</div>
					</div>

				</form>

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
							<li class="paginate" id="page<?php echo $page; ?>"><a href="product.php?page=<?php echo $page . "&$paramUrl"; ?>">1</a></li>
						<?php elseif ($totalPage < 1) : ?>

						<?php else : ?>
							<?php if ($page > 1) : ?>
								<li><a href="product.php?page=1&<?php echo ($paramUrl) ?>">&laquo;</a></li>

								<li><a href='product.php?page=<?php $prePage = $page - 1;
																echo $prePage . '&' . $paramUrl; ?>'>&lsaquo; Previous</a></li>
							<?php endif; ?>
							<?php for ($i = 1; $i <= $totalPage; $i++) : ?>

								<?php if ($i == $page) : ?>
									<?php if ($page == 1) : ?>
										<li class="paginate" id="page<?php echo $page; ?>"><a href="product.php?page=<?php echo $page . "&$paramUrl"; ?>"><?php echo $page; ?></a></li>
										<li class="paginate" id="page<?php echo $page + 1; ?>"><a href="product.php?page=<?php echo ($page + 1) . "&$paramUrl"; ?>"><?php echo $page + 1; ?></a></li>

									<?php elseif ($page == $totalPage) : ?>
										<li class="paginate" id='page<?php echo $page - 1; ?>'><a href="product.php?page=<?php echo ($page - 1) . "&$paramUrl"; ?>"><?php echo $page - 1; ?></a></li>
										<li class="paginate" id="page<?php echo $page; ?>"><a href="product.php?page=<?php echo $page . "&$paramUrl"; ?>"><?php echo $page; ?></a></li>



									<?php else : ?>
										<li class="paginate" id='page<?php echo $page - 1; ?>'><a href="product.php?page=<?php echo ($page - 1) . "&$paramUrl"; ?>"><?php echo $page - 1; ?></a></li>
										<li class="paginate" id="page<?php echo $page; ?>"><a href="product.php?page=<?php echo $page . "&$paramUrl"; ?>"><?php echo $page; ?></a></li>
										<li class="paginate" id="page<?php echo $page + 1; ?>"><a href="product.php?page=<?php echo ($page + 1) . "&$paramUrl"; ?>"><?php echo $page + 1; ?></a></li>
									<?php endif; ?>

								<?php endif; ?>

							<?php endfor; ?>

							<?php if ($page < $totalPage) {
								$nextPage = $page + 1;
								$href = "product.php?pag";
								echo "<li><a href='product.php?page=$nextPage&$paramUrl'>Next &rsaquo;</a></li>
							<li><a href='product.php?page=$totalPage&$paramUrl'>&raquo;</a></li>";
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