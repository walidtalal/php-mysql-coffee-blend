<?php include_once '../layouts/header.php'?>
<?php include_once "../../config/config.php"?>

<?php
$select_bookings = $conn->prepare("select * from bookings");
$select_bookings->execute();
$bookings = $select_bookings->fetchAll(PDO::FETCH_OBJ)
?>


<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Bookings</h5>
            
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">first_name</th>
                    <th scope="col">last_name</th>
                    <th scope="col">date</th>
                    <th scope="col">time</th>
                    <th scope="col">phone</th>
                    <th scope="col">message</th>
                    <th scope="col">status</th>
                    <th scope="col">created_at</th>
                    <th scope="col">update</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php $num =0;?>
                <?php foreach ($bookings as $booking):?>
                <?php $num++;?>
                  <tr>
                    <th scope="row"><?php echo $num;?></th>
                    <td><?php echo $booking->first_name;?></td>
                    <td><?php echo $booking->last_name;?></td>
                    <td><?php echo $booking->date;?> </td>
                    <td><?php echo $booking->time;?></td>
                    <td><?php echo $booking->phone;?></td>
                    <td><?php echo $booking->message;?></td>
                    <td><?php echo $booking->status;?></td>
                    <td><?php echo $booking->created_at;?></td>
                     <td><a href="change-status.php?id=<?php echo $booking->id;?>" class="btn btn-warning  text-center ">update</a></td>
                     <td><a href="delete-bookings.php?id=<?php echo $booking->id;?>" class="btn btn-danger  text-center ">delete</a></td>
                  </tr>
                <?php endforeach;?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>



<?php include_once '../layouts/footer.php'?>
