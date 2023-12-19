
### Passo a passo

Suba os containers do projeto
``` docker-compose up -d ```


Acessar o container
``` docker-compose exec app bash ```


Instalar as dependências do projeto
``` composer install ```


Gerar a key do projeto Laravel
``` php artisan key:generate ```


Endpoint principal da api do projeto
[http://localhost:8988/api]
