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

$totalAmount = 0;
$productRows = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the product IDs from localStorage
    if (isset($_POST['product_ids'])) {
        $productIds = json_decode($_POST['product_ids'], true);

        // Prepare the SQL statement to retrieve the prices and names based on the product IDs
        $stmt = $conn->prepare("SELECT idproduct, name, price FROM product WHERE idproduct = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error . ", SQL: " . "SELECT idproduct, name, price FROM product WHERE idproduct = ?");
        }

        // Execute the statement for each product ID
        foreach ($productIds as $productId) {
            // Bind the parameter to the statement
            $stmt->bind_param("i", $productId);

            // Execute the statement
            if ($stmt->execute()) {
                // Bind the result to variables
                $stmt->bind_result($id, $name, $price);

                // Fetch the result
                $stmt->fetch();

                // Process the retrieved data
                $productRows .= "<tr><td>$name</td><td>$$price</td></tr>";

                // Calculate the total amount
                $totalAmount += $price;
            } else {
                echo "Error executing query: " . $stmt->error;
            }
        }
    } else {
        echo "No product IDs found.";
    }

    // Close the statement
    $stmt->close();
}
// PayPal Button
if ($totalAmount > 0) {
    echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Pay with PayPal</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 20px;
                }

                .container {
                    max-width: 400px;
                    margin: 0 auto;
                    background-color: #fff;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    padding: 20px;
                    text-align: center;
                }

                h1 {
                    font-size: 24px;
                    margin-bottom: 20px;
                }

                #paypal-button-container {
                    margin-top: 30px;
                }

                .note {
                    font-size: 14px;
                    margin-top: 20px;
                    color: #888;
                }

                .note a {
                    color: #0366d6;
                    text-decoration: none;
                }

                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }

                th, td {
                    padding: 10px;
                    text-align: left;
                }

                th {
                    background-color: #f2f2f2;
                }
            </style>
            <!-- Include the PayPal JavaScript SDK -->
            <script src="https://www.paypal.com/sdk/js?client-id=AT6GZrfq-IgOwXV9t8UATxBG9m9vESe6qfTOSV9-nXgshLYlMfByFWE8-QwtmxMtRTZJznISp-TL6jFv"></script>
        </head>
        <body>
            <div class="container">
                <h1>Pay with PayPal</h1>
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required><br><br>
                
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" id="last_name" required><br><br>
                
                <label for="address">Address:</label>
                <input type="text" name="address" id="address" required><br><br>
                
                <label for="phone_number">Phone Number:</label>
                <input type="text" name="phone_number" id="phone_number" required><br><br>
                    <table>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                        </tr>
                        ' . $productRows . '
                    </table>
                    <p>Total Amount: $' . $totalAmount . '</p>
                    <div id="paypal-button-container"></div>
                <p class="note">Note: By clicking the "Pay with PayPal" button, you agree to the <a href="https://developer.paypal.com/docs/checkout/">terms and conditions</a>.</p>
            </div>

            <script>
                // Render the PayPal button only if the form is submitted successfully
                paypal.Buttons({
                    createOrder: function(data, actions) {
                        // Set up the transaction details
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value: "' . $totalAmount . '"
                                }
                            }]
                        });
                    },
                    onApprove: function(data, actions) {
                        // Capture the funds from the transaction
                        return actions.order.capture().then(function(details) {
                            // Redirect to a success page or perform further actions
                            window.location.href = "success.php";
                        });
                    },
                    onCancel: function(data) {
                        // Handle cancellation
                        window.location.href = "cancel.php";
                    },
                    onError: function(err) {
                        // Handle errors
                        console.error(err);
                    }
                }).render("#paypal-button-container");
            </script>
        </body>
        </html>
    ';
}
?>