<!-- views/courseListView.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="min-h-screen bg-light-gray">
        <nav class="bg-red-600 text-white p-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold">Youdemy</h1>
            <div>
                <a href="?action=courses" class="text-white hover:text-gray-200 mx-3">Courses</a>
                <a href="#" class="text-white hover:text-gray-200 mx-3">Sign In</a>
                <a href="#" class="text-white hover:text-gray-200 mx-3">Sign Up</a>
            </div>
        </nav>

        <!-- --------------------------------------------------Course Catalog-------------------------- -->
        <section class="p-10 bg-white">
            <h2 class="text-2xl font-semibold text-gray-800 mb-5">Course Catalog</h2>

            <!-- ------------------------------------Search ------------------------------------------------------ -->
          

            

            <!--------------------------------------------- Pagination ------------------------------------------------------->
            
        </section>

        <?php include 'footer.php'?>
    </div>
</body>
</html>
