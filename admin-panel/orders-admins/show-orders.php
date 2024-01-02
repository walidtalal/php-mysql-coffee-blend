<?php include_once '../layouts/header.php'?>
<?php include_once "../../config/config.php"?>

<?php
$select_orders = $conn->prepare("select * from orders");
$select_orders->execute();
$orders = $select_orders->fetchAll(PDO::FETCH_OBJ)
?>

          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Orders</h5>
            
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">first_name</th>
                    <th scope="col">last_name</th>
                    <th scope="col">town</th>
                    <th scope="col">state</th>
                    <th scope="col">zip_code</th>
                    <th scope="col">phone</th>
                    <th scope="col">street_address</th>
                    <th scope="col">total_price</th>
                    <th scope="col">status</th>
                    <th scope="col">Update</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php $num =0;?>
                <?php foreach ($orders as $order):?>
                  <?php $num++;?>

                  <tr>
                    <th scope="row"><?php echo $num;?></th>
                    <td><?php echo $order->first_name;?></td>
                    <td><?php echo $order->last_name;?></td>
                    <td><?php echo $order->town;?></td>
                    <td><?php echo $order->state;?></td>
                    <td>
                      <?php echo $order->zip_code;?>
                    </td>
                    <td><?php echo $order->street_address;?></td>
                    <td><?php echo $order->first_name;?> </td>
                    <td>$<?php echo $order->total_price;?></td>

                    <td><?php echo $order->status;?></td>
                    <td><a href="change-status.php?id=<?php echo $order->id?>" class="btn btn-warning  text-center ">Update</a></td>
                    <td><a href="delete-orders.php?id=<?php echo $order->id?>" class="btn btn-danger  text-center ">delete</a></td>
                  </tr>
                <?php endforeach;?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>



<?php include_once '../layouts/footer.php'?>
