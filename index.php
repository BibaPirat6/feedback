<!doctype html>
<html lang="ru">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>Обратная связь с нами</title>

  <link rel="stylesheet" href="styles/style.css" />
</head>

<body>
  <?php
  include "./config/config.php";
  ?>
  <main class="container">
    <section class="feedback">
      <h2 class="feedback__title">Форма обратной связи</h2>

      <form action="php/send.php" class="feedback__form" id="form" method="post">
        <label for="fio">Введите ваше ФИО:</label>
        <input required minlength="3" maxlength="50" name="fio" type="text" id="fio" placeholder="Иванов Иван Иванович"
          aria-describedby="error-fio">
        <p class="error disabled" id="error-fio"></p>

        <label for="email">Введите ваш e-mail:</label>
        <input required name="email" type="email" id="email" placeholder="ivanov@gmail.com"
          aria-describedby="error-email">
        <p class="error disabled" id="error-email"></p>

        <label for="message">Напишите ваше сообщение:</label>
        <textarea required minlength="10" maxlength="200" name="message" id="message" placeholder="Напишите сообщение"
          aria-describedby="error-message"></textarea>
        <p class="error disabled" id="error-message"></p>

        <button id="feedback__button" type="submit">Отправить</button>
      </form>
    </section>
  </main>

  <script src="scripts/script.js"></script>
</body>

</html>