<?php include_once '../includes/header.php'?>
<?php include_once '../config/config.php'?>

<?php

// DAta for single product
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $product = $conn->prepare("select * from products where id= :id");
    $product->execute([
            "id"=> $id
    ]);

    $singleProduct = $product->fetch(PDO::FETCH_OBJ);

// DAta for related product
    $relatedProducts = $conn->prepare("SELECT * FROM products WHERE type = :type AND id != :product_id");
    $relatedProducts->execute([
        "type" => $singleProduct->type,
        "product_id" => $singleProduct->id
    ]);

    $allRelatedProducts = $relatedProducts->fetchAll(PDO::FETCH_OBJ);

//    add product to cart

    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_POST['image'];
        $pro_id = $_POST['pro_id'];
        $quantity = $_POST['quantity'];
        $description = $_POST['description'];
        $user_id = $_SESSION['user_id'];

        $insert_cart = $conn->prepare("insert into cart (name, image, price, pro_id, quantity, description, user_id) values (:name, :image, :price, :pro_id, :quantity, :description, :user_id)");
        $insert_cart->execute([
            ":name" => $name,
            ":price" => $price,
            ":pro_id" => $pro_id,
            ":image" => $image,
            ":quantity" => $quantity,
            ":description" => $description,
            ":user_id" => $user_id
        ]);

        echo '<script>alert("Aded to cart successfully")</script>';
    }
//    Validation for the cart
    if(isset($_SESSION['user_id'])) {
        $validateCart = $conn->query("select * from cart where pro_id='$id' and user_id='$_SESSION[user_id]'");
        $validateCart->execute();

        $rowCount = $validateCart->rowCount();
    }

} else {
    header("location:" . APPURL . "/404.php");
}

?>

    <section class="home-slider owl-carousel">

      <div class="slider-item" style="background-image: url(<?php echo APPURL;?>/images/<?php echo $singleProduct->image;?>);" data-stellar-background-ratio="0.5">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center">

            <div class="col-md-7 col-sm-12 text-center ftco-animate">
            	<h1 class="mb-3 mt-5 bread">Product Detail</h1>
	            <p class="breadcrumbs"><span class="mr-2"><a href="<?php echo APPURL;?>">Home</a></span> <span>Product Detail</span></p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-6 mb-5 ftco-animate">
    				<a href="../images/menu-2.jpg" class="image-popup"><img src="<?php echo APPURL;?>/images/<?php echo $singleProduct->image;?>" class="img-fluid" alt="Colorlib Template"></a>
    			</div>
    			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
    				<h3><?php echo $singleProduct->name;?></h3>
    				<p class="price"><span>$<?php echo $singleProduct->price;?></span></p>
    				<p><?php echo $singleProduct->description;?></p>
                    <form action="product-single.php?id=<?php echo $id?>" method="post">

                    <div class="row mt-4">
							<div class="col-md-6">
<!--								<div class="form-group d-flex">-->
<!--		              <div class="select-wrap">-->
<!--	                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>-->
<!--	                  <select name="" id="" class="form-control">-->
<!--	                  	<option value="">Small</option>-->
<!--	                    <option value="">Medium</option>-->
<!--	                    <option value="">Large</option>-->
<!--	                    <option value="">Extra Large</option>-->
<!--	                  </select>-->
<!--	                </div>-->
<!--		            </div>-->
							</div>
							<div class="w-100"></div>
							<div class="input-group col-md-6 d-flex mb-3">
	             	<span class="input-group-btn mr-2">
	                	<button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
	                   <i class="icon-minus"></i>
	                	</button>
	            		</span>
                                    <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                                <span class="input-group-btn ml-2">
                                    <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                     <i class="icon-plus"></i>
                                 </button>
                                </span>
                            </div>
                        </div>
                        <input name="pro_id" type="hidden" value="<?php echo $singleProduct->id; ?>">
                        <input name="name" type="hidden" value="<?php echo $singleProduct->name; ?>">
                        <input name="image" type="hidden" value="<?php echo $singleProduct->image; ?>">
                        <input name="price" type="hidden" value="<?php echo $singleProduct->price; ?>">
                        <input name="description" type="hidden" value="<?php echo $singleProduct->description; ?>">
                        <?php if(isset($_SESSION['user_id'])):?>
                            <?php if($rowCount > 0) :?>
    <!--          	            <button style="margin-top: -335px; margin-left: 632px; height: 65px" name="submit" type="submit" class="btn btn-primary py-3 px-5" disabled>Added to Cart</button>-->
                            <button name="submit" type="submit" class="btn btn-primary py-3 px-5" disabled>Added to Cart</button>
                            <?php else:?>
    <!--          	            <button style="margin-top: -335px; margin-left: 632px; height: 65px" name="submit" type="submit" class="btn btn-primary py-3 px-5">Add to Cart</button>-->
                            <button name="submit" type="submit" class="btn btn-primary py-3 px-5">Add to Cart</button>
                            <?php endif;?>
                        <?php else:?>
                            <p>Login to add to cart</p>
                        <?php endif;?>
                    </form>
    			</div>
    		</div>
    	</div>
    </section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate text-center">
          	<span class="subheading">Discover</span>
            <h2 class="mb-4">Related products</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          </div>
        </div>
        <div class="row">
            <?php foreach ($allRelatedProducts as $allRelatedProduct): ?>
        	<div class="col-md-3">
        		<div class="menu-entry">
    					<a href="<?php echo APPURL;?>/products/product-single.php?id=<?php echo $allRelatedProduct->id; ?>" class="img" style="background-image: url(<?php echo APPURL;?>/images/<?php echo $allRelatedProduct->image;?>);"></a>
    					<div class="text text-center pt-4">
    						<h3><a href="<?php echo APPURL;?>/products/product-single.php?id=<?php echo $allRelatedProduct->id; ?>"><?php echo $allRelatedProduct->name; ?></a></h3>
    						<p><?php echo $allRelatedProduct->description; ?></p>
    						<p class="price"><span>$<?php echo $allRelatedProduct->price; ?></span></p>
    						<p><a href="<?php echo APPURL;?>/products/product-single.php?id=<?php echo $allRelatedProduct->id; ?>" class="btn btn-primary btn-outline-primary">Show</a></p>
    					</div>
    				</div>
        	</div>
            <?php endforeach;?>

        </div>
    	</div>
    </section>

<?php include_once '../includes/footer.php'?>
