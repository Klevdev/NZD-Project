<!DOCTYPE HTML>
<html lang="RU">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/css/reset.css">
	<link rel="stylesheet" href="/css/template.css">
    <?php
    if (!empty($stylesheets))
        foreach ($stylesheets as $stylesheet)
            echo "<link rel=\"stylesheet\" href=\"/css/$stylesheet.css\">";
    ?>
    <link rel="icon" href="/img/logos/logo_min_white.svg">
	<title><?php echo $view_title?></title>
</head>
<body>
    <?php
    if(!isset($data['is_main_page']) || !$data['is_main_page'] === true) {
    ?>
    <header class="header--block">
        <a class="logo--link" href="/">
            <img src="/img/logos/logo_white.png" alt="НЖД">
        </a>
        <div class="links--block">
            <a href="/">Главная</a>
            <a href="/trains">Поезда</a>
            <a href="#">Контакты</a>
        </div>
        <?php
        if (isset($_SESSION['user']) && !empty($_SESSION['user']))
            echo '<div class="user--panel"><a onclick="(document.querySelector(\'.popup-menu--block\').style.display === \'flex\') ? document.querySelector(\'.popup-menu--block\').style.display = \'none\' : document.querySelector(\'.popup-menu--block\').style.display = \'flex\'" class="first--link"><div>' . $_SESSION['user']['display_name'] . '</div><svg style="margin-left: 10px;" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.9999 9.17C16.8126 8.98375 16.5591 8.87921 16.2949 8.87921C16.0308 8.87921 15.7773 8.98375 15.5899 9.17L11.9999 12.71L8.45995 9.17C8.27259 8.98375 8.01913 8.87921 7.75495 8.87921C7.49076 8.87921 7.23731 8.98375 7.04995 9.17C6.95622 9.26296 6.88183 9.37356 6.83106 9.49542C6.78029 9.61728 6.75415 9.74799 6.75415 9.88C6.75415 10.012 6.78029 10.1427 6.83106 10.2646C6.88183 10.3864 6.95622 10.497 7.04995 10.59L11.2899 14.83C11.3829 14.9237 11.4935 14.9981 11.6154 15.0489C11.7372 15.0997 11.8679 15.1258 11.9999 15.1258C12.132 15.1258 12.2627 15.0997 12.3845 15.0489C12.5064 14.9981 12.617 14.9237 12.7099 14.83L16.9999 10.59C17.0937 10.497 17.1681 10.3864 17.2188 10.2646C17.2696 10.1427 17.2957 10.012 17.2957 9.88C17.2957 9.74799 17.2696 9.61728 17.2188 9.49542C17.1681 9.37356 17.0937 9.26296 16.9999 9.17Z" fill="#FFFFFF"/></svg></a><div class="popup-menu--block"><a ' . (($_SESSION['user']['role'] == 2) ? ' href="/administrative" style="text-align: center;">Панель администратора' : ' href="#">Личный кабинет') . '</a><a href="#">История заказов</a><a href="/user/logout" style="color: red;">Выйти</a></div></div>';
        else
            echo "<div class=\"login-signup--link\"><a href=\"#\" onclick=\"login();\">Войти</a> или <a href=\"#\" onclick=\"signup();\">Зарегистрироваться</a></div>";
        ?>
    </header>
    <main>
    <?php
    }

    include 'app/views/' . $content_view;
    ?>
    </main>
    <footer>
        <div class="logo-author">
            <a href="/" class="logo--link">
                <img src="/img/logos/logo_black.png" alt="НЖД">
            </a>
            <div class="author">&#169; 2021 Все права защищены</div>
        </div>
        <div class="links--block">
            <div class="links-column--block">
                <a href="/">Главная</a>
                <a href="/trains">Поезда</a>
                <a href="#">Контакты</a>
            </div>
            <div class="links-column--block">
                <a href="#">О нас</a>
                <a href="#">Поддержка</a>
                <a href="#">Реквизиты</a>
            </div>
            <div class="links-column--block">
                <a href="#">Политика обработки персональных данных</a>
                <a href="#">Политика конфиденциальности</a>
            </div>
        </div>
        <div class="contacts--block" name="contacts">
            <a href="tel:+7 (123) 456-78-90">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.4401 13.0001C19.2201 13.0001 18.9901 12.9301 18.7701 12.8801C18.3246 12.7819 17.8868 12.6516 17.4601 12.4901C16.9962 12.3213 16.4862 12.3301 16.0284 12.5147C15.5706 12.6993 15.1972 13.0467 14.9801 13.4901L14.7601 13.9401C13.7861 13.3983 12.8911 12.7253 12.1001 11.9401C11.3149 11.1491 10.6419 10.2541 10.1001 9.28011L10.5201 9.00011C10.9635 8.78303 11.3109 8.40964 11.4955 7.9518C11.6801 7.49396 11.6889 6.98402 11.5201 6.52011C11.3613 6.09253 11.231 5.65491 11.1301 5.21011C11.0801 4.99011 11.0401 4.76011 11.0101 4.53011C10.8887 3.82573 10.5197 3.18785 9.96972 2.73135C9.41972 2.27485 8.7248 2.02972 8.0101 2.04011H5.0101C4.57913 2.03607 4.15235 2.12493 3.75881 2.30064C3.36527 2.47636 3.01421 2.73481 2.72953 3.05839C2.44485 3.38198 2.23324 3.76311 2.10909 4.17583C1.98494 4.58855 1.95118 5.02317 2.0101 5.45011C2.54284 9.63949 4.45613 13.532 7.44775 16.5127C10.4394 19.4935 14.3388 21.3926 18.5301 21.9101H18.9101C19.6475 21.9112 20.3595 21.6406 20.9101 21.1501C21.2265 20.8672 21.4792 20.5203 21.6516 20.1324C21.8239 19.7446 21.9121 19.3245 21.9101 18.9001V15.9001C21.8979 15.2055 21.6449 14.5367 21.1944 14.0078C20.744 13.4789 20.1239 13.1227 19.4401 13.0001ZM19.9401 19.0001C19.9399 19.1421 19.9095 19.2824 19.8509 19.4117C19.7923 19.5411 19.7068 19.6564 19.6001 19.7501C19.4887 19.8471 19.3581 19.9195 19.2168 19.9626C19.0755 20.0057 18.9267 20.0185 18.7801 20.0001C15.035 19.5199 11.5563 17.8066 8.89282 15.1304C6.2293 12.4542 4.53251 8.96745 4.0701 5.22011C4.05419 5.07363 4.06813 4.92544 4.1111 4.7845C4.15407 4.64356 4.22517 4.5128 4.3201 4.40011C4.41381 4.29344 4.52916 4.20795 4.65848 4.14933C4.7878 4.09071 4.92812 4.06029 5.0701 4.06011H8.0701C8.30265 4.05494 8.52972 4.13099 8.71224 4.27518C8.89476 4.41937 9.02131 4.62268 9.0701 4.85011C9.1101 5.12345 9.1601 5.39345 9.2201 5.66011C9.33562 6.18726 9.48936 6.70529 9.6801 7.21011L8.2801 7.86011C8.1604 7.91503 8.05272 7.99306 7.96326 8.08971C7.87379 8.18636 7.8043 8.29973 7.75877 8.42331C7.71324 8.54689 7.69257 8.67824 7.69795 8.80983C7.70332 8.94142 7.73464 9.07066 7.7901 9.19011C9.2293 12.2729 11.7073 14.7509 14.7901 16.1901C15.0336 16.2901 15.3066 16.2901 15.5501 16.1901C15.6748 16.1455 15.7894 16.0766 15.8873 15.9873C15.9851 15.898 16.0643 15.7902 16.1201 15.6701L16.7401 14.2701C17.2571 14.455 17.7847 14.6086 18.3201 14.7301C18.5868 14.7901 18.8568 14.8401 19.1301 14.8801C19.3575 14.9289 19.5608 15.0554 19.705 15.238C19.8492 15.4205 19.9253 15.6476 19.9201 15.8801L19.9401 19.0001Z" fill="black"/></svg>
                <div>+7 (123) 456-78-90</div>
            </a>
            <a href="mailto:nzd@gmail.com">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19 4H5C4.20435 4 3.44129 4.31607 2.87868 4.87868C2.31607 5.44129 2 6.20435 2 7V17C2 17.7956 2.31607 18.5587 2.87868 19.1213C3.44129 19.6839 4.20435 20 5 20H19C19.7956 20 20.5587 19.6839 21.1213 19.1213C21.6839 18.5587 22 17.7956 22 17V7C22 6.20435 21.6839 5.44129 21.1213 4.87868C20.5587 4.31607 19.7956 4 19 4ZM5 6H19C19.2652 6 19.5196 6.10536 19.7071 6.29289C19.8946 6.48043 20 6.73478 20 7L12 11.88L4 7C4 6.73478 4.10536 6.48043 4.29289 6.29289C4.48043 6.10536 4.73478 6 5 6ZM20 17C20 17.2652 19.8946 17.5196 19.7071 17.7071C19.5196 17.8946 19.2652 18 19 18H5C4.73478 18 4.48043 17.8946 4.29289 17.7071C4.10536 17.5196 4 17.2652 4 17V9.28L11.48 13.85C11.632 13.9378 11.8045 13.984 11.98 13.984C12.1555 13.984 12.328 13.9378 12.48 13.85L20 9.28V17Z" fill="black"/></svg>
                <div>nzd@gmail.com</div>
            </a>
            <a href="#contacts" onclick="sendMessageForm();">
                <svg width="24" height="24" viewBox="0 0 512 512.0002" width="512pt" xmlns="http://www.w3.org/2000/svg"><path d="m256 0c-141.484375 0-256 114.496094-256 256 0 44.902344 11.710938 88.757812 33.949219 127.4375l-32.984375 102.429688c-2.300782 7.140624-.410156 14.96875 4.894531 20.273437 5.253906 5.253906 13.0625 7.214844 20.273437 4.894531l102.429688-32.984375c38.679688 22.238281 82.535156 33.949219 127.4375 33.949219 141.484375 0 256-114.496094 256-256 0-141.484375-114.496094-256-256-256zm0 472c-40.558594 0-80.09375-11.316406-114.332031-32.726562-4.925781-3.078126-11.042969-3.910157-16.734375-2.078126l-73.941406 23.8125 23.8125-73.941406c1.804687-5.609375 1.042968-11.734375-2.082032-16.734375-21.40625-34.238281-32.722656-73.773437-32.722656-114.332031 0-119.101562 96.898438-216 216-216s216 96.898438 216 216-96.898438 216-216 216zm25-216c0 13.804688-11.191406 25-25 25s-25-11.195312-25-25c0-13.808594 11.191406-25 25-25s25 11.191406 25 25zm100 0c0 13.804688-11.191406 25-25 25s-25-11.195312-25-25c0-13.808594 11.191406-25 25-25s25 11.191406 25 25zm-200 0c0 13.804688-11.191406 25-25 25-13.804688 0-25-11.195312-25-25 0-13.808594 11.195312-25 25-25 13.808594 0 25 11.191406 25 25zm0 0"/></svg>
                <div>Напишите нам</div>
            </a>
        </div>
    </footer>
    <?php
    if (!isset($_SESSION['user']) || empty($_SESSION['user']))
        echo "<script src=\"/js/login-signup.js\"></script>";
	?>
    <script src="/js/script.js"></script>
</body>
</html>
