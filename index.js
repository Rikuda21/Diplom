const avatarUpload = document.getElementById("avatar-upload");
const avatarCanvas = document.getElementById("avatar-canvas");
const avatarSave = document.getElementById("avatar-save");

avatarUpload.addEventListener("change", function () {
  const file = this.files[0];
  const reader = new FileReader();

  reader.addEventListener("load", function () {
    const image = new Image();
    image.src = this.result;
    image.addEventListener("load", function () {
      const canvas = avatarCanvas;
      const ctx = canvas.getContext("2d");

      const maxSize = 200;
      let width = image.width;
      let height = image.height;

      if (width > height) {
        if (width > maxSize) {
          height *= maxSize / width;
          width = maxSize;
        }
      } else {
        if (height > maxSize) {
          width *= maxSize / height;
          height = maxSize;
        }
      }

      canvas.width = width;
      canvas.height = height;
      ctx.drawImage(image, 0, 0, width, height);

      avatarCanvas.style.display = "block";
      avatarSave.style.display = "block";
    });
  });

  reader.readAsDataURL(file);
});

avatarSave.addEventListener("click", function () {
  const canvas = avatarCanvas;
  const dataUrl = canvas.toDataURL("images/png");
  const xhr = new XMLHttpRequest();

  xhr.open("POST", "/api/save-avatar");
  xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhr.send(JSON.stringify({ dataUrl }));

  avatarCanvas.style.display = "none";
  avatarSave.style.display = "none";
});


app.post("/api/save-avatar", function (req, res) {
  const userId = req.session.userId;
  const dataUrl = req.body.dataUrl;

  // Сохранить dataUrl в базе данных, связав его с userId
});

function saveImage() {
  // Получаем данные изображения
  var canvas = document.getElementById("avatar-canvas");
  var imageData = canvas.toDataURL();

  // Отправляем данные на сервер
  $.ajax({
    url: "photo.php",
    type: "POST",
    data: {
      image_data: imageData
    },
    success: function(response) {
      // Обработка успешного ответа сервера
      console.log("Изображение сохранено!");
    },
    error: function() {
      // Обработка ошибки
      console.log("Ошибка сохранения изображения");
    }
  });
}