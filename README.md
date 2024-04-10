
## Teste

O teste foi desenvolvido utilizando uma estrutura diferente da estrutura padão do Laravel

O projeto foi dividido em modulos com as seguintes camadas

```
- Validation
- Handler
- DTO
- Service
- Repository
- Entity
- Presenter
```


Para testar o projeto é necessario ter o Docker instalado.

Em um terminal rode os seguintes comandos:

* Iniciar os containers `docker compose up -d`
* Instalar dependencias: `docker exec app_expense composer install` 

* Copiar arquivo de configuração: `docker exec app_expense cp .env.example .env`
* Rodar as migrations: `docker exec app_expense php artisan migrate --seed`
* O projeto irá rodar na porta `8080`


Para rodar os teste: `docker exec app_expense ./vendor/bin/phpunit`

Para testar a API basta utilizar o postman e importar o arquivo: `Collection.postman_collection.json` 
que está na raiz do projeto
