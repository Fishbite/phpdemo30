##############################################################################
run this comamand to make the `public` directory the DOCUMENT_ROOT of the
project using vscode for development
##############################################################################

php -S localhost:8888 -t public

##############################################################################
htaccess rules to do the same on the production server @ infinityfree:
##############################################################################

php_value date.timezone Europe/London
php_value display_errors Off

RewriteEngine On

RewriteCond %{REQUEST_URI} !^/public/

#RewriteRule ^(.*)$ /public/$1

#### a shorter version of the above
# RewriteRule ^$ /public/$1

# stackoverflow this works and sets the public folder as the document_root
RewriteRule ^ /public/index.php [L,QSA]

##############################################################################

##############################################################################
SET the DB CONFIG in bootstrap.php:
##############################################################################

##### Update Array key to 'livedb' for production #####
return new Database($config['livedb']);

#######################################################