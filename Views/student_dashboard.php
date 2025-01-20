<?php include 'header.php'; ?>

<section class="relative h-[400px] bg-cover bg-center" style="background-image: url('uploads/study.jpg');">
    <div class="hero-overlay absolute inset-0 flex justify-center items-center text-center">
        <div>
            <h1 class="text-4xl sm:text-5xl font-bold text-white leading-tight mb-4">
                Transform Your Future with <span class="gradient-text">Youdemy</span>
            </h1>
            <p class="text-lg text-gray-300 mb-6">Start learning from world-class experts at your own pace. Join now!</p>
            <a href="#courses" class="btn-primary">Browse Courses</a>
        </div>
    </div>
</section>

<section class="py-12 px-6 bg-black">
    <h2 class="text-3xl font-semibold text-white mb-8 text-center">Explore Our Courses</h2>

    <form method="get" action="index.php?action=dashboardd" class="mb-8 max-w-3xl mx-auto flex items-center space-x-4">
    <input type="text" name="search" placeholder="Search courses..."
        value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" 
        class="w-full p-3 rounded-md text-gray-800">
    <input type="hidden" name="action" value="dashboard">
    <button type="submit" class="btn-primary">Search</button>
</form>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if (!empty($courses)): ?>
            <?php foreach ($courses as $course): ?>
                <div class="course-card bg-white p-6 rounded-lg shadow-lg">
                    <img src="uploads/cour.jpeg" alt="Course Image" class="course-image mb-6">
                    <h3 class="text-xl font-semibold text-purple-600 mb-2"><?= htmlspecialchars($course['title']) ?></h3>
                    <p class="text-gray-700 mb-4"><?= htmlspecialchars($course['description']) ?></p>
                    <p class="text-sm text-gray-600">Category: <?= htmlspecialchars($course['category'] ?? '') ?></p>
                    <p class="text-sm text-gray-600 mb-4">Instructor: <?= htmlspecialchars($course['teacher_name']) ?></p>
                    <a href="index.php?action=display_course&id=<?php echo $course['id']; ?>" class="text-gray-800 hover:text-gray-600 transition-colors duration-200">View Course</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-white text-center">No courses available.</p>
        <?php endif; ?>
    </div>

    <div class="mt-12 text-center">
        <div class="flex justify-center space-x-6">
        <?php if ($currentPage > 1): ?>
    <a href="index.php?action=dashboard&page=1<?= $search ? '&search='.urlencode($search) : '' ?>" class="text-white hover:text-yellow-400">First</a>
    <a href="index.php?action=dashboard&page=<?= $currentPage - 1 ?><?= $search ? '&search='.urlencode($search) : '' ?>" class="text-white hover:text-yellow-400">Previous</a>
<?php endif; ?>

<?php if ($currentPage < $totalPages): ?>
    <a href="index.php?action=dashboard&page=<?= $currentPage + 1 ?><?= $search ? '&search='.urlencode($search) : '' ?>" class="text-white hover:text-yellow-400">Next</a>
    <a href="index.php?action=dashboard&page=<?= $totalPages ?><?= $search ? '&search='.urlencode($search) : '' ?>" class="text-white hover:text-yellow-400">Last</a>
<?php endif; ?>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
