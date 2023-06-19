## Как запустить?

1) Установить <b>Apach 2.4 + Nginx 1.23</b>, <b>PHP 7.2</b>, <b>MySQL 5.7</b>. Можно использовать <b>Open Server Panel</b> с вышеуказанными модулями
2) Зайти в <b>PhpMyAdmin</b>, создать новую БД с названием <b>flowershop</b>, импортировать все данные в <b>flowershop</b> из файла <b>flowershop.sql</b>
3) Отредактировать в файле <b>database_functions.php</b> строку №4, где необходимо указать имя пользователя и пароль от <b>PhpMyAdmin</b>, название созданной БД
4) Наслаждаться запущенным сайтом

## Основные функции

1) Captcha при регистрации
2) Запоминание логина и пароля с помощью coookies. Чтобы окончательно выйти из аккаунта, нужно очистить coookies сайта в браузере
3) Хеширование паролей в БД, при аутентификации происходит сравнивание хешей
4) Реализовано редактирование профиля, где можно добавить аватар пользователя и изменить данные о себе. НО аватар можно выбрать только из тех, которые имеются в папке <b>flowersland.ru/bootstrap/avatar</b>
5) Присутствует admin-панель, в которой можно добавлять/удалять/редактировать категории и товары, блокировать/удалять пользователей, менять статус заказанного пользователем товара
7) Реализована корзина и история заказов
8) Поиск на сайте по названию товара

## Вход в admin-панель
- Логин: admin
- Пароль: admin

## Демонстрация
![image](https://github.com/hentaimean/FlowersLand/assets/106330825/c4075340-1138-4b35-a16f-b3c3a714d677)
![image](https://github.com/hentaimean/FlowersLand/assets/106330825/98dc71b5-2924-4671-bb1b-392cc5c87236)
![image](https://github.com/hentaimean/FlowersLand/assets/106330825/2e73ea94-553b-4243-bd05-de0588a8250c)
![image](https://github.com/hentaimean/FlowersLand/assets/106330825/b72eefa4-079f-47b9-9093-f8b36d469c65)
![image](https://github.com/hentaimean/FlowersLand/assets/106330825/0a71b548-0556-47e9-b0dd-32e3e83349c4)
![image](https://github.com/hentaimean/FlowersLand/assets/106330825/26da929b-7ecb-4441-b670-e9200219741f)
![image](https://github.com/hentaimean/FlowersLand/assets/106330825/d1829037-68bd-42af-b728-2669ee6058ff)
![image](https://github.com/hentaimean/FlowersLand/assets/106330825/2ceab816-222b-4421-ae2d-9910bec18652)
![image](https://github.com/hentaimean/FlowersLand/assets/106330825/bef6f169-f743-4ea7-b986-f9c40fc3f2e7)
![image](https://github.com/hentaimean/FlowersLand/assets/106330825/7cd62122-3b99-4bba-9548-af9d7b630957)
![image](https://github.com/hentaimean/FlowersLand/assets/106330825/8c7c9bd1-8b89-41a3-b00a-50353379a9f6)
