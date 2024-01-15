# symfony_vlad


Этот репозиторий содержит исходный код блога, созданного на фреймворке Symfony. Он включает в себя функциональность для регистрации и авторизации пользователей. Зарегистрированные и авторизованные пользователи могут публиковать свои посты и оставлять комментарии, которые мгновенно появляются на сайте. Незарегистрированные посетители также могут комментировать посты, но их комментарии требуют одобрения администратора и указания электронной почты. Администраторы сайта имеют полномочия удалять и редактировать посты, а также управлять комментариями через специальную административную панель.

Инструкция по развертыванию проекта
Для разработчиков, впервые взаимодействующих с этим проектом, важно следовать нижеприведенным инструкциям:

Установка PHP: Убедитесь, что PHP установлен на вашей системе и добавлен в переменные среды Path.
Среда Разработки: Выберите среду разработки, поддерживающую PHP (например, PhpStorm).
Установка Symfony: Скачайте и установите Symfony, добавив его в переменные среды Path.
Создание Проекта: Инициализируйте новый проект Symfony с помощью команды symfony new --webapp [Название проекта].
Настройка СУБД: Выберите и настройте СУБД (например, Docker) для хранения данных о пользователях, комментариях и постах.
Конфигурация Базы Данных: Настройте подключение к базе данных в файле .env. Установите значения по умолчанию для переменных окружения, необходимых для подключения к базе данных.
Миграция Базы Данных: Выполните миграции базы данных с помощью команд php bin/console make:migration и php bin/console doctrine:migrations:migrate

Описание работы сайта: 
Пользователь заходит на сайт и сразу может оставить комментарий, но отображаться он не может, чтобы оставить пост нужно зарегистрироваться, после он может оставить пост
Пользователь видит на странице создание постов только свой пост, его пост может изменять и удалять только админ и он сам
Пользователь видит только свои посты на странице создание постов
На сайте можно найти статью по поисковой строке, название должно точно совпадать с названием статьи для выдачи
На сайте реализована шапка сайта, а также подвал
Регистрация, пароли должны совпадать при регистрации, реализована система подтверждения пароля 

ТАКЖЕ ПРЕДСТАВЛЕН ФАЙЛ С ДЕМОНСТРАЦИЕЙ САЙТА

Установка: 

Склонируйте репозиторий: git clone

Запустите контейнеры Docker: docker-compose up -d

Установите зависимости через Composer: docker-compose exec php composer install

Примените миграции для базы данных: docker-compose exec php bin/console doctrine:migrations:migrate

Запустите веб-сервер: Symfony server:start
