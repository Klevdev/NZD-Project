<div class="trains-main--block">
    <div class="title--block">
        <a href="/" class="back--link"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.2899 12L14.8299 8.46C15.0162 8.27264 15.1207 8.01919 15.1207 7.755C15.1207 7.49081 15.0162 7.23736 14.8299 7.05C14.737 6.95627 14.6264 6.88188 14.5045 6.83111C14.3827 6.78034 14.252 6.7542 14.1199 6.7542C13.9879 6.7542 13.8572 6.78034 13.7354 6.83111C13.6135 6.88188 13.5029 6.95627 13.4099 7.05L9.16994 11.29C9.07622 11.383 9.00182 11.4936 8.95105 11.6154C8.90028 11.7373 8.87415 11.868 8.87415 12C8.87415 12.132 8.90028 12.2627 8.95105 12.3846C9.00182 12.5064 9.07622 12.617 9.16994 12.71L13.4099 17C13.5034 17.0927 13.6142 17.166 13.736 17.2158C13.8579 17.2655 13.9883 17.2908 14.1199 17.29C14.2516 17.2908 14.382 17.2655 14.5038 17.2158C14.6257 17.166 14.7365 17.0927 14.8299 17C15.0162 16.8126 15.1207 16.5592 15.1207 16.295C15.1207 16.0308 15.0162 15.7774 14.8299 15.59L11.2899 12Z" fill="#000000"/></svg><div>Вернуться на главную страницу</div></a>
        <div class="title"><?= !empty($_GET['type_train']) ? 'Поезда типа «' . $data['trains'][0]['name'] . '»' : 'Все поезда' ?></div>
        <div class="line"></div>
    </div>
    <div class="table--block">
        <div class="table-header--block">
            <div>Номер поезда</div>
            <div>Название поезда</div>
            <div>Рейтинг</div>
            <div></div>
        </div>
        <?php
        foreach ($data['trains'] as $value)
            echo '
            <div class="table-row--block">
                <div>' . $value['id'] . '</div>
                <a href="/trains?type_train=' . $value['type_id'] . '">«' . $value['name'] . '»</a>
                <div>' . $value['rating'] . ' / 5</div>
                <a href="/trains/comments?id=' . $value['id'] . '">Просмотреть комментарии к поезду</a>
            </div>
            ';
        ?>
    </div>
</div>
