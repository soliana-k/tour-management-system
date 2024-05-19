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

// Retrieve bookings with user information
$bookings_query = "SELECT bookings.*, user.fname, user.lname, user.email FROM bookings
                   JOIN user ON bookings.email = user.email";
$bookings_stmt = $con->query($bookings_query);
$bookings = $bookings_stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html>
<head>
	<title>KaMM</title>
	<style>
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
                        height: 90vh;
		}

		h1 {
			font-size: 36px;
			margin-bottom: 20px;
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
			<a href="AdminHome.php">TRS</a>
		</div>
		<nav>
			<ul>
				<li><a href="AdminHome.php">Home</a></li>
				

			</ul>
		</nav>
	</header>
	<main>
		<h1>Total Bookings</h1>
		
		<section class="table-container">
			<h2>Total Booking List</h2>
                        
			<table>
				<thead>
					<tr>
                                            <th>ID</th>
						<th>Full Name</th>
						<th>Email</th>
                                                <th>Tour Name</th>
						<th>Booked Date</th>

					</tr>
				</thead>
				<tbody>
					<?php
						$i=1;
						foreach ($bookings as $booking) {
    echo "<tr>
        <td>{$booking['id']}</td>
            <td>{$booking['fname']} {$booking['lname']}</td>
            <td>{$booking['email']}</td>
            <td>{$booking['tourname']}</td>
            <td>{$booking['date']}</td>
          </tr>";
}
						
					?>
				</tbody>
			</table>
		</section>
	</main>
    <footer>
		<p>&copy; 2024 TRS</p>
	</footer>
</body>
</html>