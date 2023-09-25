<?php
include_once('helpers/Log.php');
function connectToDatabase() {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=oprosnik', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (!$pdo) {
            throw new Exception('Не удалось подключиться к базе данных');
        }
        return $pdo;
    } catch (Exception $e) {
        throw new Exception('Ошибка при подключении к базе данных: ' . $e->getMessage());
    }
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oprosnik";

// try {
// $pdo = connectToDatabase($servername, $dbname, $username, $password);
// } catch (PDOException $e) {
//     new log($e);
// }

//$pdo = connectToDatabase($servername, $dbname, $username, $password);
?>