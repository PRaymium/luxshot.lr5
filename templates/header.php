    <header class="header">
        <div class="header-wrapper">
            <a href="http://luxshot.lr5/" class="logo-link">
                <div class="logo-link_picture">
                    <img src="Img/logo-picture.png" alt="">
                </div>
                <div class="logo-link_text">
                    LuxShot
                </div>
            </a>
            <?php if ($_SESSION['user'] == null) : ?>
                <div class="nav-burger-menu" id="nav-burger">
                    <div class="burger-menu__line burger-menu__line1"></div>
                    <div class="burger-menu__line burger-menu__line2"></div>
                    <div class="burger-menu__line burger-menu__line3"></div>
                </div>
                <nav id="nav-menu" class="nav-menu">
                    <div class="nav-menu__title">Меню</div>
                    <ul class="nav-menu__list">
                        <li class="nav-menu__list-li">
                            <div id="header-login-button" class="nav-menu__list-item">Войти</div>
                        </li>
                    </ul>
                </nav>
            <?php else : ?>

                <div class="nav-burger-menu hidden-menu" id="nav-burger">
                    <div class="burger-menu__line burger-menu__line1"></div>
                    <div class="burger-menu__line burger-menu__line2"></div>
                    <div class="burger-menu__line burger-menu__line3"></div>
                </div>
                <nav id="nav-menu" class="nav-menu hidden-menu">
                    <div class="nav-menu__title hidden-menu">Меню</div>
                    <ul class="nav-menu__list hidden-menu">
                        <li class="nav-menu__list-li hidden-menu">
                            <div href="#" class="nav-menu__list-item hidden-menu welcome">Здравствуйте, <?= $_SESSION['user']['name'] ?></div>
                        </li>
                        <li class="nav-menu__list-li hidden-menu">
                            <a href="logout.php" class="nav-menu__list-item hidden-menu">Выйти</a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </header>