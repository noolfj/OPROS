<?php
include_once("dboprosnik.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Хешируем пароль
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=oprosnik', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $hashedPassword]);

        echo "Регистрация прошла успешно!. Вы можетье перейти в  <a href='login.php'>login</a>.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" href="/style/styleLogin.css">
</head>
<body>
    <h2>Registration</h2>
    <div class="background"></div>
    <form  method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Register">
    </form>
    <button ><a href="login.php">Login</a></button>
    
</body>
</html>

