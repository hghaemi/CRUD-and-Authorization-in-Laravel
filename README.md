This program is an example for CRUD and authorization in Laravel .

Follow these steps, so you can run this website on your local space :

1. Install Laravel 10
2. Install Xampp app and run the Apache and MySQL
3. Install VSCode or another code editor or IDE
4. Open your CMD in folder where files are in, then write this command "code ." (dot is in command) after that your VSCode will opened , If you you use another code editor or IDE open that and go to the folder that mentioned
5. Create a DataBase in your Xampp that name should be as same as the name of Database of this program that mentioned in .env file , the name of DataBase is "projectdb"
6. Open your terminal in that folder and write this command "php artisan migrate"
   , after that write this command "php artisan migrate"

Hints :

1. To use this website you should sign-up at first as it mentioned in the Welcome Page of website
2. After login go to this route " (here is your local host IP)/posts"
3. Only admins can create,update and delete posts and the others, just can see the posts
4. To change a role of user you should go to your database , go to the users table and change the "is_admin" field of that user to "1"

That's it, enjoy this website!
