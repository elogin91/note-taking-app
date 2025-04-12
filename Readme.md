# Note-taking App

Note-taking is a public web application that helps you save and manage text notes.

## Requirements

Before you begin, make sure you have the following requirements installed on your machine:

- **PHP** >= 8.2
- **PDO-SQLite PHP extension enabled**
- **[Usual Symfony application requirements](https://symfony.com/doc/current/setup.html#technical-requirements).**
  - **Symfony** >= 5.x
  - **Composer**
  - **Install Symfony CLI**

## Mode 1: Deploy the application with Symfony

### Step 1: Clone the repository

First, clone the application repository to your machine:

```bash
git clone https://github.com/elogin91/note-taking-app.git
cd note-taking-app
```

### Step 2: Install Dependencies with Composer

Make sure you have Composer installed and then install all the project's dependencies:

```bash
composer install -n
```

### Step 3: Configure the Environment

To make the process easier, I've uploaded the .env file to the repository.

In theory, you shouldn't need to change anything, just make sure the connection string for SQLite is uncommented.

### Step 4: Create and Configure Our Persistence (SQLite)

Since our application requires persistence, we'll need to create the tables by running the following commands:

```bash
php bin/console doctrine:migrations:migrate --no-interaction
```

### Step 5: Start the Web Server

(For this step, you must have Symfony CLI installed.)
Finally, start the Symfony web server:

```bash
symfony server:start
```

The application will be available at `http://localhost:8000/note/`.

### Step 6: Stop the Web Server

When you're done, you can stop Symfony by pressing Ctrl + C to stop the Symfony web server.

---

Enjoy using the application! Thank you for your time and attention.
