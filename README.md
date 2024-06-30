
# Laravel-powered-api

## Installation

### 1. Clone the repository
    git clone https://github.com/Toppaponwit03/Laravel-powered-api.git
    cd Laravel-powered-api
    

### 2. Start Docker containers
    docker-compose up -d --build
    
### 3. Enter the PHP container
    docker exec -it php bash

### 4. Install Composer
    composer install

### 5. Run migrations
    php artisan migrate 

###
   <small> - WARN The database 'powered' does not exist on the 'mysql' connection. Would you like to create it? (yes/no)</small>
    
    "yes"


### 6. Testing the API From Collection Postman

   <p>Import Folder Apitest in Postman</p> 
   
   [Download Apitest](https://github.com/Toppaponwit03/Laravel-powered-api/blob/master/Apitest) 

<!-- Click Download Raw file in Link Here 
[Download Powered Api.postman_collection.json](https://github.com/Toppaponwit03/Laravel-powered-api/blob/master/Powered%20Api.postman_collection.json) -->






