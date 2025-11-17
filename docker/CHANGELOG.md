# Changelog - Docker Configuration

## Migração: Laravel 10 + Filament 3 + MySQL → Laravel 12 + Filament 4 + PostgreSQL

### 🐛 Correções Críticas

#### Erro "vite: not found" durante build

**Problema**: O script estava usando `npm install --omit=dev`, que não instala as devDependencies. Como o Vite está nas devDependencies, o build falhava com "vite: not found".

**Solução Implementada**:
```bash
# Antes (INCORRETO)
npm install --omit=dev  # Não instala Vite
npm run build          # Falha: vite not found

# Depois (CORRETO)
npm ci                 # Instala TODAS as dependências (incluindo Vite)
npm run build         # Sucesso!
npm prune --production # Remove devDependencies após o build
```

**Por que isso funciona**:
1. `npm ci` instala todas as dependências do package.json (incluindo devDependencies)
2. Isso disponibiliza o Vite para fazer o build dos assets
3. `npm prune --production` remove as devDependencies após o build, reduzindo o tamanho da imagem
4. Os assets buildados em `public/build` permanecem disponíveis

---

### 🔄 Alterações no Dockerfile

#### ✅ Atualizações Implementadas

**1. Versão do PHP**
- ❌ Antes: `php:fpm-alpine` (sem versão específica)
- ✅ Agora: `php:8.4-fpm-alpine`
- **Motivo**: Laravel 12 requer PHP 8.2+ e PHP 8.4 oferece melhor performance

**2. Banco de Dados**
- ❌ Antes: MySQL/MariaDB (`pdo_mysql`, `mysqli`, `mariadb-client`)
- ✅ Agora: PostgreSQL (`pdo_pgsql`, `pgsql`, `postgresql-client`)
- **Motivo**: Projeto migrou para PostgreSQL

**3. Extensões PHP**
- ✅ Mantidas: `zip`, `gd`, `opcache`, `intl`, `bcmath`
- ✅ PostgreSQL: `pdo_pgsql`, `pgsql`
- ❌ Removidas: `pdo_mysql`, `mysqli`

**4. Remoção de SQLite**
- ❌ Antes: Criava diretório `database/sqlite`
- ✅ Agora: Removido (projeto usa PostgreSQL)

**5. Organização**
- ✅ Comandos RUN consolidados para melhor cache de camadas
- ✅ Dependências do sistema instaladas em um único comando
- ✅ Permissões ajustadas de forma mais segura

**6. Tailwind CSS 4**
- ❌ Antes: Copiava `postcss.config.js` e `tailwind.config.js`
- ✅ Agora: Arquivos removidos (Tailwind 4 não precisa mais deles)
- **Motivo**: Tailwind CSS 4 usa configuração nativa via CSS

### 🔄 Alterações no docker-entrypoint.sh

#### ✅ Melhorias Implementadas

**1. Error Handling**
- ✅ Adicionado `set -e` para parar em caso de erro
- ✅ Mensagens de log mais descritivas com emojis

**2. Verificação de PostgreSQL**
- ✅ Aguarda PostgreSQL estar disponível usando `pg_isready`
- ✅ Loop com timeout até o banco estar pronto
- ✅ Usa variáveis de ambiente com valores padrão

**3. Geração de APP_KEY**
- ✅ Verifica se a chave já existe antes de gerar
- ✅ Evita sobrescrever chaves existentes

**4. NPM - Processo de Build Corrigido** ⚠️
- ❌ Antes: `npm install` (inconsistente)
- ❌ Tentativa inicial: `npm ci --omit=dev` (falhava - vite not found)
- ✅ Agora: 
  ```bash
  npm ci                    # Instala TODAS as dependências
  npm run build            # Build com Vite
  npm prune --production   # Remove devDependencies após build
  ```
- **Motivo**: Vite está nas devDependencies e é necessário para o build

**5. Otimizações Laravel**
- ✅ Adicionados caches específicos:
  - `config:cache`
  - `route:cache`
  - `view:cache`
  - `event:cache`
  - `filament:optimize`

**6. Seeders Opcionais**
- ✅ Executa seeders apenas se `RUN_SEEDERS=true`
- ✅ Permite controle sobre execução de seeders

**7. Permissões**
- ✅ Ajustadas para 775 (mais seguro que 777)
- ✅ Ownership correto para www-data

### 📁 Novos Arquivos Criados

#### 1. `.dockerignore`
- ✅ Otimiza build do Docker
- ✅ Exclui arquivos desnecessários
- ✅ Reduz tamanho da imagem

#### 2. `docker/README.md`
- ✅ Documentação completa
- ✅ Instruções de uso
- ✅ Troubleshooting
- ✅ Exemplos práticos

#### 3. `docker/ENVIRONMENT_VARIABLES.md`
- ✅ Lista todas as variáveis necessárias
- ✅ Exemplo de comando docker run completo
- ✅ Configurações recomendadas

#### 4. `docker-compose.prod.yml`
- ✅ Setup completo para produção
- ✅ Inclui PostgreSQL 18
- ✅ Inclui Redis 7
- ✅ Worker para filas (opcional)
- ✅ Healthchecks configurados
- ✅ Volumes persistentes

#### 5. `docker/CHANGELOG.md` (este arquivo)
- ✅ Histórico de mudanças
- ✅ Comparações antes/depois

### ⚙️ Configurações Atualizadas

#### `docker/config/laravel-php.ini`

**Antes:**
```ini
opcache.memory_consumption = 128
opcache.interned_strings_buffer = 8
opcache.max_accelerated_files = 4000
opcache.revalidate_freq = 60
opcache.fast_shutdown = 1
opcache.enable_cli = 1
```

**Agora:**
```ini
; OPcache otimizado para Laravel 12 + Filament 4
opcache.memory_consumption = 256
opcache.interned_strings_buffer = 16
opcache.max_accelerated_files = 20000
opcache.validate_timestamps = 0

; Limites aumentados para Filament
upload_max_filesize = 50M
post_max_size = 50M
memory_limit = 512M

; Configurações de sessão seguras
session.cookie_secure = 1
session.cookie_httponly = 1
session.cookie_samesite = "Lax"

; Realpath cache para performance
realpath_cache_size = 4096K
realpath_cache_ttl = 600
```

### 🚀 Como Usar

#### Opção 1: Docker Run
```bash
docker build -t devcontrole:latest .
docker run -d --name devcontrole -p 80:80 \
  -e DB_HOST=postgres -e DB_DATABASE=devcontrole \
  devcontrole:latest
```

#### Opção 2: Docker Compose (Recomendado)
```bash
docker-compose -f docker-compose.prod.yml up -d
```

### ✅ Compatibilidade

- ✅ Laravel 12
- ✅ Filament 4
- ✅ PHP 8.4
- ✅ PostgreSQL 16+
- ✅ Redis 7
- ✅ Alpine Linux

### 📊 Melhorias de Performance

1. **OPcache**: Configurações otimizadas para Filament 4
2. **Memory**: Aumentado para 512M (Filament precisa mais memória)
3. **Upload**: 50MB para arquivos maiores
4. **Realpath Cache**: Melhora performance de IO
5. **NPM CI**: Build mais rápido e consistente
6. **Multi-stage Caching**: Melhor uso de cache do Docker

### 🔒 Melhorias de Segurança

1. ✅ Cookies seguros em produção
2. ✅ Display errors desabilitado
3. ✅ Permissões corretas (775 ao invés de 777)
4. ✅ Ownership apropriado (www-data)
5. ✅ Variáveis de ambiente em .dockerignore

### 🐛 Troubleshooting

Se encontrar problemas, consulte:
- `docker/README.md` - Seção Troubleshooting
- `docker/ENVIRONMENT_VARIABLES.md` - Variáveis corretas
- Logs: `docker logs devcontrole` ou `docker-compose logs -f`

### 📝 Notas Importantes

1. **Remova MySQL**: Se estava usando MySQL antes, remova os containers antigos
2. **Migrations**: Execute migrations antes de qualquer operação
3. **Redis**: Recomendado para cache e sessões em produção
4. **Backup**: Sempre faça backup do PostgreSQL antes de atualizações
5. **APP_KEY**: Nunca commite a chave no Git

### 🎯 Próximos Passos Recomendados

1. [ ] Configure Redis para cache e sessões
2. [ ] Configure queue worker com `docker-compose.prod.yml`
3. [ ] Configure backup automático do PostgreSQL
4. [ ] Configure um proxy reverso (Nginx/Traefik) com HTTPS
5. [ ] Configure monitoring (New Relic, Sentry, etc)
6. [ ] Configure CI/CD para build automático

