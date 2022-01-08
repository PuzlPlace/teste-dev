<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

####Desenvolvido com Sql Lite 3
Para facilitar a montagem do teste.
Foi criado apenas arquivos para o Modelo Library (Biblioteca)
Não foram considerados Validators, Resources e Abstrações

##Montando o Ambiente
- Gerar Pacote SqlLite
  - `$ sudo-apt get update`
  - `$ sudo apt-get install php-sqlite3`
- Iniciar Migrações/Testes
  - '$ php artisan migrate:fresh --seed'
  - '$ php artisan test'