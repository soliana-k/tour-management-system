<?php
session_start();
try{
    $pdo=new PDO("mysql:hostname=localhost;dbname=list", "root", "");
} catch (Exception $ex) {
echo "connection error" . $ex->getMessage();
}

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
  // Redirect to the login page if not logged in
  header('Location: newLogin.php');
  exit();
}

// Get the username from the session variable
$email = $_SESSION['email'];

// Retrieve user information from the database
$stmt = $pdo->prepare('SELECT * FROM user WHERE email = ?');
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$fn=$user['fname'];
$ln=$user['lname'];
$ad=$user['country'];
$city=$user['city'];
$tel=$user['tel'];
 $sql = "SELECT bookings.*, user.*, tour.*
        FROM bookings
        JOIN user ON bookings.email = user.email
        JOIN tour ON bookings.tourname = tour.name
        WHERE bookings.email = :email";
$res = $pdo->prepare($sql);
$res->bindParam(':email', $_SESSION['email']);
$res->execute();
$books = $res->fetchAll(PDO::FETCH_ASSOC);





?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
  <style>
    /* Global styles */
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }

    /* Header styles */
    header {
      background-color: green;
      color: #fff;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header h1 {
      margin: 0;
      font-size: 26px;
    }

    /* Navigation styles */
    nav {
      text-align: left;
      padding: 10px;
      background-color: transparent;
    }

    nav a {
      color: #fff;
      text-decoration: none;
      padding: 10px 20px;
      font-size: 20px;
    }

    /* Profile section styles */
    .profile {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      margin: 20px auto;
      max-width: 600px;
      padding: 40px;
      text-align: center;
    }

    .profile h2 {
      font-size: 28px;
      margin-bottom: 20px;
      color: #333;
    }

    .profile p {
      font-size: 18px;
      line-height: 1.6;
      margin-bottom: 20px;
      color: #666;
    }

    /* User avatar styles */
    .avatar {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      background-color: green;
      color: #fff;
      font-size: 48px;
      line-height: 120px;
      margin: 0 auto 20px;
    }

    /* User information styles */
    .user-info {
      margin-bottom: 40px;
    }

    .user-info p {
      margin: 10px 0;
      color: #888;
    }

    /* Booked tours section styles */
    .booked-tours {
      max-width: 800px;
      margin-left: 20px;
    }

    /* Tour card styles */
    .tour-card {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
      padding: 20px;
    }

    .tour-card h3 {
      margin-top: 0;
      font-size: 20px;
      color: #333;
      text-align: center; /* Center align tour name */
    }

    .tour-card p {
      font-size: 16px;
      margin: 10px 0;
      color: #555;
    }

    /* Logout button styles */
    .logout {
      text-align: center;
    }

    .logout button {
      background-color: crimson;
      color: #fff;
      font-size: 18px;
      padding: 12px 24px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .logout button:hover {
      background-color: #555;
    }
  </style>
</head>
<body>
  <header>
    <nav>
      <a href="homepage.php">Home</a>
    </nav>
    <h1>User Profile</h1>
  </header>

  <div class="profile">
    <div class="avatar"><?php echo strtoupper(substr($fn, 0, 1) . substr($ln, 0, 1)); ?></div>
    <h2>Welcome, <?php echo $fn ." ". $ln ?>!</h2>
    <div class="user-info">
      <p><strong>Name:</strong> <?php echo $fn . $ln ?></p>
      <p><strong>Email:</strong> <?php echo $email ?></p>
      <p><strong>Phone:</strong> <?php echo $tel ?></p>
      <p><strong>Address:</strong> <?php echo $ad ?></p>
      <p><strong>City:</strong> <?php echo $city ?></p>
    </div>
  </div>

  <div class="booked-tours">
    <h2>Booked Tours</h2>
    <?php
      foreach ($books as $tour) {
        echo '<div class="tour-card">';
        echo '<h3>' . $tour['name'] . '</h3>';
        echo '<p><strong>Location:</strong> ' . $tour['location'] . '</p>';
        echo '<p><strong>Start Date:</strong> ' . $tour['start'] . '</p>';
        echo '<p><strong>Price:</strong> $' . $tour['price'] . '</p>';
        echo '</div>';
      }
    ?>
  </div>

  <div class="logout">
    <form method="post" action="logout.php">
      <button type="submit" name="logout">Logout</button>
    </form>
  </div>
</body>
</html>
