# DEMO DE OYE CÓMO VA VERSIÓN 1.0

## Iniciar la aplicación

Clonar el repositorio con
`git clone https://github.com/Oye-Como-Va/OyeComoVa.git`

Configurar el .env con el nombre de `oyedatabase`

Instalar dependencias de node con: npm run dev

A continuación, instalamos las dependencias del proyecto:

`composer update`
`php artisan key:generate`

`npm i`
`npm run dev`

Esto descargará todas las librerías y herramientas que hemos usado para crear el proyecto y que necesitará para poder usar la aplicación.

Para crear la base de datos e insertar un seeder para la demo, ejecute los siguientes comandos:
`php artisan migrate`
`php artisan db:seed`

El seeder creará una serie de usuarios con contraseñas predeterminadas. Puede hacer uso de cualquiera de ellos mirando la contraseña en el archivo DatabaseSeeder.php, crear su propio usuario o probar con el siguiente:
email: `juan@example.com`
password: `password123`

## Probar las funcionalidades desarrolladas hasta ahora

Los casos de uso completados hasta la fecha y que puede testear son:

-   Login / register
-   Calendario: puede crear tareas, arrastrarlas para cambiarlas de fecha, editarlas y eliminarlas en el apartado del calendario.
-   Cursos y asignaturas: funcionalidad lista, falta mejorar la vista. Puede crear cursos y asignaturas
