## SESAME TECHNICAL TEST
### Installation project

For install this project, first, you should run the docker composer command for creating the corresponding containers

```
docker-compose up -d
```

This command, will create two containers, sesame, and sesame_db. The credentials for connect to database are root for both, user and password

Enter at the Sesame container

```docker exec -it sesame bash```

once inside the container run go to ``/var/www/html``

run: ``mv .env.example .env``

``composer install`` 

``php bin/console lexik:jwt:generate-keypair``

``php bin/console doctrine:migration:migrate``

``php bin/console doctrine:fixtures:load``

This way the project will be deployed and loaded with the corresponding data.

### Check te tests and Postman endpoints

There are some json files for postman app inside of Postman folder, also, you can run the unit tests run:

``php vendor/bin/phpunit``

