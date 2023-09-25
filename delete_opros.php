<?php
// Подключаемся к базе данных
include_once("dboprosnik.php");

// Проверяем, был ли передан ID для удаления
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        // Готовим SQL-запрос для удаления записи
        $query = "DELETE FROM opros WHERE id = :id";
        $sql = $pdo->prepare($query);

        // Подставляем параметры в запрос
        $sql->bindParam(':id', $id, PDO::PARAM_INT);

        // Выполняем запрос
        $sql->execute();

        echo 'Запись успешно удалена.';
        header('Location:read_data.php');
    } catch (PDOException $e) {
        echo 'Ошибка при удалении записи: ' . $e->getMessage();
    }
} else {
    echo "Не указан ID записи для удаления.";
}
?>
