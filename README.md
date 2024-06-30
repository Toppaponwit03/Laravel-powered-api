
# Laravel-powered-api

## Installation

### 1. Clone the repository:
    git clone https://github.com/Toppaponwit03/Laravel-powered-api.git
    cd Laravel-powered-api
    

### 2. Start Docker containers:
    docker-compose up -d --build
    
### 3. Install Composer
    composer install

### 4. Enter the PHP container:
    docker exec -it php bash


### 5. Run migrations:
    php artisan migrate

###
   <small> - WARN The database 'powered' does not exist on the 'mysql' connection. Would you like to create it? (yes/no)</small>
    
    "yes"


### 6. Testing the API From Collection Postman



