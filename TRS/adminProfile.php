<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION["isAdmin"]) || $_SESSION["isAdmin"] !== true){
    // Redirect to login page
    header('Location: adminLogin.php');
    exit;
}

// Get the user's email from the session
$email = $_SESSION["em"];



// Create a PDO connection object
$dsn = "mysql:hostname=localhost;dbname=list";
$pdo = new PDO($dsn, "root", "");

$sql = "SELECT * FROM admin WHERE email = :email";
$stmt = $pdo->prepare($sql);

// Bind the parameters
$stmt->bindParam(':email', $email);

// Execute the query
$stmt->execute();

// Fetch the result
$user = $stmt->fetch();
$fn=$user['fname'];
$ln=$user['lname'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Profile</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
	body {
	  font-family: Arial, Helvetica, sans-serif;
	  margin: 0;
      background-color: #f2f2f2;
	}

	.header {
	  background-color:rgb(40, 126, 206);
	  padding: 20px;
	  text-align: center;
	}

	.container {
	  display: flex;
	  flex-wrap: wrap;
	  justify-content: center;
	  align-items: center;
	  margin: 20px;
      max-width: 800px;
      margin: 0 auto;
	}
        section{
            height:100vh;
        }

	.card {
	  background-color: #fff;
	  border-radius: 10px;
	  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
	  padding: 20px;
	  margin: 20px;
	  width: 300px;
	  text-align: start;
      position: relative;
      overflow: hidden;
      transition: transform 0.2s ease;
	}

    .card:hover {
        transform: scale(1.05);
    }
    h2{
        text-align: center;
    }

	.card h3 {
	  color: #444;
      margin-bottom: 10px;
	}

	.card p {
	  color: #888;
	  font-size: 18px;
	  margin-bottom: 10px;
	}

	.card button {
	  background-color: rgb(40, 126, 206);
	  border: none;
	  color: white;
	  padding: 10px 20px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;
	  margin: 10px;
	  border-radius: 5px;
	  cursor: pointer;
      transition: background-color 0.2s ease;
	}

    footer {
	background-color:rgb(40, 126, 206) ;
	color: #fff;
	padding: 10px;
	text-align: center;
        align-items: end;
}
nav a{
	color: #fff;
	text-decoration: none;
        position: absolute;
        top: 7%;
        left:8%;
}


  

	</style>
</head<body>
    <section>
          <nav>
            <a href='AdminHome.php'>Home</a>
        
        </nav>  
<div class="header">

  <h1>Admin Profile</h1>
</div>
<h2>Welcome, <?php echo $fn ." ". $ln ?>!</h2>
<div class="container">
  <div class="card">
    <h3>Full Name - <?php echo $user['fname'] . " ". $user['lname']; ?></h3>
    <p>Email - <?php echo $user['email']; ?></p>
    <p>Role - <?php echo "Admin"; ?></p>
   <form method="post" action="logout.php">
  <button type="submit" name="logout">Logout</button>
  
  </form>
    
   
    
    
  </div>
</div>
    </section>
 <footer>
		<p>&copy; 2023 TRS</p>
	</footer>
</body>
</html>
