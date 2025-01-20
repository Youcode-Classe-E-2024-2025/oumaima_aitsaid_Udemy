

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher - YouDemy</title>
 <script src="https://cdn.tailwindcss.com"></script>    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="../../assets/images/favicon.png" type="image/x-icon">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #ffffff;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            padding: 20px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 12px;
            margin: 8px 0;
            color: #4b5563;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar a:hover {
            background-color: #f3f4f6;
            color: #111827;
        }

        .sidebar a i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        .sidebar .active {
            background-color: #4f46e5;
            color: white;
        }

        .sidebar .active:hover {
            background-color: #4338ca;
        }

        .main-content {
            margin-left: 250px;
            padding: 24px;
        }


        .card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding: 10px;
            }

            .main-content {
                margin-left: 0;
                padding: 16px;
            }
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <a href="#" class="active">
            <i class="fas fa-tachometer-alt"></i>
            Dashboard
        </a>
        
        <a href="index.php?action=add_course">
            <i class="fas fa-users"></i>
           Add New Course
        </a>
        <a href="#">
            <i class="fas fa-book"></i>
            My Courses
        </a>
        <a href="index.php?action=view_statistics">
            <i class="fas fa-chart-line"></i>
            Statistics
        </a>
       
        <a href="index.php?action=logout" class="text-gray-900 flex items-center">
            <i class="fas fa-sign-out-alt mr-2"></i>
            Log Out
        </a>
    </div>

    <div class="main-content">
        <section class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Welcome </h1>
            <p class="text-gray-600 mt-2">Here's an overview of your courses and activities.</p>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Analytics Overview</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="card p-6">
                    <h3 class="text-lg font-semibold text-gray-900">Total Students</h3>
                   
                    <p class="text-3xl font-bold text-purple-600 mt-2"><?php echo $total_students; ?></p>
                    <p class="text-sm text-gray-500">Enrolled in your courses</p>
                </div>
                <div class="card p-6">
                    <h3 class="text-lg font-semibold text-gray-900">Course Completion Rate</h3>
                    <p class="text-3xl font-bold text-blue-600 mt-2">78%</p>
                    <p class="text-sm text-gray-500">Average across all courses</p>
                </div>
                <div class="card p-6">
                    <h3 class="text-lg font-semibold text-gray-900">Student Satisfaction</h3>
                    <p class="text-3xl font-bold text-green-600 mt-2">4.5/5</p>
                    <p class="text-sm text-gray-500">Based on feedback</p>
                </div>
            </div>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="card p-6 text-center hover:bg-gray-50 cursor-pointer" onclick="openModal()">
                    <i class="fas fa-plus-circle text-2xl text-purple-600 mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-900">Create New Course</h3>
                    <p class="text-sm text-gray-500 mt-2">Start building a new course from scratch.</p>
                </div>
                <div class="card p-6 text-center hover:bg-gray-50 cursor-pointer">
                    <i class="fas fa-edit text-2xl text-blue-600 mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-900">Edit Existing Course</h3>
                    <p class="text-sm text-gray-500 mt-2">Update and improve your existing courses.</p>
                </div>
                <div class="card p-6 text-center hover:bg-gray-50 cursor-pointer">
                    <i class="fas fa-chart-line text-2xl text-green-600 mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-900">View Analytics</h3>
                    <p class="text-sm text-gray-500 mt-2">Track student progress and performance.</p>
                </div>
                <div class="card p-6 text-center hover:bg-gray-50 cursor-pointer">
                    <i class="fas fa-comments text-2xl text-orange-600 mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-900">Student Feedback</h3>
                    <p class="text-sm text-gray-500 mt-2">Read feedback from your students.</p>
                </div>
            </div>
        </section>
        <section class="mb-8">
    <h2 class="text-2xl font-bold mb-4">Your Courses</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($courses as $course): ?>
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <img src="assets/images/course_thumbnails/<?php echo !empty($course['thumbnail']) ? $course['thumbnail'] : 'placeholder.png'; ?>" alt="<?php echo $course['title']; ?>" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2"><?php echo $course['title']; ?></h3>
                    <p class="text-gray-600 mb-4"><?php echo substr($course['description'], 0, 100); ?>...</p>
                    <div class="flex space-x-4 mt-4">
                        <a href="index.php?action=display_course&id=<?php echo $course['id']; ?>" class="text-gray-800 hover:text-gray-600 transition-colors duration-200">View Course</a>
                        <a href="index.php?action=view_enrollments&id=<?php echo $course['id']; ?>" class="text-gray-800 hover:text-gray-600 transition-colors duration-200">View Enrollment</a>
                        <a href="index.php?action=delete_course&id=<?php echo $course['id']; ?>" class="text-red-600 hover:text-red-500 transition-colors duration-200" onclick="return confirm('Are you sure you want to delete this course?');">Delete</a>
                        <a href="index.php?action=edit_course&id=<?php echo $course['id']; ?>" class="text-blue-600 hover:text-blue-500 transition-colors duration-200">Edit</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
        <section class="mb-8">
        <h2 class="text-2xl font-bold mt-8 mb-4">Recent Activities</h2>
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <ul class="divide-y divide-gray-200">
                    <?php foreach ($recent_activities as $activity): ?>
                        <li class="p-4 hover:bg-gray-50">
                            <?php if ($activity['type'] === 'enrollment'): ?>
                                <p><strong><?php echo $activity['username']; ?></strong> enrolled in <strong><?php echo $activity['course_title']; ?></strong></p>
                            <?php else: ?>
                                <p>You created a new course: <strong><?php echo $activity['course_title']; ?></strong></p>
                            <?php endif; ?>
                            <p class="text-sm text-gray-500"><?php echo date('F j, Y, g:i a', strtotime($activity['date'])); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
    </div>

   
</div>
</body>

</html>