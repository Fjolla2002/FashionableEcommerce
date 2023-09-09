
$(document).ready(function() {
  var activeImg = "-active";
  console.log("wait");
  // Attach event listeners to the parent container using event delegation
  $(document).on('mouseover', '.product-item', function() {
    $(this).find('img').attr("src", function(index, attr) {
      return attr.replace(".jpg", "-active.jpg");
    });
  });

  $(document).on('mouseout', '.product-item', function() {
    $(this).find('img').attr("src", function(index, attr) {
      return attr.replace("-active.jpg", ".jpg");
    });
  });

  // Rest of your code here
  $("#show-desc-about-product").click(function(e) {
    e.preventDefault();
        $("#show-desc-about-product").addClass("about-product-info_titles--active");
        $("#show-info-about-product").removeClass("about-product-info_titles--active");
        $("#show-desc-about-product_content").css("display", "block");
        $("#show-info-about-product_content").css("display", "none");
  });

  $("#show-info-about-product").click(function(e) {
    e.preventDefault();
        $("#show-info-about-product").addClass("about-product-info_titles--active");
        $("#show-desc-about-product").removeClass("about-product-info_titles--active");
        $("#show-desc-about-product_content").css("display", "none");
        $("#show-info-about-product_content").css("display", "block");
  });
});

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


// function addItemsOnCart(parentDivId) {
//   console.log("A");
//   waitForElm('#cart_grid').then(() => {
//     console.log("B");
//   const cartGrid = document.getElementById('cart_grid');
//   const cartItem = document.createElement('div');
//   cartItem.textContent = parentDivId;
//   cartGrid.appendChild(cartItem);
// });

// }
