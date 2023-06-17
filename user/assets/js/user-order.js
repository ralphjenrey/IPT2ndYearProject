
  // Get all the filter list items
  var filterItems = document.querySelectorAll(".filters-list-group li");

  // Add click event listeners to the filter items
  filterItems.forEach(function(item) {
    item.addEventListener("click", function() {
      // Get the filter value from the data-filter attribute
      var filterValue = this.getAttribute("data-filter");

      // Clear the search input
       document.getElementById("searchInput").value = "";
       searchItems();

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
    sendToCart();
  });

  // Function to remove the card when the remove button is clicked
function removeCard(button) {
  let card = button.closest('.card');
  card.remove();
}
 
function sendToCart() {
  // Get all item elements
  var itemElements = document.getElementsByClassName('item');

  // Create an empty array to store items with their quantities
  var items = [];

  // Loop through each item element
  for (var i = 0; i < itemElements.length; i++) {
    var itemElement = itemElements[i];

    // Get the item name, quantity, and id for the current item element
    var itemName = itemElement.querySelector('.item-name').textContent;
    var itemQuantity = parseInt(itemElement.querySelector('.counter-input').value);
    var itemId = itemElement.querySelector('input[name="item_id"]').value;
    var itemPrice = parseFloat(itemElement.querySelector('.item-price').textContent.replace('₱', ''));

    // Create an object representing the item and its details
    var item = {
      id: itemId,
      name: itemName,
      quantity: itemQuantity,
      price: itemPrice
    };

    // Push the item object to the items array if the quantity is greater than zero
    if (itemQuantity > 0) {
      items.push(item);
    }
  }

  // Create a new XMLHttpRequest object
  var xhr = new XMLHttpRequest();

  // Prepare the request
  xhr.open('POST', 'add_to_cart.php', true);

  // Set the request header
  xhr.setRequestHeader('Content-Type', 'application/json');

  // Handle the response
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // Handle the response here if needed
        console.log(xhr.responseText);
      } else {
        // Handle any errors here
        console.error(xhr.statusText);
      }
    }
  };

  // Convert the items array to JSON string
  var jsonData = JSON.stringify(items);

  // Send the request with the JSON data
  xhr.send(jsonData);
}



//---------------------------Search Function
  function searchItems() {
  // Get the search input value
  var searchText = document.getElementById("searchInput").value.toLowerCase();

  // Get all the items
  var items = document.querySelectorAll(".item");

  // Loop through each item and check if it matches the search text
  items.forEach(function(item) {
    // If the item's text content contains the search text or the search text is empty, show the item; otherwise, hide it
    var parentElement = item.parentNode;
    if (item.textContent.toLowerCase().includes(searchText) || searchText === "") {
      parentElement.style.display = "block";
    } else {
      parentElement.style.display = "none";
    }
  });
}
