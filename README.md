Aplicacion PHP utilizando Laravel que trata de la creacion de catalogos utilizando un json como base, pudiendo copiar los campos del formulario en el portapapeles del ordenador

Esta aplicacion esta diseñada para ser usada con un servidor LDAP como validacion para el login. 

# COMO INICIAR LA APLICACION
El comando de inicio se tirara en el cmd, dentro de la carpeta docker del aplicativo y una vez ya creado los .env con los datos necesarios para conectarse a la base de datos que desee el usuario. El docker-compose se cambiara en funcion si es en local (.dev) o en produccion (.prod)

 1. `docker compose -f docker-compose.dev.yml up -d --build`
