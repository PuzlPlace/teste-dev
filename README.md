# Teste para candidatos à vaga de Desenvolvedor Full Stack.

Olá, caro desenvolvedor, nesse teste analisaremos seu conhecimento geral e velocidade de desenvolvimento. Abaixo explicaremos tudo o que será necessário.

# Instruções
- Você deve desenvolver uma API, utilizando `Laravel`, `Lumen` ou `Node`.
A escolha das bibliotecas, banco de dados, arquitetura, etc, fica a seu critério.

- O código precisa rodar em múltiplas plataformas, utilizando a Docker.
Altere o arquivo README explicando o que é preciso para rodar sua aplicação.

# O teste

**Back-End**

A primeira etapa será o desenvolvimento do backend.

**Descrição**:

Você deverá desenvolver uma 'mini api' para que seja possível realizar operações CRUD de uma estante de livros.
Será necessário gerar um relatório a partir destas informações.

# Condições:
Você poderá utilizar qualquer tecnologia de banco relacional ou apenas MongoDB como banco não relacional.
> - O sistema deverá ser separado por módulos, tendo eles, seus respectivos controllers, rotas, models, camada de serviço e repositório.
> - O sistema deverá retornar os livros de forma paginada.

**Cada livro deverá possuir** :
- ID
- Nome
- Autor
- Categoria
- Código (único)
- Tipo (arquivo digital ou físico)
- Tamanho (Peso do livro físico ou tamanho do arquivo)
- Diferenciais : Testes unitários.

# Front-End
**Para a segunda etapa do teste, você deverá desenvolver uma SPA (Single Page Application) com `Vue.js 2` e nela deve ser possível:**
> - Ver a lista de livros cadastrados
> - Criar um novo livro
> - Editar um livro existente
> - Apagar um livro existente
> - Filtragem por categoria, tipo de arquivo e nome.
> - Elaboração de um relatório/dashboard de livros cadastrados, sendo possível filtrar por categoria e por período.

**Condições**:
> - A página deve ser responsiva.
> - A página deve funcionar 100% via AJAX, sem outros carregamentos de páginas.
> - Os dados das requisições deverão ser gerenciados pelo VUEX.
> - Ao criar/editar um livro, o campo "categoria" deverá ser um SELECT.
> - A definição de peso ou tamanho do arquivo deverá ser realizada pela função `watch`, verificando o tipo do arquivo: *arquivo digital ou físico*

**Dicas**:
> - Você pode usar frameworks, tanto para o front-end (Vuejs) e tanto para o back-end.
> - Você pode usar ferramentas de automação (Grunt, Gulp), mas deverá informar o uso completo para funcionamento do teste.
> - Será considerado ponto positivo no teste a utilização de orientação a objetos, design patterns e rotinas para testes.

**Entrega**

Para iniciar o teste, faça um fork deste repositório, crie uma branch com o seu nome completo e depois envie-nos o pull request. Se você apenas clonar o repositório não vai conseguir fazer push e depois vai ser mais complicado fazer o pull request.
Nossa análise
Organização do código, legibilidade e comentários, uso de padrões.
Histórico de commits.

**Dúvidas?**
Quaisquer dúvidas que você venha a ter, abra você mesmo uma nova issue, ou mande um e-mail.
Boa sorte!
