<?php
// Establish a connection to the database
$dsn = 'mysql:hostname=localhost;dbname=list';
$username = 'root';
$password = 'mypassword';
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
$pdo = new PDO($dsn, $username, "", $options);
$tour_id = $_GET['name'];

// Prepare a DELETE query to delete the tour from the database
$sql = "DELETE FROM tour WHERE name = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute(array($tour_id));
if($stmt){
// Redirect to the homepage
   
    header('Location: tourdash.php');
     echo "<script>alert('Deleted successfully')</script>";
}

unset($pdo);