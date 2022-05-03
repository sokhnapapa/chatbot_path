## About HIV SELFTESTING BOT

This is an implementation of BotMan studio for a facebook messenger chatbot.
The chatbot assists users by providing information on where to get free or paid-for HIV self testing kits, pharmacies and clinics locations, guides on how to use these kits, frequently asked questions and an option to contact a counselor for futher questions.
___

## Installation
#### System Requirements
* PHP 
* MySQL
* Crontab
* Facebook page token and id
#### Instructions
* Fork and clone the repository.
* CD in the project directory and do a `composer install` and `composer dumpautoload -o` to install the neccessary dependencies. For LInux users, make sure you are a root user.
* Copy the environment tempale `cp .env.exmaple .env`.
* Edit the .env file in the project's home directory by adding the facebook token and facebook verification code.
* Generate the APP_KEY for the project environment. Do a `php artisan key:generate` to achieve that.
* Clear Initial configuration settings and cache. Achieve that by doing `php artisan config:clear` and `php artisan cache:clear`.
* Migrate the Database i.e. `php artisan migrate` to load the pharmacies and clininc names & locations 
* While in the home directory, type `php artisan serve` and visit [http://localhost:8000](http://localhost:8000) to check whether the installation is working
* Create a database and use the .sql file to populate it with tables and initial data and edit the .env file database variables accordingly.


#### Facebook Integration
Go to the facebook developers' page, select your app and add a webhook pointing to the url of your installation through the botman route
eg `https://path.tmcg.africa/botman`
**Note:** the url has to be ssl enabled. It has to start with `https`. `http` urls won't work.

#### Chatbot menu, greeting text & getstarted button
While in the home directory, run the following commands to get these implemented respectively.
* ```php artisan botman:facebookAddMenu```
* ```php artisan botman:facebookAddGreetingText```
* ```php artisan botman:facebookAddStartButton```
#### creating a cron job for the followup flow
Run `crontab -e` and add this line `* * * * * php /path/to/project/directory/artisan schedule:run >> /dev/null 2>&1
`