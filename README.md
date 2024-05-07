### bibliotecas utilizadas:
- Composer, para dar autoload nos namespaces.
- Phinx, para lidar com migrations e seeds.
- Tailwind e Jquery no front end (e algumas bibliotecas como uglify para build).
- PhpUnit para os testes, **apesar de não ter tido tempo de fazer a classe de teste**.
- Projeto feito em Docker.

#  passos para rodar o projeto:
clonar o projeto:
```sh
    git clone https://github.com/D0urada/soft-expert-teste.git
```

dentro da pasta do projeto, copiar .env:
```sh
    cp .env.example .env
```

dentro da pasta do projeto, buildar docker:
```sh
    docker-compose -f docker-compose.yaml up --build -d
```

dentro da pasta do projeto, **caso a build não gere a vendor, ele dara um error de autoload**, entre no container:
```sh
    docker exec -it soft-expert-teste-php-fpm-1 /bin/sh 
```

**e rode o composer**:
```sh
    composer install --ignore-platform-reqs
```

```sh
    composer dump-autoload --optimize
```


**dentro do container**, rodar os comandos para criar e popular o banco:
```sh
    vendor/bin/phinx migrate
```
```sh
    vendor/bin/phinx seed:run
```

our fazer o restore do banco pelo arquivo enviado por email.

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

para criar a vendor no projeto e não apenas no container, entrar no container do php e rode os seguintes comandos:
```sh
    docker exec -it soft-expert-teste-php-fpm-1 /bin/sh 
```
```sh
    composer install --ignore-platform-reqs
```
```sh
    composer dump-autoload
```

para entrar no container do node e rodar os scrips que criei do npm:
```sh
    docker exec -it soft-expert-teste-node-1 bash
```

instala o node para criar a node_modules:
```sh
    npm install --force
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