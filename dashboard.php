<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$current_page = 'dashboard';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>FoodieBayan - Dashboard</title>
    <link rel="stylesheet" href="css/common.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
        <?php include 'includes/sidebar.php'; ?>

        <div class="main-content">
            <?php include 'includes/header.php'; ?>

            <!-- Banner -->
            <div class="banner">
                <img src="images/banner.jpg" alt="Super Delicious Food Menu">
            </div>

            <!-- Categories -->
            <div class="categories">
                <h2>Categories</h2>
                <div class="category-filters">
                    <button class="category-btn active" data-category="all">All</button>
                    <?php
                    $categories = getCategories();
                    foreach($categories as $category) {
                        echo "<button class='category-btn' data-category='" . strtolower($category) . "'>$category</button>";
                    }
                    ?>
                </div>
            </div>

            <!-- Food Menu -->
            <div class="food-menu">
                <h2>Food Menu</h2>
                <div class="food-grid">
                    <?php
                    $foods = getFoodItems();
                    foreach($foods as $food) {
                        echo "
                        <div class='food-item' data-category='" . strtolower($food['category']) . "'>
                            <img src='images/foods/{$food['image']}' alt='{$food['name']}'>
                            <h3>{$food['name']}</h3>
                            <p>" . formatPrice($food['price']) . "</p>
                            <button class='add-to-cart' onclick='addToCart({$food['id']}, \"{$food['name']}\", {$food['price']})'>
                                <i class='fas fa-plus'></i>
                            </button>
                        </div>";
                    }

                    $additional_foods = [
                        ['id' => 'new1', 'name' => 'Chicken Adobo', 'price' => 180, 'category' => 'main-dish', 'image' => 'chicken-adobo.jpg'],
                        ['id' => 'new2', 'name' => 'Sinigang na Baboy', 'price' => 220, 'category' => 'soup', 'image' => 'sinigang.jpg'],
                        ['id' => 'new3', 'name' => 'Leche Flan', 'price' => 90, 'category' => 'dessert', 'image' => 'leche-flan.jpg'],
                        ['id' => 'new4', 'name' => 'Pancit Canton', 'price' => 150, 'category' => 'noodles', 'image' => 'pancit.jpg'],
                        ['id' => 'new5', 'name' => 'Crispy Pata', 'price' => 450, 'category' => 'main-dish', 'image' => 'crispy-pata.jpg'],
                        ['id' => 'new6', 'name' => 'Halo-Halo', 'price' => 120, 'category' => 'dessert', 'image' => 'halo-halo.jpg']
                    ];
                
                    foreach($additional_foods as $food) {
                        echo "
                        <div class='food-item' data-category='" . strtolower($food['category']) . "'>
                            <img src='images/foods/{$food['image']}' alt='{$food['name']}'>
                            <h3>{$food['name']}</h3>
                            <p>" . formatPrice($food['price']) . "</p>
                            <button class='add-to-cart' onclick='addToCart(\"{$food['id']}\", \"{$food['name']}\", {$food['price']})'>
                                <i class='fas fa-plus'></i>
                            </button>
                        </div>";
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Cart Sidebar -->
        <div class="cart-sidebar">
            <h2>Add to Cart</h2>
            <div class="cart-items">
                <!-- Cart items will be dynamically added here -->
                <div class="empty-cart">Your cart is empty</div>
            </div>
            <div class="cart-summary">
                <div class="summary-item">
                    <span>Item Total</span>
                    <span class="amount">₱<span id="items-total">0.00</span></span>
                </div>
                <div class="summary-item">
                    <span>Discount</span>
                    <span class="amount">₱<span id="discount">0.00</span></span>
                </div>
                <div class="summary-item">
                    <span>Shipping fee</span>
                    <span>Free</span>
                </div>
                <div class="summary-item total">
                    <span>Total</span>
                    <span class="amount">₱<span id="total">0.00</span></span>
                </div>
                <button class="checkout-btn" onclick="proceedToCheckout()">Proceed to Checkout</button>
            </div>
        </div>
    </div>

    <script src="js/script.js"></script>
  
        
</body>
</html>
