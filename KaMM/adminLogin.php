<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, "email");
    $pass = filter_input(INPUT_POST, "pass");
    $dbinfo = "mysql:host=localhost;dbname=list";
    $dbuser = "root";

    if (!empty($email) && !empty($pass)) {
        try {
            $con = new PDO($dbinfo, $dbuser, "");
        } catch (PDOException $ex) {
            echo("error ");
        }

        $sql = "SELECT email, pass FROM admin WHERE email=:email";
        $res = $con->prepare($sql);
        $res->bindParam(':email', $email);
        $res->execute();

        $result = $res->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            if ($pass === $result['pass']) {
                $_SESSION['isAdmin'] = true;
                $_SESSION['em']=$email;
                header('Location: AdminHome.php');
                exit;
            } else {
                $error = "<span class='error'>Invalid Login Credentials. Email or password don't match.</span>";
            }
        } else {
            $error = "<span class='error'>User Not Found! Signup first Please</span>";
        }
    }
    // If there was an error or the login was unsuccessful,
    // store the error message in a session variable and redirect
    // the user back to the login page via GET.
    if (isset($error)) {
        $_SESSION['error'] = $error;
        header('Location: adminLogin.php');
        exit;
    }
}

// If the user has already logged in, redirect to the homepage.
if (isset($_SESSION['em'])&& isset($_SESSION['isAdmin'])) {
    header('Location: AdminHome.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <style>
    /* Reset styles */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    /* Global styles */
    body {
      font-family: Arial, sans-serif;
      color: #333;
      background-image: url(./image/gonder-5300.jpg);
      background-size: cover;
    }

    /* Header styles */
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: rgba(255,255,255,0.5);
      color: #fff;
      padding: 20px;
    }

    .logo a {
      font-size: 24px;
      text-decoration: none;
      color: #fff;
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
      color: #fff;
      text-decoration: none;
      font-weight: bold;
      padding: 10px;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    nav ul li a:hover {
      background-color: #fff;
      color: #1e90ff;
    }

    /*    newer*/
.form-container {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 50px;
  position: relative;
}

form {
  width: 40%;
  border: 1px solid rgba(255,255,255,0.5);
  padding: 30px;
  border-radius: 5px;
  position: relative;
  overflow: hidden;
  color: antiquewhite;
}

form h2 {
  font-size: 36px;
  margin-bottom: 20px;
  text-align: center;
}

.form-container .error {
  position: absolute;
  top: -60px;
  left: 50%;
  transform: translateX(-50%);
  background-color: #fff;
  padding: 5px 10px;
  border: 1px solid red;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.3s, visibility 0.3s, top 0.3s;
  z-index: 2;
}

.form-container .error:before {
  content: '';
  display: block;
  position: absolute;
  top: 100%;
  left: 50%;
  transform: translateX(-50%) rotate(45deg);
  width: 10px;
  height: 10px;
  background-color: red;
}

.form-container .error:after {
  content: '';
  display: block;
  position: absolute;
  top: 100%;
  left: 50%;
  transform: translateX(-50%) rotate(-45deg);
  width: 10px;
  height: 10px;
  background-color: red;
}

.form-container .error.show {
  opacity: 1;
  visibility: visible;
  top: -60px;
}

 
    form label {
      display: block;
      margin-bottom: 10px;
      font-size: 20px;
      color:crimson;
    }

    form input {
      padding: 10px;
      margin-bottom: 20px;
      width: 100%;
      box-sizing: border-box;
      border:none;
      background-color: rgba(255,255,255,0.5);
      border-radius: 4px;
      font-size: 16px;
      color:black;
    }
    form input:focus{
        border:none;

    }

    form button {
      background-color: crimson;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      font-size: 20px;
      cursor: pointer;
      transition: background-color 0.3s;
      position: relative;
      z-index: 1;
    }

    form button:hover {
      background-color:transparent;
      color: crimson;
    }

   

    /* Animation styles */
    @keyframes slide-in {
      0% {
        transform: translateX(-100%);
      }
      100% {
        transform: translateX(0);
      }
    }

    form.slide-in {
      animation: slide-in 0.5s;
    }

    @keyframes pulse {
      0% {
        transform: scale(1);
      }
      50% {
        transform: scale(1.1);
      }
      100% {
        transform: scale(1);
      }
    }

    header .logo a {
      animation: pulse 1s infinite;
    }
   /* Input container */
.input-container {
  position: relative;
  margin-bottom: 20px;
}

/* Input label */
.input-container label {
  position: absolute;
  top: 0;
  left: 10px;
  transform: translateY(50%);
  color: #333333;
  font-size: 16px;
  pointer-events: none;
  transition: all 0.3s ease;
}

/* Input field */
.input-container input {
  display: block;
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: none;
/*  background-color: rgba(255,255,255,0.2);*/
  font-size: 16px;
/*  color: white;*/
  box-shadow: 0 0 5px rgb(40, 126, 255);
  transition: box-shadow 0.3s ease;
}

/* Placeholder/label animation when input is focused */
.input-container input:not(:placeholder-shown) + label {
  top: -20px;
  font-size: 14px;
  background-color:rgba(255,255,255,0.5);
  color: rgb(54, 53, 53);
  padding: 0 5px;
}
    p{
        color: white;
    }
    a{
        text-decoration: none;
        color: white;
    }
    a :hover{
        text-decoration: underline;
    }

    
  </style>
</head>
<body>
  <header>
    <div class="logo">
      <a href="#">KaMM Admin Panel</a>
    </div>
    <nav>
      <ul>
        <li><a href="#">Home</a></li>
      </ul>
    </nav>
  </header>
<main>
  <div class="form-container">
    <form class="slide-in" method='post'>
      <h2>Admin Login</h2>
      <div class="input-container">
      <input type="email" id="email" name="email" required>
      <label for="email">Email</label>
      </div>
      <div class="input-container">
      
      <input type="password" id="password" name="pass" required>
      <label for="password">Password</label>
     </div>
      <button type="submit">Login</button>
     
    </form>
  </div>
</main>
</body>
</html>
