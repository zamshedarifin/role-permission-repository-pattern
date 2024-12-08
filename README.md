# Laravel API Project
This project is a Laravel-based API designed to manage roles, permissions, and posts. It includes
user authentication via Passport, role-based access control, and permissions for actions like
creating, updating, deleting, and viewing posts.
## Prerequisites
Before running the project, ensure you have the following installed:
- PHP 8.0 or higher
- Composer
- MySQL or another database system supported by Laravel
- Laravel 11.x (this project uses Laravel 11)
- Docker (optional, if you prefer using Docker for containerization)
## Installation
You can either set up the project manually or use Docker for an easier environment setup.
### Option 1: Manual Setup

1. **Clone the Repository**
   Clone the repository to your local machine using Git:
 ```
    git clone https://github.com/zamshedarifin/role-permission-repository-pattern.git
    
    cd role-permission-repository-pattern
 ```
2. **Install Dependencies**
        Install Composer dependencies:
 ```
    composer install
 ```
If you are using frontend assets with Laravel Mix, install Node.js dependencies:
 ```
    npm install
 ```
3. **Copy Environment File**
     Copy the `.env.example` to `.env`:
```
    cp .env.example .env
 ```
4. **Generate Application Key**
   Run the following command to generate the Laravel application key:
 ```
  php artisan key:generate
 ```
5. **Configure Database**
    Edit the `.env` file to set your database credentials:
 ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=your_database_name
     DB_USERNAME=root
     DB_PASSWORD=
 ```
Replace `your_database_name` with the actual database name.
6. **Run Database Migrations**
   Run the database migrations to create the necessary tables:
 ```
    php artisan migrate
 ```
7. **Set Up Passport (API Authentication)**
   If you're using Passport for API authentication, run:
 ```
    php artisan passport:install
 ```
This will create the necessary encryption keys for Passport.
8. **Seed Data (Optional)**
   If you have seeders for default roles, permissions, or posts, you can run:
 ```
    php artisan db:seed
 ```
9. **Start the Development Server**
   Start the Laravel development server:
 ```
    php artisan serve
 ```

The API should now be accessible at `http://127.0.0.1`

If use Docker use docker Port like `http://localhost:3000/`

---
### Option 2: Docker Setup (Optional)
If you prefer using Docker to run the project, follow these steps:
#### Step 1: Install Docker
- [Docker for Windows](https://docs.docker.com/docker-for-windows/install/)
- [Docker for Mac](https://docs.docker.com/docker-for-mac/install/)
- [Docker for Linux](https://docs.docker.com/install/linux/docker-ce/ubuntu/)
#### Step 2: Clone the Repository

Clone the repository to your local machine:
```
git clone https://github.com/yourusername/yourprojectname.git
cd yourprojectname
```
#### Step 3: Docker Setup
1. **Build and Start the Docker Containers**
   Run the following command to build and start the Docker containers:
 ```
    docker-compose build
    docker-compose up -d
 ```
This command will:
- Build the containers based on the `Dockerfile` and `docker-compose.yml`.
- Start the containers in detached mode.
2. **Install Composer Dependencies Inside the Docker Container**
   Once the containers are up and running, enter the container and install the Composer
   dependencies:
``` 
     docker exec -it -u root role-permission-repository-pattern-role_permission-1 
     
     composer install
 ```
 Update Docker Port on .env file

````
DOCKER_APP_PORT=4000
DOCKER_APP_SSL_PORT=4001
DOCKER_DB_PORT=4002
DOCKER_PHPMYADMIN_PORT=4003
DOCKER_REDIS_PORT=4004
````
 ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=your_database_name
     DB_USERNAME=root
     DB_PASSWORD=
 ```
3. **Install Node.js Dependencies (Optional)**
   If you're using Laravel Mix or have frontend assets, install the required npm packages:
 ```
  npm install
 ```
4. **Set Up Environment Variables**
   Copy the `.env.example` file to `.env`:
 ```
    cp .env.example .env
 ```
5. **Configure Database**
   Edit the `.env` file to configure the database connection:

 ```env
 DB_CONNECTION=mysql
 DB_HOST=db
 DB_PORT=3306
 DB_DATABASE=your_database_name
 DB_USERNAME=root
 DB_PASSWORD=
 ```
Note: The database host is set to `db` because it refers to the MySQL container defined in
`docker-compose.yml`.
6. **Run Migrations**
   Once inside the container, run the migrations:
 ```
    php artisan migrate
 ```
7. **Set Up Passport (API Authentication)**
   Run the following command inside the container to set up Passport:
 ```
    php artisan passport:install
```
8. **Seed Data (Optional)**
   If you have database seeders, run:
 ```
    php artisan db:seed
 ```
9. **Start Laravel Services**
   Laravel services should be running automatically with Docker, but if not, you can use:
 ```
    php artisan serve
 ```
#### Step 4: Accessing the API
Once everything is set up, you should be able to access your API at `http://localhost:8000`.
## Usage
You can now make API requests to the following endpoints (example routes):
`GET /api/v1/admin/posts` - View all posts
- `POST /api/v1/admin/posts` - Create a new post
- `GET /api/v1/admin/posts/{id}` - View a single post
- `PUT /api/v1/admin/posts/{id}` - Update an existing post
- `DELETE /api/v1/admin/posts/{id}` - Delete a post
  Ensure you pass the appropriate `Authorization` token in the headers for API access.

### API Documents
View the API Documentation:

#### Navigate to `/docs/api` in your browser.

#### JSON Documentation:

#### Access `/docs/api.json` for OpenAPI JSON format.

## Docker Commands
- **Build and Start Docker Containers**:
 ```
    docker-compose build 
    
    docker-compose up -d
 ```
- **Stop Docker Containers**:
 ```
    docker-compose down
 ```
- **Access Docker Container**:
 ```
   docker exec -it role-permission-repository-pattern-role_permission-1 

```
- **Tail Docker Logs**:
 ```
    docker logs -f role-permission-repository-pattern-role_permission-1
 ```
## Troubleshooting
- If you face issues with permissions, make sure that the appropriate roles and permissions are
  assigned to the user.
- If you're using Docker, check the container logs for detailed error messages.
--- 
