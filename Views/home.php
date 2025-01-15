<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<div class="min-h-screen bg-light-gray">
  <!-- Navbar -->
  <nav class="bg-red-600 text-white p-4 flex justify-between items-center">
    <h1 class="text-xl font-semibold">Youdemy</h1>
    <div>
      <a href="/youdemy/index.php?action=courses" class="text-white hover:text-gray-200 mx-3">Courses</a>
      <a href="#" class="text-white hover:text-gray-200 mx-3">Sign In</a>
      <a href="#" class="text-white hover:text-gray-200 mx-3">Sign Up</a>
    </div>
  </nav>

  <section class="bg-red-600 text-white p-10 text-center">
    <h2 class="text-3xl font-bold">Welcome to Youdemy</h2>
    <p class="text-lg mt-2">Find the best courses to boost your skills!</p>
    <div class="mt-5">
      <input type="text" placeholder="Search for courses..." class="p-3 w-1/3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-red-400">
      <button class="bg-yellow-500 text-white px-5 py-3 rounded-md ml-2">Search</button>
    </div>
  </section>

  <!-- Course Categories -->
  <section class="p-10">
    <h2 class="text-2xl font-semibold text-gray-800 mb-5">Browse by Categories</h2>
    <div class="flex space-x-6">
      <div class="bg-white p-5 rounded-lg shadow">
        <h3 class="text-lg font-semibold text-red-600">Web Development</h3>
        <p class="text-gray-700">Explore web development courses.</p>
        <a href="#" class="text-red-600 hover:text-red-700 mt-2 inline-block">View Courses</a>
      </div>
      <div class="bg-white p-5 rounded-lg shadow">
        <h3 class="text-lg font-semibold text-red-600">Data Science</h3>
        <p class="text-gray-700">Learn data science skills.</p>
        <a href="#" class="text-red-600 hover:text-red-700 mt-2 inline-block">View Courses</a>
      </div>
      <div class="bg-white p-5 rounded-lg shadow">
        <h3 class="text-lg font-semibold text-red-600">Business</h3>
        <p class="text-gray-700">Courses on business management.</p>
        <a href="#" class="text-red-600 hover:text-red-700 mt-2 inline-block">View Courses</a>
      </div>
      <div class="bg-white p-5 rounded-lg shadow">
        <h3 class="text-lg font-semibold text-red-600">Marketing</h3>
        <p class="text-gray-700">Explore marketing courses.</p>
        <a href="#" class="text-red-600 hover:text-red-700 mt-2 inline-block">View Courses</a>
      </div>
    </div>
  </section>

 
  <!-- Footer -->
<?php include 'footer.php'?>
</div>
