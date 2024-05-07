### bibliotecas utilizadas:
- Composer, para dar autoload nos namespaces.
- Phinx, para lidar com migrations e seeds.
- Tailwind e Jquery no front end (e algumas bibliotecas como uglify para build).
- PhpUnit para os testes.
- Projeto feito em Docker.

#  passos para rodar o projeto:
clonar o projeto:
```sh
    git clone https://github.com/D0urada/soft-expert-teste.git
```

copiar .env:
```sh
    cp .env.example .env
```

buildar docker:
```sh
    docker-compose up -d
```

rodar os comandos para criar e popular o banco:
```sh
    docker exec -it soft-expert-teste-php-fpm-1 /bin/sh 
```
```sh
    vendor/bin/phinx migrate
```
```sh
    vendor/bin/phinx seed:run
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

buildar docker em subir ambiente de dev, com container do node
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
    docker exec -it soft-expert-teste-node-1 bash
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