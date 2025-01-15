<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<div class="min-h-screen bg-gray-50 flex flex-col">
  <!-- Navbar -->
  <nav class="bg-red-400 text-white p-4 flex justify-between items-center">
    <h1 class="text-xl font-semibold">Youdemy</h1>
    <div>
      <a href="#" class="text-white hover:text-gray-200 mx-3">Home</a>
      <a href="#" class="text-white hover:text-gray-200 mx-3">My Courses</a>
      <a href="#" class="text-white hover:text-gray-200 mx-3">Profile</a>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="bg-red-600 text-white p-10 text-center">
    <h2 class="text-3xl font-bold">Welcome to Youdemy</h2>
    <p class="text-lg mt-2">Browse a wide variety of online courses and start learning today!</p>
  </section>

  <!-- Course Listings -->
  <section class="p-10">
    <h2 class="text-2xl font-semibold text-gray-800 mb-5">Popular Courses</h2>
    <div class="grid grid-cols-3 gap-8">
      <div class="bg-white p-5 rounded-lg shadow">
        <img src="https://via.placeholder.com/300" alt="Course Image" class="w-full h-40 object-cover rounded-md">
        <h3 class="font-semibold text-lg text-red-600 mt-3">Course 1</h3>
        <p class="text-gray-700">Learn the basics of web development.</p>
        <a href="#" class="text-red-600 hover:text-red-700 mt-2 inline-block">Enroll Now</a>
      </div>
      <div class="bg-white p-5 rounded-lg shadow">
        <img src="https://via.placeholder.com/300" alt="Course Image" class="w-full h-40 object-cover rounded-md">
        <h3 class="font-semibold text-lg text-red-600 mt-3">Course 2</h3>
        <p class="text-gray-700">Master Python programming from scratch.</p>
        <a href="#" class="text-red-600 hover:text-red-700 mt-2 inline-block">Enroll Now</a>
      </div>
      <div class="bg-white p-5 rounded-lg shadow">
        <img src="https://via.placeholder.com/300" alt="Course Image" class="w-full h-40 object-cover rounded-md">
        <h3 class="font-semibold text-lg text-red-600 mt-3">Course 3</h3>
        <p class="text-gray-700">Get certified in data science with real-world projects.</p>
        <a href="#" class="text-red-600 hover:text-red-700 mt-2 inline-block">Enroll Now</a>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white p-5 text-center">
    <p>&copy; 2025 Youdemy. All rights reserved.</p>
  </footer>
</div>
