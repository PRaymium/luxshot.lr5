<?php require "db.php" ?>
<?php session_start(); ?>
<?php require "templates/head.html" ?>
<?php
$img = $_GET['img'];

$items = $connection->prepare("SELECT * FROM screenshots WHERE img=?");
$items->execute([$img]);

$items = $items->fetchAll();
$user_id = $items[0]['user_id'];

$owner = $connection->prepare("SELECT * FROM users WHERE id=?");
$owner->execute([$user_id]);
$owner = $owner->fetchAll();
$items = $connection->prepare("SELECT * FROM screenshots WHERE img=?");
$items->execute([$img]);

?>

<head>
    <link rel="stylesheet" href="css/screenshot.css">
</head>

<body>
    <?php require "templates/forms.html" ?>
    <?php require "templates/header.php" ?>
    <main class="main">
        <div class="main-wrapper">
            <?php foreach ($items as $item) : ?>
                <div class="screenshot-block">
                    <div class="screenshot-block__image-container">
                        <img src="screenshots-image/<?= $item['img'] ?>" class="screenshot-block__image"></img>
                    </div>
                    <div class="screenshot-block-info">
                        <div class="screenshot-block-info__date">Дата загрузки:<br><?= $item['date'] ?></div>
                        <div class="screenshot-block-info__owner">Владелец:<br><?= $owner[0]['name'] ?></div>
                    </div>
                    <a href="download_img.php?img=<?= $item['img']?>" id="download_button" class="screenshot-block__download-button">Скачать</a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <?php require "templates/footer.html" ?>
    <script src="js/forms.js"></script>
    <script src="js/nav.js"></script>
</body>

</html>