// script.js

document.addEventListener('DOMContentLoaded', function () {
    const products = [
        { id: 1, name: '50 TL CÜZDAN KODU', price: 50, image: 'https://i.imgur.com/JzdM3ac.jpg' },
        { id: 2, name: 'XBOX LIVE GOLD 6 AY HEDIYE KARTI', price: 45, image: 'https://i.imgur.com/eZ3Fv2c.jpg' },
        { id: 3, name: 'XBOX GAME PASS ULTIMATE', price: 50, image: 'https://i.imgur.com/dekclu6.jpg' },
        { id: 4, name: '250 TL STEAM CÜZDAN KODU', price: 45, image: 'https://i.imgur.com/eZ3Fv2c.jpg' },
        { id: 5, name: '50 TL CÜZDAN KODU', price: 50, image: 'https://i.imgur.com/JzdM3ac.jpg' },
        { id: 6, name: 'NITRO KASASI', price: 45, image: 'https://i.imgur.com/nyBvN12.png' },
        { id: 7, name: 'GOLDEN GIFT', price: 50, image: 'https://i.imgur.com/tc6BT15.png' },
        { id: 8, name: 'XBOX LIVE GOLD 3 AY HEDIYE KARTI', price: 45, image: 'https://i.imgur.com/KpbP5a0.jpg' },
        { id: 9, name: '50 TL CÜZDAN KODU', price: 50, image: 'https://i.imgur.com/JzdM3ac.jpg' },
        { id: 10, name: 'PCC CRATE + KEY', price: 45, image: 'https://i.imgur.com/PIEFZY2.png' },
        { id: 13, name: 'FEROCITY CRATE + KEY', price: 50, image: 'https://i.imgur.com/pH3fCET.png' },
        { id: 14, name: 'TRIUMPH CRATE + KEY', price: 45, image: 'https://i.imgur.com/HqSfmkl.png' },
        { id: 15, name: '100X KEYS', price: 50, image: 'https://i.imgur.com/LElp4BX.png' },
        { id: 16, name: 'NITRO CRATE + KEY', price: 45, image: 'https://i.imgur.com/Dyxgwz4.png' },
        { id: 17, name: 'TRIUMPH CRATE', price: 50, image: 'https://i.imgur.com/a9fJPKc.png' },
        { id: 18, name: 'PLAYERS CHOICE CRATE', price: 45, image: 'https://i.imgur.com/I4rL8ob.png'},
        // Diğer ürünler...
    ];

    const selectedProducts = getRandomProducts(products, 6);
    displayProducts(selectedProducts);

    // Kullanıcı giriş durumuna göre menüyü güncelle
    updateMenu();
});

function updateMenu() {
    const isLoggedIn = checkLoggedIn(); // Kullanıcının giriş yapıp yapmadığını kontrol etmek için bir fonksiyon

    const registerLink = document.querySelector('nav ul li a[href="register.html"]');
    const loginLink = document.querySelector('nav ul li a[href="login.html"]');

    if (isLoggedIn) {
        // Kullanıcı giriş yapmışsa kayıt ol ve giriş yap linklerini gizle
        registerLink.style.display = 'none';
        loginLink.style.display = 'none';
    } else {
        // Kullanıcı giriş yapmamışsa kayıt ol ve giriş yap linklerini göster
        registerLink.style.display = 'inline';
        loginLink.style.display = 'inline';
    }
}

function checkLoggedIn() {
    // Bu fonksiyon kullanıcının giriş yapmış olup olmadığını kontrol etmeli
    // Kullanıcı giriş yapmışsa true, yapmamışsa false dönmelidir.
    // Bu kontrolü sunucu tarafında yapmak daha güvenlidir.
    // Şu anki örnek sadece demo amaçlıdır.
    return false; // Bu durumu sunucu tarafında kontrol etmelisiniz.
}

function getRandomProducts(allProducts, count) {
    const shuffledProducts = allProducts.sort(() => 0.5 - Math.random());
    return shuffledProducts.slice(0, count);
}

function displayProducts(products) {
    const productListElement = document.getElementById('productList');

    if (productListElement) {
        products.forEach(product => {
            const productElement = document.createElement('div');
            productElement.classList.add('product');

            const productImage = document.createElement('img');
            productImage.src = product.image;
            productImage.alt = product.name;

            const productName = document.createElement('h3');
            productName.textContent = product.name;

            const productPrice = document.createElement('p');
            productPrice.textContent = `Fiyat: $${product.price}`;

            productElement.appendChild(productImage);
            productElement.appendChild(productName);
            productElement.appendChild(productPrice);

            productListElement.appendChild(productElement);
        });
    }
}

// script.js




