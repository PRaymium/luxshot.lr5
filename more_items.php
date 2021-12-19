<?php
require "db.php";
$items_size = 6;

$query = "SELECT id FROM screenshots";
$items_count = $connection->query($query);
$items_count = $items_count->fetchAll();
$items_count = count($items_count);


$current_page = (int)($_GET['page']);
$last_item = $items_count - (($current_page - 1) * $items_size);
$offset = $items_count - ($current_page * $items_size);
if ($offset < 0) {
    $offset = 0;
    $items_size = $last_item;
}

$query = "SELECT * FROM screenshots WHERE public='1' LIMIT $items_size OFFSET $offset";
$items = $connection->query($query);
$items = $items = array_reverse($items->fetchAll());

foreach ($items as $item) :
?>

    <a href="screenshot.php?img=<?= $item['img'] ?>" class="screenshot">
        <div class="screenshot-img-block">
            <img src="screenshots-image/<?= $item['img'] ?>" alt="" class="screenshot-img">
        </div>
        <div class="screenshot-date"><?= $item['date'] ?></div>
    </a>
<?php endforeach; ?>