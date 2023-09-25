<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oprosnik";
$port=3306;
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Проверка соединения
if (!$conn) {
    die("Ошибка соединения: " . mysqli_connect_error());
}
// Запрос для выборки данных из таблицы
$sql = "SELECT * FROM opros";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Ошибка запроса: " . mysqli_error($conn));
}
// Создаем объект XML
$xml = new XMLWriter();
$xml->openMemory();
$xml->startDocument('1.0', 'UTF-8');
$xml->startElement('data'); // Корневой элемент

// Извлекаем данные из результата запроса и записываем их в XML
while ($row = mysqli_fetch_assoc($result)) {
    $xml->startElement('row'); // Элемент для каждой строки данных
    foreach ($row as $field => $value) {
        $xml->startElement($field); // Элемент для каждого поля данных
        $xml->text($value); // Значение поля данных
        $xml->endElement(); // Закрываем элемент поля данных
    }
    $xml->endElement(); // Закрываем элемент строки данных
}

$xml->endElement(); // Закрываем корневой элемент
$xml->endDocument();
// Закрытие соединения с базой данных
mysqli_close($conn);
// Сохраняем XML в файл
$xmlString = $xml->outputMemory();
file_put_contents('opros.xml', $xmlString);
echo 'Данные экспортированы в XML файл "opros.xml".';
?>
