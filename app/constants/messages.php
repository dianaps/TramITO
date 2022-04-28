<?php
class Messages
{
 // INFO
 const STATUS_ONLINE  = "En línea";
 const LAST_SEEN      = "Última vez activo: ";
 const EMPTY_MESSAGES = "No hay mensajes aún, inicie una conversación";

 // ERROR
 const ERR_USER_NOT_FOUND                 = "El usuario %s no ha sido encontrado";
 const ERR_NAME_REQUIRED                  = "El nombre es requerido";
 const ERR_LAST_NAME_REQUIRED             = "Los apellidos son requeridos";
 const ERR_USERNAME_REQUIRED              = "El nombre de usuario es requerido";
 const ERR_PASSWORD_REQUIRED              = "La contraseña es requerida";
 const ERR_EMAIL_REQUIRED                 = "El correo electrónico es requerido";
 const ERR_INCORRECT_USERNAME_OR_PASSWORD = "El usuario o la contraseña son incorrectos";
 const ERR_INCORRECT_FILE_EXTENSION       = "Solo se admiten archivos JPG, JPEG y PNG";
 const ERR_UNKNOWN_ANSWER                 = "Lo siento, no he logrado entenderte";
 const ERR_USERNAME_ALREADY_EXISTS        = "Este usuario ya ha sido registrado, verifique su número de control";
 const ERR_EMAIL_ALREADY_EXISTS           = "Este correo electrónico ya ha sido registrado";

 // SUCCESS
 const SCS_CREATION_ACCOUNT = "Cuenta creada exitosamente";

}
