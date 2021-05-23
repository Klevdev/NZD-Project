<?php 
// вывод ошибок и предупреждений
ini_set('display_errors', 1);

// подключение базовых классов
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/router.php';

// подключение каких-то других модулей
// ...

// константа с данными для подключения к БД
define('DB_CREDS', [
    'host' => '127.0.0.1',
    'user' => 'nzd_admin',
    'pass' => 'xqFv/o>01BgoB_Tj',
    'base' => 'nzd'
]);

define('MD5_SALT', 'потомучтоямогу'); // ThisIsAdditionalSecurityMeasureDontForgetIt
define('DB_ERROR', '🍆');
define('ELEMENTS_PER_PAGE', 10);

define('MYSQL_DATE_FORMAT', 'Y-m-d G:i:s');
define('DATETIME_FORMAT', 'j M Y H:i');
define('DATE_FORMAT', 'j M Y');
define('TIME_FORMAT', 'H:i');

// оно здесь вообще нужно ?
if(!isset($_SESSION)) {
   session_start(['read_and_close' => true]);
}

Route::start(); // запуск маршрутизатора
