# hackathon

Este repositório é um esqueleto Laravel + React (Inertia + Vite) usado no projeto do hackathon.

**Resumo**: aplicação Laravel (PHP 8.2+) com frontend React via Vite/Inertia. O projeto já inclui scripts para instalação, desenvolvimento, SSR e build de produção.

**Requisitos**
- PHP 8.2 ou superior com extensões padrão do Laravel (PDO, mbstring, OpenSSL, etc.).
- Composer (v2+)
- Node.js (recomenda-se v18+) e npm
- Para desenvolvimento local simples: SQLite (já configurado por padrão no `.env.example`).

**Configuração rápida (Windows / PowerShell)**

1. Abrir PowerShell na raiz do projeto.

2. Instalar dependências PHP e JS e preparar o ambiente (script conveniente):

```powershell
# executa composer install, copia .env, gera chave, executa migrações, instala npm e build dos assets
composer run setup
```

> Observação (Windows): este repositório também inclui dois scripts específicos para Windows no `composer.json`.
> Os nomes dos scripts contêm `"windowns"` conforme definido no arquivo (mesmo com o spelling). Use-os se estiver enfrentando problemas de plataforma/permssões.

```powershell
# Script para Windows que ignora a checagem da extensão `pcntl` durante a instalação (quando aplicável)
composer run setup:windowns
```

3. (Opcional) Se preferir fazer passo-a-passo manualmente:

```powershell
composer install
Copy-Item -Path .env.example -Destination .env -Force
php artisan key:generate
# Criar arquivo sqlite (caso use sqlite como em .env.example)
New-Item -Path database\database.sqlite -ItemType File -Force
php artisan migrate --force
npm install
npm run build
```

**Executando em desenvolvimento**

O `composer.json` já traz um script `dev` que executa em paralelo o servidor PHP, listeners de fila, logs e o Vite em modo dev. Use este script para uma experiência completa de desenvolvimento:

```powershell
composer run dev
```

> Observação (Windows): existe uma variante orientada ao Windows que evita o uso do `php artisan pail` no fluxo padrão. Rode a versão Windows com:

```powershell
composer run dev:windowns
```

Se preferir rodar apenas o frontend (Vite):

```powershell
npm run dev
```

Para rodar o backend com o servidor embutido do PHP isolado (útil para debug rápido):

```powershell
php artisan serve
```

**SSR (Server Side Rendering)**

Este projeto inclui suporte a SSR. Para desenvolvimento com SSR use:

```powershell
composer run dev:ssr
```

**Build para produção**

Gerar os assets frontend e preparar para deploy:

```powershell
npm run build
php artisan migrate --force
```

Se quiser executar todo o processo automatizado (scripts definidos no `composer.json`):

```powershell
composer run setup
```

**Testes e ferramentas**

- Executar testes PHP (Pest / PHPUnit):

```powershell
composer run test
```

- Verificar tipos e compilação TypeScript:

```powershell
npm run types
```

- Lint / format frontend:

```powershell
npm run lint
npm run format
```

**Banco de dados**

Por padrão o `.env.example` usa `DB_CONNECTION=sqlite`. Para outros bancos (MySQL, Postgres) ajuste as variáveis de ambiente em `.env` e atualize `DB_*` conforme necessário.

**Observações e dicas**
- Se usar Windows e encontrar problemas com permissões ao gravar em `storage/` ou `bootstrap/cache`, ajuste permissões ou execute comandos com privilégios adequados.
- Se for usar `laravel/octane` (presente nas dependências), recomenda-se checar a documentação oficial para executar com Swoole ou RoadRunner em produção.
- Para deploy, configure um servidor web (Nginx/Apache) apontando para `public/` e rode as migrações e build de assets antes de subir.

**Rodando com Docker**

O repositório inclui um `Dockerfile` e um `docker-compose.yml` para construir e executar a aplicação em container. A configuração atual:

- O `Dockerfile` usa a imagem `dunglas/frankenphp` (PHP + servidor) e instala `node`/`npm`, instala dependências PHP e gera os assets via `npm run build`.
- O `docker-compose.yml` define um serviço `app` que expõe a porta `8000` e usa `php artisan octane:start` como comando principal; o `.env` do projeto é carregado via `env_file`.

Comandos básicos (na raiz do projeto, PowerShell):

```powershell
# Buildar a imagem e subir o container (modo detached)
docker compose up --build -d

# Ver logs do serviço
docker compose logs -f app

# Executar migrações dentro do container
docker compose exec app php artisan migrate --force

# Gerar a chave da aplicação (se ainda não existir)
docker compose exec app php artisan key:generate

# Abrir um shell no container (alpine sh)
docker compose exec app sh

# Parar e remover containers
docker compose down
```

Observações sobre banco de dados e arquivos:

- O `.env.example` usa SQLite por padrão (`DB_CONNECTION=sqlite`). Se mantiver o SQLite, crie o arquivo antes de migrar:

```powershell
# criar o arquivo sqlite localmente e rodar migrações dentro do container
New-Item -Path database\database.sqlite -ItemType File -Force
docker compose exec app php artisan migrate --force
```

- O `docker-compose.yml` atual monta um volume `lvdata` para `storage/` (`volumes: - lvdata:/app/storage`), mas o código-fonte não é montado como volume, então alterações no código exigirão rebuild da imagem (`docker compose up --build`).

Limitações / dicas:

- O `Dockerfile` executa `npm ci --omit=dev` e `npm run build` durante a construção da imagem — isso produz assets estáticos para produção. Se quiser usar o modo de desenvolvimento do Vite (`npm run dev`) para hot-reload, será necessário ajustar o `Dockerfile`/`docker-compose.yml` ou rodar o frontend localmente fora do container.
- O `docker-compose.yml` configura `php artisan octane:start` no serviço; isso inicia a aplicação via Octane/FrankenPHP. Se preferir usar o servidor embutido do PHP para debugging, comente/ajuste o comando no `docker-compose.yml` para `php artisan serve` (há uma configuração comentada como exemplo no arquivo).
