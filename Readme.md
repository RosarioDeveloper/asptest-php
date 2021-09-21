## ASPTest

### Used Features

- Php
- Composer
- Mysql
- <a href="https://docs.docker.com/get-docker/" target="_blank">Docker</a>
- <a href="https://docs.docker.com/compose/" target="_blank">Docker-Compose</a>

### Requisites

- Have docker and docker-compose instaled in you machine
- Have any SGBD instaled in you machine. Exe: (MysqlWorkbach,Tableplus and etc.)

### Get start

- Clone the repository with following command:
```diff 
git clone https://github.com/RosarioDeveloper/asptest-php.git
```
- Enter in the folder project: cd asptest-php
- Run docker-compose up -d
- Run ! docker-compose exec app composer install
- Create the .env file
- Copy the content in the .env.example file to .env file
- Change the database configuration data
- Open your SGBD and create a database with the same name that you created in the .env file
- Run docker-compose exec app ./ASP-TEST db:migrate to generate database tables

### Commands

- Create user: ./ASPTest USER:CREATE first_name last_name email age
- Create password user: ./ASPTest USER:CREATE-PWD user_id pwd confirm_pwd

  OBS: The commands can be writed in capital or small letters

### Doing Unit Tests

- Run all tests: docker-compose exec app composer phpunit tests
- Run single test: docker-compose exec app composer phpunit {TestMethodName}
- Ex: docker-compose exec app phpunit ./tests/CreateUserTest.php
