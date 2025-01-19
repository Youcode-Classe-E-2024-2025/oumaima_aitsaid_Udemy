<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Course - YouDemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplemde@1.11.2/dist/simplemde.min.css">
    <script src="https://cdn.jsdelivr.net/npm/simplemde@1.11.2/dist/simplemde.min.js"></script>
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold">Add New Course</h1>
            <a href="index.php?action=dashboard" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to Dashboard
            </a>
        </div>

        <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?php echo $error; ?></span>
            </div>
        <?php endif; ?>

        <h1>Add Course</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Course Title</label>
                <div class="relative">
                    <i class="fas fa-heading absolute left-3 top-3 text-gray-400"></i>
                    <input type="text" name="title" placeholder="Enter course title" required
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Course Description</label>
                <div class="relative">
                    <i class="fas fa-align-left absolute left-3 top-3 text-gray-400"></i>
                    <textarea name="description" placeholder="Enter course description" rows="4" required
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"></textarea>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <div class="relative">
                    <i class="fas fa-folder absolute left-3 top-3 text-gray-400"></i>
                    <select name="category_id" required
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent appearance-none">
                        <option value="" disabled selected>Select Category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400 pointer-events-none"></i>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tags (Max 3)</label>
                <div class="flex flex-wrap gap-2 mb-2" id="selectedTags"></div>
                <div class="flex flex-wrap gap-2" id="tagOptions">
                    <?php foreach ($tags as $tag): ?>
                        <div class="tag-option">
                            <label>
                                <input type="checkbox" name="tags[]" value="<?= $tag['id'] ?>">
                                <?= $tag['name'] ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Resource Type</label>
                <select name="resource_type" id="resource_type" required onchange="toggleResourceFields()"
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent appearance-none">
                    <option value="video">Video</option>
                    <option value="document">Document</option>
                </select>
            </div>

            <div id="videoFields" class="hidden">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Video Title</label>
                    <input type="text" name="resource_title" placeholder="Enter video title" required
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload Video</label>
                    <input type="file" name="resource" accept="video/*" required
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
            </div>

            <div id="documentFields" class="hidden">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Document Title</label>
                    <input type="text" name="resource_title" placeholder="Enter document title" required
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Markdown Content</label>
                    <textarea id="markdown-editor" name="content_text" placeholder="Write your markdown content here" rows="6" class="hidden"></textarea>
                </div>
            </div>
            <div class="mb-4">
                <button type="submit"
                    class="w-full bg-purple-600 text-white py-2 px-4 rounded-lg hover:bg-purple-700 transition duration-300 flex items-center justify-center gap-2">
                    <i class="fas fa-save"></i>
                    Create Course
                </button>
            </div>
        </form>

    </div>

    <script>
        function toggleResourceFields() {
    const resourceType = document.getElementById('resource_type').value;
    const videoFields = document.getElementById('videoFields');
    const documentFields = document.getElementById('documentFields');
    console.log("Selected resource type:", resourceType);

    if (resourceType === 'video') {
        videoFields.classList.remove('hidden');
        documentFields.classList.add('hidden');
    } else if (resourceType === 'document') {
        documentFields.classList.remove('hidden');
        videoFields.classList.add('hidden');
    }
}

        var simplemde = new SimpleMDE({
            element: document.getElementById("markdown-editor"), 
            spellChecker: false, 
            autosave: { enabled: true, uniqueId: "markdown-editor" } 
        });
        document.addEventListener('DOMContentLoaded', function () {
            simplemde.codemirror.setValue(""); 
        });
    </script>
</body>
</html>
