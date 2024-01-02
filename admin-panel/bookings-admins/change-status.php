<?php include_once '../layouts/header.php'?>
<?php include_once "../../config/config.php"?>

<?php


if (!isset($_SESSION['admin_name'])) {
    header("location: ".ADMINURL."");
}

if(isset($_GET["id"])) {
    $id = $_GET['id'];
    if(isset($_POST['submit'])) {
        if(empty($_POST['status'])) {
            echo '<script>alert("one input or more is empty")</script>';
        } else {
            $status = $_POST['status'];

            $update = $conn->prepare("update bookings set status = :status where id =:id");
            $update->execute([
                ":status" => $status,
                ":id" => $id,
            ]);
            header("location: ".ADMINURL."/bookings-admins/show-bookings.php");
        }
    }
}

?>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-5 d-inline">Update Status</h5>
                <form method="POST" action="change-status.php?id=<?php echo $id;?>" >
                    <!-- status input -->
                    <div class="form-outline mb-4 mt-4">

                        <select name="status" class="form-select  form-control" aria-label="Default select example">
                            <option selected>Choose Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Done">Done</option>
                        </select>
                    </div>







                    <!-- Submit button -->
                    <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>


                </form>

            </div>
        </div>
    </div>
</div>
<?php include_once '../layouts/footer.php'?>
