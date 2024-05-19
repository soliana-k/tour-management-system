<?php
session_start();


if(!isset($_SESSION["isAdmin"]) || $_SESSION["isAdmin"] !== true){
    
    header('Location: adminLogin.php');
    exit;
}  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
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
			<a href="#">TRS</a>
		</div>
		<nav>
			<ul>
				<li><a href="AdminHome.php">Home</a></li>
				<li><a href="addtour.php">Add Tour</a></li>

				
			</ul>
		</nav>
	</header>
	<main>
		<h1>Total Tours</h1>
		
		<section class="table-container">
			<h2>Available Tour List</h2>
			<table>
				<thead>
					<tr>
						<th>SN</th>
						<th>Tour Name</th>
						<th>Destination</th>
						<th>Available in</th>
                                                <th>Price</th>
                                                <th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						// Create a PDO instance and connect to the database
						$db = new PDO('mysql:host=localhost;dbname=list', 'root', '');
						$sty="available";
						// Prepare the SQL query to fetch data from the "customer" table
						$sql = "SELECT * FROM tour";
						$stmt = $db->prepare($sql);
						
						// Execute the query
						$stmt->execute();
                                                $rowCount=$stmt->rowCount();
                             
						$i=1;
						// Fetch and display the results
						while ($row = $stmt->fetch()) {
							echo "<tr>";
							echo "<td>" .$i++."</td>";
							echo "<td>" . $row['name'] ."</td>";
							echo "<td>" . $row['location'] . "</td>";
							echo "<td>" . $row['start'] ." - ". $row['end']. "</td>";
                                                        echo "<td>" . "$".$row['price']  . "</td>";
                                                        echo "<td> <a href='deltour.php?name=" . $row["name"] . "'>Delete</a></td>";
							echo "</tr>";
						}
                                                if($rowCount==0){
                                                    echo "<tr>";
							echo "<td>No Data</td>";
							echo "<td>No Data</td>";
							echo "<td>No Data</td>";
							echo "<td>No Data</td>";
                                                        echo "<td>No Data</td>";
                                                        echo "<td>No Data</td>";
							echo "</tr>";
                                                }
					?>
				</tbody>
			</table>
		</section>
	</main>
    <footer>
		<p>&copy; 2023 KaMM</p>
	</footer>
</body>
</html>