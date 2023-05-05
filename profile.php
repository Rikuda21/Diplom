<?php
// Проверяем, авторизован ли пользователь
session_start();
if (!isset($_SESSION['email'])) {
    // Если пользователь не авторизован, перенаправляем его на страницу авторизации
    header("Location: login.php");
    exit();
}

// Подключаемся к базе данных
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "k5411894";
$dbName = "users";

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

// Получаем информацию о пользователе
$email = $_SESSION['email'];
$sql = "SELECT * FROM `users` WHERE `email` = '$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Закрываем соединение с базой данных
mysqli_close($conn);
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="author" content="Квасов Сергей">
  <meta name="description" content="Тестовая страница">
  <meta name="keywords" content="жкх, вода, html, оплата услуг">
  <title>Профиль</title>

  <style>
  .container {
    margin: 0 auto;
    width: 50%;
    text-align: center;
  }

  .profile-info {
    border: 1px solid #ccc;
    padding: 20px;
    border-radius: 10px;
  }

  label {
    font-size: 18px;
    font-weight: bold;
  }

  input[type="file"] {
    margin-top: 10px;
  }

  input[type="submit"] {
    margin-top: 10px;
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
  }

  input[type="submit"]:hover {
    background-color: #3e8e41;
  }

  button {
    margin-top: 10px;
    background-color: #f44336;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
  }

  button:hover {
    background-color: #d32f2f;
  }

 #avatar-upload {
  display: none;
}

#avatar-canvas {
  display: none;
  border-radius: 50%;
  border: 2px solid #ccc;
}

#avatar-save {
  display: none;
}

		h1 {
			text-align: center;
			margin-top: 50px;
			margin-bottom: 50px;
		}
		.container {
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
			align-items: center;
			margin-bottom: 50px;
		}
		.avatar {
			width: 100px;
			height: 100px;
			border-radius: 50%;
			margin-right: 20px;
			margin-bottom: 20px;
			cursor: pointer;
			box-shadow: 0px 0px 5px rgba(0,0,0,0.3);
		}
		.avatar:hover {
			box-shadow: 0px 0px 10px rgba(0,0,0,0.5);
		}
		input[type="file"] {
		  display: none;
		}
</style>



  <link rel="icon" type="image1.png" href="logo1.png">
  <link rel="stylesheet" href="style.css">
</head>
<body>


<header style="margin-bottom:250px">
		<div class="header-left">
			<a href="index.html">
		  <img src="logo.png" alt="логотип" width="60" height="60">
		</div>
		<div class="header-right">
		  <ul>
			<li><a href="index.html">Главная</a></li>
			<li><a href="uslugi.html">УСЛУГИ</a></li>
			<li><a href="kontakti.html">КОНТАКТЫ</a></li>
			<li><a href="log.html" target="_self">Личный кабинет</a></li>
            <li><a href="log.html"><button>Выйти</button></a></li>
		  </ul>
		</div>
	  </header>


    <div class="container">
  <div class="profile-info">
    <h1>Профиль пользователя</h1>
    <p><b>Ф.И.О:</b> <?php echo $user['name']; ?></p>
    <p><b>Email:</b> <?php echo $user['email']; ?></p>
    <p><b>Улица:</b> <?php echo $user['street']; ?></p>
    <p><b>Город:</b> <?php echo $user['city']; ?></p>
    <p><b>Дом:</b> <?php echo $user['house']; ?></p>
    <p><b>Квартира:</b> <?php echo $user['apartment']; ?></p>
    <p><b>Телефон:</b> <?php echo $user['phone_number']; ?></p>
    <p><b>Дополнительный телефон:</b> <?php echo $user['alt_phone_number']; ?></p>
    <p><b>Лицевой счет:</b> <?php echo $accountNumber; ?></p>


		
	


    <h1>Выберите аватар</h1>
	
	<div class="container">
		
	  <label for="file-upload" class="custom-file-upload">
	    <i class="fa fa-cloud-upload"></i> Выбрать файл
	  </label>
	  <input id="file-upload" type="file" onchange="loadFile(event)">
	  
	  <img id="avatar" src="#" class="avatar">
	  
	  <div class="slider-container">
	    <input type="range" min="10" max="200" value="100" class="slider" id="myRange">
	  </div>

	 <form action="photo.php"><button onclick="saveAvatar()">Сохранить</button></form> 

	  <script type="text/javascript">
		
	function loadFile(event) {
	  var image = document.getElementById('avatar');
	  image.src = URL.createObjectURL(event.target.files[0]);
	  image.onload = function() {
	    URL.revokeObjectURL(image.src) // free memory
	  }
	  var slider = document.getElementById("myRange");
	  slider.value = 100; // reset slider
	  slider.oninput(); // trigger slider event
	  var saveButton = document.querySelector('button');
	  saveButton.disabled = false; // enable save button
	}

	var slider = document.getElementById("myRange");
	var image = document.getElementById('avatar');
	slider.oninput = function() {
	  image.style.width = this.value + "px";
	  image.style.height = this.value + "px";
	}
  function loadFile(event) {
  var image = document.getElementById('avatar');
  image.src = URL.createObjectURL(event.target.files[0]);
  image.onload = function() {
    URL.revokeObjectURL(image.src) // free memory
  }
  var slider = document.getElementById("myRange");
  slider.value = 100; // reset slider
  slider.oninput(); // trigger slider event
  var saveButton = document.querySelector('button');
  saveButton.disabled = false; // enable save button
}
	function saveAvatar() {
	  alert('Аватар сохранен!');
	}
	</script>




    <br>
    <a href="log.html"><button>Выйти из системы</button></a>
  </div>
</div> 

    <div class="footer">
		<p>© 2023 RainPay. Все права защищены. Надежная и удобная оплата ЖКХ по воде.</p>
		<p>Телефон: +7 (912) 235-15-47</p>
		<p>Адрес: г. Москва, ул. Примерная, д. 1</p>
		<p>Почта службы поддержки: <a href="mailto:partnership@watersplash.com">partnership@watersplash.com</a></p>
	  </div>

</body>
</html>