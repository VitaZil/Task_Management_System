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

<?php require __DIR__ . '/navigation.php' ?>
<div class="items-center justify-center py-20 px-20 ">
<h1 class="">New Assigment</h1>

<?php if (isset($message)): ?>
    <p style="color:red">❌<?= $message ?></p>
<?php endif; ?>
<form class="mt-8 space-y-6" method="POST" action="/newtask">
    <input class="relative block w-full appearance-none rounded-none rounded border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" type="text" max="255" name="title" placeholder="Title" required> <br>
    <label>Select from 1 to 3 employees:</label>
    <br>
<br>

    <select class="relative w-full cursor-default rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm" name="employee[]" required>
        <option value="" hidden>First Employee</option>
        <?php foreach ($employees as $employee): ?>
        <option value="<?= $employee['id'] ?>"><?= $employee['firstname'] . ' ' . $employee['lastname'] ?></option>
        <?php endforeach; ?>
    </select> <br>

    <select class="relative w-full cursor-default rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm" name="employee[]">
        <option value="" hidden>Second Employee</option>
        <?php foreach ($employees as $employee): ?>
            <option value="<?= $employee['id'] ?>"><?= $employee['firstname'] . ' ' . $employee['lastname'] ?></option>
        <?php endforeach; ?>
    </select> <br>

    <select class="relative w-full cursor-default rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm" name="employee[]">
        <option value="" hidden>Third Employee</option>
        <?php foreach ($employees as $employee): ?>
            <option value="<?= $employee['id'] ?>"><?= $employee['firstname'] . ' ' . $employee['lastname'] ?></option>
        <?php endforeach; ?>
    </select> <br>

    <input class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" type="submit" value="Create">

</form>
</div>
</body>
</html>