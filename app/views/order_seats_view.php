<div class="trains-main--block">
    <div class="title--block">
        <a href="/user/orders/" class="back--link"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.2899 12L14.8299 8.46C15.0162 8.27264 15.1207 8.01919 15.1207 7.755C15.1207 7.49081 15.0162 7.23736 14.8299 7.05C14.737 6.95627 14.6264 6.88188 14.5045 6.83111C14.3827 6.78034 14.252 6.7542 14.1199 6.7542C13.9879 6.7542 13.8572 6.78034 13.7354 6.83111C13.6135 6.88188 13.5029 6.95627 13.4099 7.05L9.16994 11.29C9.07622 11.383 9.00182 11.4936 8.95105 11.6154C8.90028 11.7373 8.87415 11.868 8.87415 12C8.87415 12.132 8.90028 12.2627 8.95105 12.3846C9.00182 12.5064 9.07622 12.617 9.16994 12.71L13.4099 17C13.5034 17.0927 13.6142 17.166 13.736 17.2158C13.8579 17.2655 13.9883 17.2908 14.1199 17.29C14.2516 17.2908 14.382 17.2655 14.5038 17.2158C14.6257 17.166 14.7365 17.0927 14.8299 17C15.0162 16.8126 15.1207 16.5592 15.1207 16.295C15.1207 16.0308 15.0162 15.7774 14.8299 15.59L11.2899 12Z" fill="#000000"/></svg><div>Вернуться к списку заказов</div></a>
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin: 30px 0;">
            <div>
                <div style="margin: 0;" class="title"><?= $data['order_info']['name'] ?></div>
                <div class="subtitle">Номер заказа: <?= $data['order_info']['id'] ?></div>
            </div>
        </div>
        <div class="line"></div>
    </div>
    <div class="table--block">
        <div class="table-header--block">
            <div>Номер вагона</div>
            <div>Тип вагона</div>
            <div>Номер места</div>
            <div></div>
        </div>
        <?php
        foreach ($data['seats'] as $value)
            echo '
            <div class="table-row--block" style="align-items: flex-start;">
                <div style="font-size: 13px;">' . $value['id_carriage'] . '</div>
                <div>' . $value['name'] . '</div>
                <div>' . $value['seat_num'] . '</div>
                <div></div>
            </div>
            ';
        ?>
    </div>
</div>
