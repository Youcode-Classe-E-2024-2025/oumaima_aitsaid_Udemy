<?php

 include 'sideBar.php'

?>


    <!-- Main Content -->
    <div class="flex-1 overflow-x-hidden overflow-y-auto">
        <!-- Top Navbar -->
        <header class="bg-white shadow-md p-4">
            <div class="flex justify-between items-center">
                <button onclick="history.back()" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">Back</button>
                <h2 class="text-xl font-semibold text-gray-800">Categories</h2>
                <div class="flex items-center">
                    <img src="https://via.placeholder.com/40" alt="Admin" class="w-8 h-8 rounded-full">
                </div>
            </div>
        </header>

        <!-- Categories Content -->
        <main class="p-6">
            <h1 class="text-2xl font-bold mb-6">Categories</h1>
            <div class="mb-4">
                <button onclick="openModal('create')" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add New Category</button>
            </div>
            <?php if (isset($error_message)): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo $error_message; ?></span>
                </div>
            <?php endif; ?>
            <?php if (isset($_GET['message'])): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">
                        <?php
                        switch ($_GET['message']) {
                            case 'created':
                                echo 'Category created successfully.';
                                break;
                                case 'updated':
                                    echo 'Category updated successfully.';
                                    break;
                                    case 'deleted':
                                        echo 'Category deleted successfully.';
                                        break;
                                    }
                                    ?>
                    </span>
                </div>
            <?php endif; ?>
            <table class="w-full bg-white shadow-lg rounded overflow-hidden">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $category): ?>
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-4 py-3"><?php echo $category['id']; ?></td>
                                <td class="px-4 py-3"><?php echo htmlspecialchars($category['name']); ?></td>
                                <td class="px-4 py-3">
                                    <button onclick='openModal("edit", <?php echo json_encode($category); ?>)' class="text-blue-600 hover:underline">Edit</button>
                                    <a href="index.php?action=delete_category&id=<?php echo $category['id']; ?>" onclick="return confirm('Are you sure?');" class="text-red-600 hover:underline">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="px-4 py-3 text-center">No categories found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </main>
    </div>
</div>

<!-- Modal -->
<div id="categoryModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded shadow-lg w-96">
        <h2 id="modalTitle" class="text-xl font-bold mb-4"></h2>
        <form id="categoryForm" method="POST">
            <div class="mb-4">
                <label for="categoryName" class="block text-gray-700 font-medium mb-2">Name:</label>
                <input type="text" id="categoryName" name="name" class="w-full px-3 py-2 border rounded" required>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeModal()" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 mr-2">Cancel</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
            </div>
        </form>
    </div>
</div>

</body>
                                    <script>
                                        function openModal(action, category = {}) {
                                            const modal = document.getElementById('categoryModal');
                                            modal.classList.remove('hidden');
                                            document.getElementById('modalTitle').textContent = action === 'create' ? 'Create Category' : 'Edit Category';
                                            document.getElementById('categoryForm').action = action === 'create' ? 'index.php?action=create_category' : `index.php?action=edit_category&id=${category.id}`;
                                            document.getElementById('categoryName').value = category.name || '';
                                        }
                                
                                        function closeModal() {
                                            document.getElementById('categoryModal').classList.add('hidden');
                                        }
                                    </script>
</html>