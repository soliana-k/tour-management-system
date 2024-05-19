      <?php
session_start();
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    echo "<script>alert('$error_message')</script>";
    unset($_SESSION['error_message']);
}



// Check if the user is logged in
if (!isset($_SESSION['email'])) {
  // Redirect to the login page if not logged in
  header('Location: newLogin.php');
  exit();
}
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];
try{
    $pd=new PDO("mysql:hostname=localhost;dbname=list", "root", "", $options);
} catch (Exception $ex) {
echo "connection error" . $ex->getMessage();
}
// Get the username from the session variable
$email = $_SESSION['email'];
$st = $pd->prepare('SELECT * FROM user WHERE email = ?');
$st->execute([$email]);
$user = $st->fetch(PDO::FETCH_ASSOC);
$fn=$user['fname'];
$ln=$user['lname'];
// Display the welcome message
if (!isset($_SESSION['welcome_message_displayed'])) {
    echo "<script>alert('Welcome, $fn $ln!');</script>";
    $_SESSION['welcome_message_displayed'] = true;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>HomePage</title>
    <style>
        body{
            margin: 0;
            overflow-x: hidden;
        }
      header {
	display: flex;
	justify-content: space-between;
	
	
	color: blue;
	padding: 20px;
}

.logo a {
	color:white ;
	font-size: 24px;
	text-decoration: none;
}
      /* Styles for navigation menu */
      nav {

        display: flex;
        justify-content: space-around;
        padding: 10px;
      }
      
      nav ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
      }
      
      nav ul li {
        margin: 0 10px;
        justify-content: space-evenly;
      }
      
      nav ul li a {
        color: white;
        text-decoration: none;
        padding: 5px;
      }
      
      nav ul li a:hover {
        background-color: white;
        color: rgb(255, 192, 203);
      }
      
      /* Styles for main content section */
      main {
        
         
        
        background-image:url(./image/welcome-2.jpg);
        height: 80vh;
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
        
        padding: 15px;
        width: 350px;
        border-radius: 15px;
      }
      
      article h2 {
        font-size: 24px;
        margin: 0;
      }
      
      article p {
        font-size: 16px;
        margin: 10px 0;
      }
      
      article img {
        max-width: 100%;
        margin-bottom: 10px;
        align-self: center;
        
      }
      
      article button {
        background-color:  green;
        color: white;
        font-size: 18px;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }
      
      /* Styles for search form */
      #search-form {
        background-color: rgba(255, 193, 203, 0.5);
        border: 1px solid  rgba(255, 192, 203, 0.5);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        display: flex;
        justify-content: center;
        align-items: center;
       position: absolute;
       top:50%;
       left:20%;
        padding: 20px;
        width: 60%;
      }
      section{
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        background-color: white;
      }
      
      #search-form label {
        font-size: 16px;
        margin-right: 10px;
        color:white;
      }
       #search-form button {
           background-color: green;
           color:white;
           border:none;
           padding: 10px;
           border-radius: 10px;
       }

      #search-form input {
        font-size: 16px;
        padding: 5px;
        border-radius: 5px;
        border: 1px solid  rgba(255, 192, 203, 0.5);
        margin-right: 10px;
      }
      
      #search-form  {
        background-color: rgba(255, 192, 203, 0.5);
        color: pink;
        font-size: 18px;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }
        /* Styles for popup modal */
      .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 999;
      }
  
      /* Styles for form */
      #payment-form {
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
        width: 500px;
        
      }
  
      #payment-form label {
        display: block;
        margin-bottom: 10px;
      }
  
      #payment-form input {
        display: block;
        margin-bottom: 10px;
        padding: 5px;
        border: 1px solid#ccc;
        border-radius: 5px;
        width: 100%;
      }
  
      #payment-form button {
        background-color:  green;
        color: #fff;
        font-size: 18px;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }
      /* Styles for close button */
#close-btn {
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 24px;
  color: black;
  border: none;
  background-color: transparent;
  cursor: pointer;
}

#close-btn:hover {
  color: red;
}



.card-type {
    display: flex;
    align-items: center;
    margin-left: 10px;
    font-size: 24px;
  }

  .card-type-icon {
    font-size: 24px;
  }

  .card-type-name {
    margin-left: 5px;
  }

  .card-type-icon.fa-visa:before {
    content: "\f1f0";
  }
  footer{
      display:flex;
      justify-content: center;
      background-color: green;
      color: white;
      padding: 20px;
  }

  .card-type-icon.fa-mastercard:before {
    content: "\f1f1";
  }
  .featured{
      margin-left:35px;
      
      position: absolute;
      top:80%;
  }
  section{
   
    display:flex;
    justify-content: space-evenly;
    margin-top: 60px;
  }
  .moto{
    color:white;
    position: absolute;
    top: 29%;
    font-family: 'Times New Roman', Times, serif;
    left:40%;
  }
  .bolder{
    font-size: 4rem;
  }
  .bolder:hover{
    background-color: crimson;
    
  }
    </style>
     </head>
  <body>
    <main>
      <header>
          <div class="logo">
			<a href="#">TRS</a>
		</div>

    <nav>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="aboutus.html">About Us</a></li>
       
        <li><a href="userProfile.php">Profile</a></li>


      </ul>
     
    </nav>
          
          </header>
   <form id="search-form">
  <label for="search">Search:</label>
  <input type="text" id="search" name="search">
  <button type="submit">Go</button>
</form>
<div class="featured">
  <h2>Currently Available Tours</h2>
</div>
<div class="moto">
  <h1>Explore Ethiopia with <span class="bolder">TRS</span></h1>
</div>
</main>
<section>
<?php
  // Connect to the database
 
  

 

  // Retrieve tours from the database
  $search = isset($_GET['search']) ? $_GET['search'] : '';
  if (empty($search)) {
    $stmt = $pd->query('SELECT * FROM tour');
  } else {
    $stmt = $pd->prepare('SELECT * FROM tour WHERE name LIKE ? OR location LIKE ?');
    $stmt->execute(["%$search%", "%$search%"]);
  }
  $tours = $stmt->fetchAll();
  

  // Display each tour as an article
  foreach ($tours as $tour) {
       //var_dump($tour['image']);
    echo '<article>';
   echo '<img src="' . $tour['image'] . '" width="400px">';
    echo '<h2>' . $tour['name'] . '</h2>';
    echo '<p>' . $tour['description'].'</p>';
    echo '<p> Location: '. $tour['location'] . '</p>';
    echo '<p>Price: $' . $tour['price'] . '</p>';
   echo '<button class="book-tour-btn" onclick="openBookingForm(\'' . $tour['name'] . '|' . $tour['price'] . '\')">Book Now</button>';
    echo '</article>';
  }
?>

    </section>
    
    <div class="modal">
      <div id="payment-form">
        <h2>Book a Tour</h2>
         <button id="close-btn">&times;</button>
          <form action="booker.php" method="post">
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" value='<?php echo ($fn. " ". $ln)?>' required>

          <label for="email">Email:</label>
          <input type="email" id="email" name="email" value='<?php echo($user['email'])?>' required>

          <label for="tourname">Tour Name:</label>
          <input type="text" id="tourname" name="tourname" readonly required>
 <label for="price">Price:</label>
          <input type="text" id="price" name="price" readonly required>
          <label for="card-number">Card Number:</label>
          <input type="text" id="card-number" name="card-number" required>
          <div id="card-type">
               <span class="card-type-icon"></span>
      <span class="card-type-name"></span>
          </div>
      
          <label for="expiration-date">Expiration Date:</label>
          <input type="text" id="expiration-date" name="expiration-date" placeholder="MM/YY" required>

          <label for="cvv">CVV:</label>
          <input type="text" id="cvv" name="cvv" required>

          <button type="submit" class="book-t">Book Now</button>
        </form>
      </div>
    </div>
    <script>
     const bookNowButtons = document.querySelectorAll('.book-tour-btn');
const modal = document.querySelector('.modal');
const paymentForm = document.getElementById('payment-form');
const closeBtn = document.getElementById('close-btn');
const cardNumberInput = document.getElementById('card-number');
const cardTypeDisplay = document.getElementById('card-type');
const bookTour=document.querySelector('.book-t');

const cardTypeIcon = document.querySelector('.card-type-icon');
  const cardTypeName = document.querySelector('.card-type-name');

  cardNumberInput.addEventListener('input', function() {
    const cardNumber = this.value;
    const firstDigit = cardNumber.charAt(0);
  
    if (firstDigit === '4') {
      // This is a Visa card
      cardTypeIcon.className = 'card-type-icon fa fa-visa';
      cardTypeName.textContent = 'Visa';
    } else if (firstDigit === '5') {
      // This is a Mastercard
      cardTypeIcon.className = 'card-type-icon fa fa-mastercard';
      cardTypeName.textContent = 'Mastercard';
    } else {
      // This is not a Visa or Mastercard
      cardTypeIcon.className = 'card-type-icon';
      cardTypeName.textContent = 'unknown card type';
    }
  });
  // Open the booking form with the tour name as a parameter

 function openBookingForm(params) {
  // Split the parameter string into tour name and price
  var tourParams = params.split('|');
  var tourname = tourParams[0];
 var price = tourParams[1].replace('$', '');
  // Set the value of the tour name and price input fields
  document.getElementById("tourname").value = tourname;
  document.getElementById("price").value = '$'+price;
  // Display the booking form
  document.getElementById("booking-form-container").style.display = "block";
}
// Close the booking form
function closeBookingForm() {
  // Hide the booking form
  document.getElementById("booking-form-container").style.display = "none";
}
// Add event listener to open the modal when the user clicks "Book Now" button
bookNowButtons.forEach(button => {
  button.addEventListener('click', () => {
    modal.style.display = 'flex';
    paymentForm.style.display = 'block';
  });
});



// Add event listener to close the modal when the user clicks the "X" button
closeBtn.addEventListener('click', () => {
  modal.style.display = 'none';
});

// Add event listener to submit the payment form when the user clicks "Book Now" button

</script>
    <footer>TRS @2024, Adama,Ethiopia</footer>
  </body>
</html>


