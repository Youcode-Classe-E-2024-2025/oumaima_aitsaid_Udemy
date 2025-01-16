<!-- views/courseListView.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="min-h-screen bg-light-gray">
        <nav class="bg-red-600 text-white p-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold">Youdemy</h1>
            <div>
                <a href="?action=courses" class="text-white hover:text-gray-200 mx-3">Courses</a>
                <a href="#" class="text-white hover:text-gray-200 mx-3">Sign In</a>
                <a href="#" class="text-white hover:text-gray-200 mx-3">Sign Up</a>
            </div>
        </nav>

        <!-- --------------------------------------------------Course Catalog-------------------------- -->
        <section class="p-10 bg-white">
            <h2 class="text-2xl font-semibold text-gray-800 mb-5">Course Catalog</h2>

            <!-- ------------------------------------Search ------------------------------------------------------ -->
            <form method="get" action="?action=courses" class="mb-5">
                <input type="text" name="search" placeholder="Search courses..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" class="border p-2 rounded-md">
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md">Search</button>
            </form>

            <div class="grid grid-cols-3 gap-8">
                <?php if (!empty($courses)): ?>
                    <?php foreach ($courses as $course): ?>
                    <div class="bg-gray-50 p-5 rounded-lg shadow">
                        <h3 class="font-semibold text-lg text-red-600"><?= htmlspecialchars($course['title']) ?></h3>
                        <p class="text-gray-700"><?= htmlspecialchars($course['description']) ?></p>
                        <p class="text-gray-600">Category: <?= htmlspecialchars($course['category'] ?? '')  ?></p>
                        <p class="text-gray-600">Teacher: <?= htmlspecialchars($course['teacher_name']) ?></p>
                        <button class="bg-yellow-500 text-white px-5 py-2 rounded-md mt-4">Enroll Now</button>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No courses available.</p>
                <?php endif; ?>
            </div>

            <!--------------------------------------------- Pagination ------------------------------------------------------->
            <div class="mt-5 flex justify-center space-x-4">
                <?php if ($currentPage > 1): ?>
                    <a href="?action=courses&page=1<?= isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '' ?>" class="text-red-600 hover:text-red-800">First</a>
                    <a href="?action=courses&page=<?= $currentPage - 1 ?><?= isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '' ?>" class="text-red-600 hover:text-red-800">Previous</a>
                <?php endif; ?>
                
                <span class="text-gray-800">Page <?= $currentPage ?> of <?= $totalPages ?></span>

                <?php if ($currentPage < $totalPages): ?>
                    <a href="?action=courses&page=<?= $currentPage + 1 ?><?= isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '' ?>" class="text-red-600 hover:text-red-800">Next</a>
                    <a href="?action=courses&page=<?= $totalPages ?><?= isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '' ?>" class="text-red-600 hover:text-red-800">Last</a>
                <?php endif; ?>
            </div>
        </section>

        <?php include 'footer.php'?>
    </div>
</body>
</html>
