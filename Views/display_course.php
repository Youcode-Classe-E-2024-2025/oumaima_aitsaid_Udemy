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
    <div class="flex flex-wrap gap-2">
        <?php 
        if (!empty($course['tags'])): ?>
            <?php foreach ($course['tags'] as $tag): ?>
                <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
                    <i class="fas fa-tag mr-1"></i>
                    <?php echo htmlspecialchars($tag['name']); ?>
                </span>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-500 italic">No tags for this course</p>
        <?php endif; ?>
    </div>
</div>

            <div class="mb-4">
    <h2 class="text-xl font-bold mb-2">Resources</h2>
    <?php 
    $displayedResources = [];
    if (!empty($course['resources'])): ?>
        <ul class="space-y-4">
            <?php foreach ($course['resources'] as $resource): 
                if (in_array($resource['id'], $displayedResources)) continue;
                $displayedResources[] = $resource['id'];
            ?>
                <li class="border rounded-lg p-4">
                    <div class="font-medium text-lg mb-2"><?php echo htmlspecialchars($resource['title']); ?></div>
                    
                    <?php if ($resource['type'] === 'video'): ?>
                        <div class="aspect-w-16 aspect-h-9 mb-2">
                            <video controls class="w-full rounded-lg">
                                <source src="<?php echo htmlspecialchars($resource['file_path']); ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    <?php endif; ?>
                    
                    <div class="flex items-center gap-2">
                        <span class="bg-gray-100 px-2 py-1 rounded text-sm"><?php echo ucfirst($resource['type']); ?></span>
                        <a href="<?php echo htmlspecialchars($resource['file_path']); ?>" target="_blank" 
                           class="text-blue-600 hover:text-blue-800 transition-colors">
                            <i class="fas fa-external-link-alt mr-1"></i>Open in new tab
                        </a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p class="text-gray-700">No resources available for this course.</p>
    <?php endif; ?>
</div>
        </div>
    </div>
</body>
</html>

