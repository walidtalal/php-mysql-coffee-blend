<?php include_once '../includes/header.php'?>
<?php include_once '../config/config.php'?>
<?php

if(!isset($_SERVER['HTTP_REFERER'])){
        header("location: http://localhost/coffee-blend/");
        exit;

    }

if(!isset($_SESSION['user_id'])) {
    header("location: ".APPURL."");
}


    if(isset($_POST['submit'])) {
        if(empty($_POST['first_name']) || empty($_POST['last_name']) ||
            empty($_POST['state']) || empty($_POST['street_address']) ||
            empty($_POST['town']) || empty($_POST['zip_code']) || empty($_POST['phone']) ||
            empty($_POST['email']) ) {
            echo '<script>alert("one input or more is empty")</script>';
        } else {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $state = $_POST['state'];
            $street_address = $_POST['street_address'];
            $town = $_POST['town'];
            $zip_code = $_POST['zip_code'];
            $phone = $_POST['phone'];
//            $email = $_POST['email'];
            $status = "Pending";
            $total_price = $_SESSION['total_price'];
            $user_id = $_SESSION['user_id'];


            $place_orders = $conn->prepare("INSERT INTO orders 
            (first_name, last_name, state, street_address, town, zip_code, phone, status, total_price, user_id) 
            VALUES (:first_name, :last_name, :state, :street_address, :town, :zip_code, :phone, :status, :total_price, :user_id)");

            $place_orders->execute([
                ":first_name" => $first_name,
                ":last_name" => $last_name,
                ":state" => $state,
                ":street_address" => $street_address,
                ":town" => $town,
                ":zip_code" => $zip_code,
                ":phone" => $phone,
                ":status" => $status,
                ":total_price" => $total_price,
                ":user_id" => $user_id

            ]);
            header("location: pay.php");

        }
    }
?>
    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(<?php echo APPURL?>/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Checkout</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Checout</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 ftco-animate">
						<form action="checkout.php" method="post" class="billing-form ftco-bg-dark p-3 p-md-5">
							<h3 class="mb-4 billing-heading">Billing Details <?php echo $_SESSION['total_price'];?></h3>
	          	<div class="row align-items-end">
	          		<div class="col-md-6">
	                <div class="form-group">
	                	<label for="firstname">Firt Name</label>
	                  <input name="first_name" type="text" class="form-control" placeholder="">
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                	<label for="lastname">Last Name</label>
	                  <input type="text" name="last_name" class="form-control" placeholder="">
	                </div>
                </div>
                <div class="w-100"></div>
		            <div class="col-md-12">
		            	<div class="form-group">
		            		<label for="country">State / Country</label>
		            		<div class="select-wrap">
		                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
		                  <select name="state" id="" class="form-control">
		                  	<option value="France">France</option>
		                    <option value="Italy">Italy</option>
		                    <option value="Philippines">Philippines</option>
		                    <option value="South Korea">South Korea</option>
		                    <option value="Hongkong">Hongkong</option>
		                    <option value="Japan">Japan</option>
		                  </select>
		                </div>
		            	</div>
		            </div>
		            <div class="w-100"></div>
		            <div class="col-md-12">
		            	<div class="form-group">
	                	<label for="streetaddress">Street Address</label>
	                  <input name="street_address" type="text" class="form-control" placeholder="House number and street name">
	                </div>
		            </div>
		            </div>
		            <div class="w-100"></div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                	<label for="towncity">Town / City</label>
	                  <input name="town" type="text" class="form-control" placeholder="">
	                </div>
		            </div>
		            <div class="col-md-6">
		            	<div class="form-group">
		            		<label for="postcodezip">Postcode / ZIP *</label>
	                  <input name="zip_code" type="text" class="form-control" placeholder="">
	                </div>
		            </div>
		            <div class="w-100"></div>
		            <div class="col-md-6">
	                <div class="form-group">
	                	<label for="phone">Phone</label>
	                  <input name="phone" type="text" class="form-control" placeholder="">
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                	<label for="emailaddress">Email Address</label>
	                  <input name="email" type="text" class="form-control" placeholder="">
	                </div>
                </div>
                <div class="w-100"></div>
                <div class="col-md-12">
                	<div class="form-group mt-4">
										<div class="radio">
                                            <p><button type="submit" name="submit" class="btn btn-primary py-3 px-4">Place an order</button></p>

										</div>
									</div>
                </div>
	            </div>
	          </form><!-- END -->


<!-- 
	          <div class="row mt-5 pt-3 d-flex">
	          	<div class="col-md-6 d-flex">
	          		<div class="cart-detail cart-total ftco-bg-dark p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Cart Total</h3>
	          			<p class="d-flex">
		    						<span>Subtotal</span>
		    						<span>$20.60</span>
		    					</p>
		    					<p class="d-flex">
		    						<span>Delivery</span>
		    						<span>$0.00</span>
		    					</p>
		    					<p class="d-flex">
		    						<span>Discount</span>
		    						<span>$3.00</span>
		    					</p>
		    					<hr>
		    					<p class="d-flex total-price">
		    						<span>Total</span>
		    						<span>$17.60</span>
		    					</p>
								</div>
	          	</div>
	          	<div class="col-md-6">
	          		<div class="cart-detail ftco-bg-dark p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Payment Method</h3>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" class="mr-2"> Direct Bank Tranfer</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" class="mr-2"> Check Payment</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" class="mr-2"> Paypal</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div class="checkbox">
											   <label><input type="checkbox" value="" class="mr-2"> I have read and accept the terms and conditions</label>
											</div>
										</div>
									</div>
									<p><a href="#"class="btn btn-primary py-3 px-4">Place an order</a></p>
								</div>
	          	</div>
	          </div> -->
          </div> <!-- .col-md-8 -->

           
          </div>

        </div>
      </div>
    </section> <!-- .section -->

<?php include_once '../includes/footer.php'?>
