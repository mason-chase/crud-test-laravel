# HOW TO USE THE CODE BASE


## UP AND RUNNING

- You may run the whole project as container using below:
  ```bash
  # for the first time use 
  docker-compose build
  # then run up -d run containers in a dispatched mode
  docker-compose up -d
  ```
  - **Note: If you didn't add docker to your OS groups, you should use ```sudo``` before docker commands**
- You may access to: 
  - ```phpMyAdmin``` using ```localhost:3307```
  - ```mariaDb``` cli using port ```3306``` and ```chase_db``` container. see below example:
    ```bash
    # to go to the container
    docker exec -it chase_db sh
    # and inside the container use below
    mariadb -u chase -p
    # when prompt for password use 123456

    # to test if every thing is okay use below in the mysql cli
    show databases;
    ```
  - the localhost is active on port 80, so if you got any error is because you are already using the port 80. Kill the process or change the port in the docker-compose.so you can see the project in ```http://localhost/public/``` 
    - note that to use the project you should install dependencies using compose as below:
      ```bash
      docker exec -it crud-test-laravel_chase_web_1 sh
      # in the container run
      composer install
      ```
    - needed changes for ```.env``` file is exampled in ```.env.example```
    - You may run below in the container to generate the key for app:
      ```bash
      # go to the container
      docker exec -it crud-test-laravel_chase_web_1 sh
      # generate the key
      php artisan key:generate
      ```

## Documents
The three types of documentations are presented in the project are as below:
- In code docs: this docs are following ```phpDoc``` conventions and libraries.
- ```.md``` files: like the current document, provide users with some good info about how the project is fulfilled and how you may use it.
- An ```OpenApi``` file with the extension of ```.yml```.  The document can be found in [api.yml](./api.yml). To work with it you may install proper extensions in your code editor, or you may paste the content in the [swagger editor](https://editor.swagger.io/).
