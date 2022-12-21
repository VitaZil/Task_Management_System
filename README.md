# Task Management App

## About The App
Task Management App is a CRUD based project. It was created using MVC pattern. 
Project database was design with MySQL and Many-To-Many relationship.

## In this Task Management App you can do these things:

- Add new employee
- Add new task for employees
- Modify assignments as complete
- Delete assignments
- See all assignments being in progress
- See all assignments being in archive as completed
- Use pagination in archive
- Export all records from archive in .csv file


## Built With

HTML, Tailwind CSS, Vanilla PHP languages and MySQL database.


## Setup

1. Download or clone the repository
```sh
https://github.com/VitaZil/Task_management_system.git
```

2. In a project root directory run composer
```sh
composer install
```

3. To create all the nessesary tables and columns, run the following
```sh
php -f migrate.php
```

4. Start localhost from terminal
```sh
php -S localhost:8080
```

