# 📝 Blog de Seguridad Web - Proyecto Final

Aplicación completa de blog usando Docker Compose con PHP personalizado y MySQL.

> **🚀 Esta aplicación incluye una imagen personalizada que puede ser publicada en Docker Hub**

## 🎯 Características

- ✅ **Aplicación PHP 8.2 personalizada** (publicable en Docker Hub)
- ✅ MySQL 8.0 (Base de datos)
- ✅ phpMyAdmin (Administración de BD)
- ✅ Docker Compose (Orquestación)
- ✅ Sistema de posts y comentarios
- ✅ Interfaz moderna y responsive
- ✅ Datos persistentes con volúmenes
- ✅ Red aislada para seguridad
- ✅ Health checks configurados
- ✅ Seguridad: PDO, prepared statements, validación de inputs

## 📦 Requisitos Previos

- Docker Desktop instalado y corriendo
- Docker Compose (incluido en Docker Desktop)
- Puertos disponibles: 8080, 8081, 3306

## 🚀 Instalación y Uso

### 1. Iniciar la aplicación

```bash
docker-compose up -d
```

### 2. Verificar que los contenedores estén corriendo

```bash
docker-compose ps
```

Deberías ver 3 contenedores:
- `blog_mysql` (Base de datos)
- `blog_wordpress` (Aplicación web)
- `blog_phpmyadmin` (Administrador de BD)

### 3. Acceder a la aplicación

- **Blog PHP**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081

### 4. Explorar la aplicación

La aplicación ya viene con datos de ejemplo:
- 5 posts sobre seguridad web
- 3 usuarios de ejemplo
- Comentarios de ejemplo

Páginas disponibles:
- **Inicio**: Lista de posts recientes
- **Posts**: Todos los posts
- **Acerca de**: Información del proyecto
- **Post individual**: Click en cualquier post para ver detalles y comentarios

### 5. Acceder a phpMyAdmin

1. Abre http://localhost:8081
2. Credenciales (las que configuraste en tu [.env](cci:7://file:///d:/ProyectosDocker/seguridad-web-docker/.env:0:0-0:0)):
   - Servidor: `db`
   - Usuario: `blog_user` (valor de `MYSQL_USER`)
   - Contraseña: (valor de `MYSQL_PASSWORD` en tu [.env](cci:7://file:///d:/ProyectosDocker/seguridad-web-docker/.env:0:0-0:0))
3. Verás la base de datos `blog_db` con tablas pre-creadas

## 📊 Estructura de la Base de Datos

El script `mysql/init.sql` crea automáticamente:

### Tabla `posts`
- Posts de ejemplo sobre seguridad web
- Campos: id, title, content, author, created_at, updated_at

### Tabla `users`
- Usuarios de ejemplo (admin, editor, viewer)
- Campos: id, username, email, password_hash, role, created_at, last_login

### Tabla `comments`
- Comentarios de ejemplo
- Campos: id, post_id, author_name, author_email, content, created_at, approved

## 🛠️ Comandos Útiles

### Ver logs en tiempo real
```bash
docker-compose logs -f
```

### Ver logs de un servicio específico
```bash
docker-compose logs -f wordpress
docker-compose logs -f db
```

### Reiniciar un servicio
```bash
docker-compose restart wordpress
docker-compose restart db
```

### Detener la aplicación
```bash
docker-compose down
```

### Detener y eliminar volúmenes (¡CUIDADO! Borra todos los datos)
```bash
docker-compose down -v
```

### Acceder a la consola de MySQL
```bash
docker exec -it blog_mysql mysql -u blog_user -p
```
Contraseña: `blog_password123`

### Backup de la base de datos
```bash
# Backup de la base de datos
docker exec blog_mysql mysqldump -u blog_user -p blog_db > backup_$(date +%Y%m%d).sql

# Backup usando variables de entorno
docker exec blog_mysql sh -c 'mysqldump -u $MYSQL_USER -p$MYSQL_PASSWORD $MYSQL_DATABASE' > backup_$(date +%Y%m%d).sql
```

### Restaurar backup
```bash
# Restaurar backup
docker exec -i blog_mysql mysql -u blog_user -p blog_db < backup_20260116.sql
```

## 🔒 Seguridad

### ⚠️ IMPORTANTE para Producción

1. **Cambiar contraseñas**: Edita el archivo `.env` con contraseñas seguras
2. **No subir .env a Git**: Ya está en `.gitignore`
3. **Usar HTTPS**: Configura un reverse proxy (nginx/traefik) con SSL
4. **Limitar acceso**: No expongas el puerto 3306 en producción
5. **Actualizar imágenes**: Mantén Docker y las imágenes actualizadas
6. **Backups regulares**: Programa backups automáticos

### Credenciales por defecto (CAMBIAR en producción)

```env.example
MYSQL_ROOT_PASSWORD=cambiar_por_password_seguro
MYSQL_DATABASE=blog_db
MYSQL_USER=blog_user
MYSQL_PASSWORD=cambiar_por_password_seguro
```

## 📁 Estructura del Proyecto

```
seguridad-web-docker/
├── docker-compose.yml      # Configuración de servicios
├── Dockerfile              # Imagen personalizada de la app
├── .dockerignore          # Archivos excluidos de la imagen
├── .env                    # Variables de entorno (NO subir a Git)
├── .env.example           # Variables de entorno (ejemplo para el usuario)
├── .gitignore             # Archivos ignorados por Git
├── README.md              # Esta documentación
├── DOCKER_HUB.md          # Guía para publicar en Docker Hub
├── app/                    # Código fuente de la aplicación
│   ├── index.php          # Página principal
│   ├── posts.php          # Lista de posts
│   ├── post.php           # Post individual
│   ├── about.php          # Acerca de
│   ├── config.php         # Configuración
│   ├── db.php             # Clase de base de datos
│   └── css/
│       └── style.css      # Estilos
└── mysql/
    └── init.sql           # Script de inicialización de BD
```

## 🐳 Servicios Docker

### 1. MySQL (db)
- **Imagen**: mysql:8.0
- **Puerto**: 3306
- **Volumen**: mysql_data (persistente)
- **Health check**: Verifica que MySQL esté listo

### 2. Aplicación PHP (app)
- **Imagen**: Personalizada (construida desde Dockerfile)
- **Puerto**: 8080
- **Base**: PHP 8.2 con Apache
- **Depende de**: db (espera health check)
- **Health check**: Verifica que Apache responda

### 3. phpMyAdmin (phpmyadmin)
- **Imagen**: phpmyadmin:latest
- **Puerto**: 8081
- **Interfaz web**: Para administrar MySQL

## 🔧 Personalización

### Cambiar puertos

Edita `docker-compose.yml`:
```yaml
ports:
  - "9090:80"  # WordPress en puerto 9090
```

### Usar versión específica de WordPress

```yaml
wordpress:
  image: wordpress:6.4-php8.2
```

### Agregar más servicios

Puedes agregar Redis, Nginx, etc. al `docker-compose.yml`

## 🐛 Solución de Problemas

### Error: "Port already in use"
```bash
# Ver qué está usando el puerto
netstat -ano | findstr :8080

# Cambiar el puerto en docker-compose.yml o detener el otro servicio
```

### La aplicación no conecta a MySQL
```bash
# Verificar que MySQL esté saludable
docker-compose ps

# Ver logs de MySQL
docker-compose logs db

# Ver logs de la aplicación
docker-compose logs app

# Reiniciar servicios
docker-compose restart
```

### Error al construir la imagen
```bash
# Reconstruir sin caché
docker-compose build --no-cache

# Luego iniciar
docker-compose up -d
```

## 📦 Publicar en Docker Hub

**¿Quieres compartir tu aplicación?** Lee la guía completa en `DOCKER_HUB.md`

### Pasos rápidos:

1. **Crear cuenta** en https://hub.docker.com

2. **Iniciar sesión**:
   ```bash
   docker login
   ```

3. **Editar docker-compose.yml** y reemplazar `tu-usuario-dockerhub` con tu usuario

4. **Construir la imagen**:
   ```bash
   docker build -t tu-usuario/blog-seguridad-web:latest .
   ```

5. **Publicar**:
   ```bash
   docker push tu-usuario/blog-seguridad-web:latest
   ```

6. **¡Listo!** Tu imagen está en Docker Hub

Ver guía completa en `DOCKER_HUB.md` para más detalles.

## 📚 Recursos Adicionales

- [Documentación de PHP](https://www.php.net/docs.php)
- [Documentación de MySQL](https://dev.mysql.com/doc/)
- [Docker Compose Reference](https://docs.docker.com/compose/)
- [Docker Hub](https://hub.docker.com)
- [Seguridad en PHP](https://www.php.net/manual/en/security.php)

## 📝 Notas

- Los datos se persisten en volúmenes Docker
- La primera vez que inicies WordPress, deberás completar la instalación
- Las tablas personalizadas (posts, users, comments) se crean automáticamente
- WordPress crea sus propias tablas (wp_posts, wp_users, etc.)

## ✅ Checklist de Proyecto Final

- [x] Docker Compose configurado
- [x] MySQL con datos iniciales
- [x] **Aplicación PHP personalizada**
- [x] **Dockerfile para imagen personalizada**
- [x] phpMyAdmin para administración
- [x] Volúmenes persistentes
- [x] Red aislada
- [x] Variables de entorno
- [x] Documentación completa
- [x] .gitignore y .dockerignore configurados
- [x] Health checks
- [x] **Guía para publicar en Docker Hub**
- [x] Sistema de posts y comentarios
- [x] Interfaz moderna y responsive
- [x] Seguridad implementada

---

## 🔧 Configuración Inicial

1. Clona el repositorio:
   ```bash
   git clone [https://github.com/tu-usuario/blog-seguridad-web-docker.git](https://github.com/tu-usuario/blog-seguridad-web-docker.git)
   cd blog-seguridad-web-docker

2. Crea tu archivo .env desde el ejemplo:
   ```bash
   cp .env.example .env

3. Edita .env con tus credenciales:
   ```bash
   notepad .env  # Windows

4. Inicia la aplicacion
   ```bash
   docker-compose up -d

**¡Proyecto listo para usar!** 🎉
