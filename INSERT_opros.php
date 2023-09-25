<?php
include_once( 'dboprosnik.php' );
include_once( 'SELECT_dan.php' );

try {
    $conn = new PDO( "mysql:host=$servername;dbname=$dbname", $username, $password );
    // Устанавливаем режим ошибок PDO в исключительный
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
//-------------------------------------------------Сохранения данных в БД--------------------------------------------------------------------------
    // Обработка данных из формы и сохранение их в БД
    if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
        $fio = $_POST[ 'fio' ];
        $Cycles = $_POST[ 'Cycles' ];
        $Subjects = $_POST[ 'Subjects' ];
        $grade_1 = $_POST[ 'grade_1' ];
        $grade_2 = $_POST[ 'grade_2' ];
        $grade_3 = $_POST[ 'grade_3' ];
        $grade_4 = $_POST[ 'grade_4' ];
        $grade_5 = $_POST[ 'grade_5' ];
        $question1_text = $_POST[ 'question1_text' ];
        $question2_text = $_POST[ 'question2_text' ];
        $question3_text = $_POST[ 'question3_text' ];
        $question4_text = $_POST[ 'question4_text' ];
        $question5_text = $_POST[ 'question5_text' ];
        $comment_text = $_POST[ 'comment_text' ];

        // Подготавливаем SQL-запрос с плейсхолдерами
        $stmt = $conn->prepare( "INSERT INTO opros (prepodavateli_fio, lesson_c, subject_s, grade_1, grade_2 , grade_3 , grade_4 , grade_5,
        comment_text ,question1_text,question2_text,question3_text,question4_text,question5_text)
        VALUES (:fio, :Cycles, :Subjects , :grade_1 , :grade_2 , :grade_3 , :grade_4 , :grade_5 , :comment_text,
        :question1_text,:question2_text,:question3_text,:question4_text,:question5_text)" );

        // Заменяем плейсхолдеры значениями
        $stmt->bindParam( ':fio', $fio );
        $stmt->bindParam( ':Cycles', $Cycles );
        $stmt->bindParam( ':Subjects', $Subjects );
        $stmt->bindParam( ':grade_1', $grade_1 );
        $stmt->bindParam( ':grade_2', $grade_2 );
        $stmt->bindParam( ':grade_3', $grade_3 );
        $stmt->bindParam( ':grade_4', $grade_4 );
        $stmt->bindParam( ':grade_5', $grade_5 );
        $stmt->bindParam( ':question1_text', $question1_text );
        $stmt->bindParam( ':question2_text', $question2_text );
        $stmt->bindParam( ':question3_text', $question3_text );
        $stmt->bindParam( ':question4_text', $question4_text );
        $stmt->bindParam( ':question5_text', $question5_text );
        $stmt->bindParam( ':comment_text', $comment_text );

        // Выполняем запрос
        $stmt->execute();

        // echo 'Данные успешно сохранены в БД';
//--------------------------------------------------------Сохранения данных в ТЕКСТОВЫЙ ФАЙЛ-------------------------------------------------------------------
        $dataString = "ФИО: $fio\n";
        $dataString .= "Цикл: $Cycles\n";
        $dataString .= "Предмет: $Subjects\n";
        $dataString .= "Вопрос $question1_text\n Оценки: $grade_1\n";
        $dataString .= "Вопрос $question2_text\n Оценки: $grade_2\n";
        $dataString .= "Вопрос $question3_text\n Оценки: $grade_3\n";
        $dataString .= "Вопрос $question4_text\n Оценки: $grade_4\n";
        $dataString .= "Вопрос $question5_text\n Оценки: $grade_5\n";
        $dataString .= "Комментарий: $comment_text\n";

        // Указать путь к файлу, в который нужно сохранить данные
        $filePath = 'data_opros.txt';
//-----------------------------------------------ВЫВОД РЕЗУЛЬТАТА В ФОРМЕ ОПРОС----------------------------------------------------------------------------
        $grade1 = $_POST[ 'grade_1' ];
        $grade2 = $_POST[ 'grade_2' ];
        $grade3 = $_POST[ 'grade_3' ];
        $grade4 = $_POST[ 'grade_4' ];
        $grade5 = $_POST[ 'grade_5' ];

        // Рассчитываем средний балл
        $averageGrade = ( $grade1 + $grade2 + $grade3 + $grade4 + $grade5 ) / 5;

        // Создаем HTML-код с результатами опроса
        $resultHTML = '<h2>Результаты опроса:</h2>';
        $resultHTML .= "<p>Оценка по вопросу 1: $grade1</p>";
        $resultHTML .= "<p>Оценка по вопросу 2: $grade2</p>";
        $resultHTML .= "<p>Оценка по вопросу 3: $grade3</p>";
        $resultHTML .= "<p>Оценка по вопросу 4: $grade4</p>";
        $resultHTML .= "<p>Оценка по вопросу 5: $grade5</p>";
        $resultHTML .= "<p>Средний балл: $averageGrade</p>";

        // Возвращаем HTML-код с результатами в виде ответа на AJAX-запрос
        echo $resultHTML;

        // Записать данные в текстовый файл
        if ( file_put_contents( $filePath, $dataString, FILE_APPEND ) ) {
            echo 'Данные успешно сохранены в БД и в текстовый файл<br>';
        } else {
            echo 'Ошибка при сохранении данных в текстовый файл';
        }
    }
} catch ( PDOException $e ) {
    echo 'Ошибка при сохранении данных: ' . $e->getMessage();
}

// Закрытие соединения с БД
$conn = null;
?>
