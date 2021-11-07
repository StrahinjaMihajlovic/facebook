# Facebook

This is a clone of the Facebook social networking.

This project was done on the Laravel framework in conjuction with MySql and Neo4j Databases.

To install this project on your machine, my suggestion would be to use <a="https://docs.docker.com/get-docker/">docker</a> and <a href="https://docs.docker.com/compose/install/">docker-compose</a> with integrated Laravel sail scripts. After you have successfully installed both the Docker and Docker-compose, follow this list to complete project setup:

<ul>
    <ol>
        1. Copy the .env.example file. It contains default configuration for docker services this project depends upon.
    </ol>
    <ol>
        2. Navigate to the root folder and use command:
            composer install / composer update
    </ol>
    <ol>
        3. To start the docker containers, simply start the sail script like
            sudo ./vendor/laravel/sail/bin/sail up -d
        Note: You can use laravel sails script instead of the docker and docker compose for interacting with the containers, you can find more about sail<a href="https://laravel.com/docs/8.x/sail#starting-and-stopping-sail"> here </a>
    </ol>
    <ol>
        4. To setup the Database, enter the bash of the container with ./vendor/laravel/sail/bin/sail bash .
        Once in container, enter command: php artisan migrate --seed
    </ol>
    <ol>
        4. To setup neo4j, go to http://localhost:7474 and enter username/password as neo4j, after which you will be prompted for a new password, set it up and enter your new password in .env file and clear configuration with command php artisan config:clear inside the container
    </ol>
</ul>
