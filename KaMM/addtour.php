<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Tour Package</title>
    <style>    
    /* Styles for navigation menu */
body {
  margin: 0;
  font-family: Arial, sans-serif;
  background-color: #f8f8f8;
}
.logo a {
	color: #fff;
	font-size: 24px;
	text-decoration: none;
}
nav {
  background-color: grey;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
}

nav ul {
  list-style: none;
  margin: 0;
  padding: 0;
  display: flex;
}

nav ul li {
  margin: 0 10px;
}

nav ul li a {
  color: #fff;
  text-decoration: none;
  padding: 5px;
}

nav ul li a:hover {
  background-color: crimson;
  color: #fff;
}

/* Styles for add tour form */
#add-tour-form {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 50px;
  background-color: #fff;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
  border-radius: 10px;
  padding: 30px;
  width: 80%;
  max-width: 600px;
  margin: 50px auto;
}

#add-tour-form h3 {
  font-size: 24px;
  margin-bottom: 20px;
  color: crimson;
}

#add-tour-form label {
  font-size: 18px;
  margin-bottom: 10px;
  color: #333;
}

#add-tour-form input[type="text"],
#add-tour-form input[type="number"],
#add-tour-form input[type="date"],
#add-tour-form input[type="url"],
#add-tour-form select,
#add-tour-form button {
  font-size: 18px;
  padding: 10px;
  border: 1px solid #ccc;
  margin-bottom: 20px;
  border-radius: 5px;
  width: 100%;
  box-sizing: border-box;
}

#add-tour-form input[type="text"],
#add-tour-form input[type="number"],
#add-tour-form input[type="date"],
#add-tour-form input[type="url"] {
  height: 40px;
}

#add-tour-form select {
  height: 40px;
  background-color: #fff;
  max-width: 200px; /* added this line to set a max width for the select element */
}

#add-tour-form button {
  background-color: crimson;
  color: #fff;
  border: none;
  cursor: pointer;
}

#add-tour-form button:hover {
  background-color: transparent;
  color:crimson;
}
footer {
	background-color:grey ;
	color: #fff;
	padding: 10px;
	text-align: center;
}


      </style>
    </head>
    <body>
      
      <nav>
          <header>
              <div class="logo">
			<a href="#">KaMM</a>
		</div>
          </header>
        <ul id="admin-nav">
          <li><a href="#">Home</a></li>
          <li><a href="#">Logout</a></li>
          
        </ul>
      </nav>
      
      <main>
        <div id="add-tour-form">
          <form action="addtour.php" method="post">
            <h3>Add Tour Package</h3>
            <label for="name">Tour Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="desc">Description:</label>
            <input type="text" id="desc" name="desc" required>
            <label for="date">Start Date:</label>
            <input type="date" id="date" name="date" min="<?php echo date('Y-m-d'); ?>" required>
            <label for="dat">End Date:</label>
            <input type="date" id="dat" name="end" min="<?php echo date('Y-m-d'); ?>" required>
            <label for="location">Tour Location:</label>
            <input type="text" id="location" name="location" required>
            <label for="image">Tour Image URL:</label>
            <input type="url" id="image" name="image" required>
            <label for="price">Tour Price:</label>
            <input type="number" id="price" name="price" required>
            <br>
            
            <label for="status">Tour Status:</label>
            <select id="status" name="stat" required>
              <option value="">Select Status</option>
              <option value="available">Available</option>
              <option value="unavailable">Unavailable</option>
            </select>
            <button type="submit">Add Tour</button>
          </form>
        </div>
        
       
      </main>
      
      <footer>
		<p>&copy; 2023 KaMM</p>
	</footer>
    </body>
</html>
    <?php


    //
    
    
    // Get form data
    $name = filter_input(INPUT_POST,"name");
    $desc = filter_input(INPUT_POST,"desc");
    $price = filter_input(INPUT_POST,"price");
    $location = filter_input(INPUT_POST,"location");
    $time = filter_input(INPUT_POST,"end");
    $date = filter_input(INPUT_POST,"date");
    $image=filter_input(INPUT_POST, "image");
    $stat=filter_input(INPUT_POST, "stat");

    // Connect to database
    $dsn = "mysql:hostname=localhost;dbname=list";
    $db_user = "root";
if(!empty($name)){
    try {
      $pdo = new PDO($dsn, $db_user, "");
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // Prepare SQL statement to insert tour into database
      $sql = "INSERT INTO tour (name, start, end, description, location, price, image, status) VALUES (:name, :date, :time, :desc, :location, :price, :image, :stat)";
      $stmt = $pdo->prepare($sql);

      // Bind parameters to prepared statement
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':date', $date);
      $stmt->bindParam(':time', $time);
      $stmt->bindParam(':desc', $desc);
      $stmt->bindParam(':location', $location);
      $stmt->bindParam(':price', $price);
      $stmt->bindParam(':image', $image);
      $stmt->bindParam(':stat', $stat);
      
      
     

      // Execute prepared statement
      if ($stmt->execute()) {
        echo "<script>alert('Tour added successfully!')</script>";
        header('location: tourdash.php');
      } else {
        echo "<script>alert('Error adding tour!')</script>";
      }
    } catch (PDOException $e) {
      echo "Database error: " . $e->getMessage();
    }
}
    ?>
  </div>
</body>
</html>