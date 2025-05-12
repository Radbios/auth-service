<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

# Auth Service - Sistema de E-commerce com Microsserviços

Este microsserviço é responsável pela autenticação de usuários, utilizando **JWT (JSON Web Tokens)** como mecanismo de segurança. Ele provê endpoints de login, logout e recuperação de dados do usuário autenticado. Toda a autenticação do sistema passa por este serviço, sendo fundamental para proteger os demais microsserviços.

## Funcionalidades

* Login de usuários com email e senha
* Geração de token JWT
* Retorno do usuário autenticado a partir do token
* Logout (invalidação do token atual)

## Integração com o sistema

Este serviço é acessado indiretamente pelos demais microsserviços por meio do token gerado, que deve ser incluído no header `Authorization: Bearer <token>`. Ele também pode ser acessado diretamente via API Gateway para operações de autenticação.

## Rotas disponíveis

### POST `/api/service/auth/login`

Autentica o usuário e gera um token JWT.

**Corpo da requisição:**

```json
{
  "email": "usuario@example.com",
  "password": "senha123"
}
```

**Resposta de sucesso:**

```json
{
  "access_token": "eyJ0eXAiOiJKV1QiLCJh...",
  "token_type": "bearer",
  "expires_in": 3600,
  "user": {
    "id": 1,
    "name": "Usuário Exemplo",
    "email": "usuario@example.com"
  }
}
```

### GET `/api/service/auth/me`

Retorna os dados do usuário autenticado com base no token JWT.

**Cabeçalho:**

```
Authorization: Bearer <token>
```

### POST `/api/service/auth/logout`

Invalida o token atual e encerra a sessão.

**Resposta de sucesso:**

```json
{
  "message": "Deslogado com sucesso!"
}
```

## Estrutura e arquivos principais

| Arquivo                   | Descrição                                                              |
| ------------------------- | ---------------------------------------------------------------------- |
| `AuthController.php`      | Controlador com os métodos de login, logout e identificação de usuário |
| `AuthenticateRequest.php` | Valida os dados do formulário de login                                 |
| `config/auth.php`         | Define os guards de autenticação e o uso do driver JWT                 |
| `bootstrap/app.php`       | Registra middleware personalizado e configura as rotas do serviço      |

## Requisitos

* Laravel 11
* PHP 8.2+
* Biblioteca `tymon/jwt-auth` para autenticação JWT
* Middleware de autenticação configurado com o guard `api`

## Observações

Este serviço é fundamental para garantir a segurança de todos os microsserviços da aplicação. Apenas usuários autenticados com token válido poderão acessar as funcionalidades protegidas, como gerenciamento de carrinho, pedidos e pagamentos.

---
