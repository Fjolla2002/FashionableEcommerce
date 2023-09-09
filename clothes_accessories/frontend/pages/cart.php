<?php
session_start();

require_once 'database.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cart</title>
    <link rel="icon" href="../dist/images/iconlogo.svg">
    <script src="https://kit.fontawesome.com/506def2643.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./../dist/scss/app.css" />
    <style>
      .checkout-button {
  display: inliblockne-;
  padding: 10px 20px;
  background-color: #2b55dd;
  color: #fff;
  border: none;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
}

.checkout-button:hover {
  background-color: #152f47;
}

.checkout-button:active {
  background-color: #3e8e41;
  
}

.form {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 20px;
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
                  <li><a href="contact.php">Contact Us</a></li>
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
                    <a href="cart.php" class="active"
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
    <section class="products-section products-accessories full-block" id="on-sale">
        <div class="container">
        <div class="form" id="proceed-to-checkout">
      <form id="checkout-form" action="checkout.php" method="post">
        <input type="hidden" id="product-ids" name="product_ids" value="">
      <button type="submit" id="checkout-button" class="checkout-button">Go to checkout</button>
      </form>
    </div>
          </div>



<script>
  // Add event listener to the "Go to checkout" button
  document.getElementById('checkout-button').addEventListener('click', function(event) {
    // Prevent the default form submission
    event.preventDefault();

    // Retrieve product IDs from localStorage
    var productIds = localStorage.getItem('productIds');

    // Set the value of the hidden input field
    document.getElementById('product-ids').value = productIds;

    // Submit the form
    document.getElementById('checkout-form').submit();
  });
</script>

      </section>
      <section class="products-section products-accessories full-block" id="on-sale">
        <div class="container">
          <div class="grid-container" id="cart_grid">
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
    <script src="jsfunctions/cart.js"></script>      
  </body>
</html>
