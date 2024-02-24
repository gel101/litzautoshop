// Get form elements
const form = document.getElementById("pos-form");
const productNameInput = document.getElementById("product-name");
const productCodeInput = document.getElementById("product-code");
const quantityInput = document.getElementById("quantity");
const pricePerUnitInput = document.getElementById("price-per-unit");
const totalPriceInput = document.getElementById("total-price");

// Update total price when quantity or price per unit changes
quantityInput.addEventListener("input", updateTotalPrice);
pricePerUnitInput.addEventListener("input", updateTotalPrice);

function updateTotalPrice() {
  const quantity = quantityInput.valueAsNumber;
  const pricePerUnit = pricePerUnitInput.valueAsNumber;
  const totalPrice = quantity * pricePerUnit;
  totalPriceInput.value = totalPrice.toFixed(2);
}

// Submit form
form.addEventListener("submit", function(event) {
  event.preventDefault();

  // Get form values
  const productName = productNameInput.value.trim();
  const productCode = productCodeInput.value.trim();
  const quantity = quantityInput.valueAsNumber;
  const pricePerUnit = pricePerUnitInput.valueAsNumber;
  const totalPrice = totalPriceInput.valueAsNumber;

  // Validate form values
  if (!productName || !productCode || isNaN(quantity) || isNaN(pricePerUnit)) {
    alert("Please enter valid product information.");
    return;
  }

  // Log product information (or add to cart, etc.)
  console.log("Product Name:", productName);
  console.log("Product Code:", productCode);
  console.log("Quantity:", quantity);
  console.log("Price per Unit:", pricePerUnit);
  console.log("Total Price:", totalPrice);

  // Clear form inputs
  form.reset();
});
