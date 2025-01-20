<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">My Courses</h1>

        <?php if (!empty($courses)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($courses as $course): ?>
                    <div class="bg-white shadow-md rounded px-6 py-4">
                        <h2 class="text-xl font-bold"><?= htmlspecialchars($course['title']); ?></h2>
                        <p class="text-gray-700 mt-2"><?= htmlspecialchars($course['description']); ?></p>
                        <p class="text-gray-500 mt-2"><strong>Category:</strong> <?= htmlspecialchars($course['category']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-700">You are not enrolled in any courses.</p>
        <?php endif; ?>
    </div>
    <?php if (isset($_GET['alert']) && $_GET['alert'] == 'already_enrolled'): ?>
    <script>
        Swal.fire({
            title: 'You are already enrolled!',
            text: 'You have already enrolled in this course.',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
    </script>
<?php endif; ?>

</body>
</html>
