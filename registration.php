<?php
// Подключаемся к базе данных
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "k5411894";
$dbName = "users";

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

// Проверяем, были ли переданы данные из формы
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {

    // Обрабатываем данные из формы
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $street = mysqli_real_escape_string($conn, $_POST['street']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $house = mysqli_real_escape_string($conn, $_POST['house']);
    $apartment = mysqli_real_escape_string($conn, $_POST['apartment']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $altPhone = mysqli_real_escape_string($conn, $_POST['alt_phone_number']);

    // Генерируем номер лицевого счета
    $accountNumber = rand(1000000, 9999999);

    // Проверяем, существует ли пользователь с таким email
    $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        die("Пользователь с таким email уже существует");
    }
    
    // Добавляем данные в базу данных
    $sql = "INSERT INTO `users` (`name`, `email`, `password`, `street`, `city`, `house`, `apartment`, `phone_number`, `alt_phone_number`, `accountNumber`) VALUES ('$name', '$email', '$password', '$street', '$city', '$house', '$apartment', '$phone', '$altPhone', '$accountNumber')";
    $result = mysqli_query($conn, $sql);

    // Проверяем, был ли запрос выполнен успешно
    if (!$result) {
        die("Ошибка записи в базу данных: " . mysqli_error($conn));
    }

    // Закрываем соединение с базой данных
    mysqli_close($conn);

    // Выводим сообщение об успешной регистрации и переходим на страницу log.html
    echo "Регистрация прошла успешно! Вы будете перенаправлены на страницу входа.";
    header("refresh:2;url=log.html");

} else {
    die("Ошибка: не переданы данные из формы");
}
?>