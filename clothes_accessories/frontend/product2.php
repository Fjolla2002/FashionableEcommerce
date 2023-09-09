<?php
// Get the requested URL
$requestUrl = $_SERVER['REQUEST_URI'];

// Define the base URL for products
$baseUrl = '/products/';

// Check if the requested URL matches the product URL structure
if (strpos($requestUrl, $baseUrl) === 0) {
  // Extract the product slug (ID) from the URL
  $productSlug = substr($requestUrl, strlen($baseUrl));

  // Now you have the product ID (slug), you can use it to retrieve the product information from the database
  // Query the database or perform any necessary operations to fetch the product details

  // Example: Retrieve product information based on the ID (slug) from the database
  $product = getProductById($productSlug);

  // Check if the product exists
  if ($product) {
    // Render the product detail page
    renderProductPage($product);
  } else {
    // Product not found, handle the error (e.g., show a 404 page)
    renderErrorPage('Product not found');
  }
} else {
  // Handle other routes or show a default page
  renderDefaultPage();
}

// Function to retrieve product information from the database based on ID (slug)

// Function to render the product detail page
function getProductById($id) {
    // Connect to the database (assuming you have a database connection already set up)
    $connection = mysqli_connect('localhost', 'root', '', 'clothes_accessories');
  
    // Escape the ID (slug) to prevent SQL injection
    $escapedId = mysqli_real_escape_string($connection, $id);
  
    // Query the database to fetch the product information
    $query = "SELECT title, description, price, old_price FROM product WHERE id = '$escapedId'";
    $result = mysqli_query($connection, $query);
  
    // Check if the query was successful and the product exists
    if ($result && mysqli_num_rows($result) > 0) {
      // Fetch the product information as an associative array
      $product = mysqli_fetch_assoc($result);
  
      // Close the database connection
      mysqli_close($connection);
  
      // Return the product information
      return $product;
    }
  
    // Close the database connection
    mysqli_close($connection);
  
    // If the product is not found, return null or handle the error as needed
    return null;
  }

// Function to render an error page
function renderErrorPage($errorMessage) {
  // Generate the HTML for the error page with the provided error message
  // Echo or print the generated HTML
  echo "error";
}

// Function to render a default page
function renderDefaultPage() {
  // Generate the HTML for the default page (e.g., homepage, product listing)
  // Echo or print the generated HTML
  echo "nun";
}
?>
