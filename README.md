#  passos para rodar o projeto:

clonar o projeto:
```sh
    git clone https://github.com/D0urada/php-8-base.git
```

copiar .env:
```sh
    cp .env.example .env
```

buildar docker:
```sh
    docker-compose up -d
```

para acessar projeto:
```sh
    http://localhost:8080
```


#  comandos para acessar o banco de dados:

para acessar o banco de dados:
```sh
    http://localhost:8088
```

login no pgadmin:
```sh
	PGADMIN_DEFAULT_EMAIL: user@localhost.com
	PGADMIN_DEFAULT_PASSWORD: password
```

registrar o servidor:
```sh
    server_name=phpdockerdb
	host=postgres
	username=root
	password=secret
```

#  comandos extras:

buildar docker em subir ambiente de dev
```sh
    docker compose -f docker-compose-dev.yaml up --build -d
```

para criar a vendor no projeto e não apenas no container, entrar no container do php rodar os seguintes comandos:
```sh
    docker exec -it soft-expert-teste-php-fpm-1 /bin/sh 
```
```sh
    composer install --ignore-platform-reqs
```
```sh
    composer dump-autoload
```

para entrar no container do node e rodar comandos do npm:
```sh
    docker exec -it soft-expert-teste-node-1 /bin/sh 
```

comandos dos arquivos css:
```sh
    npm run css-watch
```
```sh
    npm run css-build
```

comandos dos arquivos js:
```sh
    npm run js-watch
```
```sh
    npm run js-build
```