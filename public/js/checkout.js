
document.getElementById('checkoutForm').addEventListener('submit', function(event) {
    let isValid = true;
    let errors = [];

    const shippingAddress = document.getElementById('shipping_address').value;
    const phone = document.getElementById('phone').value;

    if (!/[0-9]/.test(shippingAddress) || !/[a-zA-Z]/.test(shippingAddress)) {
        errors.push('Địa chỉ phải gồm cả số và chữ.');
        isValid = false;
    }

    if (!/^\d{10}$/.test(phone)) {
        errors.push('Số điện thoại phải đủ 10 số và không chứa ký tự');
        isValid = false;
    }

    if (!isValid) {
        alert(errors.join('\n'));
        event.preventDefault(); 
    }
});

function goToCart() {
    window.location.href = 'index.php?url=cart/viewCart';
}