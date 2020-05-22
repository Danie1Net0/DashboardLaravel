#!/bin/bash

echo "Criando os containers..."
docker-compose up -d

echo "Instalando as dependências..."
docker exec -it laravel_app composer install

echo "Gerando a chave da aplicação..."
docker exec -it laravel_app php artisan key:generate

echo "Executando as migrações..."
docker exec -it laravel_app php artisan migrate

echo "Semeando o banco de dados..."
docker exec -it laravel_app php artisan db:seed

echo "Containers:"
docker ps
