## Members log

Part finished app to record members of rowing club.

Members have to be registered by an admin but can edit their personal details.

The first admin is set from .env file.

---------------------------------------------------------------------------------------------
To set up:

set the APP_KEY as one in .env file

add the postgres free database (this seems to have added the DATABASE_URL config var)  
add the DB_CONNECTION and DB_PORT variables

add the specific application variables for the ADMIN

migrate the database with: heroku run php artisan migrate

