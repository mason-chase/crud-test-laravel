# To Dos

## MUST
- Add validation rules and test for:
  - phone numbers
  - compound uniqueness of ```first_name```, ```last_name```, and ```date_of_birth```.
- You must consult with product owner about the required unique key stated as below:
  ```md
  Customers must be unique in database: By ```Firstname```, ```Lastname``` and ```DateOfBirth```.
  ```
  because it seen very wrong. for example **Lee** is the most frequent last name in the world, and odds are very high that we have multiple **John Lee**s with the same birthday in our customers. The better one is put unique on our phone number, and email.
## SHOULD
- Validation errors should be modeled more precisely in the ```openapi``` document.

## BETTER TO DO


## NOTES
- Database Design
  - In compliance with **database naming conventions** column names are in  ```snake_case``` so ```LastName``` is converted to ```last_name```. 
  - The longest name in world based on **guinness world records** is ```747``` characters but I used a string between null to 60 chars (equivalent to mysql varchar) for the first name and a string between 1 to 60 chars for the last name. That would be more than enough. 
  - Instead on ```dateTime``` for **date_of_birth** I used ```date``` and made it nullable to guaranty a micro-optimization in the database. 
  - Based on below references, despite that numeric data types are way faster than chars, and gives a better performance in search, but for the phone number it is better to use laravel ```string``` or my sql ```varchar``` with the size of 20 (actually 15 chars is the most optimum but for the sake of future changes, and formatting numbers, we used 20). Why? see below references:
    - https://stackoverflow.com/a/24353813
    - https://en.wikipedia.org/wiki/E.164
    - https://support.twilio.com/hc/en-us/articles/223183008-Formatting-International-Phone-Numbers
    - https://en.wikipedia.org/wiki/Telephone_number
    - https://stackoverflow.com/a/4729239
    - https://github.com/giggsey/libphonenumber-for-php/blob/master/docs/PhoneNumberUtil.md
  - Based on more researches the best data type for ```email``` and ```bank_account_number``` are also laravel ```string``` of sizes 120 and 32 respectively. 

## FURTHER IMPROVEMENTS AND OPTIMIZATIONS
