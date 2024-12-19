document.addEventListener('DOMContentLoaded', function() {
    // Load saved address if exists
    const savedAddress = localStorage.getItem('deliveryAddress');
    if (savedAddress) {
        const address = JSON.parse(savedAddress);
        document.getElementById('recipientName').value = address.recipientName;
        document.getElementById('phoneNumber').value = address.phoneNumber;
        document.getElementById('region').value = address.region;
        document.getElementById('street').value = address.street;
        document.getElementById('unit').value = address.unit;
        document.querySelector(`input[name="addressType"][value="${address.addressType}"]`).checked = true;
    }

    // Form submission handler
    document.getElementById('addressForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const deliveryAddress = {
            recipientName: document.getElementById('recipientName').value,
            phoneNumber: document.getElementById('phoneNumber').value,
            region: document.getElementById('region').value,
            street: document.getElementById('street').value,
            unit: document.getElementById('unit').value,
            addressType: document.querySelector('input[name="addressType"]:checked').value
        };

        // Save to localStorage
        localStorage.setItem('deliveryAddress', JSON.stringify(deliveryAddress));
        showNotification('Address saved successfully!');
        
        // Redirect back to checkout page after saving
        setTimeout(() => {
            window.location.href = 'checkout.php';
        }, 2000);
    });
});

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