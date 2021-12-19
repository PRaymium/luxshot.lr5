<?php require "db.php";
session_start();
require "templates/head.html" ?>

<head>
    <link rel="stylesheet" href="css/add_item.css">
</head>

<body>
    <?php require "templates/forms.html";
    require "templates/header.php" ?>
    <main class="main">
        <div class="main-wrapper">
            <?php
            if ($_SESSION['user'] == null):
            ?>
                <div class="upload-form__authorization-error">У Вас нет доступа к этой секции</div>
            <?php else:?>
            <div class="upload-title">Загрузка скриншота</div>
            <form method="POST" class="upload-form" id="upload-form" enctype="multipart/form-data">
                <ul class="upload-form__list">
                    <li class="upload-form__item">
                        <label for="upload-form_file" class="upload-form__label upload-form__label_upload-text">Выберите скриншот для загрузки (макс 3 Мб.)</label>
                        <input name="file" id="upload-form_file" type="file" class="upload-form__input" accept=".jpg, .jpeg" require>
                    </li>
                    <li class="upload-form__item upload-form__item_row">
                        <input name="checkbox" id="upload-form_checkbox" type="checkbox" class="upload-form__input upload-form__input_checkbox">
                        <label for="upload-form_checkbox" class="upload-form__label">доступ только по прямой ссылке</label>
                    </li>
                    <li class="upload-form__item upload-form__item_error">
                        <div id="upload-form__error" class="upload-form__error"></div>
                    </li>
                    <li class="upload-form__item upload-form__item_submit">
                        <input type="submit" class="upload-form__input upload-form__input_submit">
                    </li>
                </ul>
            </form>
            <?php endif;?>
        </div>
    </main>
    <?php require "templates/footer.html" ?>
    <script src="js/forms.js"></script>
    <script src="js/nav.js"></script>
    <script src="js/add_item.js"></script>
</body>

</html>