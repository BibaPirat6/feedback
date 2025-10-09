Форма обратной связи
Проект создан в качестве тестового задания, можно создавать сообщения и просматривать их на той же странице
1) используется OS panel на MySQL-8.0 PHP-8.3
2) Языки программирования JS, HTML, CSS, PHP
3) Библиотека "vlucas/phpdotenv" используется для связывания .env файла с config.php

Структура сайта
public {
  scripts{
    script.js
  }
  styles{
    style.css
  }
  vendor{
    ...
  }
  .env
  composer.json
  composer.lock
  config.php
  documentation.txt
  feedback.php
  getMessage.php
  index.html
}

Запуск проекта и настройки
1) php -S localhost:8000
2) Запуск через OS panel
Установка библиотеки
composer require vlucas/phpdotenv

Функции файлов
script.js -> валидация на клиенте, отправа запросов в php, автоматическое обновление сообщений при добавлении
config.php -> испольует .env переменные, подключение к бд
feedback.php -> валидация на сервере, вставка запроса в бд
getMessage.php -> запрос к бд на получение всех сообшений и их вывод на клиент
