
# Mercatodo

Creado en laravel, este proyecto se trata de una tienda online. Posee todo lo necesario para vender cualquier producto por medio de la web.


## Instalación

- Clona el repositorio.
    ```
    git clone https://github.com/susanas7/MERCATODO..git
    ```
- Instala paquetes y dependencias.
    ```
    composer install
    ```
- Copia el archivo .env.example y configura tu entorno.
    ```
    cp .env.example .env
    ```
- Crea tu base de datos y configurala en tu archivo .env.
- Ejecuta las migraciones y los seeders para tener acceso a los usuarios administradores.
    ```
    php artisan migrate
    php artisan db:seed
    ```
- Genera la APP_KEY.
    ```
    php artisan key:generate
    ```
- Crea los enlaces configurados en la app.
    ```
    php artisan storage:link
    ```
- Instala los paquetes para node.js y compila.
    ```
    npm install
    npm run dev
    ```
- Configura mailtrap para el envío de emails:
    - Crea una cuenta en mailtrap, en caso de que no la tengas.
    - En el archivo .env configura los siguientes campos, un ejemplo:
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
- Para usar correctamente del servicio API, puedes leer la documentacion [aqui](https://documenter.getpostman.com/view/11883657/TVmHDfGU).

### ¡Eso sería todo!