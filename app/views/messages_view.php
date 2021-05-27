<div class="table">
    <div class="table-header">
        <div class="id-row">ID</div>
        <div>Имя</div>
        <div>E-mail</div>
        <div>Телефон</div>
        <div>Время для звонка</div>
        <div style="width: 300px">Сообщение</div>
        <div>Статус</div>
        <!-- <span style="visibility: hidden;">Редактировать</span> -->
        <div style="visibility: hidden;">Удалить</div>
    </div>
<?php if($data['messages'] === []): ?>
    <span>Таблица пуста</span>
<?php else:
        foreach($data['messages'] as $message): ?>
            <div class="table-row">
                <div class="id-row">
                <?php
                    $strlen = strlen($message['id']);
                    for ($i = 0; $i < 5-$strlen; $i++) {
                        echo "0";
                    }
                    echo $message['id'];
                ?>
                </div>
                <div><?= $message['name'] ?></div>
                <div><?= $message['email'] ?></div>
                <div><?= $message['phone'] ?></div>
                <div><? echo ($message['callback_time'] !== NULL ) ? $message['callback_time'] : '-' ?></div>
                <div class="message-text" style="width: 300px"><?= $message['text'] ?></div>
                <a class="table-action" href="#" onclick="customPrompt('Изменить статус', 'Изменить статус сообщения с id <?= $message['id'] ?> на', '/administrative/change_message_state?id=<?= $message['id'] ?>&state=1', '/administrative/change_message_state?id=<?= $message['id'] ?>&state=2', 'Просмотрели', 'Перезвонили')"><?= $message['state'] ?></a>
                <!-- <a class="table-action" href="#" onclick="trainForm('edit', <?= $train['id'] ?>)">Редактировать</a> -->
                <a class="table-action" href="#" onclick="customPrompt('Внимание', 'Вы уверены что хотите удалить сообщение с id <?= $message['id'] ?>?', '/administrative/delete_message?id=<?= $message['id'] ?>', '/administrative', 'Да', 'Нет')">Удалить</a>
            </div>
    <?php
    endforeach;
endif; 
?>
</div>

<div style="display:flex; justify-content: space-between;">
    <div></div>
    <?php
        require 'app/components/pagination_component.php';
        Pagination_Component::build($data['pagination']['cur_page'], $data['pagination']['pages'], $data['pagination']['action']);
    ?>
</div>