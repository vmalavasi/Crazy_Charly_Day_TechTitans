<!DOCTYPE html>
<html>
<head>
    <title>Todo List</title>
</head>
<body>
<h1>Todo List</h1>
<ul>
    <?php foreach ($items as $item): ?>
        <li><?= $item->getName() ?> (<?= $item->isCompleted() ? 'Completed' : 'Incomplete' ?>)</li>
    <?php endforeach; ?>
</ul>
</body>
</html>
