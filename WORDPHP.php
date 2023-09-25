<?php
require_once 'vendor/autoload.php'; // Подключаем автозагрузчик Composer
include_once("dboprosnik.php");
// Идентификатор или имя выбранного преподавателя (замените на нужное значение)
$selectedTeacherIdOrName = "Шарипов Зафар Шарипович"; // Замените на нужный вам идентификатор или имя Мамдов Рахмон Махмудович

// Создаем новый объект PHPWord
$phpWord = new \PhpOffice\PhpWord\PhpWord();

// Создаем раздел (section) в документе
$section = $phpWord->addSection();

// Создаем стиль для заголовка
$titleStyle = array(
    'size' => 18,
    'bold' => true,
    'alignment' => 'center',
    'spaceAfter' => 200,
    'color' => 'FF0000', // Красный цвет (в формате RGB)
);
$section->addText('Отчет на основе данных опроса', $titleStyle);

// SQL-запрос для вычисления среднего балла оценок выбранного преподавателя
$sql = "SELECT AVG(grade_1 + grade_2 + grade_3 + grade_4 + grade_5) AS avg_grade FROM opros WHERE prepodavateli_fio = :teacher_name";

// Подготовка и выполнение запроса
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':teacher_name', $selectedTeacherIdOrName, PDO::PARAM_STR);
$stmt->execute();

// Получение результата
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Извлечение среднего балла
$averageGrade = $result['avg_grade'];

// Добавляем средний балл в документ
$section->addText("Средний балл для преподавателя $selectedTeacherIdOrName: " . number_format($averageGrade, 1));

// Сохраняем документ в файл
$filename = 'srball.docx';
$phpWord->save($filename);

echo "Отчет сохранен как '$filename'.";
?>































// require_once 'vendor/autoload.php'; // Подключаем автозагрузчик Composer
// include_once("dboprosnik.php");

// // Создаем новый объект PHPWord
// $phpWord = new \PhpOffice\PhpWord\PhpWord();

// // Создаем раздел (section) в документе
// $section = $phpWord->addSection();

// // Создаем стиль для заголовка
// $titleStyle = array(
//     'size' => 18,
//     'bold' => true,
//     'alignment' => 'center',
//     'spaceAfter' => 200,
//     'color' => 'FF0000', // Красный цвет (в формате RGB)
// );
// $section->addText('Отчет на основе данных опроса', $titleStyle);

// // Создаем таблицу
// $tableStyle = array(
//     'borderSize' => 6,
//     'cellMargin' => 80,
//     'alignment' => 'center',
// );
// $table = $section->addTable($tableStyle);

// // Заголовки столбцов
// $table->addRow();
// $headerCellStyle = array(
//     'bold' => true,
//     'color' => 'FF0000', // Красный цвет
// );
// $table->addCell(2000)->addText('ID', $headerCellStyle);
// $table->addCell(4000)->addText('ФИО преподавателя', $headerCellStyle);
// $table->addCell(2500)->addText('Цикл', $headerCellStyle);
// $table->addCell(4000)->addText('Предмет', $headerCellStyle);
// $table->addCell(2000)->addText('Вопрос 1', $headerCellStyle);
// $table->addCell(2000)->addText('Оценка 1', $headerCellStyle);
// $table->addCell(2000)->addText('Вопрос 2', $headerCellStyle);
// $table->addCell(2000)->addText('Оценка 2', $headerCellStyle);
// $table->addCell(2000)->addText('Вопрос 3', $headerCellStyle);
// $table->addCell(2000)->addText('Оценка 3', $headerCellStyle);
// $table->addCell(2000)->addText('Вопрос 4', $headerCellStyle);
// $table->addCell(2000)->addText('Оценка 4', $headerCellStyle);
// $table->addCell(2000)->addText('Вопрос 5', $headerCellStyle);
// $table->addCell(2000)->addText('Оценка 5', $headerCellStyle);
// $table->addCell(4000)->addText('Комментарии', $headerCellStyle);

// // Запрос к базе данных
// $sql = "SELECT * FROM opros";
// $result = $pdo->query($sql);

// // Добавляем данные из базы данных в таблицу
// while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
//     $table->addRow();
//     $table->addCell(2000)->addText($row['id']);
//     $table->addCell(4000)->addText($row['prepodavateli_fio']);
//     $table->addCell(2500)->addText($row['lesson_c']);
//     $table->addCell(4000)->addText($row['subject_s']);
//     $table->addCell(2000)->addText($row['question1_text']);
//     $table->addCell(2000)->addText($row['grade_1']);
//     $table->addCell(2000)->addText($row['question2_text']);
//     $table->addCell(2000)->addText($row['grade_2']);
//     $table->addCell(2000)->addText($row['question3_text']);
//     $table->addCell(2000)->addText($row['grade_3']);
//     $table->addCell(2000)->addText($row['question4_text']);
//     $table->addCell(2000)->addText($row['grade_4']);
//     $table->addCell(2000)->addText($row['question5_text']);
//     $table->addCell(2000)->addText($row['grade_5']);
//     $table->addCell(4000)->addText($row['comment_text']);
// }

// // Сохраняем документ в файл
// $filename = 'otchet.docx';
// $phpWord->save($filename);

// echo "Отчет сохранен как '$filename'.";

