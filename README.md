## Trengo API using Apiato

## How to run the application

### 1. Setup the Project
`make setup`

### 2. Start the project
`make start`

### 3. Add the domain to the Hosts file
```bash
sudo vi /etc/hosts

127.0.0.1  trengo.local
127.0.0.1  api.trengo.local
```

### 4. Visit 
http://api.trengo.local

### 5 Migrate and seed data
`make migrate`
`make seed`

Application is ready make some api calls :)

### Run the commands to calculated weighted average votes
```
make shell
php artisan trengo:update:weighted-average-rating
```

do you "Welcome to Apiato". good your application is running to play around.
## Other commands
### Migrate the Database:
`make migrate`

###  Seed the database
`make seed`

### Stop the project
`make stop`

### Destroy the project and its volumes
`make destroy`

### Start a shell in docker container
`make shell`

### Run the test suite
`make test`

### Run the quality assurance suite
`make qa`



