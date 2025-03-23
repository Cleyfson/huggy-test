# huggy-test

## Projeto Laravel + Vue

Este projeto utiliza Laravel no backend e Vue.js no frontend. A seguir, estão as instruções para rodar o projeto manualmente, mas recomendo o uso do script `setup.sh` para automação do processo.

## Pré-requisitos

Antes de rodar o projeto, é necessário ter as seguintes ferramentas instaladas:

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)

### Observações

- O script `setup.sh` automatiza o processo de configuração e execução dos containers, tornando o processo mais simples e rápido. 
- **Certifique-se de preencher as variáveis de ambiente no arquivo `.env`** com as informações corretas, especialmente para integração com a **Huggy** e **Twilio**.

## Passo a Passo

### 1. Clonando o Repositório
Primeiro, clone o repositório para sua máquina local:

```bash
  git https://github.com/Cleyfson/huggy-test
  cd huggy-test
```

## 2. Execute o arquivo setup.sh que está no root do projeto

```bash
./setup.sh
```

Caso você encontre problemas de permissão ao rodar o `setup.sh`, é possível que o script não tenha permissão de execução. Para corrigir isso, execute o comando abaixo antes de rodá-lo:

```bash
chmod +x setup.sh
```

## Passo a Passo manual

### 1. Clonando o Repositório

Primeiro, clone o repositório para sua máquina local:

```bash
git clone https://github.com/Cleyfson/huggy-test
cd huggy-test
```

## 2. Configuração do Ambiente

### 2.1 Configuração da API (Backend)

Navegue até o diretório `api`:

```bash
cd api
cp .env.example .env
```

### 2.2 Configuração do Frontend
Navegue até o diretório `frontend`:

```bash
cd fronted
cp .env.example .env
```

## 3. Subindo os Containers

Execute o comando abaixo para iniciar os containers. O Docker irá construir as imagens e subir os containers em segundo plano:

```bash
docker-compose up --build -d
```

Isso vai iniciar os seguintes containers:

Backend (Laravel)
Frontend (Vue.js)
Banco de Dados (MySQL)
Mailpit (para testes de e-mails)

## 4. Executando as Migrações

Após iniciar os containers, execute as migrações do Laravel no banco de dados com o comando abaixo:

```bash
docker exec laravel_app php artisan migrate
```

## 5. Acessando a Aplicação

Após subir os containers e executar as migrações, você pode acessar a aplicação nos seguintes endereços:

Backend (Laravel): http://localhost:8000

Frontend (Vue.js): http://localhost:5173

## 6. Collection do postman para testes da api

[<img src="https://run.pstmn.io/button.svg" alt="Run In Postman" style="width: 128px; height: 32px;">](https://app.getpostman.com/run-collection/26530639-4f982cc8-8386-4b30-8021-9bf10d400685?action=collection%2Ffork&source=rip_markdown&collection-url=entityId%3D26530639-4f982cc8-8386-4b30-8021-9bf10d400685%26entityType%3Dcollection%26workspaceId%3Dd7914fe0-6a0e-4c18-a48b-86acca162e67#?env%5Btest%5D=W3sia2V5IjoidG9rZW4tY29yZS1jbGllbnQiLCJ2YWx1ZSI6IiIsImVuYWJsZWQiOnRydWUsInR5cGUiOiJkZWZhdWx0Iiwic2Vzc2lvblZhbHVlIjoiIiwiY29tcGxldGVTZXNzaW9uVmFsdWUiOiIiLCJzZXNzaW9uSW5kZXgiOjB9XQ==)