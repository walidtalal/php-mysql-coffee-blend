<?php include_once 'layouts/header.php'?>
<?php include_once "../config/config.php"?>
<?php

if (!isset($_SESSION['admin_name'])) {
    header("location: ".ADMINURL."/admins/login-admins.php");
}

$products = $conn->query("SELECT COUNT(*) AS products_count FROM products");
$products->execute();
$countProducts = $products->fetch(PDO::FETCH_OBJ);


//$reviews = $conn->query("select count(*) as reviews_count from reviews");
//$reviews->execute();
//$countReviews = $reviews->fetch(PDO::FETCH_OBJ);

$orders = $conn->query("select count(*) as orders_count from orders");
$orders->execute();
$countOrders = $orders->fetch(PDO::FETCH_OBJ);

$bookings = $conn->query("select count(*) as bookings_count from bookings");
$bookings->execute();
$countBookings = $bookings->fetch(PDO::FETCH_OBJ);

$admins = $conn->query("select count(*) as admins_count from admins");
$admins->execute();
$countAdmins = $admins->fetch(PDO::FETCH_OBJ);

?>
<div class="row">
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Products</h5>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
              <p class="card-text">number of products: <?php echo $countProducts->products_count;?></p>
             
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Orders</h5>
              
              <p class="card-text">number of orders: <?php echo $countOrders->orders_count;?></p>
              
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Bookings</h5>
              
              <p class="card-text">number of bookings: <?php echo $countBookings->bookings_count;?></p>
              
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Admins</h5>
              
              <p class="card-text">number of admins: <?php echo $countAdmins->admins_count;?></p>
              
            </div>
          </div>
        </div>
      </div>
     <!--  <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table> -->
<?php include_once 'layouts/footer.php'?>
