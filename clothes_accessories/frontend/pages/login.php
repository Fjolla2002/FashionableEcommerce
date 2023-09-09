<?php
session_start();
// Include the database connection file
require_once 'database.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $emailOrUsername = $_POST['login_username_email'];
    $password = $_POST['login_password'];

    // Prepare the SQL statement to check for matching email or username
    $stmt = $mysqli->prepare("SELECT * FROM `user` WHERE `email` = ? OR `username` = ?");
    if (!$stmt) {
        die("Prepare failed: " . $mysqli->error);
    }

    // Bind the parameters to the statement
    $stmt->bind_param("ss", $emailOrUsername, $emailOrUsername);

    // Execute the statement
    if ($stmt->execute()) {
        // Fetch the result
        $result = $stmt->get_result();

        // Check if a matching user is found
        if ($result->num_rows === 1) {
            // Retrieve the user data
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Password matches, user is authenticated
                header("Location: ../index.php");
                $_SESSION['loggedin'] = true;
                // Perform any additional actions or redirection here
            } else {
                echo "Incorrect password!";
            }
        } else {
            echo "Invalid email/username!";
        }
    } else {
        echo "Error executing query: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  // User is already logged in, redirect to another page
  header('Location: ../index.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log in</title>
    <link rel="icon" href="../dist/images/iconlogo.svg">
    <script src="https://kit.fontawesome.com/506def2643.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./../dist/scss/app.css" />
  </head>

  <body>
    <header class="full-block">
      <div class="header-navigation-container" id="scroll-container">
        <div class="container">
          <div class="navigation">
            <div class="navigation-left-side">
              <a href="../index.php"><img src="../logos/logo.svg" width="200px" alt=""></a>
            </div>
            <div class="navigation-right-side">
              <nav>
                <ul>
                  <li><a href="../index.php">Home</a></li>
                  <li><a href="clothes.php">Clothes</a></li>
                  <li><a href="accessories.php">Accessories</a></li>
                  <li><a href="contact.php">Contact Us</a></li>
                  <li><a href="login.php" class="active">Log In</a></li>
                  <li><a href="signup.php">Sign Up</a></li>
                  <li>
                    <a href="cart.php"
                      ><img src="../dist/images/shopping-cart.svg" width="30px" alt=""
                    /></a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </header>
    <main class="full-block">
      <section class="login full-block">
        <div class="container login-content">
          <h2 class="login-title">Log in</h2>
          <form class="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div>
              <label for="login_username_email">Username or email</label>
              <input id="login_username_email" type="text" placeholder="Username or Email" name="login_username_email" required />
            </div>
            <div>
              <label for="login_password">Password</label>
              <input id="login_password" type="password" placeholder="password" name="login_password" required/>
            </div>
            <div><p>You don't have an acccount? <a href="signup.html">Sign Up here</a></p></div>
            <button class="btn btn--form" type="submit" value="Log in">Log in</button>
          </form>
      </div>
      </section>
    </main>
    <footer class="footer-section full-block">
      <div class="container">
        <div class="footer-section-left-side">
          <ul>
            <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
          </ul>
          <p>name@gmail.com</p>
          <p>044 132 132</p>
        </div>
        <div class="footer-section-center">
          <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="clothes.php">Clothes</a></li>
            <li><a href="accessories.php">Accessories</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="login.php">Log In</a></li>
            <li><a href="signup.php">Sign Up</a></li>
          </ul>
        </div>
        <div class="footer-section-right-side">
            <a href="../index.php"><img src="../logos/logo2.svg" width="200px" alt=""></a>
        </div>
      </div>
    </footer>

    <script src="./../dist/js/app.js"></script>
  </body>
</html>
