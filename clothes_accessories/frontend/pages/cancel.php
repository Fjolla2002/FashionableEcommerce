<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Canceled</title>
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
        
        .highlight {
            color: #ff0000;
            font-weight: bold;
        }
        
        .container {
            text-align: center;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
        }
        
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 18px;
            background-color: #ff0000;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        
        .button:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payment Canceled</h1>
        <p>Your payment was not completed and has been canceled.</p>
        <p>If you would like to complete your purchase, please try again.</p>
        <p>If you have any questions or need assistance, please contact our customer support.</p>
        <p class="highlight">Important: Please do not share your payment details with anyone.</p>
        <a href="cart.php" class="button">Retry Payment</a>
    </div>
</body>
</html>
