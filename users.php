<?php
// Установите соединение с базой данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oprosnik";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения

if ($conn->connect_error) {
    die("Ошибка соединения: " . $conn->connect_error);
}
// Загрузка XML-файла
$xml = simplexml_load_file('users.xml');

// Импорт данных в таблицу users
foreach ($xml->user as $user) {
    $username = $user->username;
    $plaintextPassword = $user->password; // Получаем пароль в открытом виде из XML
    
    // Хешируем пароль
    $hashedPassword = password_hash($plaintextPassword, PASSWORD_DEFAULT);
    
    // Вставка данных в таблицу users с хешированным паролем
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
    if ($conn->query($sql) === TRUE) {
        echo "Запись успешно добавлена:  $username, $hashedPassword<br>";
    } else {
        echo "Ошибка при добавлении записи: " . $conn->error;
    }
}
// Закрытие соединения с базой данных
$conn->close();
?>
