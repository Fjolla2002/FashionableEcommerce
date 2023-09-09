<?php
session_start();

// Include the database connection file
require_once 'database.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Validate the form inputs (you can add more validation if needed)
    if (empty($name) || empty($email) || empty($message)) {
        $errorMessage = 'Please fill in all the required fields.';
    } else {
        // Prepare and execute the SQL query to insert the form data into the database
        $query = "INSERT INTO contact (name, email, message) VALUES (?, ?, ?)";
        $statement = $mysqli->prepare($query);
        $statement->bind_param('sss', $name, $email, $message);
        
        if ($statement->execute()) {
            $successMessage = 'Thank you for contacting us. We will get back to you soon.';
        } else {
            $errorMessage = 'Error occurred while storing the data. Please try again later.';
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
    <title>Contact Us</title>
    <link rel="icon" href="../dist/images/iconlogo.svg">
    <script src="https://kit.fontawesome.com/506def2643.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./../dist/scss/app.css" />
    <style>
    .contact-section {
      padding: 50px 0;
      text-align: center;
    }

    .contact-section h1 {
      margin-bottom: 30px;
      font-size: 36px;
      color: #333;
    }

    .contact-form {
      max-width: 500px;
      margin: 0 auto;
    }

    .contact-form .form-group {
      margin-bottom: 20px;
    }

    .contact-form label {
      display: block;
      margin-bottom: 5px;
      font-size: 16px;
      color: #333;
      font-weight: bold;
    }

    .contact-form input[type="text"],
    .contact-form input[type="email"],
    .contact-form textarea {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .contact-form textarea {
      height: 150px;
      resize: vertical;
    }

    .contact-form button[type="submit"] {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #333;
      color: #fff;
      font-size: 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .success-message,
    .error-message {
      margin-top: 20px;
      padding: 10px;
      text-align: center;
      font-size: 16px;
      font-weight: bold;
    }

    .success-message {
      color: #0f0;
    }

    .error-message {
      color: #f00;
    }
  </style>
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
                  <li><a href="contact.php" class="active">Contact Us</a></li>
                  <?php
                                           if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                                            // User is logged in
                                            echo "<li><a href='logout.php'>Log out</a></li>";
                                        } else {
                                            // User is not logged in
                                            echo "<li><a href='login.php'>Log In</a></li>";
                                            echo "<li><a href='signup.php'>Sign Up</a></li>";
                                        }
                  ?>
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
    <section class="contact-section">
      <div class="container">
        <h1>Contact Us</h1>
        <?php if (isset($successMessage)) : ?>
          <div class="success-message"><?php echo $successMessage; ?></div>
        <?php elseif (isset($errorMessage)) : ?>
          <div class="error-message"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <form class="contact-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
          </div>

          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
          </div>

          <div class="form-group">
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>
          </div>

          <button type="submit">Submit</button>
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
