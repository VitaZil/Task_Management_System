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

<?php require __DIR__ . '/components/navigation.php' ?>
<?php require __DIR__ . '/components/flash_message.php' ?>

    <div class="flex items-center justify-center py-2 px-20 ">
    <nav class="navbar navbar-expand-lg navbar-light mt-5">
        <div class="container-fluid">
            <a class="navbar-brand px-5 py-2 mx-12 text-lg text-gray-700 border hover:bg-gray-700 hover:text-white rounded-md font-medium" href="/newemployee">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                </svg>
                 New Employee
            </a>
            <a class="navbar-brand px-5 py-2 mx-12 text-lg text-gray-700 border hover:bg-gray-700 hover:text-white rounded-md font-medium" href="/newtask">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                </svg>
                New Assignment</a>
        </div>
    </nav>

</div>
<div class="items-center justify-center py-5 px-20 ">
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <?php if (count($assignments) === 0): ?>
                    <p class="mt-6 text-center text-lg font-bold tracking-tight text-gray-900">There is no assignments</p>
                    <?php else: ?>
                    <table class="table-auto min-w-full text-center">
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
                                Actions
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

                                <form action="/complete" method="post">
                                    <input type="hidden" name="complete" value="<?= $assignment['id'] ?>">
                                    <button class="inline items-center w-32 m-1 justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-6 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 align-middle" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                        </svg>
                                        Complete
                                    </button>
                                </form>

                                <form action="/delete" method="post">
                                    <div class="flex align-center justify-center text-center" >
                                    <input type="hidden" name="delete" value="<?= $assignment['id'] ?>">
                                        <button class="w-32 m-1 rounded-md border border-transparent bg-indigo-600 py-2 px-6 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 align-text-bottom inline-block align-bottom" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                        Delete
                                    </button></div>
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
</div>
</body>
</html>
