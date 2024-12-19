<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$current_page = 'delivery-status';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodieBayan - Delivery Status</title>
    <link rel="stylesheet" href="css/delivery-status.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <?php include 'includes/sidebar.php'; ?>

        <div class="main-content">
            <?php include 'includes/header.php'; ?>

            <div class="delivery-container">
                <div class="delivery-header">
                    <h2><i class="fas fa-truck"></i> Delivering</h2>
                </div>

                <div class="delivery-tracker">
                    <div class="tracker-steps">
                        <div class="step active" id="preparing">
                            <div class="step-icon">
                                <i class="fas fa-utensils"></i>
                            </div>
                            <div class="step-line"></div>
                            <div class="step-label">Preparing your food...</div>
                        </div>

                        <div class="step" id="on-the-way">
                            <div class="step-icon">
                                <i class="fas fa-motorcycle"></i>
                            </div>
                            <div class="step-line"></div>
                            <div class="step-label">On the way</div>
                        </div>

                        <div class="step" id="delivered">
                            <div class="step-icon">
                                <i class="fas fa-home"></i>
                            </div>
                            <div class="step-label">Delivered</div>
                        </div>
                    </div>
                </div>

                <div class="delivery-details">
                    <div class="order-info">
                        <h3>Order Details</h3>
                        <div id="orderItems">
                            <!-- Order items will be populated here -->
                        </div>
                    </div>
                </div>

                <button class="order-more-btn" onclick="location.href='dashboard.php'">
                    Order more
                </button>
            </div>
        </div>
    </div>

    <script src="js/delivery-status.js"></script>
</body>
</html>