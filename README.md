# Setup & Development
This is the Laravel backend powering the Datsu Ember.js frontend application. If you need help setting up the Laravel dependencies on OS X Yosemite you can read [these instructions]().

Run `composer install` to install everything needed for the backend.

Create your development environment file by running `cp .env.development.php.template .env.development.php` and filling in the necessary information.

Use `php artisan serve` to start a development server.

# Deployment
The application is deployed to a Host Europe Web Pack which means we have to deal with FTP and Apache. Mainly it means we have to use a subdomain and run the migrations via a HTTP request.

'lftp' has to be installed.  
'curl' has to be installed.  

Make sure you have setup the `.environment` file, use `.environment.template` as a template. You should also make sure you have a filled out `.env.php`,

Use `./deploy` to deploy the currently checked out version of the backend. Migrations are run automatically on each deploy.
