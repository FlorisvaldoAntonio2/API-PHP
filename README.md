Minha API

![image](https://user-images.githubusercontent.com/58447450/129438479-718ee6ce-1414-46cd-a5db-6650d14806be.png)


Esse prejeto é apenas um exercio para o treinamento pessoal;

-----Estou implementando a validação de dados e de usuarios------

Requisitos para rodar o projeto:
* PHP 
* MYSQL
* POSTMAN

PASSOS:

1 - Executar o script sql, para a criação dos bancos de dados;
![banco](https://user-images.githubusercontent.com/58447450/129658803-0bdf42af-fc7d-44a0-9e45-adc0b03cde8a.png)

2 - Subir server = php -S localhost:8000 -t public;
![server](https://user-images.githubusercontent.com/58447450/129658831-1d31d919-1585-480b-8afb-1acd5832dca1.png)

3 - Execultal as requisições para o seu localhost, eu utilizei o POSTMAN para realizar as requisições HTTP (GET - POST - DELETE - PUT);
![PostmanUrl](https://user-images.githubusercontent.com/58447450/129658853-59b5da07-b3b2-4dd3-bfa5-d63d4193219c.png)
![PostmanMetdo](https://user-images.githubusercontent.com/58447450/129658865-85c8c55a-f646-4ae9-9d7f-77389cd3a921.png)
![PostmanPrametro](https://user-images.githubusercontent.com/58447450/129658878-b7d7edd2-0f46-4fb8-ab41-e552d1afee30.png)
![PostmanResult](https://user-images.githubusercontent.com/58447450/129658891-2750bacc-0fe8-4ca5-b7c2-595686bc7a84.png)


------ URL BASE = localhost:8000/api/ -------

* EXEMPLOS:

*Usuario

- Retornar um usuario (METODO HTTP = GET): localhost:8000/api/user/{id} -> localhost:8000/api/user/1

- Retornar todos os usuarios (METODO HTTP = GET): localhost:8000/api/user

- Deletar um usuario (METODO HTTP = DELETE): localhost:8000/api/user/{id} -> localhost:8000/api/user/1

- Adicionar usuario (METODO HTTP = POST): localhost:8000/api/user
parametros no corpo da requisição = nome - email (unico) - sexo ('M' or 'F')

- Atualizar um usuairo (METODO HTTP = PUT): localhost:8000/api/user/{id} -> localhost:8000/api/user/1
parametros no corpo da requisição = nome - email (unico) - sexo ('M' or 'F')

*LIVRO

- Retornar um livro (METODO HTTP = GET): localhost:8000/api/livro/{id} -> localhost:8000/api/livro/1

- Retornar todos os livros (METODO HTTP = GET): localhost:8000/api/livro

- Reletar um livro (METODO HTTP = DELETE): localhost:8000/api/livro/{id} -> localhost:8000/api/livro/1

- Adicionar livro (METODO HTTP = POST): localhost:8000/api/livro
parametros no corpo da requisição = titulo - autor - num_pag

- Atualizar um livro (METODO HTTP = PUT): localhost:8000/api/livro/{id} -> localhost:8000/api/livro/1
parametros no corpo da requisição = titulo - autor - num_pag

*IMPORTANTE
Na atualização usar a opção x-www-form-urlencoded
![put-api](https://user-images.githubusercontent.com/58447450/129657525-ec441eb2-d0f0-4a11-9747-3803d89c84ff.png)

