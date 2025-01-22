<?php include 'header.php'; ?>

<section class="relative min-h-screen flex items-center">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-r from-purple-900/90 to-blue-900/90 z-10"></div>
        <video class="w-full h-full object-cover" autoplay muted loop>
            <source src="uploads/background.mp4" type="video/mp4">
        </video>
    </div>

    <div class="container mx-auto px-4 relative z-20">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-6xl font-bold text-white mb-6">
                Unlock Your Potential with
                <span class="bg-gradient-to-r from-purple-400 to-pink-600 text-transparent bg-clip-text">
                    YouDemy
                </span>
            </h1>
            
            <p class="text-xl text-gray-200 mb-8">
                Join millions of learners worldwide and master new skills with our expert-led courses
            </p>
            
            <div class="flex gap-4 justify-center">
                <a href="#courses" 
                   class="px-8 py-4 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full text-white font-semibold hover:scale-105 transition-transform">
                    Explore Courses
                </a>
                <a href="#how-it-works" 
                   class="px-8 py-4 bg-white/10 backdrop-blur-sm rounded-full text-white font-semibold hover:bg-white/20 transition-colors">
                    How It Works
                </a>
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-gray-900 to-transparent z-10"></div>
</section>

<section class="py-12 px-6 bg-black">
    <h2 class="text-3xl font-semibold text-white mb-8 text-center">Explore Our Courses</h2>

    <form method="get" action="index.php?action=dashboardd" class="mb-8 max-w-3xl mx-auto flex items-center space-x-4">
    <input type="text" name="search" placeholder="Search courses..."
        value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" 
        class="w-full p-3 rounded-md text-gray-800">
    <input type="hidden" name="action" value="dashboardd">
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
                    <a href="index.php?action=displaycoursestudent&id=<?php echo $course['id']; ?>" class="text-gray-800 hover:text-gray-600 transition-colors duration-200">View Course</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-white text-center">No courses available.</p>
        <?php endif; ?>
    </div>

    <div class="mt-12 text-center">
        <div class="flex justify-center space-x-6">
        <?php if ($currentPage > 1): ?>
    <a href="index.php?action=dashboardd&page=1<?= $search ? '&search='.urlencode($search) : '' ?>" class="text-white hover:text-yellow-400">First</a>
    <a href="index.php?action=dashboardd&page=<?= $currentPage - 1 ?><?= $search ? '&search='.urlencode($search) : '' ?>" class="text-white hover:text-yellow-400">Previous</a>
<?php endif; ?>

<?php if ($currentPage < $totalPages): ?>
    <a href="index.php?action=dashboardd&page=<?= $currentPage + 1 ?><?= $search ? '&search='.urlencode($search) : '' ?>" class="text-white hover:text-yellow-400">Next</a>
    <a href="index.php?action=dashboardd&page=<?= $totalPages ?><?= $search ? '&search='.urlencode($search) : '' ?>" class="text-white hover:text-yellow-400">Last</a>
<?php endif; ?>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
