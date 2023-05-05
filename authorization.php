<?php
// Подключаемся к базе данных
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "k5411894";
$dbName = "users";

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

// Проверяем, были ли переданы данные из формы
if (isset($_POST['email']) && isset($_POST['password'])) {

    // Обрабатываем данные из формы
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Ищем пользователя с такой же почтой и паролем в базе данных
    $sql = "SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password'";
    $result = mysqli_query($conn, $sql);

    // Проверяем, был ли запрос выполнен успешно
    if (!$result) {
        die("Ошибка выполнения запроса: " . mysqli_error($conn));
    }

    // Проверяем, был ли найден пользователь
    if (mysqli_num_rows($result) == 1) {
        // Пользователь найден, выполняем вход
        session_start();
        $_SESSION['email'] = $email;
        header("Location: profile.php");
    } else {
        // Пользователь не найден, выводим сообщение об ошибке
        die("Ошибка: неверный email или пароль");
    }

    // Закрываем соединение с базой данных
    mysqli_close($conn);

} else {
    die("Ошибка: не переданы данные из формы");
}
?>