# Laravel Task Management API
This project is a Laravel-based task management API that provides endpoints for creating, reading, updating, and deleting tasks. It is designed to be used in conjunction with a Vue.js front-end application.

## Installation
Clone the repository: git clone https://github.com/Felix-chengecha/Task_management-Backend.git
Navigate to the project directory: cd laravel-task-management-api
Install dependencies: composer install
Create a copy of the .env.example file and rename it to .env: cp .env.example .env
Generate an application key: php artisan key:generate
Set up your database connection in the .env file.
Run database migrations: php artisan migrate
Usage

## This API provides the following endpoints:

### GET /api/tasks
Returns a list of all tasks.

### GET /api/tasks/{id}
Returns a specific task.

### POST /api/tasks
Creates a new task.

### PUT /api/tasks/{id}
Updates an existing task.

### DELETE /api/tasks/{id}
Deletes a task.

### GET /api/user_tasks/{user_id}
Returns a list of all tasks belonging to a specific user.

### GET /api/user_tasks/{user_id}/{id}
Returns a specific task belonging to a specific user.

### POST /api/user_tasks/{user_id}
Creates a new task belonging to a specific user.

### PUT /api/user_tasks/{user_id}/{id}
Updates an existing task belonging to a specific user.

### DELETE /api/user_tasks/{user_id}/{id}
Deletes a task belonging to a specific user.

### POST /api/register
Registers a new user.

### POST /api/login
Logs in a user and returns an access token.

### POST /api/logout
Logs out a user.

### Contributing
To contribute to this project, follow these steps:

Fork this repository.
Create a new branch: git checkout -b my-new-branch
Make changes and commit them: git commit -am 'Add some feature'
Push to the branch: git push origin my-new-branch
Submit a pull request.








