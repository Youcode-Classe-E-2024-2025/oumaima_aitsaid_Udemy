<?php include 'header.php'; ?>

<main class="bg-gray-900 text-gray-100 py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center text-purple-600 mb-6">Login to Your Account</h1>
        
        <form action="/youdemy/index.php?action=login" method="POST" class="space-y-6">
            <div class="mb-4">
                <label for="email" class="block text-gray-800 font-medium mb-2">Email Address</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-md text-gray-800 focus:outline-none focus:ring-2 focus:ring-purple-600" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-800 font-medium mb-2">Password</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-md text-gray-800 focus:outline-none focus:ring-2 focus:ring-purple-600" required>
            </div>

            <button type="submit" class="w-full bg-purple-600 text-white py-3 rounded-md font-semibold hover:bg-purple-700 transition duration-300">Login</button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">Don't have an account? <a href="index.php?action=register" class="text-purple-600 hover:text-purple-800 font-semibold">Sign Up</a></p>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>
