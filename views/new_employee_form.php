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

<h1>New employee</h1>
<form method="POST" action="/newemployee">

    <?php if (isset($message)): ?>
        <p style="color:red">❌<?= $message ?></p>
    <?php endif; ?>

    <input type="text" max="10" name="firstname" placeholder="First Name" required> <br>
    <input type="text" max="10" name="lastname" placeholder="Last Name" required> <br>
    <label for="type">Multi-worker</label>
    <input type="checkbox" name="multiworker" value="multiworker" placeholder="Multi-worker"> <br>
    <input type="submit" value="Add">
</form>
</body>
</html>