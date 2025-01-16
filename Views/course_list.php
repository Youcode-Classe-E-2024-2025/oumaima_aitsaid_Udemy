<?php include 'sideBar.php'?>
    <div class="flex-1 overflow-x-hidden overflow-y-auto">
        <header class="bg-white shadow-md p-4">
            <div class="flex justify-between items-center">
                <button onclick="history.back()" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">Back</button>
                <h2 class="text-xl font-semibold text-gray-800">Course Management</h2>
                <div class="flex items-center">
                    <img src="https://via.placeholder.com/40" alt="Admin" class="w-8 h-8 rounded-full">
                </div>
            </div>
        </header>

        <main class="p-6">
            <h1 class="text-2xl font-bold mb-6">Liste des Cours</h1>

            <table class="w-full bg-white shadow-lg rounded overflow-hidden">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Titre</th>
                        <th class="px-4 py-3">Description</th>
                        <th class="px-4 py-3">Enseignant</th>
                        <th class="px-4 py-3">Catégorie</th>
                        <th class="px-4 py-3">Date de Création</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($courses as $course): ?>
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-3"><?php echo htmlspecialchars($course['id']); ?></td>
                            <td class="px-4 py-3"><?php echo htmlspecialchars($course['title']); ?></td>
                            <td class="px-4 py-3"><?php echo htmlspecialchars($course['description']); ?></td>
                            <td class="px-4 py-3"><?php echo htmlspecialchars($course['teacher'] ?? ''); ?></td>
                            <td class="px-4 py-3"><?php echo htmlspecialchars($course['category'] ?? ''); ?></td>
                            <td class="px-4 py-3"><?php echo htmlspecialchars($course['created_at']); ?></td>
                            <td class="px-4 py-3">
                                <a href="index.php?action=delete_course&id=<?php echo $course['id']; ?>" class="text-red-600 hover:underline">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</div>

</body>
</html>
