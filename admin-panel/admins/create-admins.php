<?php include_once '../layouts/header.php'?>
<?php include_once "../../config/config.php"?>

<?php


if (!isset($_SESSION['admin_name'])) {
    header("location: ".ADMINURL."");
}

if(isset($_POST['submit'])) {
    if(empty($_POST['adminname']) || empty($_POST['email']) || empty($_POST['password'])) {
        echo '<script>alert("one input or more is empty")</script>';
    } else {
        $adminname = $_POST['adminname'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $insert = $conn->prepare('insert into admins (adminname, email, password) values (:adminname , :email, :password)');
        $insert->execute([
            ":adminname" => $adminname,
            ":email" => $email,
            ":password" => $password,
        ]);
        header("location: ".ADMINURL."/admins/admins.php");
    }
}


?>
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Admins</h5>
          <form method="POST" action="create-admins.php" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />
                 
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="adminname" id="form2Example1" class="form-control" placeholder="username" />
                </div>
                <div class="form-outline mb-4">
                  <input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
                </div>

               
            
                
              


                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
<?php include_once '../layouts/footer.php'?>
