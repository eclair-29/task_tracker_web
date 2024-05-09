# Prerequisites

| Technology | Version   |
| ---------- | --------- |
| PHP        | 8.1       |
| Laravel    | 10        |
| MySQL      | >= 8.0    |
| Apache     | httpd 2.4 |
| Composer   | >= 2.4    |

> I suggest to use a freeware applications such as [Laragon](https://laragon.org/index.html) or [XAMPP](https://www.apachefriends.org/) on your local machine for an easier project setup experience (or if your using linux or linux virtual machine, this is much better).

# Project Setup Instruction

1. Clone the project repository (by running: `git clone https://github.com/eclair-29/task_tracker_web.git`).
2. Go to the project directory/folder (`cd <project folder>`).
3. Run `composer install` on your cmd or terminal.
4. Create a `.env` file on the root folder.
5. Copy the content of `.env.example` file to `.env` file (created on step 4).
6. Open your `.env` file and change the database name (`DB_DATABASE`) to whatever you have, username (`DB_USERNAME`) and password (`DB_PASSWORD`) field correspond to your configuration.
7. Run `php artisan key:generate`.
8. Run `php artisan migrate:fresh --seed`.
9. Run `php artisan serve`
10. Go to http://127.0.0.1:8000

> **Note**: For step 6, the `DB_DATABASE` schema must be present on your database before proceeding to the next steps.

Enjoy exploring the app! :)

# Features

## Back Office (Admin) Account

1. Add users
2. Assign task to a user
3. Re-assign task to another user (by editing an existing task)
4. Edit existing task details
5. Delete task
6. View all users tasks

## User Account

1. Add own task
2. Edit own task
3. Delete own task
4. View own tasks

## Login (Authentication and Authorization)

1. Admin login
2. User login
3. Only users with `Active` status are allowed to login
