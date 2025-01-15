<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="">

<div class="min-h-screen bg-gray-50 flex flex-col">
  <!-- Navbar -->
  <nav class="bg-red-600 text-white p-4 flex justify-between items-center">
    <h1 class="text-xl font-semibold">Admin Dashboard</h1>
    <div>
      <a href="#" class="text-white hover:text-gray-200 mx-3">Dashboard</a>
      <a href="#" class="text-white hover:text-gray-200 mx-3">User Management</a>
      <a href="#" class="text-white hover:text-gray-200 mx-3">Course Management</a>
      <a href="#" class="text-white hover:text-gray-200 mx-3">Analytics</a>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="bg-red-600 text-white p-10 text-center">
    <h2 class="text-3xl font-bold">Welcome, Admin!</h2>
    <p class="text-lg mt-2">Manage the platform, courses, and users efficiently.</p>
  </section>

  <!-- Platform Overview -->
  <section class="p-10">
    <h2 class="text-2xl font-semibold text-gray-800 mb-5">Platform Overview</h2>
    <div class="grid grid-cols-4 gap-8">
      <div class="bg-white p-5 rounded-lg shadow">
        <h3 class="font-semibold text-lg text-red-600">Total Courses</h3>
        <p class="text-gray-700">320</p>
      </div>
      <div class="bg-white p-5 rounded-lg shadow">
        <h3 class="font-semibold text-lg text-red-600">Total Users</h3>
        <p class="text-gray-700">1,500</p>
      </div>
      <div class="bg-white p-5 rounded-lg shadow">
        <h3 class="font-semibold text-lg text-red-600">Active Users</h3>
        <p class="text-gray-700">1,200</p>
      </div>
      <div class="bg-white p-5 rounded-lg shadow">
        <h3 class="font-semibold text-lg text-red-600">Revenue</h3>
        <p class="text-gray-700">$5,000</p>
      </div>
    </div>
  </section>

  <!-- User Management -->
  <section class="p-10">
    <h2 class="text-2xl font-semibold text-gray-800 mb-5">User Management</h2>
    <div class="bg-white p-5 rounded-lg shadow">
      <h3 class="font-semibold text-lg text-red-600 mt-3">Users List</h3>
      <p class="text-gray-700">View, approve, suspend, or remove users.</p>
      <a href="#" class="text-red-600 hover:text-red-700 mt-2 inline-block">Manage Users</a>
    </div>
  </section>

  <!-- Course Management -->
  <section class="p-10">
    <h2 class="text-2xl font-semibold text-gray-800 mb-5">Course Management</h2>
    <div class="bg-white p-5 rounded-lg shadow">
      <h3 class="font-semibold text-lg text-red-600 mt-3">Courses Overview</h3>
      <p class="text-gray-700">Approve new courses, manage course content, and view course enrollment.</p>
      <a href="#" class="text-red-600 hover:text-red-700 mt-2 inline-block">Manage Courses</a>
    </div>
  </section>

  <!-- Analytics and Reporting -->
  <section class="p-10">
    <h2 class="text-2xl font-semibold text-gray-800 mb-5">Platform Analytics</h2>
    <div class="grid grid-cols-2 gap-8">
      <div class="bg-white p-5 rounded-lg shadow">
        <h3 class="font-semibold text-lg text-red-600 mt-3">Student Engagement</h3>
        <p class="text-gray-700">Track active students and engagement rate.</p>
        <a href="#" class="text-red-600 hover:text-red-700 mt-2 inline-block">View Report</a>
      </div>
      <div class="bg-white p-5 rounded-lg shadow">
        <h3 class="font-semibold text-lg text-red-600 mt-3">Revenue Reports</h3>
        <p class="text-gray-700">View detailed financials, payments, and earnings.</p>
        <a href="#" class="text-red-600 hover:text-red-700 mt-2 inline-block">View Report</a>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white p-5 text-center">
    <p>&copy; 2025 Youdemy. All rights reserved.</p>
  </footer>
</div>
