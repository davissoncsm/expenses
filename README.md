
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
* Instalar dependencias: `composer install` 
* Instalar dependencias: `composer install` 
* Copiar arquivo de configuração: `cp .env.example .env`
* O projeto irá rodar na porta `8080`


Para rodar os teste: `docker exec <container id> ./vendor/bin/phpunit`

Para testar a API basta utilizar o postman e importar o arquivo: `Collection.postman_collection.json` 
que está na raiz do projeto
