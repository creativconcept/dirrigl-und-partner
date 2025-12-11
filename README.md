# Dirrigl und Partner WordPress Project

WordPress website for Dirrigl und Partner with custom theme.

## Quick Start

### Prerequisites

1. **Docker and Docker Compose** installed
2. **Traefik Proxy** running (see below)
3. Files from team lead:
   - **Database dump** (`db_dump.sql`)
   - **Plugins** from `wp-content/plugins/`
   - **Uploads** from `wp-content/uploads/`

### One-Time Setup: Traefik Proxy

```bash
~/docker/traefik-proxy/install.sh
```

### Setup Steps

```bash
# 1. Clone repository
git clone git@github.com:creativconcept/dirrigl-und-partner.git
cd dirrigl-und-partner

# 2. Copy environment file
cp .env.example .env

# 3. Place files from team lead:
#    - Database dump -> db-dumps/db_dump.sql
#    - Plugins -> wordpress/plugins/
#    - Uploads -> wordpress/uploads/

# 4. Start Docker
docker-compose up -d

# 5. Import database (wait ~15 sec for MySQL to be ready)
docker-compose exec db bash -c 'MYSQL_PWD="$MYSQL_ROOT_PASSWORD" mysql -u root "$MYSQL_DATABASE" < /db-dumps/db_dump.sql'

# 6. Activate all plugins
docker-compose exec wpcli wp plugin activate --all

# 7. Create admin user
docker-compose exec db bash -c 'MYSQL_PWD="$MYSQL_PASSWORD" mysql -u "$MYSQL_USER" "$MYSQL_DATABASE" -e "DELETE FROM wp_users; DELETE FROM wp_usermeta;"'
docker-compose exec wpcli wp user create ccadmin info@creativconcept.de --role=administrator --user_pass=StrongPass123!

# 8. Replace production URLs (adjust domain as needed)
docker-compose exec wpcli wp search-replace 'https://dirrigl-und-partner.de/' 'http://dirrigl-und-partner.localhost/' --all-tables

# 9. Clear cache
docker-compose exec wpcli wp cache flush
```

## Services

| Service | URL |
|---------|-----|
| WordPress | http://dirrigl-und-partner.localhost |
| phpMyAdmin | http://pma.dirrigl-und-partner.localhost |
| Mailpit | http://mail.dirrigl-und-partner.localhost |
| WP-CLI | `docker-compose exec wpcli wp` |

**Login:** http://dirrigl-und-partner.localhost/wp-admin with `ccadmin` / `StrongPass123!`

## Project Structure

```
.
├── wordpress/
│   ├── themes/
│   │   └── dirrigl/          # Custom theme (tracked)
│   ├── plugins/              # All plugins (NOT tracked)
│   └── uploads/              # Media uploads (NOT tracked)
├── db-dumps/
│   └── .gitkeep              # Database dumps (NOT tracked)
├── docker-compose.yml        # Docker configuration
├── .env.example              # Environment template
└── README.md
```

## What's Tracked

- Custom theme: `wordpress/themes/dirrigl/`
- Configuration files
- Docker setup

## What's NOT Tracked (get from team lead)

- Plugins
- Uploads/media
- Database dumps

## Common Commands

```bash
# Start/Stop
docker-compose up -d
docker-compose down

# View logs
docker-compose logs -f wordpress

# Export database
docker-compose exec wpcli wp db export /db-dumps/backup.sql

# Search & replace URLs
docker-compose exec wpcli wp search-replace 'old-url' 'new-url' --all-tables

# Clear cache
docker-compose exec wpcli wp cache flush
```

## Development

1. Edit files in `wordpress/themes/dirrigl/`
2. Changes appear immediately (Docker volume mount)
3. Test at http://dirrigl-und-partner.localhost
4. Commit following [CONTRIBUTING.md](CONTRIBUTING.md)

## Troubleshooting

**WordPress redirects to live site:**
```bash
docker-compose exec wpcli wp search-replace 'https://dirrigl-und-partner.de/' 'http://dirrigl-und-partner.localhost/' --all-tables
```

**Reset everything:**
```bash
docker-compose down -v
docker-compose up -d
# Then re-import database
```

See [CONTRIBUTING.md](CONTRIBUTING.md) for detailed workflow.