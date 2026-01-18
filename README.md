# Hackathon

Sistema de gerenciamento de hackathon construido com Laravel e React.

## Stack Tecnologica

**Backend**
- PHP 8.4
- Laravel 12
- Filament v5 (painel administrativo)
- Laravel Octane v2

**Frontend**
- React 19
- Livewire v4
- Tailwind CSS v4
- TypeScript

**Autenticacao**
- WorkOS

## Arquitetura

### Modelos de Dominio

| Modelo | Descricao |
|--------|-----------|
| `User` | Usuarios com roles (participant, appraiser, commission, admin) |
| `Team` | Times de participantes com projeto |
| `Evaluation` / `Criteria` | Sistema de avaliacao dos times |
| `Registration` / `Payment` | Fluxo de inscricao de participantes |
| `SponsorLead` / `Post` | Gerenciamento de conteudo |

### Estrutura do Filament

Os resources do Filament seguem um padrao modular em `app/Filament/Resources/{ResourceName}/`:

```
ResourceName/
├── Pages/           # Paginas List, Create, Edit, View
├── Schemas/         # Configuracoes de formularios e infolists
├── Tables/          # Configuracoes de tabelas
└── {Resource}Resource.php
```

### Estrutura do Frontend

```
resources/js/
├── pages/           # Componentes de pagina Inertia
├── components/      # Componentes React reutilizaveis
│   └── ui/          # Componentes base (shadcn/ui + Radix)
├── layouts/         # Layouts da aplicacao
└── hooks/           # React hooks customizados
```

## Requisitos

- PHP 8.4+ com extensoes padrao do Laravel (PDO, mbstring, OpenSSL, etc.)
- Composer v2+
- Node.js 24+ e npm
- SQLite (padrao) ou MySQL/PostgreSQL

## Configuracao Rapida

### Setup Automatizado

```bash
# Setup completo: instala dependencias, migra banco, builda assets
composer run setup

# Windows (ignora checagem do pcntl)
composer run setup:windows
```

### Setup Manual

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite  # se usar SQLite
php artisan migrate --force
npm install
npm run build
```

## Desenvolvimento

### Servidor de Desenvolvimento

```bash
# Executa servidor PHP, queue, logs e Vite em paralelo
composer run dev

# Windows (sem pail)
composer run dev:windows

# Com SSR
composer run dev:ssr
```

### Comandos Individuais

```bash
# Apenas frontend (Vite)
npm run dev

# Apenas backend
php artisan serve
```

## Testes e Qualidade de Codigo

```bash
# Testes PHP (Pest)
php artisan test                          # Todos os testes
php artisan test tests/Feature/File.php   # Arquivo especifico
php artisan test --filter=testName        # Filtrar por nome

# Formatacao PHP
vendor/bin/pint --dirty

# Frontend
npm run types    # Verificar tipos TypeScript
npm run lint     # ESLint
npm run format   # Prettier
```

## Build para Producao

```bash
npm run build
php artisan migrate --force
```

Com SSR:

```bash
npm run build:ssr
```

## Docker

O repositorio inclui `Dockerfile` e `docker-compose.yml` usando FrankenPHP.

```bash
# Build e iniciar
docker compose up --build -d

# Logs
docker compose logs -f app

# Migracoes
docker compose exec app php artisan migrate --force

# Shell
docker compose exec app sh

# Parar
docker compose down
```

### Notas sobre Docker

- A imagem usa `dunglas/frankenphp` com Octane
- Assets sao buildados durante a construcao da imagem
- Volume `lvdata` montado em `storage/`
- Alteracoes no codigo requerem rebuild (`docker compose up --build`)
- SQLite: crie o arquivo antes de migrar: `touch database/database.sqlite`

## Banco de Dados

Por padrao usa SQLite (`DB_CONNECTION=sqlite`). Para MySQL ou PostgreSQL, ajuste as variaveis `DB_*` no `.env`.

## Convencoes do Projeto

- Forms e tables do Filament sao extraidos para classes separadas em `Schemas/` e `Tables/`
- Icones do Filament usam o enum `Heroicon` (ex: `Heroicon::OutlinedUserGroup`)
- Controle de acesso via Gates (`is_admin`, `is_commission`)
- Testes usam sintaxe Pest com `test()` ou `it()`
- Roles de usuario definidos no enum `UserRoles`
