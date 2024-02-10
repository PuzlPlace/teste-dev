# biblioteca-de-livros 📔📚📒📕📗

Biblioteca de livros é um projeto que desenvolvi criando um mini API que estrutura um CRUD de uma estante de livros. Se trata de uma SPA (Single Page Application) manipulada pelo Vue.js utilizando o banco de dados Firestore da Firebase.

## Tecnologias principais

- Vue.js v3.4.15
- Vue Router v4.2.5
- Firebase v10.7.2
- Bootstrap v5.3.2

### Rodando o projeto local

- Clone o projeto na sua máquina;
- Instale as dependências usando `npm i`
- Renomeie o arquivo `.env.local.example` para `.env.local`;
- Crie uma conta no [Firebase](https://firebase.google.com/) (basta ter uma conta do Google);
- Utilize o banco de dados Firestore;
- No console, adicione um novo projeto e dê o nome que preferir;
- Copie as credenciais do projeto para o ambiente Web e coloque-as em seus devidos locais dentro do arquivo `.env.local`;
- Ative o método de login para E-mail/senha;
- Ative o Firestore Database dentro do console do Firebase;
- Execute `npm run dev` para subir um servidor local para desenvolvimento com hot reload ativado.

## Project Setup

```sh
npm install
```

### Compile and Hot-Reload for Development

```sh
npm run dev
```

### Compile and Minify for Production

```sh
npm run build
```
