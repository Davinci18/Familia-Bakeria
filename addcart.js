document.addEventListener('DOMContentLoaded', () => {
    const addToCartButtons = document.querySelectorAll('.add-to-cart'); //this retrieves the button at the bottom of the products
    const cartModal = document.getElementById('cart-modal'); //retrieves the template/format of how the cart modal should display like
    const closeModal = document.getElementsByClassName("close")[3];//gets the fourth close button in the store closed array
    const cartItemsContainer = document.getElementById('cart-items');//this is to garb the "box" of the cart
    const cartTotal = document.getElementById('cart-total'); //retrieves the format of how to display the total of the cart
    const cartItemTemplate = document.getElementById('cart-item-template');//this is to grab the contents inside the carts
    const purchaseButton = document.getElementById('purchase-btn'); 

    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    addToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            const productName = button.getAttribute('data-name');
            const productPrice = parseFloat(button.getAttribute('data-price'));
            const productImage = button.getAttribute('data-img');

            const existingProductIndex = cart.findIndex(item => item.name === productName);
            if (existingProductIndex !== -1) {
                cart[existingProductIndex].quantity++;
            } else {
                cart.push({ name: productName, price: productPrice, quantity: 1, image: productImage });
            }

            saveCart();
            updateCart();
        });
    });

    closeModal.addEventListener('click', () => {
        cartModal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === cartModal) {
            cartModal.style.display = 'none';
        }
    });

    document.querySelector('.cart-icon').addEventListener('click', () => {
        cartModal.style.display = 'block';
        updateCart();
    });

    purchaseButton.addEventListener('click', () =>{

        if(cart.length === 0 ){
            alert('The cart is empty. Please add items to the cart before purchasing.');
        }else{
            alert('Purchase successful! Thank you for your order.');

        cart = [];
        saveCart();
        updateCart();}
    });

    function saveCart() {
        localStorage.setItem('cart', JSON.stringify(cart));
    }

    function updateCart() {
        cartItemsContainer.innerHTML = '';

        cart.forEach(item => {
            const cartItem = cartItemTemplate.cloneNode(true);
            cartItem.style.display = 'flex';
            cartItem.querySelector('img').src = item.image; // Use the actual image path from the item
            cartItem.querySelector('.item-name').textContent = item.name;
            cartItem.querySelector('.item-price').textContent = `R${item.price.toFixed(2)}`;
            cartItem.querySelector('.item-quantity').textContent = `Quantity: ${item.quantity}`;

            const removeButton = cartItem.querySelector('.btn-remove');
            removeButton.addEventListener('click', () => {
                const itemIndex = cart.findIndex(cartItem => cartItem.name === item.name);
                if (itemIndex !== -1) {
                    cart.splice(itemIndex, 1);
                    saveCart();
                    updateCart();
                }
            });

            cartItemsContainer.appendChild(cartItem);
        });

        const total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
        cartTotal.textContent = total.toFixed(2);
    }

    // Initial load of cart from localStorage
    updateCart();

});
