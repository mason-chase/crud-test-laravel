# Usage Project


## Start up project

- after install docker and docker compose, run command below command
  ```bash
  # for build
  docker compose build
  # for up
  docker compose up -d
  ```
- After the container is up, enter the container with the following command
  ```bash
  docker compose -f docker-compose.dev.yml exec --user=www-data app ash  
  ```
- at the end, enter commands
  ```bash
  cp .env.example .env
  composer install
  php artisan key:generate
  ```
- For run unit tests run this command 
  ```bash
  php artisan test
  ```
