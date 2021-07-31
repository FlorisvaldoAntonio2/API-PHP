Minha API

executar o script sql, para a criação do banco

subir server = php -S localhost:8000 -t public

eu utilizei o POSTMAN para realizar as requisições HTTP (GET - POST - DELETE - PUT)

URL base = localhost:8000/api/user

retornar um usuario (METODO HTTP = GET): localhost:8000/api/user/{id} -> localhost:8000/api/user/1

retornar todos os usuarios (METODO HTTP = GET): localhost:8000/api/user

deletar um usuario (METODO HTTP = DELETE): localhost:8000/api/user/{id} -> localhost:8000/api/user/1

adicionar usuario (METODO HTTP = POST): localhost:8000/api/user
parametros no corpo da requisição = nome - email (unico) - sexo ('M' or 'F')