# **RECOVO**

## **Requisitos**

Para ejecutar este proyecto, asegúrate de tener los siguientes requisitos:

- **PHP** (versión mínima 8.x)
- **Composer**
- **Docker**
- **Laravel** (versión mínima 9.x)
- **Base de datos** (MySQL)
- **Sanctum** Laravel Sanctum se utiliza para gestionar la autenticación mediante tokens API. Sino lo tenes y deseas instalarlo, ejecuta el siguiente comando:

    ```bash
    composer require laravel/sanctum
    ```

-------

## **Instalación**

### **1. Configuración con Docker**

Sigue estos pasos para configurar el entorno de desarrollo utilizando Docker:

1. **Instalar Docker**  
   Asegúrate de tener **Docker** y **Docker Compose** instalados en tu máquina.

2. **Archivos necesarios**  
   Asegúrate de tener los archivos `docker-compose.yml` y `.env` en el proyecto. Si no los tienes, puedes obtener una copia que hay en archivos adjuntos del mail, o simplemente copiar y pegar el contenido.

3. **Se debe tener libre el puerto 8000 para la app y el 3306 para la base.**

4. **Construcción y ejecución de contenedores**  
   Una vez que tienes Docker y Docker Compose listos, ejecuta el siguiente comando para construir y levantar los contenedores:

   ```bash
   docker-compose up --build -d
   ```

5. **Levantar los contenedores Docker**  
    ```bash
    docker-compose up
    ```
    Si quisieras detener los contenedores, ejecuta:
    ```bash
    docker-compose down
    ```

6. **Verificar que los contenedores se estén ejecutando correctamente**:

    Ejecuta el siguiente comando para verificar los contenedores en ejecución:

    ```bash
    docker ps
    ```

7. **Ejecutar el siguiente comando para acceder al contenedor**:

    ```bash
    docker exec -it laravel_app bash
    ```

8. **Una vez dentro del contenedor docker ejecutar**:

    ```bash
    php artisan migrate --seed
    ```

    Esto creará el usuario y el carrito con el que se usarán los endpoints.

    Si se quieren crear productos en la base de datos, este seeder crea 10 productos:

    ```bash
    php artisan db:seed --class=ProductSeeder
    ```

    O se podrán crear manualmente con el endpoint de **Create Product**.


## Postman

1. **Descargar colección de Postman**  
    Descarga la colección de Postman que se adjuntó en este proyecto.

2. **Importar colección**  
    Dirígete a Postman, ve a la pestaña 'Import', y selecciona el archivo de la colección descargada.

3. **Autenticación y Bearer Token**  
    En la carpeta 'Authentication' de la colección importada, realiza el Login clickeando en 'send'. Esto generará automáticamente tu Bearer Token, que se utilizará en todos los demás requests.

4. **Probar los Endpoints**  
    Con el token generado, podrás probar los diferentes endpoints disponibles en la colección de Postman. Realiza las pruebas según sea necesario.

## Características de los Endpoints

### Authentication

- **Login**: Este endpoint solo se utiliza la primera vez para generar el **Bearer Token**. Una vez obtenido el token, será utilizado automáticamente en las siguientes solicitudes.

### Cart

- **Index**: Consulta el contenido actual del carrito de compras. Este endpoint te permite ver todos los productos que has añadido al carrito.
- **Add-item**: Agrega un producto al carrito. Debes enviar los datos del nuevo producto en el cuerpo de la solicitud (body). Asegúrate de haber creado previamente el `product_id` y de incluir el `cartItemId` en la URL.
- **Update-item**: Actualiza los detalles de un producto en el carrito. Debes enviar los nuevos datos del producto en el cuerpo de la solicitud (body). Incluye el `cartItemId` en la URL para especificar qué item quieres actualizar.
- **Remove-item**: Elimina un producto del carrito. Debes incluir el `cartItemId` en la URL para eliminar el artículo correspondiente.
- **Empty Cart**: Vacía el carrito completamente, eliminando todos los productos en él.

### Product

- **Index**: Obtén una lista de todos los productos disponibles en el sistema.
- **Show**: Muestra los detalles de un producto específico. Incluye el `product_id` en la URL para obtener la información del producto.
- **Create**: Crea un nuevo producto. Debes enviar los datos del producto en el cuerpo de la solicitud (body).
- **Update**: Actualiza un producto existente. Debes enviar los datos nuevos del producto en el cuerpo de la solicitud (body) y asegúrate de incluir el `product_id` en la URL.
- **Delete**: Elimina un producto del sistema. Debes proporcionar el `product_id` en la URL para especificar qué producto deseas eliminar.