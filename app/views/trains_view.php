<div class="table">
<?php if($data['trains'] === []): ?>
    <span style="grid-column: 1/8">Таблица пуста</span>
<?php else:
        foreach($data['trains'] as $train): ?>
            <div class="table-row">
                <span class="id"><?= $train['id'] ?><span>
                <span><?= $train['name'] ?><span>  
                <?php foreach($train['carriages'] as $carriage_num): ?>
                    <span class="id"><?= $carriage_num ?><span>
                <?php endforeach; ?>
                <span>Редактировать<span>
                <span>Удалить<span>
            </div>
    <?php
    endforeach;
endif; 
?>
</div>

<div style="display:flex; justify-content: space-between;">
    <button onclick="addTrain()">Добавить поезд</button>
    <?php //Pagination_Component::build($data['pagination']['cur_page'], $data['pagination']['pages'], $data['pagination']['href_base']); ?>
</div>