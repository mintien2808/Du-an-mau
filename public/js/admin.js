document.addEventListener('DOMContentLoaded', function() {
    const decreaseButtons = document.querySelectorAll('.decrease');
    const increaseButtons = document.querySelectorAll('.increase');

    decreaseButtons.forEach(button => {
        button.addEventListener('click', function() {
            const input = this.closest('.quantity-container').querySelector('.quantity-amount');
            let value = parseInt(input.value);
            if (value > 1) { // Đảm bảo số lượng không nhỏ hơn 1
                value--;
                input.value = value;
            }
        });
    });

    increaseButtons.forEach(button => {
        button.addEventListener('click', function() {
            const input = this.closest('.quantity-container').querySelector('.quantity-amount');
            let value = parseInt(input.value);
            value++;
            input.value = value;
        });
    });
});