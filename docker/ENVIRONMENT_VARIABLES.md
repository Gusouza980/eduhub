# Variáveis de Ambiente para Produção

Este arquivo contém as variáveis de ambiente necessárias para executar a aplicação em produção com Docker.

## 📋 Variáveis Obrigatórias

### Aplicação
```bash
APP_NAME=DevControle
APP_ENV=production
APP_KEY=base64:sua-chave-aqui  # Gere com: php artisan key:generate
APP_DEBUG=false
APP_URL=https://seu-dominio.com
APP_TIMEZONE=America/Sao_Paulo
```

### Banco de Dados (PostgreSQL)
```bash
DB_CONNECTION=pgsql
DB_HOST=seu-host-postgresql
DB_PORT=5432
DB_DATABASE=devcontrole
DB_USERNAME=seu-usuario
DB_PASSWORD=sua-senha-segura
```

## 🔧 Variáveis Recomendadas

### Cache e Sessão (Redis)
```bash
CACHE_STORE=redis
CACHE_PREFIX=devcontrole_cache

SESSION_DRIVER=redis
SESSION_LIFETIME=120
SESSION_SECURE_COOKIE=true

REDIS_HOST=seu-redis-host
REDIS_PASSWORD=sua-senha-redis
REDIS_PORT=6379
REDIS_DB=0
REDIS_CACHE_DB=1
```

### Fila (Queue)
```bash
QUEUE_CONNECTION=redis  # ou database, sqs, etc
```

### Logging
```bash
LOG_CHANNEL=stack
LOG_STACK=daily
LOG_LEVEL=error
LOG_DEPRECATIONS_CHANNEL=null
```

### Email
```bash
MAIL_MAILER=smtp
MAIL_HOST=seu-smtp-host
MAIL_PORT=587
MAIL_USERNAME=seu-usuario
MAIL_PASSWORD=sua-senha
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@seu-dominio.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Filament
```bash
FILAMENT_FILESYSTEM_DISK=public
```

## 🐳 Variáveis Específicas do Docker

```bash
# Execute seeders no primeiro deploy
RUN_SEEDERS=false  # true para executar seeders
```

## 📝 Exemplo de Comando Docker Run Completo

```bash
docker run -d \
  --name devcontrole \
  --restart unless-stopped \
  -p 80:80 \
  -e APP_NAME=DevControle \
  -e APP_ENV=production \
  -e APP_KEY=base64:sua-chave \
  -e APP_DEBUG=false \
  -e APP_URL=https://seu-dominio.com \
  -e APP_TIMEZONE=America/Sao_Paulo \
  -e DB_CONNECTION=pgsql \
  -e DB_HOST=postgresql-host \
  -e DB_PORT=5432 \
  -e DB_DATABASE=devcontrole \
  -e DB_USERNAME=devcontrole \
  -e DB_PASSWORD=senha-segura \
  -e CACHE_STORE=redis \
  -e SESSION_DRIVER=redis \
  -e QUEUE_CONNECTION=redis \
  -e REDIS_HOST=redis-host \
  -e REDIS_PORT=6379 \
  -e LOG_CHANNEL=stack \
  -e LOG_LEVEL=error \
  devcontrole:latest
```

## 🔐 Segurança

**IMPORTANTE:**
- Nunca commite o arquivo `.env` com credenciais reais
- Use senhas fortes e únicas para o banco de dados
- Mantenha a `APP_KEY` segura
- Configure `APP_DEBUG=false` em produção
- Use HTTPS em produção (`SESSION_SECURE_COOKIE=true`)
- Configure firewall para proteger PostgreSQL e Redis

## 🔄 Atualizar Variáveis em Container em Execução

Para atualizar variáveis de ambiente sem recriar o container:

1. Pare o container:
```bash
docker stop devcontrole
```

2. Remova o container:
```bash
docker rm devcontrole
```

3. Recrie com novas variáveis:
```bash
docker run -d [suas-novas-variáveis] devcontrole:latest
```

## 📦 Docker Compose (Alternativa)

Você também pode usar Docker Compose para gerenciar variáveis:

```yaml
version: '3.8'

services:
  app:
    image: devcontrole:latest
    ports:
      - "80:80"
    environment:
      APP_NAME: DevControle
      APP_ENV: production
      APP_DEBUG: "false"
      DB_HOST: postgres
      # ... outras variáveis
    depends_on:
      - postgres
      - redis
  
  postgres:
    image: postgres:18-alpine
    environment:
      POSTGRES_DB: devcontrole
      POSTGRES_USER: devcontrole
      POSTGRES_PASSWORD: senha-segura
    volumes:
      - postgres-data:/var/lib/postgresql/data
  
  redis:
    image: redis:7-alpine
    volumes:
      - redis-data:/data

volumes:
  postgres-data:
  redis-data:
```

