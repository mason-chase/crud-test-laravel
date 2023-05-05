# Steps to fullfil the task

## 1. Dockerize the project 
Because it is a test project, I didn't separate docker files from the actual project, but in a real world scenario, I put all the code inside ```src``` directory and outside of that I dockerize the project. 

**Why mariadb**: due to lots of trouble Oracle posed on programmers in Iran, I prefer to use mariaDb which is an open source fork of the mysql. 

**Git note**: based on what was described in the project I created the repo. But unlike my daily routing I don't use multiple branches to finish the job (all changes would be on one branch only)

**Usage**: you may find needed info for running the project in the [usage.md](./usage.md)


## 2. customer database table
In this **story** i only try to model and program a minimum viable product (MVP) that meets project requirements very loosely. So based on that every thing would be very minimalistic for now (**No event sourcing would be modeled in this stage** ).

- Also to be in consistent with **database naming conventions** I will use all lowercase for column and table names and to separate words with an underscore ("_"). see the community and [brainstation](https://brainstation.io/learn/sql/naming-conventions) for more info. 
  - here are some examples ```Firstname``` would be ```first_name```, ```DateOfBirth``` would be ```data_of_birth``` and so on. 

- Note that lots of consideration were taken into account that you can see in the [todos.md](./todos.md) in the **MUST** and **Notes** sections.


## 3. customer model and factory
In this step we create a basic eloquent model for the customer and a decent factory. then seed the database for further inspections. 
- **Note**: I never use ```repository design pattern``` along side of Laravel, I am totally against it and have very good reasons for that. 

## 4. Test what ever is done up until this stage
Some unit test for Customer database is devised to check if every thing is fine up until now. 

## 5. Customer controller and associated APIs
A basic customer controller along side with a ```ResponseBuilder``` class is devised to represent results in a json format. Note that I am intended to completely separate the backend project from the future front-end.
* please note that instead of working with the UI, I always use ```unit tests``` and ```tinker``` to interact with the APIs and models.
* please note in this stage I began to document api using ```OpenAPI 3```. The document can be found in [api.yml](./api.yml). To work with it you may install proper extensions in your code editor, or you may paste the content in the [swagger editor](https://editor.swagger.io/).

1. index method and needed tests
2. store method, tests, and request class (validation and data cleansing).
   1. adding localization directories and files
3. store method, tests, and request class (validation and data cleansing).
4. delete method, tests, and documentation.
5. show method, tests, and documentations. 
