# php_ekz
1. Зарегистрироваться на сайте пройдя по http://php.std-966.ist.mospolytech.ru/signup.php
2. Авторизируемся http://php.std-966.ist.mospolytech.ru/login.php
3. Заходим в базу данных https://phpmyadmin.fit.mospolytech.ru  login:std_966
Пароль:123456789
4. Заходим в таблицу users меняем у своего пользователя столбец admin на 1
5. Перезагружаем страницу с сайтом http://php.std-966.ist.mospolytech.ru/index.php
6. Нажать на кнопку создать сессию: Там можно добавить вопрос, добавить ответ на него и т.д.
7. Что-бы создать сессию - нажать кнопку test
8. Вернуться к сессиям 
9. Заходим обратно в бд и меняем  users меняем у своего пользователя столбец admin на 0 => перезагружаем страницу
10. Заходим в Бд в таблице expert_session в колонке link, копируем то что там будет написано.
11. переходим на http://php.std-966.ist.mospolytech.ru/expert.php?hash=<тут пишем link>
