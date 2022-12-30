<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Document</title>
</head>
<body>

<?php require './views/components/navigation.php' ?>
<?php require './views/components/flash_message.php' ?>
<?php require './views/components/error_message.php' ?>
<?php require './views/components/second-nav.php' ?>

<div class="items-center justify-center py-5 px-20 ">
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <?php if (count($employees) === 0): ?>
                        <p class="mt-6 text-center text-lg font-bold tracking-tight text-gray-900">There is no
                            employees</p>
                    <?php else: ?>
                        <table class="table-auto min-w-full text-center">
                            <thead class="border-b bg-gray-800">
                            <tr>
                                <th scope="col" class="text-md font-medium text-white px-6 py-4">
                                    First Name
                                </th>
                                <th scope="col" class="text-md font-medium text-white px-6 py-4">
                                    Last Name
                                </th>
                                <th scope="col" class="text-md font-medium text-white px-6 py-4">
                                    Multiworker
                                </th>
                                <th scope="col" class="text-md font-medium text-white px-6 py-4">
                                    Created At
                                </th>
                                <th scope="col" class="text-md font-medium text-white px-6 py-4">
                                    Running Tasks
                                </th>
                                <th scope="col" class="text-md font-medium text-white px-6 py-4">
                                    Assignment Titles
                                </th>
                                <th scope="col" class="text-md font-medium text-white px-6 py-4">
                                    Actions
                                </th>
                            </tr>
                            </thead class="border-b">
                            <tbody>
                            <tr class="bg-white border-b">
                                <?php foreach ($employees as $employee): ?>
                                <td class="text-md text-gray-900 font-light px-6 py-4">
                                    <?= $employee['firstname'] ?>
                                </td>
                                <td class="text-md text-gray-900 font-light px-6 py-4">
                                    <?= $employee['lastname'] ?>
                                </td>
                                <td class="text-md text-gray-900 font-light px-6 py-4">
                                    <?php if ($employee['multiworker'] == 1): ?>
                                        <span>Yes</span>
                                    <?php else: ?>
                                        <span>No</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-md text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    <?= $employee['created_at'] ?>
                                </td>
                                <td class="text-md text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    <?= $employee['running_tasks'] ?>
                                </td>
                                <td class="text-md text-gray-900 font-light px-6 py-4">
                                    <?php foreach (explode(',', $employee['tasks_titles']) as $title): ?>
                                        <span> <?= $title ?> </span><br>
                                    <?php endforeach; ?>
                                </td>
                                <td class="text-md text-gray-900 font-light px-6 py-4 whitespace-nowrap">

                                    <a href="/employees/<?= $employee['id'] ?>"
                                       class="inline items-center w-32 m-1 justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-6 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 align-middle"
                                       type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="inline w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                                        </svg>
                                        Edit
                                    </a>

                                    <form action="/employees/delete" method="post">
                                        <div class="flex align-center justify-center text-center">
                                            <input type="hidden" name="delete" value="<?= $employee['id'] ?>">
                                            <button class="w-32 m-1 rounded-md border border-transparent bg-indigo-600 py-2 px-6 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 align-text-bottom inline-block align-bottom"
                                                    type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="inline w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                </svg>
                                                Delete
                                            </button>
                                        </div>
                                    </form>
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
    <?php if (count($employees) > 0): ?>
        <?php require './views/components/pagination.php' ?>
    <?php endif; ?>
</div>
</body>
</html>
