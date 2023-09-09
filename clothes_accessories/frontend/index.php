<?php
session_start();
// Database credentials
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "clothes_accessories";

// Create a connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function renderResults2($result, $sectionName)
{
    if ($result) {
        // Fetch the products as an associative array
        $products = $result->fetch_all(MYSQLI_ASSOC);

        // Include the additems.js script
        echo "<script src='pages/jsfunctions/additems.js'></script>";

        // Process the products
        foreach ($products as $product) {
            // Access the product attributes
            $productId = $product['idproduct'];
            $productName = $product['name'];
            $productPrice = $product['price'];
            $productImage = $product['imagepath'];
            $productCategory = $product['category'];
            $productDesc = $product['description'];

            // Do something with the product data
            echo "<script>";
            echo "additem('$productId', '$sectionName', '$productName', '$productDesc', '$productCategory', '$productPrice', '$productImage');";
            echo "</script>";
        }
    } else {
        // Handle the case when the query fails
        echo "Error retrieving products: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Clothes & Accessories</title>
    <link rel="icon" href="dist/images/iconlogo.svg">
    <script src="https://kit.fontawesome.com/506def2643.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./dist/scss/app.css" />
  </head>

  <body>
    <header class="full-block">
      <div class="header-navigation-container" id="scroll-container">
        <div class="container">
          <div class="navigation">
            <div class="navigation-left-side">
              <a href="index.php"><img src="logos/logo.svg" width="200px" alt=""></a>
            </div>
            <div class="navigation-right-side">
              <nav>
                <ul>
                  <li><a href="index.php" class="active">Home</a></li>
                  <li><a href="pages/clothes.php">Clothes</a></li>
                  <li><a href="pages/accessories.php">Accessories</a></li>
                  <li><a href="pages/contact.php">Contact Us</a></li>
                  <?php
                                           if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                                            // User is logged in
                                            echo "<li><a href='pages/logout.php'>Log out</a></li>";
                                        } else {
                                            // User is not logged in
                                            echo "<li><a href='pages/login.php'>Log In</a></li>";
                                            echo "<li><a href='pages/signup.php'>Sign Up</a></li>";
                                        }
                  ?>
                  <li>
                    <a href="pages/cart.php"
                      ><img src="dist/images/shopping-cart.svg" width="30px" alt=""
                    /></a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div class="hero-banner-container full-block">
        <div class="hero-banner full-block">
          <div class="container">
            <div class="hero-banner-left-side">
              <div class="hero-banner-left-side_content">
                <h1>Mid Season Sale</h1>
                <p>For Woman Who Like To Follow Trends But Have A <br> Strong Sense Of Individual Style</p>
                <div class="hero-banner-left-side_content-btns">
                  <a href="#discover-store">Discover store</a>
                  <a href="#on-sale">Special Offers</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <main class="full-block">
      <section class="category full-block" id="discover-store">
        <div class="container">
          <div class="category-content">
            <div class="category-content-left-side">
              <div class="category-content-left-side-fashion">
                <div class="category-description">
                  <div class="category-description_content">
                    <h2>Clothes</h2>
                    <span>Best trending 2023</span><br>
                    <a href="pages/clothes.php">Discover Store</a>
                  </div>
                </div>
              </div>
              <div class="category-content-left-side-best-sale big-category">
                <div class="category-description">
                  <div class="category-description_content">
                    <h2>Popular items</h2>
                    <span>Best trending 2023</span><br>
                    <a href="#popular_items">Discover Store</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="category-content-right-side">
              <div class="category-content-right-side-accessories big-category">
                <div class="category-description">
                  <div class="category-description_content">
                    <h2>Recent releases</h2>
                    <span>Best trending 2023</span><br>
                    <a href="#recent_releases">Discover</a>
                  </div>
                </div>
              </div>
              <div class="category-content-right-side-others">
                <div class="category-description">
                  <div class="category-description_content">
                    <h2>Accessories</h2>
                    <span>Best trending 2023</span><br>
                    <a href="pages/accessories.php">Discover Store</a>
                  </div>
                </div>
              </div>      
            </div>
          </div>
        </div>
      </section>
      <section class="products-section products-accessories full-block" id="on-sale">
        <div class="container">
          <div class="products-section_title">
            <h3>Special offers</h3>
            <p>Exclusive Deals and Discounts</p>
          </div>
          <div class="grid-container" id="sales_grid">
          <?php
                 $queryForSales = "SELECT *, ((old_price - price) / old_price) * 100 AS discount_percentage FROM product
                 WHERE
                 old_price IS NOT NULL
                 AND old_price > 0
                 ORDER BY
                 discount_percentage DESC LIMIT 8;";
                 

                  $result3 = $conn->query($queryForSales);
                  if ($result3) {
                    // Render the results for each query
                    renderResults2($result3, "sales_grid");
                } else {
                    // Handle the case when the queries fail
                    echo "Error retrieving products: " . $conn->error;
                }             
              ?>
          </div>
        </div>
      </section>
      <section class="products-section products-accessories full-block" id="popular_items">
        <div class="container">
          <div class="products-section_title">
            <h3>Popular items</h3>
            <p>Trending products flying off the shelves</p>
          </div>
          <div class="grid-container" id="popular_items_grid">
              <?php
                  $queryTimesSold = "SELECT * FROM product ORDER BY times_sold DESC LIMIT 8;";
                  $result1 = $conn->query($queryTimesSold);
                  if ($result1) {
                    // Render the results for each query
                    renderResults2($result1, "popular_items_grid");
                } else {
                    // Handle the case when the queries fail
                    echo "Error retrieving products: " . $conn->error;
                }             
              ?>
          </div>
        </div>
      </section>
      <section class="products-section products-featured full-block" id="recent_releases">
        <div class="container">
          <div class="products-section_title">
            <h3>Recent releases</h3>
            <p>The most recent additions to our collection</p>
          </div>
          <div class="grid-container" id="recent_releases_grid">
          <?php
                 $queryRecentProd = "SELECT * FROM product ORDER BY date_added DESC LIMIT 8;";

                  $result2 = $conn->query($queryTimesSold);
                  if ($result2) {
                    // Render the results for each query
                    renderResults2($result2, "recent_releases_grid");
                } else {
                    // Handle the case when the queries fail
                    echo "Error retrieving products: " . $conn->error;
                }             
                $conn->close();
              ?>
           </div>
      </section>
      
  <section class="subscribe-section full-block">
  <div class="container">
    <div class="subscribe-section-flex-container">
      <div class="subscribe-section-flex-container_left-side">
        <h4>Autumn / Winter Sale</h4>
        <p>Subscribe and Take 40% Off On Women’s</p>
      </div>
      <div class="subscribe-section-flex-container_right-side">
        <form action="#">
          <input type="email" name="" id="email-input" placeholder="Enter your email address">
          <input type="button" id="subscribe-btn" value="Subscribe!">
        </form>
      </div>
    </div>
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
            <li><a href="index.php">Home</a></li>
            <li><a href="pages/clothes.php">Clothes</a></li>
            <li><a href="pages/accessories.php">Accessories</a></li>
            <li><a href="pages/contact.php">Contact Us</a></li>
            <li><a href="pages/login.php">Log In</a></li>
            <li><a href="pages/signup.php">Sign Up</a></li>
          </ul>
        </div>
        <div class="footer-section-right-side">
          <a href="../index.php"><img src="logos/logo2.svg" width="200px" alt=""></a>
        </div>
      </div>
    </footer>
    <script src="./dist/js/app.js"></script>
    <script src="pages/jsfunctions/addToCart.js" type="module"></script>
  </body>
</html>
