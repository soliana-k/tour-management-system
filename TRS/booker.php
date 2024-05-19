<?php

$cusname=filter_input(INPUT_POST, 'cusname');
$tourname=filter_input(INPUT_POST, 'tourname');
$email=filter_input(INPUT_POST, 'email');
$price=filter_input(INPUT_POST, 'price');

try {
    $con = new PDO("mysql:hostname=localhost;dbname=list", "root", "");
} catch (Exception $ex) {
    echo "connection error ". $ex->getMessage();
}

// Check if user with email exists
$user_query = "SELECT * FROM user WHERE email = :em";
$user_stmt = $con->prepare($user_query);
$user_stmt->bindParam(":em", $email);
$user_stmt->execute();

if ($user_stmt->rowCount() == 0) {
    session_start();
    $_SESSION['error_message'] = "User with email $email not found";
    header("Location: homepage.php");
} else {
    // User exists, insert booking
    $date = date('Y-m-d');
    $query = "INSERT INTO bookings (tourname, email, date, price) VALUES (:tn, :em, :d, :pr)";
    $stmt = $con->prepare($query);
    $stmt->bindParam(":d", $date);
    $stmt->bindParam(":tn", $tourname);
    $stmt->bindParam(":em", $email);
    $stmt->bindParam(":pr", $price);

    if ($stmt->execute()) {
        // Booking successful, redirect back to home page
        header('Location: homepage.php');
    } else {
        // Booking failed, redirect back to home page with error message
         session_start();
        $_SESSION['error_message'] = "Booking failed";
        header("Location: homepage.php");
        }
}