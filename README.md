Minha API

![image](https://user-images.githubusercontent.com/58447450/129438479-718ee6ce-1414-46cd-a5db-6650d14806be.png)


Esse prejeto é apenas um exercio para o treinamento pessoal;

-----Estou implementando ainda o PUT e a validação de dados e usuarios(Update dos usuarios e livros)------

Requisitos para rodar o projeto:
* PHP 
* MYSQL
* POSTMAN

PASSOS:

1 - Executar o script sql, para a criação dos bancos;

2 - Subir server = php -S localhost:8000 -t public;

3 - Execultal as requisições para o seu localhost, eu utilizei o POSTMAN para realizar as requisições HTTP (GET - POST - DELETE - PUT);

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

- Atualizar um usuairo (METODO HTTP = PUT): localhost:8000/api/livro/{id} -> localhost:8000/api/livro/1
parametros no corpo da requisição = titulo - autor - num_pag
