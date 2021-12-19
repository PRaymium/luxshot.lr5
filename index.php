<?php require "db.php" ?>
<?php session_start(); ?>

<?php
$query = "SELECT id FROM screenshots";
$ids = $connection->query($query);
$ids = $ids->fetchAll();
$last_id = end($ids)['id'];
$items_size = 6;
$offset = $last_id - $items_size;
$query = "SELECT * FROM screenshots WHERE public='1' LIMIT $items_size OFFSET $offset";
$items = $connection->query($query);
$items = array_reverse($items->fetchAll());
?>

<?php require "templates/head.html" ?>

<body>
    <?php require "templates/preloader.html" ?>
    <?php require "templates/forms.html" ?>
    <?php require "templates/header.php" ?>
    <main class="main">
        <div class="main-wrapper">
            <div class="upload-block">
                <div class="upload-block_text">
                    Для загрузки скриншота, необходимо авторизироваться
                </div>
            </div>
            <div class="screenshots-block">
                <div class="screenshots-block_title">Последние скриншоты</div>
                <div class="screenshots">
                    <?php foreach ($items as $item) : ?>
                        <a href="screenshot.php?id=<?= $item['id'] ?>" class="screenshot">
                            <div class="screenshot-img-block">
                                <img src="screenshots-image/<?= $item['img'] ?>" alt="" class="screenshot-img">
                            </div>
                            <div class="screenshot-date"><?= $item['date'] ?></div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <button id="ajax_loader_button" class="ajax-loader-button" data-page="1" data-page-max="<?= ceil($last_id / $items_size) ?>">Загрузить ещё</button>
        </div>
    </main>
    <?php require "templates/footer.html" ?>
    <script src="js/preloader.js"></script>
    <script src="js/forms.js"></script>
    <script src="js/more_items.js"></script>
    <script src="js/nav.js"></script>
</body>

</html>