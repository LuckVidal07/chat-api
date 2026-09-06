# Chat API

API REST para um sistema de conversas e mensagens, desenvolvida com Laravel.
O projeto tem como objetivo praticar desenvolvimento de APIs, autenticação, autorização, relacionamentos entre entidades e organização de regras de negócio.

## 🚀 Tecnologias

* PHP
* Laravel
* Laravel Sanctum
* MySQL
* Docker
* Laravel Sail

## 📋 Funcionalidades

### Autenticação

* Login de usuários
* Autenticação utilizando Laravel Sanctum
* Identificação do usuário autenticado

### Usuários

* Cadastro e gerenciamento de usuários
* Relacionamento entre usuários e conversas

### Conversas

* Criação de conversas
* Listagem de conversas
* Visualização de uma conversa
* Associação de usuários a conversas
* Identificação do criador da conversa através de `created_by`

### Mensagens

* Criação de mensagens
* Listagem de mensagens de uma conversa
* Atualização de mensagens
* Identificação do remetente
* Autorização para alteração das próprias mensagens

### Autorização

O projeto utiliza **Policies** para controlar o acesso às operações.

Exemplo:

* Apenas usuários pertencentes a uma conversa podem enviar mensagens.
* Apenas o autor de uma mensagem pode alterá-la.
* O criador de uma conversa é identificado através de `created_by`.

## 🏗️ Estrutura

O projeto utiliza uma separação de responsabilidades entre as principais camadas:

```text
app/
├── Http/
│   ├── Controllers/
│   └── Requests/
│
├── Models/
├── Policies/
└── Services/

database/
└── migrations/

routes/
└── api.php
```

### Responsabilidades

**Controllers**
Responsáveis por receber as requisições e coordenar o fluxo da aplicação.

**Form Requests**
Responsáveis pela validação dos dados enviados pelo cliente.

**Policies**
Responsáveis pelas regras de autorização.

**Services**
Responsáveis pelas operações e regras de negócio.

**Models**
Representam as entidades e seus relacionamentos com o banco de dados.

## 🔐 Autenticação

A API utiliza Laravel Sanctum para autenticação baseada em tokens.

Rotas protegidas utilizam:

```text
auth:sanctum
```

O fluxo básico é:

```text
Login
  ↓
Token
  ↓
Authorization: Bearer <token>
  ↓
Rota protegida
  ↓
Usuário autenticado
```

## 🗄️ Banco de dados

Principais entidades:

```text
User
 │
 ├──< Conversation
 │
 └──< Message

Conversation
 │
 ├──< Message
 │
 └──< User
```

Relacionamento entre usuários e conversas:

```text
users
  ↕
conversation_user
  ↕
conversations
```

Uma mensagem pertence a uma conversa e possui um usuário como remetente.

## ⚙️ Como executar

### Requisitos

* Docker
* Docker Compose
* Git

### Clonar o projeto

```bash
git clone <URL_DO_REPOSITORIO>
cd api-chat
```

### Instalar dependências

```bash
composer install
```

### Configurar o ambiente

Copie o arquivo `.env.example`:

```bash
cp .env.example .env
```

Configure as variáveis do banco de dados no `.env`.

Exemplo utilizando Laravel Sail:

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=chat
DB_USERNAME=sail
DB_PASSWORD=password
```

### Gerar a chave da aplicação

```bash
./vendor/bin/sail artisan key:generate
```

### Executar as migrations

```bash
./vendor/bin/sail artisan migrate
```

### Iniciar a aplicação

```bash
./vendor/bin/sail up -d
```

A API estará disponível através do servidor configurado pelo Laravel Sail.

## 📡 Principais endpoints

### Autenticação

```http
POST /api/login
GET  /api/me
```

### Conversas

```http
GET    /api/conversations
POST   /api/conversations
GET    /api/conversations/{conversation}
```

### Mensagens

```http
GET    /api/conversations/{conversation}/messages
POST   /api/conversations/{conversation}/messages
PATCH  /api/messages/{message}
```

As rotas protegidas exigem um token Sanctum:

```http
Authorization: Bearer <token>
```

## 🧪 Testes

Os testes podem ser executados com:

```bash
./vendor/bin/sail artisan test
```

## 📌 Status

🚧 **Em desenvolvimento**

Novas funcionalidades e melhorias de arquitetura serão adicionadas conforme o desenvolvimento do projeto.

## 👨‍💻 Autor

Lucas
