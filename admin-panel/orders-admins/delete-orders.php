<?php include_once "../layouts/header.php"; ?>

<?php include_once "../../config/config.php"; ?>

<?php

if (!isset($_SESSION['admin_name'])) {
    header("location: ".ADMINURL."/admins/login-admins.php");
}
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $delete_order = $conn->prepare("delete from orders where id = :id");
    $delete_order->execute([
       ":id" => $id
    ]);
    header("location: ".ADMINURL."/orders-admins/show-orders.php");

}
?>