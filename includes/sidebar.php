<aside class="sidebar">
    <nav>
        <ul>
            <li class="<?php echo ($current_page === 'dashboard') ? 'active' : ''; ?>">
                <a href="dashboard.php">
                    <img src="images/home-icon.png" alt="Home" class="icon-img">
                </a>
            </li>
            <li class="<?php echo ($current_page === 'checkout') ? 'active' : ''; ?>">
                <a href="checkout.php">
                    <img src="images/checkout-icon.png" alt="Checkout" class="icon-img">
                </a>
            </li>
            <li>
                <a href="checkout.php" class="cart-icon">
                    <img src="images/cart-icon.png" alt="Cart" class="icon-img">
                    <span id="cart-count" class="cart-count">0</span>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
</aside>