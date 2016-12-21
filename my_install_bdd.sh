/etc/init.d/postgresql-9.3 start
dropdb -U postgres --if-exists portail
dropuser -U postgres --if-exists portail
echo "Database : Creation de l'utilisateur mantisbt"
createuser -U postgres -S -D -R -i -l -P portail
createdb -U postgres -O portail portail

php artisan migrate
