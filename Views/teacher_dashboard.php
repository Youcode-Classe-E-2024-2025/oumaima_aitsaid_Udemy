<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<div class="min-h-screen bg-gray-50 flex flex-col">
  <nav class="bg-red-600 text-white p-4 flex justify-between items-center">
    <h1 class="text-xl font-semibold">Teacher Dashboard</h1>
    <div>
      <a href="#" class="text-white hover:text-gray-200 mx-3">Dashboard</a>
      <a href="#" class="text-white hover:text-gray-200 mx-3">My Courses</a>
      <a href="#" class="text-white hover:text-gray-200 mx-3">Statistics</a>
      <a href="#" class="text-white hover:text-gray-200 mx-3">Profile</a>
    </div>
  </nav>
  <section class="bg-red-600 text-white p-10 text-center">
    <h2 class="text-3xl font-bold">Welcome, Teacher!</h2>
    <p class="text-lg mt-2">Manage your courses, track student progress, and view your statistics.</p>
  </section>
  <section class="p-10">
    <h2 class="text-2xl font-semibold text-gray-800 mb-5">Your Courses</h2>
    <div class="grid grid-cols-3 gap-8">
      <div class="bg-white p-5 rounded-lg shadow">
        <img src="https://via.placeholder.com/300" alt="Course Image" class="w-full h-40 object-cover rounded-md">
        <h3 class="font-semibold text-lg text-red-600 mt-3">Course 1</h3>
        <p class="text-gray-700">Manage students and track course progress.</p>
        <a href="#" class="text-red-600 hover:text-red-700 mt-2 inline-block">Edit Course</a>
      </div>
      <div class="bg-white p-5 rounded-lg shadow">
        <img src="https://via.placeholder.com/300" alt="Course Image" class="w-full h-40 object-cover rounded-md">
        <h3 class="font-semibold text-lg text-red-600 mt-3">Course 2</h3>
        <p class="text-gray-700">Update course content and manage enrollments.</p>
        <a href="#" class="text-red-600 hover:text-red-700 mt-2 inline-block">Edit Course</a>
      </div>
    </div>
  </section>
  <section class="p-10">
    <h2 class="text-2xl font-semibold text-gray-800 mb-5">Your Statistics</h2>
    <div class="grid grid-cols-2 gap-8">
      <div class="bg-white p-5 rounded-lg shadow">
        <h3 class="font-semibold text-lg text-red-600 mt-3">Total Students</h3>
        <p class="text-gray-700">120</p>
      </div>
      <div class="bg-white p-5 rounded-lg shadow">
        <h3 class="font-semibold text-lg text-red-600 mt-3">Total Courses</h3>
        <p class="text-gray-700">5</p>
      </div>
    </div>
  </section>

<?php include 'footer.php'?>
</div>
