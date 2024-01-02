<?php include_once '../includes/header.php'?>
<?php include_once '../config/config.php'?>

<?php

if(!isset($_SERVER['HTTP_REFERER'])){
    header("location: http://localhost/coffee-blend/");
    exit;

}

if(!isset($_SESSION['user_id'])) {
    header("location: ".APPURL."");
}

$deleteAll = $conn->prepare("delete from cart where user_id= '$_SESSION[user_id]'");

$deleteAll->execute();

header("location: cart.php");
?>
