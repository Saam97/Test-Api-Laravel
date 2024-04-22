Esta es una pequeña prueba en donde habia que hacer solititudes a una api, seguir los pasos y responder la pregunta final. 
http://mini-challenge.foris.ai/

Bienvenidos al Mini Reto Foris

Para iniciar este desafío debes enviar una POSTsolicitud al http://mini-challenge.foris.ai/login con cuerpo {"username": "foris_challenge", "password": "ForisChallenge"}.

Luego sigue las instrucciones.

¡Buena suerte!

Aquí están los uris válidos con sus métodos permitidos.

/acceso:
Métodos permitidos: POST.
Requiere autenticación: No.
Cuerpo requerido: {"username": "foris_challenge", "password": "ForisChallenge"}.
/desafío:
Métodos permitidos: GET.
Requiere autenticación: Sí.
/volcados/{dump_type}:
Métodos permitidos: GET.
Requiere autenticación: Sí.
/validar:
Este es un método para validar su respuesta. Tenga cuidado, solo puede enviar esta solicitud una vez cada hora.
Métodos permitidos: POST.
Requiere autenticación: Sí.
Cuerpo_requerido: {"number_of_groups": NUMBER_OF_GROUPS, "answer": YOUR_ANSWER}.
NUMBER_OF_GROUPS: Es el número de grupos presentes en la tabla groupdel volcado dado. Al dar esto demuestras que inspeccionaste exitosamente tu base de datos.
YOUR_ANSWER: Es la respuesta a la pregunta formulada en el uri /challenge.
Respuesta: Puede ser respuesta correcta o respuesta incorrecta.
