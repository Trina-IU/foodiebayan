<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$current_page = 'order-success';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodieBayan - Order Confirmed</title>
    <link rel="stylesheet" href="css/success.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <?php include 'includes/sidebar.php'; ?>

        <div class="main-content">
            <?php include 'includes/header.php'; ?>

            <div class="success-container">
                <div class="success-content">
                    <div class="success-icon">
                        <img src="assets/images/success-emoji.png" alt="Success">
                    </div>
                    <h1>ORDER CONFIRMED SUCCESSFULLY!</h1>
                    <p class="thank-you">Thank you for ordering!</p>
                    <p class="order-message">
                        Your order is now being processed<br>
                        and will be delivered out afterwards.
                    </p>
                    <button onclick="location.href='delivery-status.php'" class="check-order-btn">
                        Check your order
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>