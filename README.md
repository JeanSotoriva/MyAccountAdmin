### Descrição da prova

* Foi criada uma Api com seguindo padrões REST com várias regras de validação.
* Foi criado uma Aplicação Web como área de administração de contas, usuarios e movimentações.

### As tecnologias utilizadas foram:

- Docker
- Php/Laravel
- Vuejs ( vuex , Axios)
- Foi criado Migrations, Seeders, Repositories e Services no backend.


### Subir a aplicacao:

* O projeto é dividido em backend e frontend, cada um tem seus docker-compose.yml
* 1 - entrar com terminal em /api e executar `docker-compose build`  e depois `docker-compose up`
* 2 - entrar com terminal em /webApp e executar `docker-compose build`  e depois `docker-compose up`

* Acessar `https://localhost/8080` para acessar o frontend.
* Acessar `https://localhost/8988/api` no google para testar se esta "ok" a api.
* Acessar o container da api em outro terminal dentro de /api executando `docker-compose exec -it -u root app sh`
* Executar os comandos da migration :  `php artisan migrate:migration`
