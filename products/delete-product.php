<?php //include_once '../includes/header.php'?>
<?php //include_once '../config/config.php'?>
<!---->
<?php
//
//if (!isset($_SESSION['username'])) {
//    header("location: ".APPURL."");
//}
//
//if (isset($_GET['id'])) {
//    $id = $_GET['id'];
//
//    // Prepare the SQL query
//    $delete = $conn->prepare("DELETE FROM cart WHERE id = :id");
//
//    // Bind the parameter and execute the query
//    $delete->execute([
//        'id' => $id
//    ]);
//
//    header("location: cart.php");
//}
//?>

<?php
// Include necessary files
require_once '../includes/header.php';
require_once '../config/config.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("location: " . APPURL);
    exit; // Terminate script execution after redirect
}

// Check if 'id' is set in the GET parameters
if (isset($_GET['id'])) {
    // Sanitize and validate the input ID
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    if ($id === false || $id <= 0) {
        // Invalid ID, handle error (redirect or show an error message)
        header("location: cart.php"); // Redirect to cart page or appropriate error page
        exit;
    }

    try {
        // Prepare the SQL query to delete from cart
        $delete = $conn->prepare("DELETE FROM cart WHERE id = :id");

        // Bind the parameter and execute the query
        $delete->execute(['id' => $id]);

        // Redirect to cart page after successful deletion
        header("location: cart.php");
        exit; // Terminate script execution after redirect
    } catch (PDOException $e) {
        // Handle database errors
        // You can log the error, display an error message, or redirect to an error page
        echo "Error: " . $e->getMessage(); // Display error message for debugging
        // header("location: error.php"); // Redirect to an error page
        exit;
    }
} else {
    // If 'id' is not set in GET parameters, redirect to cart page or handle the situation accordingly
    header("location: cart.php");
    exit;
}
?>

