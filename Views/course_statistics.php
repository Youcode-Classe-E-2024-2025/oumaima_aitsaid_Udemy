<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Statistics - YouDemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold">Course Statistics</h1>
            <a href="index.php?action=dashboard" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Back to Dashboard
            </a>
        </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">An error occurred while fetching statistics.</span>
            </div>
        <?php endif; ?>

        <!-- Main Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold">Total Courses</h2>
                    <i class="fas fa-book text-blue-600 text-2xl"></i>
                </div>
                <p class="text-4xl font-bold text-blue-600">
                    <?php echo isset($statistics['total_courses']) ? number_format($statistics['total_courses']) : '0'; ?>
                </p>
            </div>

            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold">Total Students</h2>
                    <i class="fas fa-users text-green-600 text-2xl"></i>
                </div>
                <p class="text-4xl font-bold text-green-600">
                    <?php echo isset($statistics['total_students']) ? number_format($statistics['total_students']) : '0'; ?>
                </p>
            </div>

            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold">Avg. Courses per Student</h2>
                    <i class="fas fa-chart-line text-purple-600 text-2xl"></i>
                </div>
                <p class="text-4xl font-bold text-purple-600">
                    <?php echo isset($statistics['avg_courses_per_student']) ? number_format($statistics['avg_courses_per_student'], 2) : '0.00'; ?>
                </p>
            </div>
        </div>

        <!-- Category Distribution -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div class="bg-white shadow-md rounded p-6">
                <h2 class="text-xl font-semibold mb-4">Category Distribution</h2>
                <?php if (!empty($statistics['category_distribution'])): ?>
                    <div class="space-y-4">
                        <?php foreach ($statistics['category_distribution'] as $category): ?>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span><?php echo htmlspecialchars($category['category']); ?></span>
                                    <span class="font-medium"><?php echo $category['count']; ?></span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <?php $percentage = ($category['count'] / $statistics['total_courses']) * 100; ?>
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: <?php echo $percentage; ?>%"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">No category data available</p>
                <?php endif; ?>
            </div>

            <!-- Most Popular Course -->
            <div class="bg-white shadow-md rounded p-6">
                <h2 class="text-xl font-semibold mb-4">Most Popular Course</h2>
                <?php if (isset($statistics['most_popular_course']) && $statistics['most_popular_course']): ?>
                    <div class="space-y-2">
                        <h3 class="text-lg font-medium"><?php echo htmlspecialchars($statistics['most_popular_course']['title']); ?></h3>
                        <p class="text-gray-600">
                            <span class="font-medium"><?php echo number_format($statistics['most_popular_course']['student_count']); ?></span>
                            enrolled students
                        </p>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">No course data available</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Top Teachers -->
        <div class="bg-white shadow-md rounded p-6">
            <h2 class="text-xl font-semibold mb-4">Top Teachers</h2>
            <?php if (!empty($statistics['top_teachers'])): ?>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php foreach ($statistics['top_teachers'] as $index => $teacher): ?>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <?php 
                                    $medals = ['🥇', '🥈', '🥉'];
                                    echo $medals[$index] ?? '🏅';
                                    ?>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        <?php echo htmlspecialchars($teacher['username']); ?>
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        <?php echo number_format($teacher['course_count']); ?> courses
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        <?php echo number_format($teacher['student_count']); ?> students
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-gray-500">No teacher data available</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animate numbers
            const numbers = document.querySelectorAll('.text-4xl');
            numbers.forEach(number => {
                number.style.opacity = '0';
                number.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    number.style.transition = 'all 0.5s ease-out';
                    number.style.opacity = '1';
                    number.style.transform = 'translateY(0)';
                }, 100);
            });

            // Animate progress bars
            const bars = document.querySelectorAll('.bg-blue-600');
            bars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0';
                setTimeout(() => {
                    bar.style.transition = 'width 1s ease-out';
                    bar.style.width = width;
                }, 200);
            });
        });
    </script>
</body>
</html>

