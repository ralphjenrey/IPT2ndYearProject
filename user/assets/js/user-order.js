
  // Get all the filter list items
  var filterItems = document.querySelectorAll(".filters-list-group li");

  // Add click event listeners to the filter items
  filterItems.forEach(function(item) {
    item.addEventListener("click", function() {
      // Get the filter value from the data-filter attribute
      var filterValue = this.getAttribute("data-filter");

      // Get all the items
      var items = document.querySelectorAll(".item");

      // Loop through each item and check if it matches the filter value
      items.forEach(function(item) {
        // If the item has the filter value or the filter value is "*", show the item; otherwise, hide it
        var parentElement = item.parentNode;
        if (item.classList.contains(filterValue) || filterValue === "*") {
          parentElement.style.display = "block";
        } else {
          parentElement.style.display = "none";
        }
      });

      // Remove the "active" class from all filter items
      filterItems.forEach(function(item) {
        item.classList.remove("active");
      });

      // Add the "active" class to the clicked filter item
      this.classList.add("active");
    });
  });
//------------------------------------------------------------------------------

// Get all counter elements
const counters = document.querySelectorAll('.input-group');

// Loop through each counter
counters.forEach((counter) => {
  const decrementBtn = counter.querySelector('.decrement');
  const incrementBtn = counter.querySelector('.increment');
  const counterInput = counter.querySelector('.counter-input');

  // Decrement button click event
  decrementBtn.addEventListener('click', () => {
    let count = parseInt(counterInput.value);
    if (count > 0) {
      count--;
      counterInput.value = count;
    }
  });

  // Increment button click event
  incrementBtn.addEventListener('click', () => {
    let count = parseInt(counterInput.value);
    count++;
    counterInput.value = count;
  });
});



// Get "Add to Cart" button
let addToCartBtn = document.querySelector('.add-to-cart-btn');

// Add click event listener to each button

  addToCartBtn.addEventListener('click', function() {
    // Get the item details (name, price, quantity)
    let itemNames = this.parentNode.querySelectorAll('.item-name');
    let itemPrices = this.parentNode.querySelectorAll('.item-price');
    let quantities = this.parentNode.querySelectorAll('.counter-input');

    let item = {
      name: [],
      prices: [],
      quantities: []
    };

    itemNames.forEach(function(itemName) {
      let name = itemName.textContent;
      item.name.push(name);
    });


    // Loop through each item-price element and retrieve its value
    itemPrices.forEach(function(itemPrice) {
      let price = itemPrice.textContent.replace('₱', '');
      item.prices.push(price);
    });

    // Loop through each counter-input element and retrieve its value
    quantities.forEach(function(quantity) {
      item.quantities.push(quantity.value);
    });

    // Check if any quantity is zero
    if (item.quantities.every(quantity => quantity === "0")) {
      alert('Please select a quantity');
      return; // Exit the function
    }

    // Call a function to add the item to the cart
    addToCart(item);
  });


  // Function to add the item to the cart
 // Function to add the item to the cart
function addToCart(item) {
  let modalBody = document.querySelector('.cart');
  let existingItems = modalBody.querySelectorAll('.card-title');

    // Check if all quantities are zero
  if (item.quantities.every(quantity => quantity === "0")) {
    alert('Please select an item');
    return; // Exit the function
  }

  for (let i = 0; i < item.prices.length; i++) {
    const totalPrice = item.prices[i] * item.quantities[i];
    const itemName = item.name[i];

    // Check for duplicate item by comparing the item name
    let duplicateItem = null;
    for (let j = 0; j < existingItems.length; j++) {
      if (existingItems[j].textContent === itemName) {
        duplicateItem = existingItems[j].closest('.cart-item');
        break;
      }
    }

    // If duplicate item found, update the quantity and total price
    if (duplicateItem) {
      let quantityElement = duplicateItem.querySelector('.card-quantity');
      let totalPriceElement = duplicateItem.querySelector('.card-total-price');
      let quantity = parseInt(quantityElement.textContent);
      let newQuantity = quantity + parseInt(item.quantities[i]);
      let newTotalPrice = parseInt(totalPriceElement.textContent) + totalPrice;
      quantityElement.textContent = newQuantity;
      totalPriceElement.textContent = newTotalPrice;

    } else {

      if (item.quantities[i] !== "0") {
        // Create a new card for the item
      let newItem = document.createElement('div');
      newItem.classList.add('cart-item');

      newItem.innerHTML = `
         <div class="card mb-3">
        <div class="card-body">
          <input type="hidden" name="item[${i}][name]" value="${itemName}">
          <input type="hidden" name="item[${i}][quantity]" value="${item.prices[i]}">
          <input type="hidden" name="item[${i}][quantity]" value="${item.quantities[i]}">
          <input type="hidden" name="item[${i}][total]" value="${totalPrice}">
          <button class="remove-btn float-end" onclick="removeCard(this)">X</button>
          <div class="form-group">
            <label for="item_name_${i}">Item Name</label>
            <input type="text" class="form-control" id="item_name_${i}" name="item[${i}][item_name]" value="${itemName}" readonly>
          </div>
          <div class="form-group">
            <label for="item_price_${i}">Price</label>
            <input type="text" class="form-control" id="item_price_${i}" name="item[${i}][item_price]" value="${item.prices[i]}" readonly>
          </div>
          <div class="form-group">
            <label for="item_quantity_${i}">Quantity</label>
            <input type="number" class="form-control" id="item_quantity_${i}" name="item[${i}][item_quantity]" value="${item.quantities[i]}" readonly>
          </div>
          <div class="form-group">
            <label for="item_total_${i}">Total Price</label>
            <input type="text" class="form-control" id="item_total_${i}" name="item[${i}][item_total]" value="${totalPrice}" readonly>
          </div>
        </div>
      </div>
      `;
     

      modalBody.appendChild(newItem);
    }

  }

  
      }
       alert('Added to cart');
}


  // Function to remove the card when the remove button is clicked
function removeCard(button) {
  let card = button.closest('.card');
  card.remove();
}

//Submit form to save-to-cart.php without refresh
document.addEventListener("DOMContentLoaded", function() {
  var form = document.getElementById("saveForLaterForm");

  form.addEventListener("submit", function(event) {
    // Prevent the form from submitting
    event.preventDefault();

    // Perform your desired logic here
    // For example, you can make an AJAX request to save the data without navigating away from the current page
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "save-to-cart.php");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
      if (xhr.status === 200) {
        // Optional: Display a success message or perform any other actions

        // Clear the form fields if needed
        form.reset();
      } else {
        // Optional: Display an error message or perform any other error handling
      }
    };
    
    // Get the form data and serialize it
    var formData = new FormData(form);
    var serializedFormData = [];
    for (var pair of formData.entries()) {
      serializedFormData.push(encodeURIComponent(pair[0]) + "=" + encodeURIComponent(pair[1]));
    }
    var encodedFormData = serializedFormData.join("&");

    xhr.send(encodedFormData);
  });
});