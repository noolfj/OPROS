<?php
session_start();
include_once("dboprosnik.php");
include_once("session_status.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $pdo = new PDO("mysql:host=localhost;port=3306;dbname=oprosnik", "root", "");

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Записываем информацию о пользователе в сессию
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            // Создаем cookie для "запоминания" пользователя (по желанию)
            $cookie_name = 'remember_me';
            $cookie_value = $user['id'];
            $cookie_expire = time() + 3600 * 24 * 30; // Например, на месяц
            setcookie($cookie_name, $cookie_value, $cookie_expire, '/'); // Путь к куки, '/' означает доступность на всем сайте
            // После успешной аутентификации, перенаправляем на другую страницу
            header("Location: opros.php");
            exit(); // Важно завершить выполнение скрипта после перенаправления
        } else {
            echo "Invalid username or password.";
        }
    } catch (PDOException $e) {
        echo "Database Error:";
        writeToLog("Database Error:" . $e->getMessage());
        new Log($e);
        // $error_message = "Database Error: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Error:";
    }
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="/style/styleLogin.css">
</head>
<body>
    <h2>Login</h2>
    <div class="background"></div>
    <form  method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
    <button ><a href="index.php">Registration</a></button>
</body>
</html>
