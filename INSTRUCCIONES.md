# 🚀 Instrucciones Rápidas - Proyecto Final

## ⚠️ IMPORTANTE: Primero detén los contenedores anteriores

```bash
cd d:\ProyectosDocker\seguridad-web-docker
docker-compose down
```

## 🔧 Paso 1: Construir y Probar Localmente

```bash
# Construir la imagen personalizada
docker-compose build

# Iniciar todos los servicios
docker-compose up -d

# Ver el progreso
docker-compose logs -f app
```

Espera 1-2 minutos y accede a:
- **Aplicación**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081

## 📦 Paso 2: Publicar en Docker Hub

### 1. Crear cuenta en Docker Hub
- Ve a https://hub.docker.com
- Regístrate (gratis)
- Anota tu nombre de usuario (ejemplo: `juanperez`)

### 2. Iniciar sesión desde terminal

```bash
docker login
```

Ingresa tu usuario y contraseña de Docker Hub.

### 3. Editar docker-compose.yml

Abre `docker-compose.yml` y en la línea 29, reemplaza:

```yaml
image: tu-usuario-dockerhub/blog-seguridad-web:latest
```

Por tu usuario real, ejemplo:

```yaml
image: juanperez/blog-seguridad-web:latest
```

### 4. Reconstruir con tu nombre de usuario

```bash
docker-compose build
```

### 5. Publicar en Docker Hub

```bash
docker-compose push app
```

O manualmente:

```bash
docker push juanperez/blog-seguridad-web:latest
```

### 6. Verificar en Docker Hub

1. Ve a https://hub.docker.com
2. Inicia sesión
3. Ve a "Repositories"
4. Verás tu imagen `blog-seguridad-web`

## ✅ ¡Listo!

Ahora tu imagen está publicada y cualquiera puede usarla:

```bash
docker pull juanperez/blog-seguridad-web:latest
```

## 📋 Resumen de lo que tienes

1. ✅ Aplicación PHP personalizada con:
   - Sistema de posts y comentarios
   - Interfaz moderna
   - Conexión a MySQL
   - Seguridad implementada

2. ✅ Dockerfile para crear imagen personalizada

3. ✅ Docker Compose con 3 servicios:
   - MySQL (base de datos)
   - App PHP (tu aplicación)
   - phpMyAdmin (administración)

4. ✅ Imagen publicable en Docker Hub

5. ✅ Documentación completa

## 🎯 Para tu presentación

Puedes mostrar:
- La aplicación funcionando en http://localhost:8080
- El código fuente en la carpeta `app/`
- El Dockerfile que construye la imagen
- Tu imagen publicada en Docker Hub
- phpMyAdmin mostrando la base de datos

## 🔄 Comandos útiles

```bash
# Ver contenedores corriendo
docker-compose ps

# Ver logs
docker-compose logs -f

# Detener todo
docker-compose down

# Reiniciar
docker-compose restart

# Reconstruir imagen
docker-compose build --no-cache
```

---

**¿Dudas?** Lee `README.md` para documentación completa o `DOCKER_HUB.md` para guía detallada de publicación.
