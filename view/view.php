<?php
class SurveyView {
    public function renderTable($responses) {
        echo '<table border="1" width="100%">';
        echo '<tr>
                <th>ID</th>
                <th>ФИО преподавателя</th>
                <th>Цикл</th>
                <th>Предмет</th>
                <th>Вопрос 1</th>
                <th>Оценка 1</th>
                <th>Вопрос 2</th>
                <th>Оценка 2</th>
                <th>Вопрос 3</th>
                <th>Оценка 3</th>
                <th>Вопрос 4</th>
                <th>Оценка 4</th>
                <th>Вопрос 5</th>
                <th>Оценка 5</th>
                <th>Комментарии</th>
            </tr>';

        foreach ($responses as $row) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['prepodavateli_fio'] . '</td>';
            echo '<td>' . $row['lesson_c'] . '</td>';
            echo '<td>' . $row['subject_s'] . '</td>';
            echo '<td>' . $row['question1_text'] . '</td>';
            echo '<td>' . $row['grade_1'] . '</td>';
            echo '<td>' . $row['question2_text'] . '</td>';
            echo '<td>' . $row['grade_2'] . '</td>';
            echo '<td>' . $row['question3_text'] . '</td>';
            echo '<td>' . $row['grade_3'] . '</td>';
            echo '<td>' . $row['question4_text'] . '</td>';
            echo '<td>' . $row['grade_4'] . '</td>';
            echo '<td>' . $row['question5_text'] . '</td>';
            echo '<td>' . $row['grade_5'] . '</td>';
            echo '<td>' . $row['comment_text'] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    }
}
?>