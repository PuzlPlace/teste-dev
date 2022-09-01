# Teste-dev

## Tecnologias usadas

- [PHP 8](https://www.php.net/downloads): https://www.php.net/downloads
- [Laravel 9](https://laravel.com/docs/8.x): https://laravel.com/docs/8.x
- [NodeJS 16.14.2](https://nodejs.org/download/release/v16.14.2/): https://nodejs.org/download/release/v16.14.2/

## Pacotes de terceiros utilizados

### API

- [jwt-auth 1.0](https://github.com/tymondesigns/jwt-auth): https://github.com/tymondesigns/jwt-auth

### Client

- [Axios 0.27.2](https://axios-http.com/ptbr/docs/intro): https://axios-http.com/ptbr/docs/intro
- [Js-Cookie 3.0.1](https://github.com/js-cookie/js-cookie): https://github.com/js-cookie/js-cookie
- [NProgress 0.2.0](https://github.com/rstacruz/nprogress): https://github.com/rstacruz/nprogress
- [Sweetalert2 11.4.17](https://sweetalert2.github.io/): https://sweetalert2.github.io/

## Implementação

### 1. Primeiro clone o projeto

```bash
git clone https://github.com/gabrielrj/teste-dev | https://github.com/PuzlPlace/teste-dev
```

#### 2. API
###### 2.1. Entre na pasta da API

```bash
cd api
```
###### 2.2. Crie o arquivo .env

```bash
cp .env.example .env
```

###### 2.3. Suba os containers docker com docker-compose

```bash
sudo docker-compose up --build -d
```

###### 2.3.1 Entre na bash do container laravel para executar os demais comandos

```bash
sudo docker-compose exec teste_dev_app bash
```

###### 2.4. Rode o composer para instalar as dependências do projeto

```bash
composer install
```

###### 2.5. Gere a key do projeto

```bash
php artisan key:generate
```

###### 2.6. Gere a secret do JWT

```bash
php artisan jwt:secret
```

###### 2.7. Se atente as variáveis de ambiente necessárias

* 2.7.1. Banco de Dados

| Variável      | Descrição                                                                  |
|---------------|----------------------------------------------------------------------------|
| DB_CONNECTION | Qual servidor de banco de dados será utilizado (ex: Mysql, Postgree, etc). |
| DB_HOST       | IP ou Url de conexão com o banco de dados (ex: localhost, etc).            |
| DB_PORT       | Porta de conexão com o banco de dados (ex: 3306, 5432, etc).               |
| DB_DATABASE   | Nome do schema de banco de dados (ex: itasks, etc).                        |
| DB_USERNAME   | Usuário de banco de dados para conexão (ex: root, etc).                    |
| DB_PASSWORD   | Senha do usuário de banco (ex: root, etc).                                 |

* 2.7.1. Serviço de E-mail (Eu utilizo para testes o [Mailtrap](https://mailtrap.io/))

| Variável          | Descrição                                                   |
|-------------------|-------------------------------------------------------------|
| MAIL_MAILER       | Serviço de envio de e-mail (ex: smtp, etc).                 |
| MAIL_HOST         | Url do serviço de e-mail (ex: smtp.mailtrap.io, etc).       |
| MAIL_PORT         | Porta de conexão com o serviço de e-mail (ex: 2525).        |
| MAIL_USERNAME     | Usuário do serviço de e-mail.                               |
| MAIL_PASSWORD     | Senha do usuário no serviço de e-mail.                      |
| MAIL_ENCRYPTION   | Método de encriptação da mensagem de e-mail (ex: tls, etc). |
| MAIL_FROM_ADDRESS | Endereço de e-mail do sistema.                              |
| MAIL_FROM_NAME    | Nome do endereço de e-mail.                                 |


###### 2.8. Rode as migrations

```bash
php artisan migrate
```

###### 2.9. Crie um usuário administrador via CLI

- Ao rodar o comando o sistema irá solicitar os dados para cadastrar o usuário.

```bash
php artisan user:new
```

###### 2.9.1 Saia do terminal (bash) do container laravel

```bash
exit
```

==============================================================================

#### 3. Client
###### 3.1. Entre na pasta do Client

```bash
cd client
```
###### 3.2. Crie o arquivo .env

```bash
cp .env.example .env
```

* 3.2.1 Insira a URL da API na variável <b>VUE_APP_URL_API</b> (ex: http://localhost:8001/api).
* Sem essa variável preenchida ocorrerá erro nas chamadas AJAX.

###### 3.3. Suba o container do client (vuejs)

```bash
sudo docker-compose up --build -d
```


