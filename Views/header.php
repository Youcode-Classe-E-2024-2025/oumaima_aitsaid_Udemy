<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Courses</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .gradient-text {
            background: linear-gradient(45deg, rgb(142, 13, 255), rgb(175, 0, 238));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-overlay {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.9));
        }

        .course-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .course-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .course-image {
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            width: 100%;
        }

        .btn-primary {
            background-color: #6f42c1;
            color: white;
            border-radius: 4px;
            padding: 10px 20px;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #5a2e8f;
        }

        .btn-secondary {
            background-color: #ffdd57;
            color: black;
            border-radius: 4px;
            padding: 10px 20px;
        }

        .btn-secondary:hover {
            background-color: #e0c446;
        }
    </style>
</head>

<body class="bg-gray-900 text-gray-100">

    <!-- Navigation -->
    <nav class="bg-gray-900 shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-graduation-cap text-3xl gradient-text"></i>
                    <span class="font-bold text-2xl text-white gradient-text">Youdemy</span>
                </div>
                <div class="flex items-center space-x-8">
                    <a href="index.php?action=courses" class="text-white hover:text-yellow-400">Courses</a>
                    <a href="index.php?action=login" class="text-white hover:text-yellow-400">Sign In</a>
                    <a href="index.php?action=register"  class="text-white hover:text-yellow-400">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>