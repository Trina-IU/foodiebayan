// Initialize cart from localStorage
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Notification Styles
const notificationStyles = `
.notification {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #333;
    color: white;
    padding: 12px 24px;
    border-radius: 4px;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.3s ease;
    z-index: 1000;
}

.notification.show {
    opacity: 1;
    transform: translateY(0);
}`;

// Add notification styles to document
const styleSheet = document.createElement('style');
styleSheet.textContent = notificationStyles;
document.head.appendChild(styleSheet);

// Cart functions
function addToCart(id, name, price) {
    const existingItem = cart.find(item => item.id === id);
    
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            id: id,
            name: name,
            price: price,
            quantity: 1
        });
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartDisplay();
    showNotification('Item added to cart');
}

function updateCartDisplay() {
    const cartItems = document.querySelector('.cart-items');
    const itemsTotal = document.getElementById('items-total');
    const discount = document.getElementById('discount');
    const total = document.getElementById('total');
    
    if (cart.length === 0) {
        cartItems.innerHTML = '<div class="empty-cart">Your cart is empty</div>';
    } else {
        cartItems.innerHTML = cart.map(item => `
            <div class="cart-item">
                <div class="cart-item-details">
                    <span class="item-name">${item.name}</span>
                    <span class="item-price">₱${item.price.toFixed(2)}</span>
                </div>
                <div class="item-quantity">
                    <button onclick="decreaseQuantity(${item.id})">-</button>
                    <span>${item.quantity}</span>
                    <button onclick="increaseQuantity(${item.id})">+</button>
                </div>
                <button class="remove-item" onclick="removeFromCart(${item.id})">×</button>
            </div>
        `).join('');
    }
    
    let subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    let discountAmount = subtotal * 0.20;
    let finalTotal = subtotal - discountAmount;
    
    itemsTotal.textContent = subtotal.toFixed(2);
    discount.textContent = discountAmount.toFixed(2);
    total.textContent = finalTotal.toFixed(2);

    updateCartCount();
}

function increaseQuantity(id) {
    const item = cart.find(item => item.id === id);
    if (item) {
        item.quantity += 1;
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartDisplay();
    }
}

function decreaseQuantity(id) {
    const item = cart.find(item => item.id === id);
    if (item && item.quantity > 1) {
        item.quantity -= 1;
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartDisplay();
    }
}

function removeFromCart(id) {
    cart = cart.filter(item => item.id !== id);
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartDisplay();
    showNotification('Item removed from cart');
}

function updateCartCount() {
    const cartCount = document.getElementById('cart-count');
    if (cartCount) {
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        cartCount.textContent = totalItems;
        cartCount.style.display = totalItems > 0 ? 'flex' : 'none';
    }
}

function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => notification.classList.add('show'), 100);
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

function proceedToCheckout() {
    if (cart.length === 0) {
        showNotification('Your cart is empty');
        return;
    }
    window.location.href = 'checkout.php';
}

// Initialize when document is loaded
document.addEventListener('DOMContentLoaded', function() {
    updateCartDisplay();

    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const foodItems = document.querySelectorAll('.food-item');
            
            foodItems.forEach(item => {
                const foodName = item.querySelector('h3').textContent.toLowerCase();
                if (foodName.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
});