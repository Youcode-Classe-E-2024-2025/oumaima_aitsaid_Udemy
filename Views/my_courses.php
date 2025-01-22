<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                <i class="fas fa-graduation-cap mr-2 text-purple-600"></i>
                My Learning Journey
            </h1>
            <div class="flex gap-4">
                <button class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">
                    <i class="fas fa-filter mr-2"></i>Filter
                </button>
                <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                    <i class="fas fa-sort mr-2"></i>Sort
                </button>
            </div>
        </div>

        <?php if (!empty($courses)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($courses as $course): ?>
                    <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                        <div class="h-48 bg-purple-100">
                            <img src="uploads/cours.jpg" alt="<?= htmlspecialchars($course['title']); ?>" 
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="bg-purple-100 text-purple-600 text-sm px-3 py-1 rounded-full">
                                    <?= htmlspecialchars($course['category']); ?>
                                </span>
                                <span class="bg-green-100 text-green-600 text-sm px-3 py-1 rounded-full">
                                    In Progress
                                </span>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800 mb-3">
                                <?= htmlspecialchars($course['title']); ?>
                            </h2>
                            <p class="text-gray-600 mb-4">
                                <?= htmlspecialchars($course['description']); ?>
                            </p>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-clock text-gray-400"></i>
                                    <span class="text-sm text-gray-500">6h 30min</span>
                                </div>
                                <button class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">
                                    Continue Learning
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-16">
                <i class="fas fa-books text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-600 text-xl">You haven't enrolled in any courses yet.</p>
                <a href="index.php?action=courses" class="inline-block mt-4 bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition">
                    Browse Courses
                </a>
            </div>
        <?php endif; ?>
    </div>

    <?php if (isset($_GET['alert']) && $_GET['alert'] == 'already_enrolled'): ?>
        <script>
            Swal.fire({
                title: 'Already Enrolled',
                text: 'You are already learning this course!',
                icon: 'info',
                confirmButtonText: 'Continue Learning',
                confirmButtonColor: '#9333ea'
            });
        </script>
    <?php endif; ?>
</body>
</html>
