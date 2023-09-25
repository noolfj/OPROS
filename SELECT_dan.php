<?php
include_once("dboprosnik.php");
include_once("SELECT_dan.php");
include_once("INSERT_opros.php");

// Извлечение данных о преподавателе, цикле и предмете
$sql = "SELECT * FROM opros,prepodavateli,cycles,subjects ";
$result=$pdo->query($sql);
$row = $result->fetch();
while($row = $result->fetch()){
    $id = $row["id"];
    $Prepodavateli = $row["fio"];
    $Cycles = $row["lesson_cycle"];
    $subjetcs = $row["subject"];

 }
try {
    $stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Ошибка выполнения SQL-запроса: " . $e->getMessage());
}
?>