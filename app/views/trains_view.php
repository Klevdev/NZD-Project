<div class="table">
    <div class="table-header">
        <div class="id-row">ID</div>
        <div>Тип поезда</div>
        <div>Сидячие</div>
        <div>Плацкартные</div>
        <div>Купе</div>
        <div>Комфорт</div>
        <!-- <span style="visibility: hidden;">Редактировать</span> -->
        <div style="visibility: hidden;">Удалить</div>
    </div>
<?php if($data['trains'] === []): ?>
    <span>Таблица пуста</span>
<?php else:
        foreach($data['trains'] as $train): ?>
            <div class="table-row">
                <div class="id-row">
                <?php
                    $strlen = strlen($train['id']);
                    for ($i = 0; $i < 5-$strlen; $i++) {
                        echo "0";
                    }
                    echo $train['id'];
                ?>
                </div>
                <div><?= $train['name'] ?></div>  
                <?php foreach($train['carriages'] as $carriage_num): ?>
                    <div class="id"><?= $carriage_num ?> ваг.</div>
                <?php endforeach; ?>
                <!-- <a class="table-action" href="#" onclick="trainForm('edit', <?= $train['id'] ?>)">Редактировать</a> -->
                <a class="table-action" href="#" onclick="customPrompt('Внимание', 'Вы уверены что хотите удалить поезд с id <?= $train['id'] ?>?', '/administrative/delete_train?id=<?= $train['id'] ?>', '/administrative', 'Да', 'Нет')">Удалить</a>
            </div>
    <?php
    endforeach;
endif; 
?>
</div>

<div style="display:flex; justify-content: space-between;">
    <button onclick="trainForm('add')">Добавить поезд</button>
    <?php
        require 'app/components/pagination_component.php';
        Pagination_Component::build($data['pagination']['cur_page'], $data['pagination']['pages'], $data['pagination']['action']);
    ?>
</div>