<?php include_once '../layouts/header.php'?>
<?php include_once "../../config/config.php"?>

<?php


if (!isset($_SESSION['admin_name'])) {
    header("location: ".ADMINURL."");
}

$select_admins = $conn->prepare("select * from admins");
$select_admins->execute();
$admins = $select_admins->fetchAll(PDO::FETCH_OBJ)

?>

<div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Admins</h5>
             <a  href="create-admins.php" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">username</th>
                    <th scope="col">email</th>
                  </tr>
                </thead>
                <tbody>
                <?php $num = 0?>
                <?php foreach ($admins as $admin):?>
                <?php $num++;?>
                  <tr>
                    <th scope="row"><?php echo $num?></th>
                    <td><?php echo $admin->adminname?></td>
                    <td><?php echo $admin->email?></td>
                   <?php endforeach;?>
                  </tr>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>



<?php include_once '../layouts/footer.php'?>
