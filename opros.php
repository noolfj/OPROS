<?php

session_start();
include_once("dboprosnik.php");
include_once("SELECT_dan.php");
include_once("INSERT_opros.php");


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];

    // Теперь у вас есть доступ к данным пользователя, сохраненным в сессии
    echo "Вы вошли как $username (ID: $user_id).";

    // Если вы хотите разрешить пользователю выйти из сессии (выход)
    echo '<a href="logout.php">Logout</a>';
} else {
    // Если пользователь не вошел, можно выполнить действия, например, перенаправить на страницу входа.
    header("Location: login.php");
    exit(); // Важно завершить выполнение скрипта после перенаправления
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Опросник</title>
    <link rel="stylesheet" href="/style/styles.css">
    <!-- <script src="scripts/script.js"></script> -->
    <script src="jquery.js"></script>
    <script>
    $(document).ready(function () {
    // Обработчик отправки формы опросника
    $("form").submit(function (e) {
        e.preventDefault(); // Предотвращаем обычную отправку формы

        // Собираем данные из формы
        var formData = $(this).serialize();

        // Отправляем данные на сервер через AJAX
        $.ajax({
            type: "POST", // Метод HTTP-запроса
            url: "INSERT_opros.php", // URL для обработки данных на сервере
            data: formData, // Данные, отправляемые на сервер
            success: function (response) {
                // Обработка успешного ответа от сервера
                $("#surveyResults").html(response); // Отображаем результаты опроса
            }
        });
    });
});
</script>
</head>
<body>

    <div class="background"></div>
    <h1>Опросник</h1>
    <!-- Форма опросника -->
    <form method="post">
        <!-- ФИО преподавателя -->
        <b class="name">ФИО преподавателя: <?= $row['fio'] ?></b>
        <input type="text" name="fio" value="<?= $row['fio'] ?>" hidden>
<br>

<!-- Выбор цикла -->
<b class="name">Цикл: <?= $row['lesson_cycle'] ?></b>
<input type="text" name="Cycles" value="<?= $row['lesson_cycle'] ?>" hidden>
<br>
<b class="name">Предмет: <?= $row['subject'] ?></b>
<input type="text" name="Subjects" value="<?= $row['subject'] ?>" hidden>

        <div id="question">
            <h2 name="question1_text">1: Насколько хорошо преподаватель мотивирует Вас к изучению предмета</h2>
            <textarea name="question1_text" hidden>1: Насколько хорошо преподаватель мотивирует Вас к изучению предмета</textarea>
            <p>Выберите оценку от 1 до 5:</p>
            <input type="radio"  name="grade_1" value="1">
            <label for="rating1_1">1</label>
            <input type="radio" id="rating1_2" name="grade_1" value="2">
            <label for="rating1_2">2</label>
            <input type="radio" id="rating1_3" name="grade_1" value="3">
            <label for="rating1_3">3</label>
            <input type="radio" id="rating1_4" name="grade_1" value="4">
            <label for="rating1_4">4</label>
            <input type="radio" id="rating1_5" name="grade_1" value="5">
            <label for="rating1_5">5</label>

            <h2 name="question2_text">2: Насколько справедливо, на Ваш взгляд, преподаватель оценил Ваши знания</h2>
            <textarea name="question2_text" hidden>2: Насколько справедливо, на Ваш взгляд, преподаватель оценил Ваши знания</textarea>

            <p>Выберите оценку от 1 до 5:</p>
            <input type="radio" id="rating2_1" name="grade_2" value="1">
            <label for="rating2_1">1</label>
            <input type="radio" id="rating2_2" name="grade_2" value="2">
            <label for="rating2_2">2</label>
            <input type="radio" id="rating2_3" name="grade_2" value="3">
            <label for="rating2_3">3</label>
            <input type="radio" id="rating2_4" name="grade_2" value="4">
            <label for="rating2_4">4</label>
            <input type="radio" id="rating2_5" name="grade_2" value="5">
            <label for="rating2_5">5</label>

            <h2>3: Соответствовали ли задания преподавателя пройденному материалу</h2>
            <textarea name="question3_text" hidden>3: Соответствовали ли задания преподавателя пройденному материалу</textarea>

            <p>Выберите оценку от 1 до 5:</p>
            <input type="radio" id="rating3_1" name="grade_3" value="1">
            <label for="rating3_1">1</label>
            <input type="radio" id="rating3_2" name="grade_3" value="2">
            <label for="rating3_2">2</label>
            <input type="radio" id="rating3_3" name="grade_3" value="3">
            <label for="rating3_3">3</label>
            <input type="radio" id="rating3_4" name="grade_3" value="4">
            <label for="rating3_4">4</label>
            <input type="radio" id="rating3_5" name="grade_3" value="5">
            <label for="rating3_5">5</label>

            <h2>4: Ваш преподаватель старается донести до Вас смысл или факты</h2>
            <textarea name="question4_text" hidden>4: Ваш преподаватель старается донести до Вас смысл или факты</textarea>

            <p>Выберите оценку от 1 до 5:</p>
            <input type="radio" id="rating4_1" name="grade_4" value="1">
            <label for="rating4_1">1</label>
            <input type="radio" id="rating4_2" name="grade_4" value="2">
            <label for="rating4_2">2</label>
            <input type="radio" id="rating4_3" name="grade_4" value="3">
            <label for="rating4_3">3</label>
            <input type="radio" id="rating4_4" name="grade_4" value="4">
            <label for="rating4_4">4</label>
            <input type="radio" id="rating4_5" name="grade_4" value="5">
            <label for="rating4_5">5</label>

            <h2>5: Насколько четко и понятно преподаватель объясняет материал</h2>
            <textarea name="question5_text" hidden>5: Насколько четко и понятно преподаватель объясняет материал</textarea>

            <p>Выберите оценку от 1 до 5:</p>
            <input type="radio" id="rating5_1" name="grade_5" value="1">
            <label for="rating5_1">1</label>
            <input type="radio" id="rating5_2" name="grade_5" value="2">
            <label for="rating5_2">2</label>
            <input type="radio" id="rating5_3" name="grade_5" value="3">
            <label for="rating5_3">3</label>
            <input type="radio" id="rating5_4" name="grade_5" value="4">
            <label for="rating5_4">4</label>
            <input type="radio" id="rating5_5" name="grade_5" value="5">
            <label for="rating5_5">5</label>
        </div>
        <br>
        <div class="comments">
            <label for="comments"><b>Комментарии:</b></label>
            <textarea  name="comment_text" rows="4" cols="50"></textarea>
        </div>
        <!-- Кнопка отправки формы -->
        <br>
        <input type="submit" value="Отправить">
    </form>
    <!-- <a href="generate_report.php?teacher_name=Шарипов Зафар Шарипович">Сгенерировать отчет для преподавателя Шарипов Зафар Шарипович</a> -->

    <div id="surveyResults">
    <!-- Здесь будут отображаться результаты опроса -->
</div>

</body>

</html>