# 📦 Guía para Publicar en Docker Hub

Esta guía te muestra cómo construir y publicar tu imagen personalizada en Docker Hub.

## 📋 Requisitos Previos

1. **Cuenta en Docker Hub**
   - Crea una cuenta gratuita en https://hub.docker.com
   - Anota tu nombre de usuario (ejemplo: `juanperez`)

2. **Docker Desktop**
   - Asegúrate de tener Docker Desktop instalado y corriendo

## 🔐 Paso 1: Iniciar Sesión en Docker Hub

Abre PowerShell o CMD y ejecuta:

```bash
docker login
```

Ingresa:
- **Username**: tu nombre de usuario de Docker Hub
- **Password**: tu contraseña

Verás: `Login Succeeded`

## 🏗️ Paso 2: Construir la Imagen

Navega al directorio del proyecto:

```bash
cd d:\ProyectosDocker\seguridad-web-docker
```

Construye la imagen (reemplaza `tu-usuario` con tu nombre de usuario de Docker Hub):

```bash
docker build -t tu-usuario/blog-seguridad-web:latest .
```

Ejemplo:
```bash
docker build -t juanperez/blog-seguridad-web:latest .
```

Esto tomará unos minutos la primera vez.

## 🔍 Paso 3: Verificar la Imagen

Lista tus imágenes locales:

```bash
docker images
```

Deberías ver algo como:
```
REPOSITORY                          TAG       IMAGE ID       CREATED         SIZE
juanperez/blog-seguridad-web       latest    abc123def456   2 minutes ago   450MB
```

## 🧪 Paso 4: Probar la Imagen Localmente (Opcional)

Antes de publicar, prueba que funcione:

```bash
docker-compose up -d
```

Accede a http://localhost:8080 y verifica que todo funcione correctamente.

Detén los contenedores:
```bash
docker-compose down
```

## 🚀 Paso 5: Publicar en Docker Hub

Sube la imagen a Docker Hub:

```bash
docker push tu-usuario/blog-seguridad-web:latest
```

Ejemplo:
```bash
docker push juanperez/blog-seguridad-web:latest
```

Verás el progreso de subida de cada capa. Esto puede tomar varios minutos.

## ✅ Paso 6: Verificar en Docker Hub

1. Ve a https://hub.docker.com
2. Inicia sesión
3. Ve a "Repositories"
4. Deberías ver `blog-seguridad-web`
5. Click en el repositorio para ver los detalles

## 📝 Paso 7: Actualizar docker-compose.yml

Edita `docker-compose.yml` y reemplaza `tu-usuario-dockerhub` con tu usuario real:

```yaml
app:
  image: juanperez/blog-seguridad-web:latest
  # ... resto de la configuración
```

## 🎯 Paso 8: Usar la Imagen Publicada

Ahora cualquier persona puede usar tu imagen:

```bash
docker pull juanperez/blog-seguridad-web:latest
```

O simplemente ejecutar:
```bash
docker-compose up -d
```

Docker descargará automáticamente la imagen desde Docker Hub.

## 🏷️ Versionado (Opcional)

Puedes crear versiones específicas:

```bash
# Construir con versión
docker build -t juanperez/blog-seguridad-web:1.0 .
docker build -t juanperez/blog-seguridad-web:latest .

# Publicar ambas versiones
docker push juanperez/blog-seguridad-web:1.0
docker push juanperez/blog-seguridad-web:latest
```

## 📊 Comandos Útiles

### Ver imágenes locales
```bash
docker images
```

### Eliminar imagen local
```bash
docker rmi juanperez/blog-seguridad-web:latest
```

### Ver información de la imagen
```bash
docker inspect juanperez/blog-seguridad-web:latest
```

### Reconstruir sin caché
```bash
docker build --no-cache -t juanperez/blog-seguridad-web:latest .
```

### Cerrar sesión de Docker Hub
```bash
docker logout
```

## 🔒 Mejores Prácticas

1. **No incluyas datos sensibles** en la imagen
   - Usa variables de entorno para credenciales
   - No incluyas archivos `.env` en la imagen

2. **Mantén la imagen pequeña**
   - Usa `.dockerignore` para excluir archivos innecesarios
   - Limpia archivos temporales en el Dockerfile

3. **Documenta tu imagen**
   - Agrega un README en Docker Hub
   - Incluye ejemplos de uso
   - Lista las variables de entorno necesarias

4. **Usa tags semánticos**
   - `latest` para la versión más reciente
   - `1.0`, `1.1`, etc. para versiones específicas
   - `dev` para versiones de desarrollo

5. **Actualiza regularmente**
   - Mantén las dependencias actualizadas
   - Reconstruye y republica periódicamente

## 🌐 Hacer el Repositorio Público/Privado

Por defecto, los repositorios son públicos. Para cambiar:

1. Ve a Docker Hub
2. Click en tu repositorio
3. Ve a "Settings"
4. Cambia la visibilidad

**Nota**: Las cuentas gratuitas tienen 1 repositorio privado.

## 📖 Agregar Descripción en Docker Hub

1. Ve a tu repositorio en Docker Hub
2. Click en "Description"
3. Agrega información sobre tu proyecto:

```markdown
# Blog de Seguridad Web

Aplicación completa de blog construida con PHP 8.2, MySQL 8.0 y Docker.

## Características

- ✅ PHP 8.2 con Apache
- ✅ MySQL 8.0
- ✅ Sistema de posts y comentarios
- ✅ Interfaz moderna y responsive
- ✅ Seguridad implementada (PDO, prepared statements)

## Uso Rápido

```bash
docker run -d -p 8080:80 \
  -e DB_HOST=db \
  -e DB_NAME=blog_db \
  -e DB_USER=blog_user \
  -e DB_PASS=blog_password123 \
  juanperez/blog-seguridad-web:latest
```

## Variables de Entorno

- `DB_HOST`: Host de MySQL (default: db)
- `DB_NAME`: Nombre de la base de datos
- `DB_USER`: Usuario de MySQL
- `DB_PASS`: Contraseña de MySQL

## Docker Compose

Ver repositorio completo en GitHub para `docker-compose.yml`
```

## 🎓 Resumen del Proceso

1. ✅ Crear cuenta en Docker Hub
2. ✅ `docker login`
3. ✅ `docker build -t usuario/nombre:tag .`
4. ✅ `docker push usuario/nombre:tag`
5. ✅ Verificar en Docker Hub
6. ✅ Actualizar docker-compose.yml
7. ✅ ¡Listo para compartir!

---

**¡Tu imagen ya está publicada en Docker Hub!** 🎉

Ahora cualquier persona puede descargarla y usarla con:
```bash
docker pull tu-usuario/blog-seguridad-web:latest
```
