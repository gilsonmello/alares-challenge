# Desafio Alares

## Backend Laravel

### Requisitos
- Docker
- Docker compose
- Nodejs 16

### Passo a passo
- Acesse a pasta backend e rode os seguintes comandos no terminal
```bash
cd backend
docker compose up -d
docker compose exec php composer install
cp .env.example .env
docker compose exec php php artisan key:generate
docker compose exec php php artisan migrate:fresh
docker compose exec php php artisan db:seed
npm install
npm run dev
```
- Acesse o google chrome e digite http://localhost:8080/admin/login para acessar a parte administrativa
email: test@example.com
senha: password
![image](https://github.com/gilsonmello/alares-challenge/assets/13243336/d401948f-dc19-422d-a0cf-7c4eabeb0f41)

### Extras
- Caso precise verificar as tabelas do banco de dados, o PHPMyadmin encontra-se configurado na porta 5050(http://localhost5050)
![image](https://github.com/gilsonmello/alares-challenge/assets/13243336/bf4c79a3-45dc-4be0-b38c-53e8886ac5ff)

## Frontend React|Next.js

### Requisitos
- Node 16

### Passo a passo
- Acesse a pasta frontend e rode os seguintes comandos no terminal
```bash
cd frontend
npm install
npm run dev
```
- Acesse o google chrome e digite http://localhost:3000 para acessar os combos de internet
![image](https://github.com/gilsonmello/alares-challenge/assets/13243336/8ba72083-eb89-4a75-abe3-d8bc55aba1cc)
![image](https://github.com/gilsonmello/alares-challenge/assets/13243336/f0fa8d8f-5840-4bd9-ba6c-200ee0115ee0)