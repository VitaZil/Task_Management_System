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

<a href="/newemployee">New Employee</a>
<a href="/newtask">New Assignment</a>

<table>
    <tr>
        <th>Title</th>
        <th>Employees</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($assignments as $assignment): ?>
        <?php if ($assignment['status'] === 'running'): ?>
            <tr>
                <td><?= $assignment['title'] ?></td>

                <td>
                    <?php foreach (explode(',', $assignment['name']) as $name): ?>
                        <span> <?= $name ?> </span><br>
                    <?php endforeach; ?>
                </td>

                <td><?= $assignment['created_at'] ?></td>

                <td>
                    <form action="/complete" method="post">
                        <input type="hidden" name="complete" value="<?= $assignment['id'] ?>">
                        <input type="submit" value="Complete"> <br>
                    </form>

                    <form action="/delete" method="post">
                        <input type="hidden" name="delete" value="<?= $assignment['id'] ?>">
                        <input type="submit" value="Delete"> <br>
                    </form>
                </td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>

</table>
</body>
</html>
