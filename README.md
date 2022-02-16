# Decrição

Olá, o backend dessa aplicação está feito em `Node` e o front em `Vue`. O banco de dados utilizado foi o `Postgres`.
Com essa aplicação o usuário consegue adicionar, editar, vizualizar e deletar livros, assim como vizualizar dois gráficos
na tela dashboard, referente as informações desses livros.

# Instruções
- Após baixar os arquivos, utilize os comandos:

git fetch; git checkout AdryannMillosSantosDeFreitas

- Na raiz do projeto terão duas pastas, backend e frontend, com os comandos:

cd backend; npm install; 

- Você entrará na pasta do backend e baixará todas as dependências, nessa mesma pasta você encontrará um arquivo chamado 
.env.exemple, copie-o e renomeie a copia para apenas .env, edite-a de acordo com o seu banco de dados que irá utilizar na aplicação e escolha uma porta para o servidor, por exemplo a 8000.

- Com o comando:

npm start

- O servidor deve iniciar na porta determinada no seu .env .

- Abra um novo terminal, sem fechar o do backend e utilize os comando :

cd frontend; npm install; npm run dev;

- assim, entrando na pasta do frontend, baixando as dependencias e iniciando-o no link mostrado no terminal. Abra o seu navegador e acesse o link.

**Frontend**

A pagina inicial acessada pelo navegador é a Home, onde você pode vizualizar todos os livros criados e suas informações, de forma paginada, podendo utilizar os filtros em cima da tabela de livros para filtrar de acordo com sua preferencia essas informações. 

Na navbar, tem-se o botão de adicionar livro, que redireciona o usuário para uma tela de cadastro de livro, também tem-se um botão para
a tela dashboard onde o usuário pode ver em forma de gráfico, informações sobre os livros cadastrados.

Na Home o usuário ainda tem acesso a mais dois botões, um de editar, que redireciona para uma página em que se pode editar as informações do 
livro selecionado, e um botão de deletar, onde apaga-se as informações do livro selecionado.

**Backend**:

Na pasta src dentro de backend, tem-se a pasta routes, onde estão definidas todas as rotas da api, seus métodos http e o controller responsável por essas rotas, que encontra-se na pasta controllers. 
Dentro do controller, temos uma contante para cada rota, validações(que está dentro da pasta validation), paginação, services responsável e o que cada roda tem que retornar em caso de sucesso ou erro. 
Dentro de services temos todos os serviços, lógica de negócio e a interligação com o repository(pasta repository) que é o responsável pela interação com o banco de dados.

**Testes**
Na pasta tests, dentro do arquivo book.test.js temos os testes unitários, lembre-se de que para obter sucesso noprimeiro teste de cada uma dessas rotas, /api/v1/book/:id e  /api/v1/book/update/:id deve-se ter criado um livro com o mesmo id que vai ser testado (pode ser utilizando o frontend ou usando uma ferramenta como o postman). Para iniciar os testes, estando com o terminal dentro da pasta backend, basta usar o comando:

npm run test

