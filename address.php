<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$current_page = 'address';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodieBayan - My Address</title>
    <link rel="stylesheet" href="css/address.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <?php include 'includes/sidebar.php'; ?>

        <div class="main-content">
            <?php include 'includes/header.php'; ?>

            <div class="address-container">
                <div class="address-form-container">
                    <h2>My Address</h2>
                    <form id="addressForm" class="address-form">
                        <div class="form-group">
                            <label>Recipient's Name <span class="required">*</span></label>
                            <input type="text" id="recipientName" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Phone Number <span class="required">*</span></label>
                            <input type="tel" id="phoneNumber" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Region/City/District <span class="required">*</span></label>
                            <input type="text" id="region" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Street/Building Name <span class="required">*</span></label>
                            <input type="text" id="street" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Unit/Floor <span class="required">*</span></label>
                            <input type="text" id="unit" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Address Category <span class="required">*</span></label>
                            <div class="address-type">
                                <label class="radio-label">
                                    <input type="radio" name="addressType" value="home" checked>
                                    <span>Home</span>
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="addressType" value="office">
                                    <span>Office</span>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="save-btn">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/address.js"></script>
</body>
</html>