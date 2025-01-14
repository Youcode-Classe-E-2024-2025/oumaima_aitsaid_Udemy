<?php include 'header.php'; ?>
<main class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Register</h1>
    <form action="index.php?action=register" method="POST" class="bg-white p-6 rounded shadow-md max-w-md mx-auto">
        <div class="mb-4">
            <label for="username" class="block text-gray-700">Name</label>
            <input type="text" name="username" id="name" class="w-full px-4 py-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="role" class="block text-gray-700">Role</label>
            <select name="role" id="role" class="w-full px-4 py-2 border rounded" required>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
            </select>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Register</button>
    </form>
</main>
<?php include 'footer.php'; ?>
