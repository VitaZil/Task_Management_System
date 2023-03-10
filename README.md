# Task Management App

## About The App
Task Management App is a CRUD based project. It was created using MVC pattern. 
Project database was design with Many-To-Many relationship in MySQL.

## In Task Management App you can do:

- Add new employee
- Add new task for employees
- Modify assignments as complete
- Change employee's name or surname
- Delete assignments and employees
- See all employees with assign tasks
- See all assignments being in progress
- See all assignments being in archive as completed
- Use pagination
- Use search function
- Export all records from archive in .csv file


## Built With

HTML, Tailwind CSS, Vanilla PHP language and MySQL database.


## Setup

1. Download or clone the repository
```sh
git clone https://github.com/VitaZil/Task_Management_System.git
```

2. In a project root directory run composer
```sh
composer install
```

3. Add your database credentials(database username, password and port) to the DatabaseService.php and migrate.php files


4. To create all the necessary tables and columns, run the following
```sh
php -f migrate.php
```

5. Start localhost from terminal
```sh
php -S localhost:8080
```
