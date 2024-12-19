document.addEventListener('DOMContentLoaded', function() {
    // Get order details from localStorage
    const orderDetails = JSON.parse(localStorage.getItem('currentOrder'));
    
    // Update order items display
    if (orderDetails) {
        const orderItemsContainer = document.getElementById('orderItems');
        orderItemsContainer.innerHTML = orderDetails.items.map(item => `
            <div class="order-item">
                <span class="item-name">${item.name}</span>
                <span class="item-quantity">x${item.quantity}</span>
                <span class="item-price">₱${(item.price * item.quantity).toFixed(2)}</span>
            </div>
        `).join('');
    }

    // Simulate delivery progress (for demo purposes)
    setTimeout(() => {
        document.getElementById('on-the-way').classList.add('active');
    }, 5000);

    setTimeout(() => {
        document.getElementById('delivered').classList.add('active');
    }, 10000);
});