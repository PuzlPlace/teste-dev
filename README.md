# Test

## Introdução

Projeto de CRUD em Laravel + Vue.js 3

## Stack utilizada

**Back-end:** Laravel
**Front-end:** Vue.js

## Como Usar

Para executar o projeto, precisamos instalar e configurar o docker engine, e após, o docker-compose. Seguindo os passos disponíveis em https://docs.docker.com/engine/install/ubuntu/ e depois em https://docs.docker.com/compose/install/

Um passo necessário após está instalação uma configuração rootless: https://docs.docker.com/engine/install/linux-postinstall/

Após o docker estar rodando na sua máquina, vamos subir o container da aplicação.

```sh
#cd ./test
#cp ./.env.example ./.env && make up
```

aguardar até 5-10min setar todo o env docker

depois de pronto em uma nova aba do terminal, vamos rodar as migrations e seeders de dados

```sh
#make sh
#php artisan migrate --seed
#php artisan config:cache
```

Para facilitar, vamos adicionar um dns interno para utilizar no insomnia e no browser.

#sudo nano /etc/hosts
adicione as duas linhas
127.0.0.1 dev.test.lh
