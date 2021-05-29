<div class="table">
    <div class="table-header">
        <div class="id-row">ID</div>
        <div>Название</div>
        <div style="width: 400px;">Станции маршрута</div>
        <!-- <div>Время в пути</div> -->
        <div>Длина маршрута</div>
        <span style="visibility: hidden;">Редактировать</span>
        <div style="visibility: hidden;">Удалить</div>
    </div>
<?php if($data['routes'] === []): ?>
    <span>Таблица пуста</span>
<?php else:
        foreach($data['routes'] as $route): ?>
            <div class="table-row">
                <div class="id-row">
                <?php
                    $strlen = strlen($route['id']);
                    for ($i = 0; $i < 5-$strlen; $i++) {
                        echo "0";
                    }
                    echo $route['id'];
                ?>
                </div>
                <div><?= $route['name'] ?></div>  
                <div style="width: 400px;display: flex; flex-direction: column;">
                    <?php foreach($route['stations'] as $stop_index => $station): ?>
                        <span><?= $stop_index ?>) <?= $station['name'] ?> [<?= $station['id'] ?>]<?= $station['stop_duration'] ? " - ".$station['stop_duration']." мин." : '' ?></span>
                    <?php endforeach; ?>
                </div>
                <!-- <div><?= (ceil($route['time']/60/24) > 1) ? ceil($route['time']/60/24).' д.'.(ceil($route['time']%60)).' ч.' : round($route['time']/60, 2).' ч.' ?></div>   -->
                <div><?= $route['length'] ?> км</div>  
                <a class="table-action" href="#" onclick="routeForm('edit', <?= $route['id'] ?>)">Редактировать</a>
                <a class="table-action" href="#" onclick="customPrompt('Внимание', 'Вы уверены что хотите удалить маршрут <?= $route['name'] ?>?', '/administrative/delete_route?id=<?= $route['id'] ?>', '/administrative', 'Да', 'Нет')">Удалить</a>
            </div>
    <?php
    endforeach;
endif; 
?>
</div>

<div style="display:flex; justify-content: space-between;">
    <div>
        <!-- <button onclick="routeForm('add')" style="margin-right: 10px">Добавить маршрут</button>
        <button onclick="addStation()">Добавить станцию</button> -->
    </div>
    <?php
        require 'app/components/pagination_component.php';
        Pagination_Component::build($data['pagination']['cur_page'], $data['pagination']['pages'], $data['pagination']['action']);
    ?>
</div>