<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($course['title']); ?> - YouDemy</title>
    <script src="https://cdn.tailwindcss.com"></script>    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold"><?php echo htmlspecialchars($course['title']); ?></h1>
            <a href="index.php?action=dashboard" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to Dashboard
            </a>
        </div>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <h2 class="text-xl font-bold mb-2">Description</h2>
                <p class="text-gray-700"><?php echo nl2br(htmlspecialchars($course['description'])); ?></p>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-bold mb-2">Category</h2>
                <p class="text-gray-700"><?php echo htmlspecialchars($course['category_name']); ?></p>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-bold mb-2">Tags</h2>
                <div class="flex flex-wrap">
                    <?php foreach ($course['tags'] as $tag): ?>
                        <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded"><?php echo htmlspecialchars($tag['name']); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-bold mb-2">Resources</h2>
                <?php if (empty($course['resources'])): ?>
                    <p class="text-gray-700">No resources available for this course.</p>
                <?php else: ?>
                    <ul class="list-disc list-inside">
                        <?php foreach ($course['resources'] as $resource): ?>
                            <li class="mb-2">
                                <span class="font-medium"><?php echo htmlspecialchars($resource['title']); ?></span>
                                (<?php echo ucfirst($resource['type']); ?>)
                                <a href="<?php echo htmlspecialchars($resource['file_path']); ?>" target="_blank" class="text-blue-600 hover:underline">View</a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>

