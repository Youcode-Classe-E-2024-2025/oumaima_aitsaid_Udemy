<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course - YouDemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplemde@1.11.2/dist/simplemde.min.css">
    <script src="https://cdn.jsdelivr.net/npm/simplemde@1.11.2/dist/simplemde.min.js"></script>
<!--tagify-->
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold">Edit Course</h1>
            <a href="index.php?action=dashboard" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to Dashboard
            </a>
        </div>

        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Course Title</label>
                <div class="relative">
                    <i class="fas fa-heading absolute left-3 top-3 text-gray-400"></i>
                    <input type="text" name="title" value="<?php echo $course['title']; ?>" required
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Course Description</label>
                <div class="relative">
                    <i class="fas fa-align-left absolute left-3 top-3 text-gray-400"></i>
                    <textarea name="description" rows="4" required
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500"><?php echo $course['description']; ?></textarea>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <div class="relative">
                    <i class="fas fa-folder absolute left-3 top-3 text-gray-400"></i>
                    <select name="category_id" required class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg">
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>" <?php echo ($category['id'] == $course['category_id']) ? 'selected' : ''; ?>>
                                <?= $category['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="mb-6">
    <label class="block text-sm font-medium text-gray-700 mb-1">Tags (Max 3)</label>
    <input name='tags' class='tagify-input' value='<?php echo json_encode($currentTags); ?>'>
</div>


<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">Current Resources</label>
    <div class="space-y-2">
        <?php foreach ($resources as $resource): ?>
            <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                <span><?php echo $resource['title']; ?></span>
                <button type="button" onclick="deleteResource(<?php echo $resource['id']; ?>)" 
                    class="text-red-600 hover:text-red-800">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700 mb-1">Add New Resource</label>
    <select name="resource_type" id="resource_type" onchange="toggleResourceFields()"
        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg">
        <option value="">Select Resource Type</option>
        <option value="video">Video</option>
        <option value="document">Document</option>
    </select>
</div>

<div id="videoFields" class="hidden">
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Video Title</label>
        <input type="text" name="resource_title" placeholder="Enter video title"
            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg">
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Upload Video</label>
        <input type="file" name="resource" accept="video/*"
            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg">
    </div>
</div>

<div id="documentFields" class="hidden">
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Document Title</label>
        <input type="text" name="resource_title" placeholder="Enter document title"
            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg">
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Markdown Content</label>
        <textarea id="markdown-editor" name="content_text" class="hidden"></textarea>
    </div>
</div>


            <div class="mb-4">
                <button type="submit" class="w-full bg-purple-600 text-white py-2 px-4 rounded-lg hover:bg-purple-700">
                    <i class="fas fa-save mr-2"></i>Update Course
                </button>
            </div>

          
        </form>
    </div>
    <script>
        
const input = document.querySelector('input[name=tags]');
const tagify = new Tagify(input, {
    maxTags: 3,
    whitelist: <?php echo json_encode(array_map(function($tag) {
        return ['id' => $tag['id'], 'value' => $tag['name']];
    }, $tags)); ?>,
    enforceWhitelist: true,
    dropdown: {
        maxItems: 20,
        classname: "tags-look",
        enabled: 0,
        closeOnSelect: false
    }
});
function deleteResource(resourceId) {
    if (confirm('Are you sure you want to delete this resource?')) {
        const formData = new FormData();
        formData.append('resource_id', resourceId);

        fetch('index.php?action=delete_resource', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const resourceElement = document.querySelector(`[data-resource-id="${resourceId}"]`);
                if (resourceElement) {
                    resourceElement.remove();
                }
            } else {
                alert('Failed to delete resource: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the resource');
        });
    }
}


function toggleResourceFields() {
    const resourceType = document.getElementById('resource_type').value;
    const videoFields = document.getElementById('videoFields');
    const documentFields = document.getElementById('documentFields');

    videoFields.classList.add('hidden');
    documentFields.classList.add('hidden');

    if (resourceType === 'video') {
        videoFields.classList.remove('hidden');
    } else if (resourceType === 'document') {
        documentFields.classList.remove('hidden');
    }
}
var simplemde = new SimpleMDE({
    element: document.getElementById("markdown-editor"),
    spellChecker: false
});
</script>

</body>
</html>