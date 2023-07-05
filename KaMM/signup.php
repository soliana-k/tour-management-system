   <?php
  
$fname = filter_input(INPUT_POST,"first-name");
 $lname = filter_input(INPUT_POST,"last-name");
 $count = filter_input(INPUT_POST,"country");
 $city = filter_input(INPUT_POST,"city");
 $email = filter_input(INPUT_POST,"email");
 $pass = filter_input(INPUT_POST,"password");
 $pass2 = filter_input(INPUT_POST,"pass2");
 $tel=filter_input(INPUT_POST, "tel");
 if(!empty($fname)||!empty($pass)|| !empty($pass2) || !empty($lname) || !empty($city) || !empty($count) || !empty($email)){
     
 
 
 
 $dbinfo= "mysql:hostname=localhost;dbname=list";
 $dbuser= "root";


 
   try{
       $u= new PDO($dbinfo, $dbuser, "");
   
   } catch (PDOException $ex) {
       echo("error connection error");
       $err=$ex->getMessage();
       echo($err);
    }
        $sql="INSERT into user(fname,lname,email,pass,country,city,tel)values(:fname,:lname,:email,:pass,:count,:city, :tel);";
        $res= $u->prepare($sql);
        $res ->bindParam(':fname', $fname);
        $res ->bindParam(':lname', $lname);
        $res ->bindParam(':email', $email);
        $res ->bindParam(':pass', $pass);
        $res ->bindParam(':count', $count);
        $res ->bindParam(':city', $city);
        $res->bindParam(':tel', $tel);
       if($res->execute()) {
    header('Location: newLogin.php');
    echo "<script>alert('Successful signup!')</script>";
    exit;
}
 }
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>KaMM - Signup</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    <style>
         /* Header styles */
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: rgba(255, 192,203, 0.5);
      color: crimson;
      padding: 20px;
    }

    .logo a {
      font-size: 24px;
      text-decoration: none;
      color: crimson;
      font-weight: bold;
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
      color: crimson;
      text-decoration: none;
      font-weight: bold;
      padding: 10px;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    nav ul li a:hover {
      background-color: crimson;
      color: white;
    }

        * {
	box-sizing: border-box;
    margin: 0%;
}

body {
	background-color: #f2f2f2;
	font-family: Arial, sans-serif;
}

.container {
	margin: 80px auto;
	max-width: 500px;
    margin-top: 55px;
	padding: 20px;
	background-color: rgba(255, 192,203, 0.5);
	box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
	border-radius: 5px;
}

h1 {
	text-align: center;
	margin-bottom: 30px;
    color:crimson;
}

form label {
	display: block;
	margin-bottom: 8px;
}

form input[type="text"], form input[type="email"], form input[type="tel"], form input[type="password"], form select {
	width: 100%;
	padding: 12px;
	border: 1px solid crimson;
	border-radius: 10px;
	margin-bottom: 20px;
	font-size: 16px;
}

form select {
	height: 40px;
}

form button[type="submit"] {
	background-color: crimson;
	color: #fff;
	padding: 14px 20px;
	border: none;
	border-radius: 4px;
	cursor: pointer;
	font-size: 16px;
}

form button[type="submit"]:hover {
	background-color: white;
    color:crimson;
}

form button[type="submit"]:disabled {
	background-color: #ccc;
	cursor: not-allowed;
}

form p.error {
	color: red;
	font-size: 14px;
	margin-top: 5px;
}

form p.success {
	color: green;
	font-size: 14px;
	margin-top: 5px;
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
            <li><a href="welcome.html">Index</a></li>
          </ul>
        </nav>
      </header>
	<div class="container">
		<h1>Signup Form</h1>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"id="signup-form" method="post">
			<label for="first-name">First Name</label>
			<input type="text" id="first-name" name="first-name" required>

			<label for="last-name">Last Name</label>
			<input type="text" id="last-name" name="last-name" required>

			<label for="email">Email</label>
			<input type="email" id="email" name="email" required>

			<label for="country">Country</label>
			<select id="country" name="country">
				<option value="">Select Country</option>
				<option value="Ethiopia">Ethiopia</option>
				<option value="Eriterea">Eriterea</option>
				<option value="Sudan">Sudan</option>
				<option value="Egypt">Egypt</option>
			</select>

			<label for="city">City</label>
			<select id="city" name="city">
				<option value="">Select City</option>
				<option value="Adiss Ababa">Adiss Ababa</option>
				<option value="Asmara">Asmara</option>
				<option value="Khartoum">Khartoum</option>
				<option value="Cairo">Cairo</option>
			</select>

			<label for="tel">Telephone Number</label>
			<input type="tel" id="tel" name="tel" required>

			<label for="password">Password</label>
			<input type="password" id="password" name="password" required>

			<label for="confirm-password">Confirm Password</label>
			<input type="password" id="confirm-password" name="pass2" required>

			<button type="submit" name="submit">Sign Up</button>
		</form>
	</div>

	<script>
        // Get the select elements for country and city
const countrySelect = document.getElementById("country");
const citySelect = document.getElementById("city");

// Define city options for each country
const citiesByCountry = {
	"Ethiopia": ["Adiss Ababa", "Hawasa", "Adama"],
	"Eriterea": ["Asmara", "Massawa"],
	"Sudan": ["Khartoum"],
	"Egypt": ["Cairo", "Giza", "Aswan"]
};

// Update city options when country changes
countrySelect.addEventListener("change", function() {
	const selectedCountry = countrySelect.value;
	const cities = citiesByCountry[selectedCountry];
	updateCityOptions(cities);
});

// Update city options based on selected country
function updateCityOptions(cities) {
	citySelect.innerHTML = "";
	for (let i = 0;i < cities.length; i++) {
		const city = cities[i];
		const option = document.createElement("option");
		option.value = city;
		option.textContent = city;
		citySelect.appendChild(option);
	}
}

// Automatically fill in area code for telephone number based on selected country
countrySelect.addEventListener("change", function() {
	const selectedCountry = countrySelect.value;
	const areaCode = getAreaCode(selectedCountry);
	const telInput = document.getElementById("tel");
	telInput.value = `+${areaCode} `;
});

// Get area code based on selected country
function getAreaCode(country) {
	switch (country) {
		case "Ethiopia":
			return "251";
		case "Eriterea":
			return "291";
		case "Sudan":
			return "249";
		case "Egypt":
			return "20";
		default:
			return "";
	}
}



    </script>
</body>
</html>
 

   


    
  