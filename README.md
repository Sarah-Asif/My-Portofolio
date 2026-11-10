# Dynamic Personal Portfolio (PHP + MySQL + Bootstrap)

## Setup (XAMPP)
1. Install XAMPP, start **Apache** and **MySQL** in the XAMPP Control Panel.
2. Copy this `portfolio` folder into `C:\xampp\htdocs\`.
3. Open http://localhost/phpmyadmin -> **Import** -> choose `database.sql` -> Go.
   (This creates the `portfolio_db` database with tables and sample data.)
4. If your MySQL has a password or the folder name differs, edit `includes/config.php`.
5. Open http://localhost/portfolio/

## Admin panel
- URL: http://localhost/portfolio/admin/login.php
- Sample credentials: **admin / password** (change them; submit privately as required)
- Can add, edit, delete projects and read/delete contact messages.

### Change the admin password
Create a temporary `hash.php` with `<?php echo password_hash('NewPassword', PASSWORD_DEFAULT);`, open it in the browser,
then in phpMyAdmin run: `UPDATE admins SET password_hash='<paste hash>' WHERE username='admin';` and delete `hash.php`.

## Personalise
Edit the `profile`, `skills`, `education` and `projects` rows in phpMyAdmin (or via admin for projects). The pages update with no HTML changes.

## Usage
Browse Home, Skills & Education, Projects (search/filter), Contact (validated form saved to DB).

## Note
Bootstrap is loaded from a CDN, so an internet connection is needed for styling.
