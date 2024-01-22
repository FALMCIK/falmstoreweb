// categoryscript.js

// Ürün listesini gösteren fonksiyon
function displayProducts(products) {
    const productListElement = document.getElementById('productList');

    if (!productListElement) {
        console.error("productList element not found!");
        return;
    }

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
