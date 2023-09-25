<?php
include_once("helpers/log.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oprosnik";
$port = 3306;

$options = [
    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $dsn = "mysql:host=$servername;dbname=$dbname;port=$port";
    $pdo = new \PDO($dsn, $username, $password, $options);
    // echo "Успешное подключение к базе данных ";
    writeToLog("Успешное подключение к базе данных");
} catch (PDOException $e) {
    // Обработка ошибки подключения к базе данных
    writeToLog("Ошибка подключения к базе данных: " . $e->getMessage());
    // Перебросим исключение, добавив к нему более подробное сообщение
    throw new Exception("Произошла ошибка при подключении к базе данных: " . $e->getMessage());
new Log($e);
}

?>
