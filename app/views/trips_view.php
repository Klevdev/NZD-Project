<div class="table">
    <div class="table-header">
        <div class="id-row">ID</div>
        <div>Маршрут</div>
        <div>Поезд</div>
        <div>Время отбытия</div>
        <span style="visibility: hidden;">Редактировать</span>
        <div style="visibility: hidden;">Удалить</div>
    </div>
<?php if($data['trips'] === []): ?>
    <span>Таблица пуста</span>
<?php else:
        foreach($data['trips'] as $trip): ?>
            <div class="table-row">
                <div class="id-row">
                <?php
                    $strlen = strlen($trip['id']);
                    for ($i = 0; $i < 5-$strlen; $i++) {
                        echo "0";
                    }
                    echo $trip['id'];
                ?>
                </div>
                <div><?= $trip['route_name'] ?></div>
                <div><?= $trip['train_id'] ?></div>
                <div><?= $trip['start_time'] ?></div>
                <a class="table-action" href="#" onclick="tripForm('edit',<?= $trip['id'] ?>)">Редактировать</a>
                <a class="table-action" href="#" onclick="customPrompt('Внимание','Вы уверены что хотите отменить рейс <?= $trip['route_name'] ?> <?= $trip['start_time'] ?>?','/administrative/delete_trip?id=<?= $trip['id'] ?>','/administrative', 'Да', 'Нет')">Отменить</a>
            </div>
    <?php
    endforeach;
endif; 
?>
</div>

<div style="display:flex; justify-content: space-between;">
    <button onclick="tripForm('add')" style="margin-right: 10px">Добавить рейс</button>
    <?php
        require 'app/components/pagination_component.php';
        Pagination_Component::build($data['pagination']['cur_page'], $data['pagination']['pages'], $data['pagination']['action']);
    ?>
</div>