# Docker - Laravel 12 + Filament 4 + PostgreSQL

Este diretório contém as configurações Docker para executar a aplicação em produção.

## 📋 Requisitos

- Docker 20.10+
- Docker Compose 2.0+ (opcional, para desenvolvimento local)

## 🚀 Build e Deploy

### Build da Imagem

```bash
docker build -t devcontrole:latest .
```

### Executar Container

```bash
docker run -d \
  --name devcontrole \
  -p 80:80 \
  -e DB_HOST=seu-host-postgresql \
  -e DB_PORT=5432 \
  -e DB_DATABASE=devcontrole \
  -e DB_USERNAME=seu-usuario \
  -e DB_PASSWORD=sua-senha \
  -e APP_ENV=production \
  -e APP_DEBUG=false \
  -e APP_URL=https://seu-dominio.com \
  devcontrole:latest
```

### Executar Seeders (Opcional)

Para executar seeders durante o deploy, adicione a variável de ambiente:

```bash
docker run -d \
  --name devcontrole \
  -e RUN_SEEDERS=true \
  # ... outras variáveis
  devcontrole:latest
```

## 🔧 Configurações

### Variáveis de Ambiente Importantes

**Aplicação:**
- `APP_NAME`: Nome da aplicação
- `APP_ENV`: Ambiente (production, staging, etc)
- `APP_DEBUG`: Debug mode (false em produção)
- `APP_URL`: URL da aplicação
- `APP_KEY`: Chave de criptografia (gerada automaticamente se não existir)

**Banco de Dados (PostgreSQL):**
- `DB_CONNECTION=pgsql`
- `DB_HOST`: Host do PostgreSQL
- `DB_PORT`: Porta do PostgreSQL (padrão: 5432)
- `DB_DATABASE`: Nome do banco de dados
- `DB_USERNAME`: Usuário do banco
- `DB_PASSWORD`: Senha do banco

**Cache e Sessão:**
- `CACHE_STORE`: Driver de cache (file, redis, etc)
- `SESSION_DRIVER`: Driver de sessão (file, database, redis, etc)
- `QUEUE_CONNECTION`: Driver de fila (sync, database, redis, etc)

**Seeders:**
- `RUN_SEEDERS`: Se true, executa seeders no deploy (padrão: false)

### Arquivos de Configuração

**docker/config/laravel-php.ini**
- Configurações do OPcache para performance

**docker/config/nginx.conf**
- Configuração principal do Nginx

**docker/config/site-nginx.conf**
- Configuração do virtual host para a aplicação Laravel

## 📦 Estrutura

```
docker/
├── config/
│   ├── laravel-php.ini    # Configurações PHP
│   ├── nginx.conf          # Configuração Nginx principal
│   └── site-nginx.conf     # Virtual host Laravel
└── README.md               # Este arquivo
```

## 🏗️ Build Stages

O Dockerfile executa as seguintes etapas:

1. **Base Image**: PHP 8.4 FPM Alpine
2. **System Dependencies**: Instala pacotes necessários
3. **PHP Extensions**: Instala extensões PHP (zip, gd, pdo_pgsql, opcache, intl, bcmath)
4. **Application Files**: Copia arquivos da aplicação
5. **Configuration**: Copia configurações personalizadas
6. **Composer**: Instala Composer
7. **Permissions**: Ajusta permissões

## 🔄 Entrypoint

O `docker-entrypoint.sh` executa:

1. ✅ Instalação de dependências do Composer
2. ✅ Geração da APP_KEY (se necessário)
3. ✅ Build dos assets do frontend (Vite)
4. ✅ Aguarda PostgreSQL estar disponível
5. ✅ Executa migrations
6. ✅ Executa seeders (se `RUN_SEEDERS=true`)
7. ✅ Otimiza a aplicação (cache de config, routes, views, events)
8. ✅ Otimiza Filament
9. ✅ Cria link simbólico do storage
10. ✅ Ajusta permissões
11. ✅ Inicia PHP-FPM e Nginx

## 🔍 Troubleshooting

### Container não inicia

Verifique os logs:
```bash
docker logs devcontrole
```

### Erro "vite: not found" durante o build

**Causa**: Tentativa de executar `npm run build` sem instalar as devDependencies.

**Solução**: O entrypoint foi corrigido para:
1. Instalar todas as dependências (incluindo dev)
2. Fazer o build dos assets
3. Remover dependências de dev após o build

```bash
npm ci                      # Instala todas as dependências
npm run build              # Build dos assets
npm prune --production     # Remove devDependencies
```

### Erro de conexão com PostgreSQL

1. Verifique se o PostgreSQL está acessível
2. Confirme as credenciais nas variáveis de ambiente
3. Verifique se o container pode acessar o host do banco

```bash
docker exec devcontrole pg_isready -h seu-host -p 5432 -U seu-usuario
```

### Permissões de arquivo

Execute dentro do container:
```bash
docker exec devcontrole chmod -R 775 storage bootstrap/cache
docker exec devcontrole chown -R www-data:www-data storage bootstrap/cache
```

### Limpar cache manualmente

```bash
docker exec devcontrole php artisan cache:clear
docker exec devcontrole php artisan config:clear
docker exec devcontrole php artisan route:clear
docker exec devcontrole php artisan view:clear
```

## 🔒 Segurança

Em produção, certifique-se de:

- [ ] `APP_DEBUG=false`
- [ ] `APP_ENV=production`
- [ ] Usar HTTPS (configure um proxy reverso como Nginx ou Traefik)
- [ ] Configurar firewall adequado
- [ ] Usar senhas fortes para o banco de dados
- [ ] Manter a `APP_KEY` segura e não commitá-la no Git

## 📊 Performance

Para melhor performance:

1. Use Redis para cache e sessões
2. Configure filas com Redis ou SQS
3. Use CDN para assets estáticos
4. Configure PostgreSQL com parâmetros otimizados
5. Considere usar um load balancer para múltiplas instâncias

## 🐳 Docker Compose

### Desenvolvimento (Laravel Sail)

Para desenvolvimento local, use o Laravel Sail:

```bash
./vendor/bin/sail up -d
```

O arquivo `compose.yaml` já está configurado com PostgreSQL 18.

### Produção (docker-compose.prod.yml)

Para produção com Docker Compose:

**1. Configure as variáveis de ambiente:**

Crie um arquivo `.env.production` na raiz do projeto com suas variáveis (veja `docker/ENVIRONMENT_VARIABLES.md`).

**2. Build e execute:**

```bash
# Build das imagens
docker-compose -f docker-compose.prod.yml build

# Executar em background
docker-compose -f docker-compose.prod.yml up -d

# Ver logs
docker-compose -f docker-compose.prod.yml logs -f

# Parar serviços
docker-compose -f docker-compose.prod.yml down
```

**3. Serviços incluídos:**

- **app**: Aplicação Laravel + Nginx (porta 80)
- **postgres**: PostgreSQL 18 (porta 5432)
- **redis**: Redis 7 (porta 6379)
- **worker**: Queue worker (opcional)

**4. Healthchecks:**

O compose inclui healthchecks para garantir que os serviços estejam funcionando corretamente.

