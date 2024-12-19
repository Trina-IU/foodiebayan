// Define these functions in the global scope
let cart = JSON.parse(localStorage.getItem('cart')) || [];

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

function confirmOrder() {
    const savedAddress = localStorage.getItem('deliveryAddress');
    
    if (!savedAddress) {
        showNotification('Please add your delivery address first');
        setTimeout(() => {
            window.location.href = 'address.php';
        }, 2000);
        return;
    }

    if (cart.length === 0) {
        showNotification('Your cart is empty');
        return;
    }

    const currentOrder = {
        items: cart,
        address: JSON.parse(savedAddress),
        orderTime: new Date().toISOString()
    };
    localStorage.setItem('currentOrder', JSON.stringify(currentOrder));

    // Clear the cart
    localStorage.removeItem('cart');
    
    // Redirect to success page
    window.location.href = 'order-success.php';
}

// The rest of your code inside DOMContentLoaded
document.addEventListener('DOMContentLoaded', function() {
    function updateCheckoutDisplay() {
        const cartList = document.querySelector('.cart-list');
        const itemsCount = document.querySelector('.items-count');
        
        if (!cartList || !itemsCount) return;
        
        itemsCount.textContent = `${cart.length} items`;

        cartList.innerHTML = cart.map(item => `
            <div class="cart-item">
                <div class="item-details">
                    <h4>${item.name}</h4>
                    <p>₱${item.price.toFixed(2)}</p>
                </div>
                <div class="item-quantity">
                    <button onclick="updateQuantity(${item.id}, ${item.quantity - 1})">-</button>
                    <span>${item.quantity}</span>
                    <button onclick="updateQuantity(${item.id}, ${item.quantity + 1})">+</button>
                </div>
                <span class="item-total">₱${(item.price * item.quantity).toFixed(2)}</span>
            </div>
        `).join('');

        updateSummary();
    }

    function updateSummary() {
        const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const tax = subtotal * 0.20;
        const total = subtotal + tax;

        const elements = {
            subtotal: document.getElementById('subtotal'),
            tax: document.getElementById('tax'),
            total: document.getElementById('total')
        };

        if (elements.subtotal) elements.subtotal.textContent = subtotal.toFixed(2);
        if (elements.tax) elements.tax.textContent = tax.toFixed(2);
        if (elements.total) elements.total.textContent = total.toFixed(2);
    }

    window.updateQuantity = function(id, newQuantity) {
        if (newQuantity < 1) return;

        const itemIndex = cart.findIndex(item => item.id === id);
        if (itemIndex !== -1) {
            cart[itemIndex].quantity = newQuantity;
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCheckoutDisplay();
        }
    };

    // Initialize checkout display
    updateCheckoutDisplay();
});