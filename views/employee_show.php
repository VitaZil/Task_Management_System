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

<div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">

        <h1 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Edit employee info</h1>

        <form class="mt-8 space-y-6" method="POST" action="/employees/<?= $employee['id'] ?>">

            <?php if (isset($_GET['message'])): ?>
                <div class="relative px-4 py-3 leading-normal text-red-700 bg-red-100 rounded-lg" role="alert">
  <span class="absolute inset-y-0 left-0 flex items-center ml-4">
    <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path
                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                clip-rule="evenodd" fill-rule="evenodd"></path>
    </svg>
  </span>
                    <p class="ml-6"><?= $_GET['message'] ?></p>
                </div>
            <?php endif; ?>

            <label class="ml-2 block text-sm text-gray-900" for="firstname">Current First
                Name: <?= $employee['firstname'] ?>
            </label>
            <input class="relative block w-full appearance-none rounded-none rounded border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                   type="text" maxlength="10" id="firstname" name="firstname" placeholder="New First Name" required>

            <label class="ml-2 block text-sm text-gray-900" for="lastname">Current Last
                Name: <?= $employee['lastname'] ?>
            </label>
            <input class="relative block w-full appearance-none rounded-none rounded border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                   type="text" maxlength="10" id="lastname" name="lastname" placeholder="New Last Name" required>

            <div class="flex items-center">

                <?php if ($employee['multiworker'] === 'null'): ?>
                    <input class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" type="checkbox"
                           name="multiworker" id="type" value="multiworker" placeholder="Multi-worker">
                <?php else: ?>
                    <input class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" type="checkbox"
                           name="multiworker" id="type" value="1" placeholder="Multi-worker" checked>
                <?php endif; ?>

                <label class="ml-2 block text-sm text-gray-900" for="type">Can work on multiple assignments at
                    once</label>
            </div>
            <input class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                   type="submit" value="Update">
        </form>
    </div>
</div>
</body>
</html>
