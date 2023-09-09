<?php
$host = "localhost";
$dbname = "clothes_accessories";
$username = "root";
$password = "";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;
///a function that is used multipe times
function renderResults($result, $sectionName)
{
    if ($result) {
        // Fetch the products as an associative array
        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
            echo "<script src='jsfunctions/additems.js'></script>";
            echo "<script>";
            echo "additem('$productId', '$sectionName', '$productName', '$productDesc', '$productCategory', '$productPrice', '../$productImage');";
            echo "</script>";
        }
    } else {
        // Handle the case when the query fails
        echo "Error retrieving products: " . mysqli_error($mysqli);
    }
}