<?php
// Connect to the database using PDO



try {
    $con = new PDO("mysql:host=localhost;dbname=list", "root", "");
    // Set the PDO error mode to exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Get the user ID from the query parameter
$em = $_GET["email"];

// Delete the user from the database
$stmt = $con->prepare("DELETE FROM user WHERE email = :email");
$stmt->bindParam(":email", $em);
if($stmt->execute()){
echo "<script>alert('deleted succesfully')</script>";
// Redirect back to the original page
   header("Location: dash.php");
}
