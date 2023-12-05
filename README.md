# Teste Prático para vaga de Desenvolvedor Full Stack na PuzlPlace - Desenvolvimento de uma API e SPA

# Sobre o Projeto
Este projeto consiste em uma aplicação desenvolvida em Node.js para o backend e Vue.js para o frontend, permitindo operações CRUD de uma estante de livros, geração de relatórios e interações em uma SPA(Single Page Application)

### Requisitos
- Node.js(BackEnd)
- Vuejs(Front-end)
- npm (Node Package Manager)
- MongoDB (Banco de Dados)

### Banco de dados
Este projeto utiliza um banco de dados MongoDB para armazenar os dados. A conexão com o banco de dados é feita através do arquivo `conn.js` localizado no diretório `Guilherme_valli_parreira/Backend/db/conn.js`.

### Conexão com o Banco de Dados
O arquivo `conn.js` foi configurado para se conectar ao banco de dados MongoDB sem a necessidade de fornecer credenciais de autenticação. Ao executar o código, a conexão com o banco de dados será estabelecida automaticamente.

# Backend

### Clone o Repositório GitHub
1. Clonando o Repositório GitHub no Terminal
   -git clone https://github.com/guiparreira98/Guilherme_valli_parreira.git/Backend
   

2.Navegue até o diretório no terminal
   -cd https://github.com/guiparreira98/Guilherme_valli_parreira.git/Backend
   

3.Instale as dependências do projeto
   -npm install
   

### Instalação Nodejs(caso não tenha instalado)

1.Acesse o site oficial do Node.js:
  -Visite nodejs.org no seu navegador.
  
2.Baixe o instalador:
  -No site, você verá um botão para baixar o Node.js. Ele oferecerá a versão LTS (Long Term Support) recomendada para a maioria dos usuários. Clique no botão para baixar o instalador.

3.Execute o instalador:
  -Após baixar o instalador, execute-o e siga as instruções do assistente de instalação. O instalador geralmente oferece opções padrão que funcionam bem para a maioria dos casos.

4.Verifique a instalação:
  -Após a instalação ser concluída, abra um terminal ou prompt de comando e execute os seguintes comandos para verificar se o Node.js
  -node -v

### Instalação Node.js no Sistema Linux(caso não tenha instalado)
1. Abra o terminal no seu sistema Linux.

2.Utilize um dos seguintes métodos para instalar o Node.js
  -sudo apt update
  - sudo apt install nodejs npm

3.Verificar se o Node.js foi instalado corretamente
   -node -v
   
### Instalação Node.js no Mac(caso não tenha instalado)

1.Instale o Homebrew
   -No terminal digite: /bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
   
2.Instale o Node.js utilizando o homebrew
   -Apos Instalar o Homebrew digite: brew install node
   
3.Verificar Instalação
   -node -v
   -npm -v

### Instalar o Express

1.Instalação
   -npm install express

### Iniciar Aplicação

1.Executando o aplicativo no Terminal
    
   -node index.js

2.Mensagem Terminal
   - Se aparecer no Terminal as seguintes mensagens: "Servidor Online" e "Conectado ao banco" significa que a Inicialização foi feita Corretamente

# FrontEnd

### Instalando o Vue.js Globalmente
   -npm install -g @vue/cli

### Inicializando o FrontEnd
   1.Acessar o Frontend
      -cd https://github.com/guiparreira98/Guilherme_valli_parreira.git/FrontEnd/frontend
      
   2.Inicialize o servidor de desenvolvimento
      -npm run serve
      -O frontend estará disponível em: http://localhost:8080
