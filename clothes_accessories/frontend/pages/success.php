<?php
session_start();

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

// Retrieve the form inputs from the session
$name = $_SESSION['name'];
$last_name = $_SESSION['last_name'];
$address = $_SESSION['address'];
$phone_number = $_SESSION['phone_number'];

// Insert the order data into the database
$stmt = $conn->prepare("INSERT INTO `orders` (name, last_name, address, phone_number) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    die("Prepare failed: " . $conn->error . ", SQL: " . "INSERT INTO `orders` (name, last_name, address, phone_number) VALUES (?, ?, ?, ?)");
}

// Bind the parameters to the statement
$stmt->bind_param("ssss", $name, $last_name, $address, $phone_number);

// Execute the statement
if ($stmt->execute()) {
    // Order placed successfully
    $order_id = $stmt->insert_id;
    $_SESSION['order_id'] = $order_id;
    echo "Order placed successfully. Order ID: " . $order_id;
} else {
    echo "Error inserting order: " . $stmt->error;
}

// Close the statement
$stmt->close();

// Clear the session variables
unset($_SESSION['name']);
unset($_SESSION['last_name']);
unset($_SESSION['address']);
unset($_SESSION['phone_number']);

// You can redirect the user to a confirmation page or perform further actions here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            color: #333;
        }
        
        h1 {
            font-size: 36px;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            margin-bottom: 10px;
        }
        
        p {
            font-size: 20px;
            margin-bottom: 10px;
        }
        
        ul {
            list-style-type: none;
            padding: 0;
            margin-bottom: 10px;
        }
        
        li {
            margin-bottom: 5px;
        }
        
        .container {
            text-align: center;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payment Successful!</h1>
        <p>Thank you for your purchase. Your payment has been successfully processed.</p>
        <p>Order Details:</p>
        <ul>
            <li>Order ID: <?php echo $_GET['orders_id']; ?></li>
            <!-- Add any other relevant order details here -->
        </ul>
        <p>For any inquiries or issues regarding your order, please contact our customer support.</p>
    </div>
</body>
</html>
