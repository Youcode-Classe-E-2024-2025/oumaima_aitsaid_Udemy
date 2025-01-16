<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Youdemy Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white">
        <div class="p-4">
            <h1 class="text-xl font-bold">Youdemy Admin</h1>
        </div>
        <nav class="mt-4">
            <a href="index.php?action=admin_dashboard" class="block py-2 px-4 hover:bg-gray-700">Dashboard</a>
            <a href="index.php?action=manage_users" class="block py-2 px-4 bg-gray-900">User Management</a>
            <a href="index.php?action=list_courses" class="block py-2 px-4 hover:bg-gray-700">Course Management</a>
            <a href="index.php?action=categories" class="block py-2 px-4 hover:bg-gray-700">Categories</a>
            <a href="index.php?action=settings" class="block py-2 px-4 hover:bg-gray-700">Settings</a>
        </nav>
        <div class="absolute bottom-0 w-64 p-4">
            <a href="index.php?action=logout" class="block w-full py-2 px-4 bg-red-600 text-center rounded hover:bg-red-700">Logout</a>
        </div>
    </aside>
    <div class="flex-1 overflow-x-hidden overflow-y-auto">
        <header class="bg-white shadow-md p-4">
            <div class="flex justify-between items-center">
                <button onclick="history.back()" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">Back</button>
                <h2 class="text-xl font-semibold text-gray-800">User Management</h2>
                <div class="flex items-center">
                    <img src="https://via.placeholder.com/40" alt="Admin" class="w-8 h-8 rounded-full">
                </div>
            </div>
        </header>

        <main class="p-6">
            <h1 class="text-2xl font-bold mb-6">Manage Users</h1>

            <table class="w-full bg-white shadow-lg rounded overflow-hidden">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">Username</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Role</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Validate Teacher</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-3"><?php echo htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="px-4 py-3"><?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="px-4 py-3"><?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="px-4 py-3"><?php echo htmlspecialchars($user['role'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="px-4 py-3">
                                <?php echo $user['is_active'] ? '<span class="text-green-600">Active</span>' : '<span class="text-red-600">Inactive</span>'; ?>
                            </td>
                            <td class="px-4 py-3">
                                <?php if ($user['role'] === 'teacher'): ?>
                                    <?php if ($user['validated']): ?>
                                        <span class="text-green-600">Validated</span>
                                    <?php else: ?>
                                        <span class="text-yellow-600">Pending Validation</span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3">
                                <form action="index.php?action=manage_users" method="POST" class="inline">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <?php if ($user['role'] === 'teacher' && !$user['validated']): ?>
                                        <button type="submit" name="action" value="validate" class="text-blue-600 hover:underline">Validate</button>
                                    <?php endif; ?>
                                    <?php if ($user['is_active']): ?>
                                        <button type="submit" name="action" value="suspend" class="text-yellow-600 hover:underline">Suspend</button>
                                    <?php else: ?>
                                        <button type="submit" name="action" value="activate" class="text-green-600 hover:underline">Activate</button>
                                    <?php endif; ?>
                                    <button type="submit" name="action" value="delete" class="text-red-600 hover:underline">Delete</button>
                                </form>
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
