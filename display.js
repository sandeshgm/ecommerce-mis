document.addEventListener("DOMContentLoaded", () => {
  fetch("fetch_products.php")
    .then((response) => response.json())
    .then((products) => {
      const productsContainer = document.querySelector(".products");

      if (products.length === 0) {
        productsContainer.innerHTML = "<p>No products available.</p>";
        return;
      }

      productsContainer.innerHTML = products
        .map(
          (product) => `
        <div class="bg-white rounded-lg shadow-lg p-4">
          <img src="${product.image}" alt="${
            product.name
          }" class="w-full h-48 object-cover rounded-t-lg" />
          <h3 class="text-lg font-semibold mt-2">${product.name}</h3>
          <p class="text-gray-600">${product.description}</p>
          <p class="text-xl font-bold mt-2">$${product.price.toFixed(2)}</p>
        </div>
      `
        )
        .join("");
    })
    .catch((error) => console.error("Error fetching products:", error));
});
