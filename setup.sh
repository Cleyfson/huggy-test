#!/bin/bash

set -e  # Para interromper a execução se houver erro

# Verifica se Docker e Docker Compose estão instalados
if ! command -v docker &> /dev/null || ! command -v docker-compose &> /dev/null; then
    echo "Docker e Docker Compose precisam estar instalados."
    exit 1
fi

# Configuração do ambiente API
echo "Configurando API..."
cd api
if [ ! -f ".env" ]; then
    cp .env.example .env
fi
cd ..

# Configuração do ambiente Frontend
echo "Configurando Frontend..."
cd frontend
if [ ! -f ".env" ]; then
    cp .env.example .env
fi
cd ..

echo "Iniciando os containers..."
docker-compose up --build -d

echo "Executando migrações..."
docker exec laravel_app php artisan migrate

echo "Setup concluído!"
