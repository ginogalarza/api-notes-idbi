# Api Notes ID

API NOTES IDBI es una aplicacion desarrollada en Laravel 9 para la creacion de notas personalizadas en grupos categorizados tan solo con un usuario registrado.
Esta API se desarrollo para la prueba tecnica Backend de la empresa ID.


# Requerimientos

PHP 7.2 o superior

## Pasos

#### Instalar Api Notes ID
 - Configure su archivo .env
 - Configure un servicio de Correo Electronico para el envio de emails a los usuarios.
   
 - `composer install`

## End Points
Se listan los siguientes:

 - `POST: /register` => Registrar Usuario
 - `POST: /login` => Iniciar Sesión
 - `GET: /group`=> Listar los Grupos
 - `POST: /group-join` => Unirse a un grupo
 - `GET: /group/{group}` => Listar datos de un grupo
 - `GET: /note`  => Listar todas las notas
 - `POST: /group/{group}/note`  => Registra una nueva nota
 - `GET: /logout`=> Cerrar Sesión
