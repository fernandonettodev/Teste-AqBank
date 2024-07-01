# Projeto Teste AqBank usando Laravel 10, Sail e JWT Token.

## Iniciando

### Necessario:
[Docker](https://www.docker.com/products/docker-desktop/)
[PHP 8.1](https://www.php.net/releases/8.1/en.php)

### Passos para rodar o projeto:

1. Clone o projeto para sua máquina:
   ```bash
   git clone https://github.com/fernandonettodev/Teste-AqBank
   cd seu-projeto
   ```

2. Copie o arquivo `.env.example` para `.env` e configure suas variáveis de ambiente:
   ```bash
   cp .env.example .env
   ```

3. Instale as dependências do Composer:
   ```bash
   ./vendor/bin/sail composer install
   ```

4. Gere a chave da aplicação:
   ```bash
   ./vendor/bin/sail artisan key:generate
   ```

5. Inicie os containers do Docker com o Sail:
   ```bash
   ./vendor/bin/sail up -d
   ```

6. Rode as migrations para criar as tabelas no banco de dados:
   ```bash
   ./vendor/bin/sail artisan migrate
   ```

7. (Opcional) Popule o banco de dados com dados iniciais, incluindo um usuário administrador:
   ```bash
   ./vendor/bin/sail artisan db:seed
   ```

### Dados de autenticação do administrador:

- **Email:** admin@aqbank.dev
- **Senha:** admin

## Visão Geral do Projeto

Este é um projeto Laravel 10 que utiliza Tokens JSON Web (JWT) para autenticação e Sail para desenvolvimento. O projeto consiste em três entidades principais: Autores, Livros e Empréstimos.

## Autenticação

Para utilizar a API, você precisa se autenticar usando um token JWT. Você pode obter um token enviando uma solicitação POST para o endpoint `/login` com um email de usuário e senha válidos.


## Coleção do Postman

Você pode encontrar uma coleção do Postman para essa API neste link:
[Postman Collection e Globals](https://drive.google.com/drive/folders/1pOf5EshrUS3xan6brmkczIJdb5LR_vKH?usp=drive_link)

## Lembrete:
Siga sempre o passo de:
Autenticar, cadastrar autor, cadastrar livro e depois poder fazer o emprestimo.

## Endpoints

### Autenticação

- **POST /login:** Autenticar um usuário e obter um token JWT
  - **Corpo da solicitação:** `email` e `password`
  - **Resposta:** `token` (token JWT)

### Autores

- **GET /autores:** Recuperar uma lista de todos os autores
  - **Resposta:** Array de objetos de autor

- **POST /autores:** Criar um novo autor
  - **Corpo da solicitação:** `name` e `birthday`
  - **Resposta:** Objeto de autor criado

- **GET /autores/{id}:** Recuperar um autor único por ID
  - **Resposta:** Objeto de autor

- **PUT /autores/{id}:** Atualizar um autor existente
  - **Corpo da solicitação:** `name` e `birthday`
  - **Resposta:** Objeto de autor atualizado

- **DELETE /autores/{id}:** Excluir um autor
  - **Resposta:** Mensagem de sucesso

### Livros

- **GET /livros:** Recuperar uma lista de todos os livros
  - **Resposta:** Array de objetos de livro

- **POST /livros:** Criar um novo livro
  - **Corpo da solicitação:** `title`, `[author_ids]` e `publicado_em`
  - **Resposta:** Objeto de livro criado

- **GET /livros/{id}:** Recuperar um livro único por ID
  - **Resposta:** Objeto de livro

- **PUT /livros/{id}:** Atualizar um livro existente
  - **Corpo da solicitação:** `title`, `[author_ids]` e `publicado_em`
  - **Resposta:** Objeto de livro atualizado

- **DELETE /livros/{id}:** Excluir um livro
  - **Resposta:** Mensagem de sucesso

### Empréstimos

- **GET /emprestimos:** Recuperar uma lista de todos os empréstimos
  - **Resposta:** Array de objetos de empréstimo

- **POST /emprestimos:** Criar um novo empréstimo
  - **Corpo da solicitação:** `book_id`, `user_id`
  - **Resposta:** Objeto de empréstimo criado

- **GET /emprestimos/{id}:** Recuperar um empréstimo único por ID
  - **Resposta:** Objeto de empréstimo

- **PUT /emprestimos/{id}:** Atualizar o empréstimo para entrege.
  - **Resposta:** Mensagem de sucesso

- **DELETE /emprestimos/{id}:** Excluir um empréstimo
  - **Resposta:** Mensagem de sucesso

