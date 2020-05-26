<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Tecnologias utilizadas

Neste projeto foram utilizadas as seguintes linguagens, frameworks e bibliotecas:

- [Laravel](https://laravel.com/) - Versão 7.0
- [MariaDB](https://mariadb.org/) - Versão 10.3
- [Laravel Permission](https://docs.spatie.be/laravel-permission/v3/introduction/)
- [Bootstrap](https://getbootstrap.com/) - Versão 4.4.1
- [jQuery](https://jquery.com/) - Versão 3.4.1
- [jQuery Mask Plugin](https://igorescobar.github.io/jQuery-Mask-Plugin/)
- [SweetAlert2](https://sweetalert2.github.io/)
- [Vali Admin](https://pratikborsadiya.in/vali-admin)

# Funcionamento

Confira a [wiki](https://github.com/Danie1Net0/DashboardLaravel/wiki) para mais detalhes sobre o funcionamento do projeto.

## Executando o projeto localmente

Para executar o projeto localmente, as seguintes dependências devem estar instaladas:

- PHP 7.4
- MariaDB ou MySQL
- Composer

A partir de uma instância do terminal aberta, execute os seguintes passos:

1. Faça o download ou clone o projeto:
```
$ git clone https://github.com/Danie1Net0/DashboardLaravel.git
```

2. Entre no diretório do projeto clonado:
```
$ cd DashboardLaravel
```

3. Instale as dependências do Laravel via Composer:
```
$ composer install
```

4. Crie o arquivo **.env**: 
```
$ cp .env.example .env
```

5. Gere a chave da aplicação:
```
$ php artisan key:generate
```

6. Crie um banco de dados e altere o seguinte trecho do arquivo **.env** com os parâmetros correspondentes: 
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE="nome do banco criado"
DB_USERNAME="nome de usuario do banco"
DB_PASSWORD="senha do banco"
```

7. Ainda no arquivo *.env*, altere o seguinte trecho com os parâmetros do seu servidor de e-mail (utilizado para enviar as notificações):
   
> Os parâmetros **MAIL_MAILER**, **MAIL_HOST** e **MAIL_PORT** podem ser substituídos por quaisquer outros, o SMTP do GMail pela porta 587 é apenas um exemplo.                                                                                                                                            
```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME="seu endereço de e-mail"
MAIL_PASSWORD="senha do seu e-mail"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="endereço de e-mail que aparecerá nas mensagens"
MAIL_FROM_NAME="Nome do rementente que aparecerá nas mensagens"
```

8. Execute as migrações e "semeie" o banco de dados: 
```
$ php artisan migrate --seed
```

9. Crie o link de armazenamento de arquivos públicos: 
```
$ php artisan storage:link
```

10. Inicie a aplicação:
```
$ php artisan serve
```

> Por padrão a porta utilizada é a 8000. Se esta já estiver em uso por outra aplicação, é possível alterar a porta padrão com o argumento **--port**:
```
php artisan serve --port=3000
```

## Executando o projeto via Docker:

A partir de uma instância do terminal aberta, execute os seguintes passos:

1. Faça o download ou clone o projeto:
```
$ git clone https://github.com/Danie1Net0/DashboardLaravel.git
```

2. Entre no diretório do projeto clonado:
```
$ cd DashboardLaravel
```

3. Crie o arquivo **.env**: 
```
$ cp .env.example .env
```

4. Altere as seguintes informações sobre o banco de dados no arquivo **.env** **(NÃO É NECESSÁRIO CRIAR O BANCO DE DADOS)**:
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE="um nome para o banco de dados"
DB_USERNAME="um nome de usuário para o banco de dados"
DB_PASSWORD="um senha para o banco de dados"
```

5. Execute o arquivo **configure-docker.sh** (esse arquivo fará todo o processo de criação dos contâiners e
 implantação do projeto):
```
$ ./configure-docker.sh
```

6. Crie o link de armazenamento de arquivos públicos: 
```
$ docker exec -it laravel_app php artisan storage:link
```

> Será necessário executar os comandos acima (passos 5 e 6) como super-usuário, caso o Docker não pertença ao grupo 
> de administradores do sistema.


> É importante conferir as permissões de escrita do diretório para que o processo ocorra corretamente.

> A aplicação será executada, por padrão, na porta 8000, mas isso pode ser falcimente alterado através do seguinte 
> trecho do arquivo **.env**:
```
DOCKER_HTTP_PORT=8000
```

## Informação importante

Um administrador padrão é gerado a partir do seeder **database/seeds/AdministratorSeeder**:
> **E-mail:** admin@admin.com <br>
> **Senha:** password
