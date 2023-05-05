# Task Requirements

## Practices and patterns (Must):
| # 	| Description                                      	| Status 	|
|---	|--------------------------------------------------	|--------	|
| 1 	| TDD                                              	| Done ✅ 	|
| 2 	| DDD                                              	| Done ✅ 	|
| 3 	| BDD                                              	| Done ✅ 	|
| 4 	| Clean architecture                               	| Done ✅ 	|
| 5 	| CQRS pattern (Event sourcing).                   	| UnResolved 😐 	|
| 6 	| Clean git commits that shows your work progress. 	| Done ✅ 	|
| 7 	| Use PHP 8.2.x only                               	| Done ✅ 	|

## Validations (Must)
| # 	| Description                                                                                     	| Status 	|
|---	|-------------------------------------------------------------------------------------------------	|--------	|
| 1 	| During Create; validate the phone number to be a valid mobile number only                       	| Done ✅ 	|
| 2 	| Use Google LibPhoneNumber to validate number at the backend                                     	| Done ✅ 	|
| 3 	| A Valid email and a valid bank account number must be checked before submitting the form        	| Done ✅ 	|
| 4 	| Customers must be unique in database: By ```Firstname```, ```Lastname``` and ```DateOfBirth```. 	| Done ✅ 	|
| 5 	| Email must be unique in the database.                                                           	| Done ✅ 	|


## Storage (Must)
| # 	| Description                                                                                     	| Status 	|
|---	|-------------------------------------------------------------------------------------------------	|--------	|
| 1 	| Store the phone number in a database with minimized space storage                               	| Done ✅ 	|

* Some extensive researches are made to find the best choices for today and tomorrow needs. You may see the references in the **NOTES** section of [todos](./todos.md). 

## Delivery (Must)

**PART 1**
| # 	| Description                                                     	| Status     	|
|---	|-----------------------------------------------------------------	|------------	|
| 1 	| clone the repository in a new github repository in private mode 	| Done ✅     	|
| 2 	| share with ID: ```mason-chase``` in private mode on github.com  	| Done ✅     	|
| 3 	| make sure you do not erase my commits and then                  	| Done ✅     	|
| 4 	| create a pull request (code review)                             	| Done ✅ 	|


**PART 2**
| # 	| Description                                                                                   	| Status 	|
|---	|-----------------------------------------------------------------------------------------------	|--------	|
| 1 	| Docker-compose project that loads database service automatically with ```docker-compose up``` 	| Done ✅ 	|



## Presentation (Must)
| # 	| Description 	| Status 	|
|---	|-------------	|--------	|
| 1 	| Web UI      	| UnResolved 😐 	|
| 2 	| Swagger     	| Done ✅ 	|

**Note** that ```OpenApi 3``` is used to document the api.