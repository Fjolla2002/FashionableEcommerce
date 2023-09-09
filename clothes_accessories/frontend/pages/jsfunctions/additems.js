function additem(productID, productSection, productName, productDesc, productCategory, productPrice, imagePath) {
  waitForElm(`#${productSection}`).then((elm) => {
    const popularItems = document.getElementById(productSection);
    const parentDivId = productID; // Set the parent div ID as the product ID

    const productItem = document.createElement('div');
    productItem.className = 'product-item';
    productItem.id = parentDivId;

    const productImg = document.createElement('div');
    productImg.className = 'product-item_img';
    productImg.innerHTML = `
      <div class="out-of-stock">Out Of Stock</div>
      <div class="sale">SALE!</div>
      <a href="#">
        <img id="product-img" src="${imagePath}" alt="">
      </a>
      <div class="add-item-somewhere">
        <a href="#" class="add-to-cart">Add to Cart</a>
      </div>`;

    const productDescSection = document.createElement('div');
    productDescSection.className = 'product-item-little-desc';
    productDescSection.innerHTML = `
      <div>
        <a href="#" class="product-item-little-desc_categories-name">${productCategory}</a>
      </div>
      <div>
        <a href="#" class="product-item-little-desc_product-name">${productName}</a>
      </div>
      <del class="product-item-little-desc_old-product-price">$150.00</del>
      <span class="product-item-little-desc_product-price">$${productPrice}</span>
    `;

    productItem.appendChild(productImg);
    productItem.appendChild(productDescSection);
    popularItems.appendChild(productItem);

    const addToCartButton = productItem.querySelector('.add-to-cart');
    addToCartButton.addEventListener('click', function(event) {
      event.preventDefault();
      var product = $(this).closest('.product-item');
    // Get the outer HTML of the product element
      var productHTML = product.prop('outerHTML');
      
    // Example using localStorage:
      var products = JSON.parse(localStorage.getItem('productData')) || [];
      products.push(productHTML);
      localStorage.setItem('productData', JSON.stringify(products));

      var productId = productItem.id;

      // Example using localStorage:
      var productIds = JSON.parse(localStorage.getItem('productIds')) || [];
      productIds.push(productId);
      localStorage.setItem('productIds', JSON.stringify(productIds));
    });
  });
}
function waitForElm(selector) {
    return new Promise(resolve => {
      if (document.querySelector(selector)) {
        return resolve(document.querySelector(selector));
      }
  
      const observer = new MutationObserver(mutations => {
        if (document.querySelector(selector)) {
          resolve(document.querySelector(selector));
          observer.disconnect();
        }
      });
  
      document.addEventListener("DOMContentLoaded", () => {
        observer.observe(document.body, {
          childList: true,
          subtree: true
        });
      });
    });
  }