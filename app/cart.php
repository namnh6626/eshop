<?php


include_once 'connect.php';
include_once('./includes/header.php');
if (!isset($_SESSION['customer_id'])) {
	header('location:login.php');
}

include_once './includes/menu.php';

$cart = [];
if (isset($_SESSION['customer_id'])) {
	$customer = $_SESSION['customer_id'];
	$sql = "SELECT * FROM carts,products,sizes where customer_id = $customer AND carts.product_id = products.product_id and sizes.size_id = carts.size_id";

	$query = mysqli_query($conn, $sql);

	while ($row = mysqli_fetch_assoc($query)) {
		$cart[] = $row;
	}

	$sizes = [];
	$sizeSql = mysqli_query($conn, "SELECT * FROM sizes");
	while($row = mysqli_fetch_assoc($sizeSql)){
		$sizes[] = $row;
	}
	$total = 0;
	foreach($cart as $item){
		$total += $item['price'] * $item['quantity'];
	}
}

?>


<form action="payment.php" method="post">
	
	
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li class="active">Shopping Cart</li>
				</ol>
			</div>
			<?php if(count($cart) > 0) : ?>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description">Name</td>
							<td>Size</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Into money</td>
							<td></td>
						</tr>
					</thead>
					<tbody>

				
					<?php foreach ($cart as $item) : ?>
						
							<input type="hidden" value="<?php echo $item['customer_id'] ?>" name="customer">
							<tr>
								<td class="cart_product">
									<a href="product-details.php?id=<?php echo $item['product_id']; ?>"><img src="../images/cart/one.png" alt=""></a>
								</td>
								<td class="cart_description">
									<h4 style="margin: 0;"><a href="product-details.php?id=<?php echo $item['product_id']; ?>"><?php echo $item['product_name']; ?></a></h4>
									<input type="hidden" value="<?php echo $item['product_id'] ?>" name="product[]">
									<input type="hidden" value="<?php echo $item['price'] ?>" name="price[]">

								</td>
								<td>
									<select name="size[]" id="">
										<option value="<?php echo $item['size_id'] ?>"><?php echo $item['size_name'] ?></option>
										<?php foreach($sizes as $size): ?>
											<?php if($size['size_id'] != $item['size_id']): ?>
												<option value="<?php echo $size['size_id'] ?>"><?php echo $size['size_name'] ?></option>
											<?php endif;  ?>
										<?php endforeach; ?>
										
									</select>
								</td>
								<td class="cart_price">
									<p style="margin: 0;">$<?php echo $item['price']; ?></p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<span style="width: 100px; height:40px;">
											<input class="" style="width: 100px;height:40px;" type="number" step="1" min="1" name="quantity[]" value="<?php echo $item['quantity']; ?>" autocomplete="off">
										</span>
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price" style="margin: 0;">$<?php echo $item['price']; ?></p>
								</td>
								<td class="">
									<a style="color: #FFFFFF; padding:5px 7px;background:#ed2828" href="delete-cart.php?id=<?php echo $item['product_id']; ?>&size=<?php echo $item['size_id'] ?>"  ><i class="fa fa-lg fa-times"></i></a>
								</td>
							</tr>
					<?php endforeach; ?>
					<?php else: ?>
						<div class="row" style="display:flex ; justify-content:center; padding-bottom:40px;">
							<strong>Cart is empty!! </strong>
						</div>
						<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</section>
<!--/#cart_items-->

<?php if(count($cart) > 0) : ?>

<section id="do_action">
	<div class="container">
		<!-- <div class="heading">
			<h3>What would you like to do next?</h3>
			<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
		</div> -->
		<div class="row">
			<!-- <div class="col-sm-6">
				<div class="chose_area">
					<ul class="user_option">
						<li>
							<input type="checkbox">
							<label>Use Coupon Code</label>
						</li>
						<li>
							<input type="checkbox">
							<label>Use Gift Voucher</label>
						</li>
						<li>
							<input type="checkbox">
							<label>Estimate Shipping & Taxes</label>
						</li>
					</ul>
					<ul class="user_info">
						<li class="single_field">
							<label>Country:</label>
							<select>
								<option>United States</option>
								<option>Bangladesh</option>
								<option>UK</option>
								<option>India</option>
								<option>Pakistan</option>
								<option>Ucrane</option>
								<option>Canada</option>
								<option>Dubai</option>
							</select>

						</li>
						<li class="single_field">
							<label>Region / State:</label>
							<select>
								<option>Select</option>
								<option>Dhaka</option>
								<option>London</option>
								<option>Dillih</option>
								<option>Lahore</option>
								<option>Alaska</option>
								<option>Canada</option>
								<option>Dubai</option>
							</select>

						</li>
						<li class="single_field zip-field">
							<label>Zip Code:</label>
							<input type="text">
						</li>
					</ul>
					<a class="btn btn-default update" href="">Get Quotes</a>
					<a class="btn btn-default check_out" href="">Continue</a>
				</div>
			</div> -->
			<div class="col-sm-6">
				<div class="total_area">
					<ul>
						<li>Cart Sub Total <span>$<?php echo number_format($total); ?></span></li>
						<!-- <li>Eco Tax <span>$2</span></li> -->
						<li>Shipping Cost <span>Payment on delivery</span></li>
						<li>Total <span>$<?php echo number_format($total); ?></span></li>
					</ul>
					<button type="submit" class="btn btn-default update" href="/app/payment.php";>Check Out</button>
				</div>
			</div>
		</div>
	</div>
</section>

<?php endif; ?>
<!--/#do_action-->
</form>
<?php include_once "./includes/footer.php";	 ?>