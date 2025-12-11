# Contributing Guide

## Development Setup

### Prerequisites

1. **Docker and Docker Compose**
2. **Traefik Proxy** (one-time setup: `~/docker/traefik-proxy/install.sh`)
3. Files from team lead: database dump, plugins, uploads

### Setup

```bash
# Clone and configure
git clone git@github.com:creativconcept/dirrigl-und-partner.git
cd dirrigl-und-partner
cp .env.example .env

# Place files from team lead
# - db-dumps/db_dump.sql
# - wordpress/plugins/
# - wordpress/uploads/

# Start Docker
docker-compose up -d

# Import database
docker-compose exec db bash -c 'MYSQL_PWD="$MYSQL_ROOT_PASSWORD" mysql -u root "$MYSQL_DATABASE" < /db-dumps/db_dump.sql'

# Setup
docker-compose exec wpcli wp plugin activate --all
docker-compose exec wpcli wp user create ccadmin info@creativconcept.de --role=administrator --user_pass=StrongPass123!
docker-compose exec wpcli wp search-replace 'https://dirrigl-und-partner.de/' 'http://dirrigl-und-partner.localhost/' --all-tables
docker-compose exec wpcli wp cache flush
```

## Git Workflow

### Branches

- `main` - Production (deployed to live server)
- `develop` - Development branch
- `feature/<name>` - New features
- `fix/<name>` - Bug fixes

### Workflow

```bash
# Start new feature
git checkout develop
git pull origin develop
git checkout -b feature/my-feature

# Make changes, test locally
# ...

# Commit and push
git add .
git commit -m "feat(themes/dirrigl): add feature description"
git push origin feature/my-feature

# Create PR to develop via GitHub
```

## Commit Messages

Follow [Conventional Commits](https://www.conventionalcommits.org/):

```
type(scope): subject
```

### Types

- `feat` - New feature
- `fix` - Bug fix
- `docs` - Documentation
- `style` - Formatting
- `refactor` - Code restructuring
- `chore` - Maintenance

### Scopes

- `themes/dirrigl` - Theme changes
- `docker` - Docker configuration
- `config` - Project configuration

### Examples

```bash
feat(themes/dirrigl): add responsive header menu
fix(themes/dirrigl): correct footer alignment on mobile
docs: update setup instructions
chore(docker): update MySQL version
```

## Code Style

### PHP

```bash
# Install dependencies
composer install

# Check code style
composer cs-check

# Auto-fix issues
composer cs-fix
```

### EditorConfig

Project uses `.editorconfig` for consistent formatting:
- PHP: Tabs, LF line endings
- JS/CSS: 2 spaces, LF line endings

## Testing

1. Edit files in `wordpress/themes/dirrigl/`
2. Changes appear immediately at http://dirrigl-und-partner.localhost
3. Check browser console for JS errors
4. View debug log: `docker-compose exec wordpress tail -f /var/www/html/wp-content/debug.log`

## Deployment

Currently **manual deployment**:

### Option 1: SFTP (Transmit)

1. Connect to live server
2. Upload changed theme files to `wp-content/themes/dirrigl/`
3. Clear WordPress cache

### Option 2: rsync

```bash
rsync -av wordpress/themes/dirrigl/ user@server:/path/to/wp-content/themes/dirrigl/
```

## Useful Commands

```bash
# Docker
docker-compose up -d          # Start
docker-compose down           # Stop
docker-compose logs -f        # View logs
docker-compose restart        # Restart

# WP-CLI
docker-compose exec wpcli wp plugin list
docker-compose exec wpcli wp theme list
docker-compose exec wpcli wp cache flush
docker-compose exec wpcli wp db export /db-dumps/backup.sql

# Database
docker-compose exec db bash -c 'MYSQL_PWD="$MYSQL_PASSWORD" mysql -u "$MYSQL_USER" "$MYSQL_DATABASE"'
```

## Refreshing Local Data

```bash
# Get fresh dump from team lead, then:
docker-compose down -v
docker-compose up -d

# Import new dump
docker-compose exec db bash -c 'MYSQL_PWD="$MYSQL_ROOT_PASSWORD" mysql -u root "$MYSQL_DATABASE" < /db-dumps/db_dump.sql'

# Reconfigure
docker-compose exec wpcli wp plugin activate --all
docker-compose exec wpcli wp search-replace 'https://dirrigl-und-partner.de/' 'http://dirrigl-und-partner.localhost/' --all-tables
docker-compose exec wpcli wp cache flush
```

## Support

1. Check [README.md](README.md)
2. Review Docker logs: `docker-compose logs`
3. Contact team lead