
# Mercatodo

Created with laravel and php, this project is about an online store. It has everything you need to sell any product on the web.

## Functionalities
- Login system
- Allows you to manage products, users, roles, categories
- Generation of reports for market analysis
- Allows you to pay through the Placetopay gateway
- Allows you to manage products through API Rest
- Import and export products

## Installation

- Clone the repository.
    ```
    git clone https://github.com/susanas7/MERCATODO..git
    ```
- Install packages and dependencies.
    ```
    composer install
    ```
- Copy the .env.example file and configure your environment.
    ```
    cp .env.example .env
    ```
- Create your database and configure it in your .env file.
- Run migrations and seeders to access admin users.
    ```
    php artisan migrate
    php artisan db:seed
    ```
- Generate the APP_KEY.
    ```
    php artisan key:generate
    ```
- Create the links configured in the app.
    ```
    php artisan storage:link
    ```
- Install the packages for node.js and compile.
    ```
    npm install
    npm run dev or npm run prod
    ```
- Configure mailtrap for sending emails:
    - In the .env file configure the following fields, an example:
        ```
        MAIL_MAILER=smtp
        MAIL_HOST=smtp.mailtrap.io
        MAIL_PORT=2525
        MAIL_USERNAME= (username de mailtrap)
        MAIL_PASSWORD= (password de mailtrap)
        MAIL_ENCRYPTION=tls
        MAIL_FROM_ADDRESS=norequest@mailtrap
        MAIL_FROM_NAME="${APP_NAME}"
        ```
- To use API Rest correctly, you can read the documentation [here](https://documenter.getpostman.com/view/11883657/TVmHDfGU).

### It is done!