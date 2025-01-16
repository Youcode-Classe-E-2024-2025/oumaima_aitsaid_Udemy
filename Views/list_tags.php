<?php

 include 'sideBar.php'

?>
    <div class="flex-1 overflow-x-hidden overflow-y-auto">
        <header class="bg-white shadow-md p-4">
            <div class="flex justify-between items-center">
                <button onclick="history.back()" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">Back</button>
                <h2 class="text-xl font-semibold text-gray-800">tags</h2>
                <div class="flex items-center">
                    <img src="https://via.placeholder.com/40" alt="Admin" class="w-8 h-8 rounded-full">
                </div>
            </div>
        </header>

        <main class="p-6">
            <h1 class="text-2xl font-bold mb-6">tags</h1>
            <div class="mb-4">
                <button onclick="openModal('create')" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add New Tags</button>
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
                                echo 'Tags created successfully.';
                                break;
                                case 'updated':
                                    echo 'Tags updated successfully.';
                                    break;
                                    case 'deleted':
                                        echo 'Tags deleted successfully.';
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
                    <?php if (!empty($tags)): ?>
                        <?php foreach ($tags as $tag): ?>
                            <tr class="border-b hover:bg-gray-100">
                                <td class="px-4 py-3"><?php echo $tag['id']; ?></td>
                                <td class="px-4 py-3"><?php echo htmlspecialchars($tag['name']); ?></td>
                                <td class="px-4 py-3">
                                    <button onclick='openModal("edit", <?php echo json_encode($tag); ?>)' class="text-blue-600 hover:underline">Edit</button>
                                    <a href="index.php?action=delete_tag&id=<?php echo $tag['id']; ?>" onclick="return confirm('Are you sure?');" class="text-red-600 hover:underline">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="px-4 py-3 text-center">No tags found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </main>
    </div>
</div>

<!-- Modal -->
<div id="tagModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded shadow-lg w-96">
        <h2 id="modalTitle" class="text-xl font-bold mb-4"></h2>
        <form id="tagForm" method="POST" action="">
    <div class="mb-4">
        <label for="tagName" class="block text-gray-700 font-medium mb-2">Name:</label>
        <input type="text" id="tagName" name="name" class="w-full px-3 py-2 border rounded" required>
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
     function openModal(action, tag = {}) {
         const modal = document.getElementById('tagModal');
         modal.classList.remove('hidden');
         document.getElementById('modalTitle').textContent = action === 'create' ? 'Create tag' : 'Edit tag';
         document.getElementById('tagForm').action = action === 'create' ? 'index.php?action=create_tag' : `index.php?action=update_tag&id=${tag.id}`;
         document.getElementById('tagName').value = tag.name || '';
     }

     function closeModal() {
         document.getElementById('tagModal').classList.add('hidden');
     }
 </script>
</html>