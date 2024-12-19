<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$current_page = 'checkout';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodieBayan - Checkout</title>
    <link rel="stylesheet" href="css/checkout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <?php include 'includes/sidebar.php'; ?>

        <div class="main-content">
            <?php include 'includes/header.php'; ?>

            <div class="checkout-content">
                <!-- Cart Items Section -->
                <div class="cart-items">
                    <h3>My Cart <span class="items-count"></span></h3>
                    <div class="cart-list">
                        <!-- Cart items will be dynamically populated here -->
                    </div>
                </div>

                <!-- Checkout Summary Section -->
                <div class="checkout-summary">
                    <h3>Cash on Delivery</h3>
                    <div class="summary-details">
                        <div class="summary-item">
                            <span>Subtotal</span>
                            <span class="amount">₱<span id="subtotal">0.00</span></span>
                        </div>
                        <div class="summary-item">
                            <span>Delivery Fee</span>
                            <span>FREE</span>
                        </div>
                        <div class="summary-item">
                            <span>Tax</span>
                            <span class="amount">₱<span id="tax">0.00</span></span>
                        </div>
                        <div class="summary-item total">
                            <span>Total</span>
                            <span class="amount">₱<span id="total">0.00</span></span>
                        </div>
                    </div>
                    <button class="checkout-btn" onclick="confirmOrder()">Confirm Order</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/checkout.js"></script>
</body>
</html>