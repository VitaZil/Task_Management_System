<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    <title>Document</title>
</head>
<body>

<?php require __DIR__ . '/navigation.php' ?>

<h1>New Assigment</h1>
<?php if (isset($message)): ?>
    <p style="color:red">❌<?= $message ?></p>
<?php endif; ?>
<form method="POST" action="/newtask">
    <input type="text" max="255" name="title" placeholder="Title" required> <br>
    <label>Select from 1 to 3 employees:</label>
    <br>
<br>

    <select name="employee[]" required>
        <option value="" hidden>First Employee</option>
        <?php foreach ($employees as $employee): ?>
        <option value="<?= $employee['id'] ?>"><?= $employee['firstname'] . ' ' . $employee['lastname'] ?></option>
        <?php endforeach; ?>
    </select> <br>

    <select name="employee[]">
        <option value="" hidden>Second Employee</option>
        <?php foreach ($employees as $employee): ?>
            <option value="<?= $employee['id'] ?>"><?= $employee['firstname'] . ' ' . $employee['lastname'] ?></option>
        <?php endforeach; ?>
    </select> <br>

    <select name="employee[]">
        <option value="" hidden>Third Employee</option>
        <?php foreach ($employees as $employee): ?>
            <option value="<?= $employee['id'] ?>"><?= $employee['firstname'] . ' ' . $employee['lastname'] ?></option>
        <?php endforeach; ?>
    </select> <br>

    <input type="submit" value="Create">

</form>
</body>
</html>