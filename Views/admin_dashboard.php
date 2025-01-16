<?php include 'sideBar.php'?>

    <div class="flex-1 overflow-x-hidden overflow-y-auto">
        <header class="bg-white shadow-md p-4">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">Dashboard</h2>
                <div class="flex items-center">
                    <img src="https://via.placeholder.com/40" alt="Admin" class="w-8 h-8 rounded-full">
                </div>
            </div>
        </header>

        <main class="p-6">
            <section class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-gray-500 text-sm font-medium">Total Users</h3>
                    <p class="text-3xl font-bold text-gray-800"><?= number_format($stats['total_users']) ?></p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-gray-500 text-sm font-medium">Total Courses</h3>
                    <p class="text-3xl font-bold text-gray-800"><?= number_format($stats['total_courses']) ?></p>
                </div>
            </section>
            <section class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Courses by Category</h3>
                <canvas id="coursesByCategoryChart"></canvas>
            </section>
            <section class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Most Popular Course</h3>
                <p class="text-lg font-medium text-gray-700"><?= htmlspecialchars($stats['most_popular_course']['title']) ?></p>
                <p class="text-gray-600">Students Enrolled: <?= number_format($stats['most_popular_course']['student_count']) ?></p>
            </section>
            <section class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Top 3 Teachers</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Courses</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Students</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($stats['top_teachers'] as $teacher): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($teacher['username']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?= number_format($teacher['course_count']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?= number_format($teacher['student_count']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Top Teachers Comparison</h3>
                <canvas id="topTeachersChart"></canvas>
            </section>
        </main>
    </div>
</div>

<script>
    const coursesByCategoryCtx = document.getElementById('coursesByCategoryChart').getContext('2d');
    new Chart(coursesByCategoryCtx, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($stats['courses_by_category'], 'name')) ?>,
            datasets: [{
                label: 'Number of Courses',
                data: <?= json_encode(array_column($stats['courses_by_category'], 'count')) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const topTeachersCtx = document.getElementById('topTeachersChart').getContext('2d');
    new Chart(topTeachersCtx, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($stats['top_teachers'], 'username')) ?>,
            datasets: [
                {
                    label: 'Number of Courses',
                    data: <?= json_encode(array_column($stats['top_teachers'], 'course_count')) ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Number of Students',
                    data: <?= json_encode(array_column($stats['top_teachers'], 'student_count')) ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</body>
</html>

