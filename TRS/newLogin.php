<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $pass = filter_input(INPUT_POST, "pass");
    $dbinfo = "mysql:host=localhost;dbname=list";
    $dbuser = "root";
    $dbpass = ""; // assuming no password for root, change it if necessary

    if (!empty($email) && !empty($pass)) {
        try {
            $con = new PDO($dbinfo, $dbuser, $dbpass);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            $_SESSION['error'] = "Database connection error: " . $ex->getMessage();
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }

        $sql = "SELECT email, pass FROM user WHERE email = :email";
        $res = $con->prepare($sql);
        $res->bindParam(':email', $email);
        $res->execute();

        $result = $res->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            if ($pass === $result['pass']) {
                $_SESSION['email'] = $email;
                header('Location: homepage.php');
                exit;
            } else {
                $_SESSION['error'] = "Invalid Login Credentials. Email or password don't match.";
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit;
            }
        } else {
            $_SESSION['error'] = "User Not Found! Please sign up first.";
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
    } else {
        $_SESSION['error'] = "Please enter both email and password.";
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

if (isset($_SESSION['email'])) {
    header('Location: homepage.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
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
      color: blue;
      font-size: 20px;
      text-decoration: none;
      font-weight: bold;
      padding: 10px;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    nav ul li a:hover {
      background-color: blue;
      color: white;
    }
    /* Newer styles */
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
      background-color: rgba(255,255,255,0.2);
    }

    form h2 {
      font-size: 36px;
      margin-bottom: 20px;
      text-align: center;
    }

    .form-container .error {
      position: absolute;
      bottom: -30px;
      left: 50%;
      transform: translateX(-50%);
      background-color: #ff4444; /* darker red background */
      color: white; /* white text */
      padding: 5px 10px;
      border: 1px solid darkred;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.3s, visibility 0.3s, bottom 0.3s;
      z-index: 2;
    }

    .form-container .error.show {
      opacity: 1;
      visibility: visible;
      bottom: 10px;
    }

    form label {
      display: block;
      margin-bottom: 10px;
      font-size: 20px;
      color:black;
    }

    form input {
      padding: 10px;
      margin-bottom: 20px;
      width: 100%;
      box-sizing: border-box;
      border: none;
      background-color: rgba(255,255,255,0.5);
      border-radius: 4px;
      font-size: 16px;
      color: black;
    }

    form input:focus {
      border: none;
    }

    form button {
      background-color: blue;
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
      background-color: transparent;
      color: crimson;
    }

    p {
      color: white;
    }

    a {
      text-decoration: none;
      color: white;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">
      <a href="welcome.html">TRS</a>
    </div>
    <nav>
      <ul>
        <li><a href="welcome.html">Home</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <div class="form-container">
      <form class="slide-in" id="form" method="post">
        <h2>Login</h2>
        <div class="input-container">
            <label for="email">Email</label>
          <input type="email" id="email" name="email" required>
          
        </div>
        <div class="input-container">
            <label for="password">Password:</label>
          <input type="password" id="password" name="pass" required>
          
        </div>
        <button type="submit">Login</button>
        <?php if (isset($_SESSION['error'])) { ?>
          <div class="error show"><?php echo $_SESSION['error']; ?></div>
          <?php unset($_SESSION['error']); ?>
        <?php } ?>
        <p>Don't have an account? <a href="signup.php">SignUp</a></p>
      </form>
    </div>
  </main>
</body>
</html>
