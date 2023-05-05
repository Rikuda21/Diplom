<?php
// Подключаемся к базе данных
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "k5411894";
$dbName = "users";
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

// Проверяем, был ли передан email из формы
if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Проверяем, есть ли пользователь с таким email в базе данных
    $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Если пользователь уже зарегистрирован, выводим сообщение об ошибке и прекращаем выполнение скрипта
        echo "<span style='color: red;'>Пользователь с таким email уже зарегистрирован. Пожалуйста, используйте другой email.</span>";
        exit();
    } else {
        // Если email свободен, выводим сообщение об успешной проверке
        echo "<span style='color: green;'>Email свободен для регистрации.</span>";
    }

    // Закрываем соединение с базой данных
    mysqli_close($conn);
} else {
    // Если email не был передан, выводим сообщение об ошибке
    echo "<span style='color: red;'>Ошибка: email не был передан.</span>";
}
?>