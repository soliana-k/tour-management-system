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
<html>
<head>
  <title>Profile</title>
  <style>
    /* Global styles */
    body {
      font-family: Arial, sans-serif;
      background-color: #f7f7f7;
      margin: 0;
    }

    /* Header styles */
    header {
      background-color: crimson;
      color: #fff;
      padding: 20px;
      text-align: center;
    }

    header h1 {
      margin: 0;
      font-size: 36px;
    }

    /* Profile section styles */
    .profile {
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      margin: 20px auto;
      max-width: 600px;
      padding: 20px;
      transition: transform 0.3s ease-in-out;
    }

    .profile:hover {
      transform: scale(1.03);
    }

    .profile h2 {
      margin-top: 0;
      font-size: 24px;
    }

    .profile p {
      font-size: 16px;
      line-height: 1.5;
      margin: 10px 0;
    }

    /* Logout button styles */
    .logout {
      text-align: center;
    }
 article {
         background-color: white;
        border: 1px solid  rgba(255, 192, 203, 0.5);
        box-shadow: 0 0 10px rgba(255, 192, 203, 0.5);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex-wrap: wrap;
/*         align-items: center; */
        margin-bottom: 50px;
        padding: 20px;
        width: 350px;
        border-radius: 15px;
        margin-left:15px;
      }
      
      article h2 {
        font-size: 24px;
        margin: 0;
      }
      
      article p {
        font-size: 16px;
        margin: 10px 0;
      }
      
    .logout button {
        background-color:  crimson;
        color: white;
        font-size: 18px;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      
    }

    .logout button:hover {
      background-color: red;
    }
    .classic{
        background-color:  crimson;
        color: #fff;
        font-size: 18px;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        position:absolute;
        top:3.5%;
        right: 5%;
    }
    .title{
        display: flex;
        justify-content: center;
        font-family: 'Times New Roman', 'sans-serif';
        font-size: 1.7rem;
    }
  </style>
</head>
<body>
  <header>
    <h1>User Profile</h1>
  </header>

  <div class="profile">
    <h2>Welcome, <?php echo $fn ." ". $ln ?>!</h2>
    <p>Personal Profile Page for You, <?php echo $fn; ?>.</p>
    <p>Some information about you:</p>
    <ul>
      <li>Name: <?php echo $fn . $ln ?></li>
      <li>Email: <?php echo $email ?></li>
      <li>Phone: <?php echo $tel ?></li>
    </ul>
  </div>
    <div class='title'>
  <h2>Booked Tours</h2>
</div>

    <?php
     foreach ($books as $tour) {
    echo '<article>';
    echo '<h2>' . $tour['name'] . '</h2>';
    echo '<p>' . $tour['description'].'</p>';
    echo '<p> Location: '. $tour['location'] . '</p>';
    echo '<p>Start Date - ' . $tour['start'] . '</p>';
   echo '<p>Price: $' . $tour['price'].'</p>';
    echo '</article>';
  }
?>
  <form method="post" action="logout.php">
  <button type="submit" name="logout" class='classic'>Logout</button>
  </form>

  </body>
</html>