<section class="main-screen--block">
    <header class="header-main-screen--block">
        <a class="logo--link" href="/">
            <img src="/img/logos/logo_white.png" alt="НЖД">
        </a>
        <div class="links--block">
            <a href="/" class="active">Главная</a>
            <a href="/trains">Поезда</a>
            <a href="#">Контакты</a>
        </div>
        <?php
        if (isset($_SESSION['user']) && !empty($_SESSION['user']))
            echo '<div class="user--panel"><a onclick="(document.querySelector(\'.popup-menu--block\').style.display === \'flex\') ? document.querySelector(\'.popup-menu--block\').style.display = \'none\' : document.querySelector(\'.popup-menu--block\').style.display = \'flex\'" class="first--link"><div>' . $_SESSION['user']['display_name'] . '</div><svg style="margin-left: 10px;" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.9999 9.17C16.8126 8.98375 16.5591 8.87921 16.2949 8.87921C16.0308 8.87921 15.7773 8.98375 15.5899 9.17L11.9999 12.71L8.45995 9.17C8.27259 8.98375 8.01913 8.87921 7.75495 8.87921C7.49076 8.87921 7.23731 8.98375 7.04995 9.17C6.95622 9.26296 6.88183 9.37356 6.83106 9.49542C6.78029 9.61728 6.75415 9.74799 6.75415 9.88C6.75415 10.012 6.78029 10.1427 6.83106 10.2646C6.88183 10.3864 6.95622 10.497 7.04995 10.59L11.2899 14.83C11.3829 14.9237 11.4935 14.9981 11.6154 15.0489C11.7372 15.0997 11.8679 15.1258 11.9999 15.1258C12.132 15.1258 12.2627 15.0997 12.3845 15.0489C12.5064 14.9981 12.617 14.9237 12.7099 14.83L16.9999 10.59C17.0937 10.497 17.1681 10.3864 17.2188 10.2646C17.2696 10.1427 17.2957 10.012 17.2957 9.88C17.2957 9.74799 17.2696 9.61728 17.2188 9.49542C17.1681 9.37356 17.0937 9.26296 16.9999 9.17Z" fill="#FFFFFF"/></svg></a><div class="popup-menu--block"><a ' . (($_SESSION['user']['role'] == 2) ? ' href="/administrative" style="text-align: center;">Панель администратора' : ' href="#">Личный кабинет') . '</a><a href="/user/orders">История заказов</a><a href="/user/logout" style="color: red;">Выйти</a></div></div>';
        else
            echo "<div class=\"login-signup--link\"><a href=\"#\" onclick=\"login();\">Войти</a> или <a href=\"#\" onclick=\"signup();\">Зарегистрироваться</a></div>";
        ?>
    </header>
    <div class="title">Новые Железные Дороги</div>
    <div class="subtitle">Безопасность<div></div>Комфорт<div></div>Доступность</div>
    <form method="GET" action="" novalidate autocomplete="off">
        <div class="row--block">
            <div class="field--block">
                <label for="from">Откуда</label>
                <input name="from" id="fieldFrom" type="text" placeholder="Санкт-Петербург" required>
            </div>
            <button type="button" class="change--button" onclick="swapDirection();"><svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.20817 10.2083H2.33317V3.79166H6.88317L6.4165 4.25249C6.30666 4.36156 6.24464 4.5098 6.2441 4.6646C6.24355 4.81939 6.30452 4.96807 6.41359 5.07791C6.52266 5.18776 6.6709 5.24977 6.82569 5.25032C6.98049 5.25087 7.12916 5.1899 7.239 5.08083L8.69734 3.62249C8.75201 3.56827 8.79541 3.50375 8.82502 3.43266C8.85464 3.36158 8.86989 3.28533 8.86989 3.20833C8.86989 3.13132 8.85464 3.05508 8.82502 2.98399C8.79541 2.91291 8.75201 2.84839 8.69734 2.79416L7.239 1.33583C7.12971 1.22718 6.98186 1.1662 6.82775 1.1662C6.67365 1.1662 6.5258 1.22718 6.4165 1.33583C6.36183 1.39006 6.31843 1.45457 6.28882 1.52566C6.2592 1.59674 6.24396 1.67299 6.24396 1.74999C6.24396 1.827 6.2592 1.90325 6.28882 1.97433C6.31843 2.04542 6.36183 2.10993 6.4165 2.16416L6.87734 2.62499H1.74984C1.59513 2.62499 1.44675 2.68645 1.33736 2.79585C1.22796 2.90525 1.1665 3.05362 1.1665 3.20833V10.7917C1.1665 10.9464 1.22796 11.0947 1.33736 11.2041C1.44675 11.3135 1.59513 11.375 1.74984 11.375H3.20817C3.36288 11.375 3.51125 11.3135 3.62065 11.2041C3.73005 11.0947 3.7915 10.9464 3.7915 10.7917C3.7915 10.637 3.73005 10.4886 3.62065 10.3792C3.51125 10.2698 3.36288 10.2083 3.20817 10.2083ZM12.2498 2.62499H10.7915C10.6368 2.62499 10.4884 2.68645 10.379 2.79585C10.2696 2.90525 10.2082 3.05362 10.2082 3.20833C10.2082 3.36304 10.2696 3.51141 10.379 3.62081C10.4884 3.7302 10.6368 3.79166 10.7915 3.79166H11.6665V10.2083H6.784L7.24484 9.74749C7.29951 9.69327 7.34291 9.62875 7.37252 9.55766C7.40214 9.48658 7.41739 9.41034 7.41739 9.33333C7.41739 9.25632 7.40214 9.18008 7.37252 9.10899C7.34291 9.03791 7.29951 8.97339 7.24484 8.91916C7.13554 8.81051 6.9877 8.74953 6.83359 8.74953C6.67948 8.74953 6.53163 8.81051 6.42234 8.91916L4.964 10.3775C4.90933 10.4317 4.86593 10.4962 4.83632 10.5673C4.8067 10.6384 4.79146 10.7147 4.79146 10.7917C4.79146 10.8687 4.8067 10.9449 4.83632 11.016C4.86593 11.0871 4.90933 11.1516 4.964 11.2058L6.42234 12.6642C6.53218 12.7732 6.68085 12.8342 6.83565 12.8337C6.99045 12.8331 7.13868 12.7711 7.24775 12.6612C7.35682 12.5514 7.41779 12.4027 7.41725 12.2479C7.4167 12.0931 7.35468 11.9449 7.24484 11.8358L6.784 11.375H12.2498C12.4045 11.375 12.5529 11.3135 12.6623 11.2041C12.7717 11.0947 12.8332 10.9464 12.8332 10.7917V3.20833C12.8332 3.05362 12.7717 2.90525 12.6623 2.79585C12.5529 2.68645 12.4045 2.62499 12.2498 2.62499Z" fill="white"/></svg></button>
            <div class="field--block">
                <label for="to">Куда</label>
                <input name="to" id="fieldTo" type="text" placeholder="Москва" required>
            </div>
        </div>
        <div class="row--block">
            <div class="field--block">
                <label for="date">Дата отправки</label>
                <input style="height: 50px; cursor: text" name="date" type="date" value="<?= date('Y-m-d') ?>" required>
            </div>
            <div class="field--block">
                <label for="count">Количество человек</label>
                <div>
                    <button type="button" onclick="fieldIncrement(false);"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M3.57757 9.41073C3.73385 9.25445 3.94582 9.16666 4.16683 9.16666H15.8335C15.8335 9.16666 16.2665 9.25445 16.4228 9.41073C16.579 9.56701 16.6668 9.77898 16.6668 9.99999C16.6668 10.221 16.579 10.433 16.4228 10.5892C16.2665 10.7455 16.0545 10.8333 15.8335 10.8333H4.16683C3.94582 10.8333 3.73385 10.7455 3.57757 10.5892C3.42129 10.433 3.3335 10.221 3.3335 9.99999C3.3335 9.77898 3.42129 9.56701 3.57757 9.41073Z" fill="#2787F5"/></svg></button>
                    <input style="display: inline-block; cursor: default;" name="count" type="text" value="1 чел." readonly id="count" required>
                    <button type="button" onclick="fieldIncrement(true);"><svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M15.8335 9.16668H10.8335V4.16668C10.8335 3.94566 10.7457 3.7337 10.5894 3.57742C10.4331 3.42114 10.2212 3.33334 10.0002 3.33334C9.77915 3.33334 9.56719 3.42114 9.41091 3.57742C9.25463 3.7337 9.16683 3.94566 9.16683 4.16668V9.16668H4.16683C3.94582 9.16668 3.73385 9.25447 3.57757 9.41075C3.42129 9.56703 3.3335 9.779 3.3335 10C3.3335 10.221 3.42129 10.433 3.57757 10.5893C3.73385 10.7455 3.94582 10.8333 4.16683 10.8333H9.16683V15.8333C9.16683 16.0544 9.25463 16.2663 9.41091 16.4226C9.56719 16.5789 9.77915 16.6667 10.0002 16.6667C10.2212 16.6667 10.4331 16.5789 10.5894 16.4226C10.7457 16.2663 10.8335 16.0544 10.8335 15.8333V10.8333H15.8335C16.0545 10.8333 16.2665 10.7455 16.4228 10.5893C16.579 10.433 16.6668 10.221 16.6668 10C16.6668 9.779 16.579 9.56703 16.4228 9.41075C16.2665 9.25447 16.0545 9.16668 15.8335 9.16668Z" fill="#2787F5"/></svg></button>
                </div>
            </div>
        </div>
        <button type="submit">Найти билеты</button>
    </form>
</section>
<section class="routes--block">
    <div class="title">Популярные маршруты</div>
    <div class="subtitle">Самые популярные маршруты <span>в разные уголки мира</span></div>
    <div class="routes--block-1">
        <a onclick="(function () { document.querySelector('input[name=\'from\']').value = 'Санкт-Петербург'; document.querySelector('input[name=\'to\']').value = 'Москва'; window.scrollTo(0, 0); })();" class="route--link main" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/img/routes/1.png'); background-repeat: no-repeat; background-size: auto 100%; background-position: center;">
            <div>Санкт-Петербург -<br>Москва</div>
        </a>
        <div>
            <a onclick="(function () { document.querySelector('input[name=\'from\']').value = 'Москва'; document.querySelector('input[name=\'to\']').value = 'Санкт-Петербург'; window.scrollTo(0, 0); })();" class="route--link" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/img/routes/2.png'); background-repeat: no-repeat; background-size: auto 100%; background-position: center;">
                <div>Москва -<br>Санкт-Петербург</div>
            </a>
            <a onclick="(function () { document.querySelector('input[name=\'from\']').value = 'Санкт-Петербург'; document.querySelector('input[name=\'to\']').value = 'Минск'; window.scrollTo(0, 0); })();" class="route--link" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/img/routes/3.png'); background-repeat: no-repeat; background-size: auto 100%; background-position: center;">
                <div>Санкт-Петербург -<br>Минск</div>
            </a>
        </div>
        <div>
            <a onclick="(function () { document.querySelector('input[name=\'from\']').value = 'Москва'; document.querySelector('input[name=\'to\']').value = 'Владивосток'; window.scrollTo(0, 0); })();" class="route--link" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/img/routes/4.png'); background-repeat: no-repeat; background-size: auto 100%; background-position: center;">
                <div>Москва -<br>Владивосток</div>
            </a>
            <a onclick="(function () { document.querySelector('input[name=\'from\']').value = 'Москва'; document.querySelector('input[name=\'to\']').value = 'Севастополь'; window.scrollTo(0, 0); })();" class="route--link" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/img/routes/5.png'); background-repeat: no-repeat; background-size: auto 100%; background-position: center;">
                <div>Москва -<br>Севастополь</div>
            </a>
        </div>
    </div>
</section>
<section class="trains--block">
    <div class="title">Поезда компании «Новые Железные Дороги»</div>
    <div class="subtitle">Наши поезда <span>- наша гордость</span></div>
    <div class="trains--block-1">
        <a href="/trains?type_train=1" class="train--link" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('/img/trains/1.png'); background-repeat: no-repeat; background-size: auto 100%; background-position: center;">
            <div>Ибрагим</div>
        </a>
        <a href="/trains?type_train=2" class="train--link" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('/img/trains/2.png'); background-repeat: no-repeat; background-size: auto 100%; background-position: center;">
            <div>Жан</div>
        </a>
        <a href="/trains?type_train=3" class="train--link" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('/img/trains/3.png'); background-repeat: no-repeat; background-size: auto 100%; background-position: center;">
            <div>Николь</div>
        </a>
        <a href="/trains" class="train--link" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('/img/trains/4.png'); background-repeat: no-repeat; background-size: auto 100%; background-position: center;">
            <div>Все<br>поезда</div>
        </a>
    </div>
</section>
<script src="/js/main-page.js"></script>
<script src="/js/login-signup.js"></script>