# Work sample: Online courses and exam site

## Some features of the site:
- User definition in two roles, admin and user
- Admin panel with features: user management, courses (sessions and course exams) management, payments, completed exams management and sliders management, etc.
- Ability to define time frame and group (group) for registration of courses
- Course content in the form of video or audio or file
- User panel for users including profile editing, payments, courses and test results
- etc...

## Project Setup

1.clone Project
```sh
git clone https://github.com/mrnajafi81/OnlindeEducation.git
```
2.run
```sh
composer install
```
3.run
* in Linux
```sh
cp .env.example .env
```
* in Windows
```sh
copy .env.example .env
```
4. run
```sh
php artisan key:generate
```
5. create MySql database and set db information in .env
6. run 
```sh
php artisan migrate --seed
```
* --seed is important
7. run
```sh
php artisan serve
```

## Admin Panel Information
number: 09910001122
pass  : Admin@1234

## User Panel Information
number: 09910002233
pass  : User@1234

## License
This site is only a work sample and the content used in it is experimental.
Any copying of this work sample is not allowed.
