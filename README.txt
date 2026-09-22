Для запуска

- создайте файл настройк (.env)
переименуйте файл .env.example в .env

- заполните поля в файле .env
DB_CONNECTION=sqlite
DOCTOR_BASE_API=
DOCTOR_CITY_ID=
DOCTOR_USER_IP=
DOCTOR_USER_AGENT=

- запускает сервер:
php -S 127.0.0.1:8081 -t public/

- откройте в бразуре ссылку:
http://127.0.0.1:8081/doctors
