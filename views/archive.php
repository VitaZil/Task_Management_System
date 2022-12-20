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

<a href="/export">Export to .csv</a>

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

</table>
<span>Total <?= $numberOfItems ?> results</span>

<span><?= $currentPage ?> </span>
<br>
<?php foreach (range(1, $pageNumber) as $page): ?>
    <?php if ($currentPage == $page): ?>
<a class="font-bold" href="/archive?page=<?= $page ?>" ><?= $page ?></a>
<?php else: ?>
    <a href="/archive?page=<?= $page ?>" ><?= $page ?></a>
<?php endif; ?>

<?php endforeach; ?>
<br>

</body>
</html>
