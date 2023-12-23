# Work sample: Online courses and exam site

## Some features of the site:
- User definition in two roles, admin and user
- Admin panel with features: user management, courses (sessions and course exams) management, payments, completed exams management and sliders management, etc.
- Ability to define time frame and group (group) for registration of courses
- Course content in the form of video or audio or file
- User panel for users including profile editing, payments, courses and test results
- etc...

## Project Setup

1. create MySql database and set db information in .env
2. run 
```sh
php artisan migrate --seed
```
* --seed is important
3. run
```sh
php artisan serve
```


## License
This site is only a work sample and the content used in it is experimental.
Any copying of this work sample is not allowed.
