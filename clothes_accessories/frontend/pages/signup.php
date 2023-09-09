<?php
// Include the database connection file
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  // User is already logged in, redirect to another page
  header('Location: ../index.php');
  exit;
}
require_once 'database.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
      // Validation rules
      $nameRegex = '/^[a-zA-Z\s]+$/';
      $usernameRegex = '/^[a-zA-Z][a-zA-Z0-9]*$/';
      $emailMaxLength = 70;
      $phoneMaxLength = 70;
      $addressMaxLength = 128;
      
      $number = preg_match('@[0-9]@', $password);
      $uppercase = preg_match('@[A-Z]@', $password);
      $lowercase = preg_match('@[a-z]@', $password);
      $specialChars = preg_match('@[^\w]@', $password);
  
      // Perform individual validations
      $errors = [];
      if (!isset($_POST['terms'])) {
        $errors[] = 'You have to agree with terms and conditions';
        
    }
      if (!preg_match($nameRegex, $name)) {
          $errors[] = 'Invalid name. Please enter a name without special characters.';
      }
  
      if (!preg_match($usernameRegex, $username)) {
          $errors[] = 'Invalid username. It must start with a letter and can contain only letters and numbers.';
      }
  
      if (strlen($email) > $emailMaxLength) {
          $errors[] = 'Email cannot exceed ' . $emailMaxLength . ' characters.';
      }
  
      if (strlen($phone) > $phoneMaxLength) {
          $errors[] = 'Phone number cannot exceed ' . $phoneMaxLength . ' characters.';
      }
      
      if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
        $errors[] = 'Invalid password. It should contain at least 8 characters, including one uppercase letter, one lowercase letter, one number, and one special character.';
      }
  
      if ($password != $password2) {
          $errors[] = 'Passwords do not match.';
      }
  
      if (strlen($address) > $addressMaxLength) {
          $errors[] = 'Address cannot exceed ' . $addressMaxLength . ' characters.';
      }
  // Check if there are any errors
if (empty($errors)) {
  // Validation passed, proceed with further actions (e.g., database operations, redirect)
  // Prepare the SQL statement to check for duplicate email, username, and phone number
  $checkStmt = $mysqli->prepare("SELECT * FROM `user` WHERE `email` = ? OR `username` = ? OR `phonenumber` = ?");
  if (!$checkStmt) {
      die("Prepare failed: " . $mysqli->error);
  }

  // Bind the parameters to the statement
  $checkStmt->bind_param("sss", $email, $username, $phone);

  // Execute the statement
  $checkStmt->execute();

  // Store the result
  $checkResult = $checkStmt->get_result();

  // Check if there are any rows with the same email, username, or phone number
  if ($checkResult->num_rows > 0) {
      while ($row = $checkResult->fetch_assoc()) {
          if ($row['email'] === $email) {
              $errors[] = 'Email already exists.';
          }
          if ($row['username'] === $username) {
              $errors[] = 'Username already exists.';
          }
          if ($row['phonenumber'] === $phone) {
              $errors[] = 'Phone number already exists.';
          }
      }
  }

  // Close the statement and result
  $checkStmt->close();
  $checkResult->close();
}
      // Check if there are any errors
      if (empty($errors)) {
          // Validation passed, proceed with further actions (e.g., database operations, redirect)
          // Prepare the SQL statement
    $stmt = $mysqli->prepare("INSERT INTO `user` (`name`, `username`, `email`, `password`, `address`, `phonenumber`) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $mysqli->error);
    }

    // Bind the parameters to the statement
    $stmt->bind_param("ssssss", $name, $username, $email, $passwordHash, $address, $phone);

    // Execute the statement
    if ($stmt->execute()) {
      header("Location: login.php");
      exit();
    } else {
        echo "Error adding user: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
  
          // For now, let's display a success message
      } else {
        $errorString = implode("\\n", $errors);
        echo "<script>alert('" . $errorString . "');</script>";
      }
  }

} 

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
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
                  <li><a href="login.php">Log In</a></li>
                  <li><a href="signup.php" class="active">Sign Up</a></li>
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
      <section class="signup full-block">
        <div class="container signup-content">
          <h2 class="signup-title">Sign up</h2>
          <form id="signupForm" class="signup-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div>
              <div>
                <label for="name">Name</label>
                <input id="name" type="text" placeholder="Name" name="name" required />
              </div>
              <div>
                <label for="username">Username </label>
                <input id="username" type="text" placeholder="Username" name="username" required />
              </div>
            </div>
            <div>
              <div>
                <label for="email">Email </label>
                <input id="email" type="email" placeholder="Email" name="email" required />
              </div>
              <div>
                <label for="phone">Phone number</label>
                <input id="phone" type="number" placeholder="Phone number" name="phone" required />
              </div>
            </div>      
            <div>
              <div>
                <label for="password">Password</label>
                <input id="password" type="password" placeholder="password" name="password" required/>
              </div>
              <div>
                <label for="password2">Repeat Password</label>
                <input id="password2" type="password" placeholder="password" name="password2" required/>
              </div>
            </div>
            <div>
              <div>
                <label for="address">Address</label>
                <input id="address" type="text" placeholder="Address" name="address" required />
              </div>
              <div class="signup_terms">
                <input id="terms" type="checkbox" name="terms" required />
                <label for="terms">Please indicate your consent for our company <br> to utilize this data for internal application purposes.</label>
              </div>
            </div>
            <div><p>You already have an acccount? <a href="login.html">Log In here</a></p></div>
            <button class="btn btn--form" type="submit" value="Signup">Sign up</button>
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
    <script src="./../otherfiles/validation.js"></script>
  </body>
</html>
