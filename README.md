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

Problemas? Abra uma issue descrevendo o erro e o ambiente (Windows/macOS/Linux, versões de PHP/Node). Boa sorte!
