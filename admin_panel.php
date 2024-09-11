<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: index.html");
    exit();
}

$query = "SELECT * FROM products ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Header -->
    <header class="bg-blue-600 text-white p-6 shadow-md">
        <div class="container mx-auto text-center"> 
            <h1 class="text-3xl font-bold hover:text-red-500 cursor-pointer">Sports@Nepal</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto my-8 ">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-8 ">

            <!-- ADD/EDIT Product Form -->
            <section class="md:col-span-1 bg-white p-6 rounded-lg shadow-md ">
                <h2 class="text-2xl font-semibold mb-4">ADD/EDIT Product</h2>
                <form action="admin_process.php" method="POST" enctype="multipart/form-data" class="space-y-4  ">
                    <input type="hidden" name="id" id="product-id">

                    <div>
                        <label class="block text-lg font-medium">Product Name</label>
                        <input type="text" name="name" id="product-name" 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-lg font-medium">Product Price</label>
                        <input type="number" name="price" id="product-price" 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-lg font-medium">Product Description</label>
                        <textarea name="description" id="product-description" 
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </textarea>
                    </div>

                    <div>
                        <label class="block text-lg font-medium">Product Image</label>
                        <input type="file" name="image" id="product-image" 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="flex justify-between">
                        <button type="submit" name="save_product" 
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Save Product
                        </button>
                    </div>
                </form>

                <!-- Delete Product Form (Hidden) -->
                <form id="delete-product-form" action="admin_process.php" method="POST" class="hidden">
                    <input type="hidden" name="id" id="product-id">
                    <input type="hidden" name="delete_product" value="1">
                </form>
            </section>

            <!-- Product List -->
            <section class="md:col-span-2 bg-white p-6 rounded-lg shadow-md ">
                <h2 class="text-2xl font-semibold mb-4 underline ">Product List</h2>
                <ul class="space-y-4 ">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <li class="bg-gray-50 p-4 rounded-lg shadow-md flex justify-between items-center bg-green-100">
                            <div >
                                <?php if ($row['image']): ?>
                                    <img src="<?= htmlspecialchars($row['image']) ?>" 
                                    alt="<?= htmlspecialchars($row['name']) ?>" 
                                    class="w-40 h-30 object-cover mt-2 rounded-lg">
                                <?php endif; ?>
                                <h3 class="text-2xl font-semibold text-gray-600 hover:cursor-pointer hover:underline"><?= htmlspecialchars($row['name']) ?></h3>
                                <p class="text-blue-500 text-lg font-bold hover:cursor-pointer hover:underline"><?= number_format($row['price'], 2) ?></p>
                                <p><?= htmlspecialchars($row['description']) ?></p>
                                
                            </div>
                            <div class="flex space-x-2">
                                <button class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 focus:outline-none" 
                                onclick="editProduct(<?= $row['id'] ?>, 
                                '<?= addslashes($row['name']) ?>', 
                                <?= $row['price'] ?>, 
                                '<?= addslashes($row['description']) ?>')">Edit</button>

                                <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 focus:outline-none" 
                                onclick="confirmDelete(<?= $row['id'] ?>)">Delete</button>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </section>
        </div>
    </main>
    <script>
        function editProduct(id, name, price, description) {
            document.getElementById('product-id').value = id;
            document.getElementById('product-name').value = name;
            document.getElementById('product-price').value = price;
            document.getElementById('product-description').value = description;
        }

        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this product?')) {
                document.getElementById('product-id').value = id;
                document.getElementById('delete-product-form').submit();
            }
        }
    </script>
</body>
</html>
