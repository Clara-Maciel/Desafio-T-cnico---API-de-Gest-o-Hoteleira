# Hotel API

API para gerenciamento de quartos e reservas hoteleiras, desenvolvida como desafio técnico para vaga de estágio.

## Tecnologias

- PHP 8.3 + Laravel 11
- MySQL 8.0

## Como rodar

1. Instale as dependências
```bash
composer install
```

2. Configure o `.env` com suas credenciais do banco e rode as migrations
```bash
php artisan migrate
```

3. Importe os dados dos XMLs
```bash
php artisan import:xml
```

4. Suba o servidor
```bash
php artisan serve
```

## Endpoints

| Método | Rota | Descrição |
|--------|------|-----------|
| GET | /api/rooms | Lista todos os quartos |
| GET | /api/rooms/{id} | Retorna um quarto |
| POST | /api/rooms | Cria um quarto |
| PUT | /api/rooms/{id} | Atualiza um quarto |
| DELETE | /api/rooms/{id} | Remove um quarto |
| GET | /api/reservations | Lista todas as reservas |
| POST | /api/reservations | Cria uma reserva |





