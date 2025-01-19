<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Enrollments - YouDemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold">Course Enrollments</h1>
            <a href="index.php?action=dashboard" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to Dashboard
            </a>
        </div>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="text-2xl font-bold mb-4"><?php echo htmlspecialchars($course['title']); ?></h2>
            
            <?php if (empty($enrollments)): ?>
                <p class="text-gray-600">No enrollments for this course yet.</p>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Student Name</th>
                                <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Email</th>
                                <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Enrollment Date</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            <?php foreach ($enrollments as $enrollment): ?>
                                <tr>
                                    <td class="w-1/3 text-left py-3 px-4"><?php echo htmlspecialchars($enrollment['username']); ?></td>
                                    <td class="w-1/3 text-left py-3 px-4"><?php echo htmlspecialchars($enrollment['email']); ?></td>
                                    <td class="text-left py-3 px-4"><?php echo date('F j, Y', strtotime($enrollment['enrolled_at'])); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

