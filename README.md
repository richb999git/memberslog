## Members log

Part finished app to record members of rowing club.

Members have to be registered by an admin but can edit their personal details.

The first admin is set from .env file.

---------------------------------------------------------------------------------------------
To set up:

set the APP_KEY as one in .env file

add the specific application variables for the ADMIN_xxxx


For production (railway.app):
set APP_ENV=production
set DB_xxxx variables as per railway.app
set DB_CONNECTION=mysql

railway.app build command as a minimum should be: php run optimize
this can be in the settings or you can set a variable NIXPACKS_BUILD_CMD
  if you wanted to start from scratch you could add: php run optimize && php artisan migrate --force