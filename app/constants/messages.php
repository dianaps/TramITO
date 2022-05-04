<?php
class Messages
{
 // INFO
 const STATUS_ONLINE     = "En línea";
 const LAST_SEEN         = "Última vez activo: ";
 const EMPTY_MESSAGES    = "No hay mensajes aún, inicie una conversación";
 const EMPTY_DEPARTMENTS = "No se encontraron departamentos";

 // ERROR
 const ERR_USER_NOT_FOUND                 = "El usuario %s no ha sido encontrado";
 const ERR_NAME_REQUIRED                  = "El nombre es requerido";
 const ERR_LAST_NAME_REQUIRED             = "Los apellidos son requeridos";
 const ERR_SEMESTER_REQUIRED              = "El semestre es requerido";
 const ERR_ENROLLMENT_REQUIRED            = "El número de control es requerido";
 const ERR_FORMAT_ENROLLMENT              = "El número de control está formado únicamente por 8 dígitos";
 const ERR_PASSWORD_REQUIRED              = "La contraseña es requerida";
 const ERR_CAREER_REQUIRED                = "La carrera es requerida";
 const ERR_EMAIL_REQUIRED                 = "El correo electrónico es requerido";
 const ERR_FORMAT_EMAIL                   = "El formato del email no es válido";
 const ERR_INCORRECT_USERNAME_OR_PASSWORD = "El usuario o la contraseña son incorrectos";
 const ERR_INCORRECT_FILE_EXTENSION       = "Solo se admiten archivos JPG, JPEG y PNG";
 const ERR_UNKNOWN_ANSWER                 = "Lo siento, no he logrado entenderte";
 const ERR_USERNAME_ALREADY_EXISTS        = "Este usuario ya ha sido registrado";
 const ERR_EMAIL_ALREADY_EXISTS           = "Este correo electrónico ya ha sido registrado";
 const ERR_INCORRECT_USERNAME_OR_EMAIL    = "El usuario o el email son incorrectos";
 const SCS_INFO_UPDATE                    = "La información se ha actualizado correctamente";
 const ERR_UPDATE_PROFILE_PICTURE         = 'Ocurrió un error al subir la imagen de perfil';
 const ERR_EMAIL_SENT                     = "Hubo un error al enviar la nueva contraseña.";

 // UPDATE PASSWORD
 const ERR_CURRENT_PASSWORD_REQUIRED    = "La contraseña actual es requerida";
 const ERR_NEW_PASSWORD_REQUIRED        = "La contraseña nueva es requerida";
 const ERR_CONFIRM_PASSWORD_REQUIRED    = "La confirmación de la contraseña es requerida";
 const ERR_DIFFERENT_PASSWORDS_REQUIRED = "La contraseña nueva no puede ser idéntica a la actual";
 const ERR_DIFFERENT_PASSWORDS          = "Las contraseñas no coinciden";
 const ERR_CURRENT_PASSWORD             = "La contraseña actual no es correcta";
 const SCS_UPDATE_PASSWORD              = "La contraseña se ha actualizado correctamente";

 // SUCCESS
 const SCS_CREATION_ACCOUNT    = "Cuenta creada exitosamente";
 const SCS_CREATION_DEPARTMENT = "Departamento creado exitosamente";
 const SCS_CREATION_ADMIN      = "El administrador se ha registrado correctamente";
 const SCS_EMAIL_SENT          = "Se ha enviado una nueva contraseña al correo propocionado.";

 // ADMIN
 const ERR_USERNAME_REQUIRED                  = "El nombre de usuario es requerido";
 const ERR_USERNAME_ADMIN_ALREADY_EXISTS      = "Este nombre de usuario ya ha sido registrado";
 const ERR_NAME_DEPARTMENT_REQUIRED           = "El nombre del departamento es requerido";
 const ERR_INFO_DEPARTMENT_REQUIRED           = "La información del departamento es requerida";
 const ERR_PHONE_DEPARTMENT_REQUIRED          = "El teléfono es requerido";
 const ERR_PHONE_FORMAT                       = "El teléfono debe estar conformado únicamente por 10 dígitos";
 const ERR_BOSS_DEPARTMENT_REQUIRED           = "El nombre del jefe de departmento es requerido";
 const ERR_USERNAME_DEPARTMENT_ALREADY_EXISTS = "Este usuario ya ha sido registrado. Elija otro, por favor";
 const ERR_DEPARTMENT_DOESNT_EXIST            = "El departamento no existe. Inténtalo de nuevo";
 const SCS_UPDATE_DEPARTMENT                  = "El departamento se ha actualizado correctamente";
 const ERR_ADMIN_DOESNT_EXIST                 = "El administrador no existe. Inténtalo de nuevo";
 const SCS_UPDATE_ADMIN                       = "El administrador se ha actualizado correctamente";
 const ERR_QA_DOESNT_EXIST                    = "No se encontró la pregunta solicitada. Inténtalo de nuevo";

 // XOOCHBOT QA
 const ERR_QUESTION_REQUIRED = "La pregunta es requerida";
 const ERR_ANSWER_REQUIRED   = "La respuesta es requerida";
 const SCS_ADD_QA            = "La pregunta-respuesta ha sido agregada correctamente";
}
