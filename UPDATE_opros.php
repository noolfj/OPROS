<?php
// Выбер id
// update_opros.php?id=
include_once("dboprosnik.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM opros WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "Не указан ID записи для обновления.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $grade_1 = $_POST['grade_1'];
    $grade_2 = $_POST['grade_2'];
    $grade_3 = $_POST['grade_3'];
    $grade_4 = $_POST['grade_4'];
    $grade_5 = $_POST['grade_5'];
    $comment_text = $_POST['comment_text'];

    try {
        $query = "UPDATE opros SET grade_1 = :grade_1, grade_2 = :grade_2, grade_3 = :grade_3,
        grade_4 = :grade_4, grade_5 = :grade_5, comment_text=:comment_text WHERE id = :id";
        $sql = $pdo->prepare($query);

        $data = [
            'id' => $id,
            'grade_1' => $grade_1,
            'grade_2' => $grade_2,
            'grade_3' => $grade_3,
            'grade_4' => $grade_4,
            'grade_5' => $grade_5,
            'comment_text' => $comment_text,
        ];
        $sql->execute($data);
        echo 'Оценки успешно обновлены.';
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обновление данных</title>
    <link rel="stylesheet" href="/style/styles.css">
    <script src="scripts/script.js"></script>
</head>
<body>
    <h1>Обновление данных</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        
        <h2>1: Насколько хорошо преподаватель мотивирует Вас к изучению предмета</h2>
        <p>Выберите новую оценку от 1 до 5:</p>
        <input type="radio" name="grade_1" value="1">
        <label for="rating1_1">1</label>
        <input type="radio" name="grade_1" value="2">
        <label for="rating1_2">2</label>
        <input type="radio" name="grade_1" value="3">
        <label for="rating1_3">3</label>
        <input type="radio" name="grade_1" value="4">
        <label for="rating1_4">4</label>
        <input type="radio" name="grade_1" value="5">
        <label for="rating1_5">5</label>

        <h2 name="question2_text">2: Насколько справедливо, на Ваш взгляд, преподаватель оценил Ваши знания</h2>

        <p>Выберите новую оценку от 1 до 5:</p>

            <input type="radio"  name="grade_2" value="1">
            <label for="rating2_1">1</label>
            <input type="radio"  name="grade_2" value="2">
            <label for="rating2_2">2</label>
            <input type="radio"  name="grade_2" value="3">
            <label for="rating2_3">3</label>
            <input type="radio"  name="grade_2" value="4">
            <label for="rating2_4">4</label>
            <input type="radio"  name="grade_2" value="5">
            <label for="rating2_5">5</label>

            <h2>3: Соответствовали ли задания преподавателя пройденному материалу</h2>

            <p>Выберите новую оценку от 1 до 5:</p>

            <input type="radio"  name="grade_3" value="1">
            <label for="rating3_1">1</label>
            <input type="radio"  name="grade_3" value="2">
            <label for="rating3_2">2</label>
            <input type="radio"  name="grade_3" value="3">
            <label for="rating3_3">3</label>
            <input type="radio"  name="grade_3" value="4">
            <label for="rating3_4">4</label>
            <input type="radio"  name="grade_3" value="5">
            <label for="rating3_5">5</label>

            <h2>4: Ваш преподаватель старается донести до Вас смысл или факты</h2>

            <p>Выберите новую оценку от 1 до 5:</p>

            <input type="radio"  name="grade_4" value="1">
            <label for="rating4_1">1</label>
            <input type="radio"  name="grade_4" value="2">
            <label for="rating4_2">2</label>
            <input type="radio"  name="grade_4" value="3">
            <label for="rating4_3">3</label>
            <input type="radio"  name="grade_4" value="4">
            <label for="rating4_4">4</label>
            <input type="radio"  name="grade_4" value="5">
            <label for="rating4_5">5</label>

            <h2>5: Насколько четко и понятно преподаватель объясняет материал</h2>

            <p>Выберите новую оценку от 1 до 5:</p>

            <input type="radio"  name="grade_5" value="1">
            <label for="rating5_1">1</label>
            <input type="radio"  name="grade_5" value="2">
            <label for="rating5_2">2</label>
            <input type="radio"  name="grade_5" value="3">
            <label for="rating5_3">3</label>
            <input type="radio"  name="grade_5" value="4">
            <label for="rating5_4">4</label>
            <input type="radio"  name="grade_5" value="5">
            <label for="rating5_5">5</label>
        </div>
        <!-- Аналогично добавьте остальные поля для обновления оценок -->
        <div class="comments">
            <label for="comments"><b>Новый комментарии:</b></label>
            <textarea  name="comment_text" rows="4" cols="50"></textarea>
        </div>
        <br>
        <input type="submit" value="Обновить">
    </form>
</body>
</html>