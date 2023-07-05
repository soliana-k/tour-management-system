<?php
session_start();


if(!isset($_SESSION["isAdmin"]) || $_SESSION["isAdmin"] !== true){
    
    header('Location: adminLogin.php');
    exit;
}
try {
    $con = new PDO("mysql:hostname=localhost;dbname=list", "root", "");
} catch (Exception $ex) {
    echo "connection error ". $ex->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	

    <style>
        #customer-list-container {
	display: none;
}
                body {
	font-family: Arial, sans-serif;
	margin: 0;
	padding: 0;
}

header {
	display: flex;
	justify-content: space-between;
	align-items: center;
	background-color: rgb(40, 126, 206);
	color: #fff;
	padding: 20px;
}

.logo a {
	color: #fff;
	font-size: 24px;
	text-decoration: none;
}

nav ul {
	display: flex;
	list-style: none;
	margin: 0;
	padding: 0;
}

nav ul li {
	margin-left: 20px;
}

nav ul li a {
	color: #fff;
	text-decoration: none;
}

main {
	padding: 50px;
}

h1 {
	font-size: 36px;
	margin-bottom: 20px;
}

.cards {
	display: flex;
	flex-wrap: wrap;
	margin-bottom: 50px;
        justify-content: space-evenly;
}

.card {
    
	background-color: #f5f5f5;
	border-radius: 4px;
	box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
	margin-right: 30px;
        margin-bottom: 30px;
	width: 400px;
        height: 300px;
        
}

.card:last-child {
	margin-right: 0;
}

.card-icon {
	background-color: rgb(40, 126, 206);
	color: #fff;
	height: 50px;
	width: 50px;
	border-top-left-radius: 4px;
	border-bottom-left-radius: 4px;
	display: flex;
	justify-content: center;
	align-items: center;
        text-align: center;
	float: none;
}

.card-content {
	padding: 10px;
	float: left;
}

.card-content h2 {
	font-size: 20px;
	margin-bottom: 5px;
}

.card-content p {
	font-size: 16px;
	margin: 0;
}

.table-container {
	margin-bottom: 50px;
}

table {
	border-collapse: collapse;
	width: 100%;
}

thead {
	background-color: rgb(40, 126, 206);
	color: #fff;
}

th,
td {
	padding: 10px;
	text-align: left;
	border-bottom: 1px solid #ccc;
}

th:first-child,
td:first-child {
	text-align: center;
}

th:last-child,
td:last-child {
	text-align: right;
}

th {
	font-weight: bold;
}

footer {
	background-color:rgb(40, 126, 206) ;
	color: #fff;
	padding: 10px;
	text-align: center;
}
    </style>
</head>
<body>
	<header>
		<div class="logo">
			<a href="#">KaMM</a>
		</div>
		<nav>
			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="tourdash.php">Tours</a></li>
				<li><a href="bookdash.php">Bookings</a></li>
				
				
				<li><a href="adminProfile.php">Profile</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<h1>Welcome to the Admin Dashboard</h1>
		<section class="cards">
			<div class="card" onclick="window.location.href='tourdash.php'">
				<div class="card-icon">
					<i class="fas fa-globe"></i>
				</div>
				<div class="card-content" >
					<h2>Total Available Tours</h2>
					 <?php
                                        $count_tour = "SELECT COUNT(*) FROM tour";
$count_to = $con->query($count_tour);
$c = $count_to->fetchColumn();
echo "<p>$c</p>";
?>
				</div>
			</div>
			<div class="card" id="total-customers-card" onclick="window.location.href='dash.php';">
				<div class="card-icon">
					<i class="fas fa-users"></i>
				</div>
                            <div class="card-content" >
					<h2>Total Users</h2>
                                        <?php
                                        $count_query = "SELECT COUNT(*) FROM user";
$count_stmt = $con->query($count_query);
$count = $count_stmt->fetchColumn();
echo "<p>$count</p>";
?>
					
				</div>
			</div>
			<div class="card" onclick="window.location.href='bookdash.php';">
				<div class="card-icon">
					<i class="fas fa-book"></i>
				</div>
				<div class="card-content">
					<h2>Total Bookings</h2>
					 <?php
                                        $count_book = "SELECT COUNT(*) FROM bookings";
$count_boo = $con->query($count_book);
$co = $count_boo->fetchColumn();
echo "<p>$co</p>";
?>
				</div>
			</div>
                    <div class="card" onclick="window.location.href='admindash.php';">
				<div class="card-icon">
					<i class="fas fa-book"></i>
				</div>
				<div class="card-content">
					<h2>Total Admin</h2>
					 <?php
                                        $ad = "SELECT COUNT(*) FROM admin";
$admin = $con->query($ad);
$add = $admin->fetchColumn();
echo "<p>$add</p>";
?>
				</div>
			</div>
		</section>
		
	</main>
	<footer>
		<p>&copy; 2023 KaMM</p>
	</footer>
	
</body>
</html>
