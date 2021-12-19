<?php
require "db.php";
$items_size = 6;

$query = "SELECT id FROM screenshots";
$max_id = $connection->query($query);
$max_id = $max_id->fetchAll();
$max_id = end($max_id)['id'];

$current_page = (int)($_GET['page']);
$last_id = $max_id - (($current_page - 1) * $items_size);
$offset = $max_id - ($current_page * $items_size);
if ($offset <= 0) {
    $offset = 0;
    $items_size = $last_id;
}

$query = "SELECT * FROM screenshots WHERE public='1' LIMIT $items_size OFFSET $offset";
$items = $connection->query($query);
$items = $items = array_reverse($items->fetchAll());

foreach ($items as $item) :
?>

    <a href="screenshot.php?id=<?= $item['id'] ?>" class="screenshot">
        <div class="screenshot-img-block">
            <img src="screenshots-image/<?= $item['img'] ?>" alt="" class="screenshot-img">
        </div>
        <div class="screenshot-date"><?= $item['date'] ?></div>
    </a>
<?php endforeach; ?>