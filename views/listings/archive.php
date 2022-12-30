<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Document</title>
</head>
<body>

<?php require __DIR__ . '/components/navigation.php' ?>

<div class="items-center justify-center py-2 px-20 ">

    <div class="py-10 px-20">
        <a href="/export"
           class="w-24 my-1 justify-center rounded-md bg-indigo-600 py-3 px-5 text-md font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="inline w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
            </svg>
            Export to .csv
        </a>

        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <?php if (count($assignments) === 0): ?>
                            <p class="mt-6 text-center text-lg font-bold tracking-tight text-gray-900">
                                There is no assignments</p>
                        <?php else: ?>
                            <table class="table-auto min-w-full text-center mt-5">
                                <thead class="border-b bg-gray-800">
                                <tr>
                                    <th scope="col" class="text-md font-medium text-white px-6 py-4">
                                        Title
                                    </th>
                                    <th scope="col" class="text-md font-medium text-white px-6 py-4">
                                        Employees
                                    </th>
                                    <th scope="col" class="text-md font-medium text-white px-6 py-4">
                                        Created At
                                    </th>
                                    <th scope="col" class="text-md font-medium text-white px-6 py-4">
                                        Completed At
                                    </th>
                                </tr>
                                </thead class="border-b">
                                <tbody>
                                <tr class="bg-white border-b">
                                    <?php foreach ($assignments as $key => $assignment): ?>
                                    <td class="text-md text-gray-900 font-light px-6 py-4">
                                        <?= $assignment['title'] ?>
                                    </td>
                                    <td class="text-md text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?php foreach (explode(',', $assignment['name']) as $name): ?>
                                            <span> <?= $name ?> </span><br>
                                        <?php endforeach; ?>
                                    </td>
                                    <td class="text-md text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?= $assignment['created_at'] ?>
                                    </td>
                                    <td class="text-md text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?= $assignment['updated_at'] ?>
                                    </td>
                                </tr class="bg-white border-b">
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (count($assignments) > 0): ?>
        <?php require __DIR__ . '/components/pagination.php' ?>
    <?php endif; ?>
</div>
</body>
</html>
