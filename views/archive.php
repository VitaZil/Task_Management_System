<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <title>Document</title>
</head>
<body>

<?php require __DIR__ . '/navigation.php' ?>

<table class="table table-striped table-bordered">
    <thead class="thead-dark">
    <tr>
        <th>Title</th>
        <th>Employees</th>
        <th>Created At</th>
        <th>Completed At</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($assignments as $assignment): ?>
        <?php if ($assignment['status'] === 'complete'): ?>
            <tr>
                <td><?= $assignment['title'] ?></td>
                <td>
                    <?php foreach (explode(',', $assignment['name']) as $name): ?>
                        <span><?= $name ?></span><br>
                    <?php endforeach; ?>
                </td>
                <td><?= $assignment['created_at'] ?></td>
                <td><?= $assignment['updated_at'] ?></td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
    </tbody>
    <br>
    <?php foreach (range(1, $pageNumber) as $page): ?>
    <a href="/archive?page=<?= $page ?>" ><?= $page ?></a>
    <?php endforeach; ?>

</table>
</body>
</html>
