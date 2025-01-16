<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management - Youdemy Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body class="bg-gray-100">

<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white">
        <div class="p-4">
            <h1 class="text-xl font-bold">Youdemy Admin</h1>
        </div>
        <nav class="mt-4">
            <a href="index.php?action=admin_dashboard" class="block py-2 px-4 hover:bg-gray-700">Statistique</a>
            <a href="index.php?action=manage_users" class="block py-2 px-4 hover:bg-gray-700">User Management</a>
            <a href="index.php?action=list_courses" class="block py-2 px-4 bg-gray-900">Course Management</a>
            <a href="index.php?action=categories" class="block py-2 px-4 hover:bg-gray-700">Categories Management</a>
            <a href="index.php?action=Tags" class="block py-2 px-4 hover:bg-gray-700">Tags Management</a>
        </nav>
        <div class="absolute bottom-0 w-64 p-4">
            <a href="index.php?action=logout" class="block w-full py-2 px-4 bg-red-600 text-center rounded hover:bg-red-700">Logout</a>
        </div>
    </aside>