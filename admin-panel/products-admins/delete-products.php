<?php include_once "../layouts/header.php"; ?>

<?php include_once "../../config/config.php"; ?>

<?php
if (!isset($_SESSION['admin_name'])) {
    header("location: ".ADMINURL."");
}

if (!isset($_SESSION['admin_name'])) {
    header("location: ".ADMINURL."/admins/login-admins.php");
}
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $select_product = $conn->prepare("select * from products where id = :id");
    $select_product->execute([
        ":id" => $id
    ]);
    $image = $select_product->fetch(PDO::FETCH_OBJ);
    unlink("images/".$image->image);

    $delete_product = $conn->prepare("delete from products where id = :id");
    $delete_product->execute([
       ":id" => $id
    ]);
    header("location: ".ADMINURL."/products-admins/show-products.php");

}
?>