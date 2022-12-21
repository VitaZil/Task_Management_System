<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Tailwind CSS 404 Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<?php require __DIR__ . '/components/navigation.php' ?>

<div class="flex flex-col items-center my-40">
    <div class="text-indigo-500 font-bold text-7xl">
        404
    </div>

    <div class="font-bold text-3xl xl:text-7xl lg:text-6xl md:text-5xl mt-10">
        This page does not exist
    </div>

    <div class="text-gray-400 font-medium text-sm md:text-xl lg:text-2xl mt-8">
        The page you are looking for could not be found.
    </div>
</div>
</body>
</html>
