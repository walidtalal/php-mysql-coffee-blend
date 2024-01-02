<?php include_once '../layouts/header.php'?>
<?php include_once "../../config/config.php"?>

<?php

if (!isset($_SESSION['admin_name'])) {
    header("location: ".ADMINURL."");
}

$select_products = $conn->prepare("select * from products");
$select_products->execute();
$products = $select_products->fetchAll(PDO::FETCH_OBJ)
?>


<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Foods</h5>
              <a href="create-products.php" class="btn btn-primary mb-4 text-center float-right">Create Products</a>

              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">image</th>
                    <th scope="col">price</th>
                    <th scope="col">type</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php $num =0;?>

                <?php foreach ($products as $product):?>
                    <?php $num++;?>

                    <tr>
                     <th scope="row"><?php echo $num;?></th>
                     <td><?php echo $product->name;?></td>
                     <td><img src="images/<?php echo $product->image;?>" alt="" style="width: 60px; height: 60px;"></td>
                     <td>$<?php echo $product->price;?></td>
                     <td><?php echo $product->type;?></td>
                     <td><a href="delete-products.php?id=<?php echo $product->id?>" class="btn btn-danger  text-center ">delete</a></td>
                  </tr>
                <?php endforeach;?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>
<?php include_once '../layouts/footer.php'?>

