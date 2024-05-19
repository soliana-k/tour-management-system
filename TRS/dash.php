<?php
session_start();


if(!isset($_SESSION["isAdmin"]) || $_SESSION["isAdmin"] !== true){
    
    header('Location: adminLogin.php');
    exit;
}?>
<!DOCTYPE html>
<html>
<head>
	<title>TRS</title>
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
			<a href="AdminHome.php">KaMM</a>
		</div>
		<nav>
			<ul>
				<li><a href="AdminHome.php">Home</a></li>
				
				
			</ul>
		</nav>
	</header>
	<main>
		<h1>Total Users</h1>
		
		<section class="table-container">
			<h2>Customer List</h2>
			<table>
				<thead>
					<tr>
						<th>Customer ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>Address</th>
                                                <th>Telephone</th>
                                                <th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						// Create a PDO instance and connect to the database
						$db = new PDO('mysql:host=localhost;dbname=list', 'root', '');
						
						// Prepare the SQL query to fetch data from the "customer" table
						$sql = "SELECT * FROM user";
						$stmt = $db->prepare($sql);
						
						// Execute the query
						$stmt->execute();
						$i=1;
						// Fetch and display the results
						while ($row = $stmt->fetch()) {
							echo "<tr>";
							echo "<td>" .$i++."</td>";
							echo "<td>" . $row['fname'] ." ". $row['lname']. "</td>";
							echo "<td>" . $row['email'] . "</td>";
							echo "<td>" . $row['country'] .", " . $row['city']. "</td>";
                                                        echo "<td>" . $row['tel']. "</td>";
                                                        echo "<td><a href='deluser.php?email=" . $row["email"] . "'>Delete</a>" ."</td>";
							echo "</tr>";
						}
					?>
				</tbody>
			</table>
		</section>
	</main>
    <footer>
		<p>&copy; 2023 TRS</p>
	</footer>
</body>
</html>