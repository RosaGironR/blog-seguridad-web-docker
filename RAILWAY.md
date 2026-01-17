# 🚂 Guía de Despliegue en Railway

Esta guía te muestra cómo desplegar tu aplicación de blog en Railway.

## 📋 Requisitos Previos

1. Cuenta en Railway: https://railway.app
2. Proyecto subido a GitHub
3. Archivos ya configurados:
   - ✅ `Dockerfile` (corregido para Railway)
   - ✅ `railway.json` (configuración de build)
   - ✅ `.railwayignore` (archivos a excluir)

## 🚀 Paso 1: Crear Proyecto en Railway

1. Ve a https://railway.app
2. Inicia sesión con GitHub
3. Click en **"New Project"**
4. Selecciona **"Deploy from GitHub repo"**
5. Busca y selecciona: `RosaGironR/blog-seguridad-web-docker`
6. Railway comenzará a construir automáticamente

## 🗄️ Paso 2: Agregar Base de Datos MySQL

1. En tu proyecto de Railway, click en **"+ New"**
2. Selecciona **"Database"**
3. Click en **"Add MySQL"**
4. Railway creará una base de datos MySQL automáticamente
5. Anota las credenciales que aparecen en la pestaña "Variables"

Verás algo como:
```
MYSQL_URL=mysql://root:password@mysql.railway.internal:3306/railway
MYSQLHOST=mysql.railway.internal
MYSQLPORT=3306
MYSQLUSER=root
MYSQLPASSWORD=tu_password_generado
MYSQLDATABASE=railway
```

## ⚙️ Paso 3: Configurar Variables de Entorno

1. Click en tu servicio de la aplicación (blog-seguridad-web-docker)
2. Ve a la pestaña **"Variables"**
3. Click en **"+ New Variable"**
4. Agrega estas variables (usa los valores de MySQL de Railway):

```
DB_HOST=mysql.railway.internal
DB_NAME=railway
DB_USER=root
DB_PASS=tu_password_generado_por_railway
```

**Importante**: Usa los valores exactos que Railway generó para MySQL.

## 📊 Paso 4: Importar Datos Iniciales a MySQL

Railway no ejecuta automáticamente `init.sql`. Tienes dos opciones:

### Opción A: Usar Railway CLI (Recomendado)

```bash
# 1. Instalar Railway CLI
npm i -g @railway/cli

# 2. Iniciar sesión
railway login

# 3. Vincular con tu proyecto
railway link

# 4. Conectar a MySQL
railway connect mysql

# 5. Una vez conectado, ejecutar:
source /ruta/a/tu/proyecto/mysql/init.sql
```

### Opción B: Usar Cliente MySQL Local

```bash
# Conectar a MySQL de Railway (usa las credenciales de Railway)
mysql -h containers-us-west-XXX.railway.app -P XXXX -u root -p

# Seleccionar base de datos
USE railway;

# Copiar y pegar el contenido de mysql/init.sql
```

### Opción C: Usar phpMyAdmin (Más Fácil)

1. En Railway, agrega un servicio de phpMyAdmin:
   - Click en "+ New"
   - Selecciona "Template"
   - Busca "phpMyAdmin"
2. Configura las variables para conectar con tu MySQL
3. Accede a phpMyAdmin desde el dominio que Railway te da
4. Importa el archivo `mysql/init.sql`

## 🌐 Paso 5: Generar Dominio Público

1. En tu servicio de aplicación, ve a **"Settings"**
2. Scroll hasta **"Networking"**
3. Click en **"Generate Domain"**
4. Railway te dará una URL como: `https://blog-seguridad-web-production.up.railway.app`

## ✅ Paso 6: Verificar Despliegue

1. Accede a tu URL de Railway
2. Deberías ver tu blog funcionando
3. Verifica que los posts aparezcan (si importaste `init.sql`)

## 🔍 Paso 7: Revisar Logs

Si algo falla:

1. Ve a la pestaña **"Deployments"**
2. Click en el deployment más reciente
3. Ve a **"Deploy Logs"** para ver errores de construcción
4. Ve a **"View Logs"** para ver errores de ejecución

## 🐛 Solución de Problemas Comunes

### Error: "More than one MPM loaded"
✅ Ya está solucionado en el Dockerfile actualizado

### Error: "Connection refused to MySQL"
- Verifica que las variables `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS` estén correctas
- Usa `mysql.railway.internal` como host (no localhost)

### Error: "No such file or directory"
- Verifica que la estructura de carpetas sea correcta
- Asegúrate que `app/` existe en tu repositorio

### La aplicación se construye pero no muestra posts
- Necesitas importar `mysql/init.sql` a la base de datos de Railway
- Usa una de las opciones del Paso 4

## 🔄 Actualizar la Aplicación

Cada vez que hagas cambios en GitHub:

1. Haz `git push` a tu repositorio
2. Railway detectará los cambios automáticamente
3. Reconstruirá y redesplegar la aplicación

## 💰 Costos

Railway ofrece:
- **Plan gratuito**: $5 de crédito mensual
- Suficiente para proyectos pequeños y demos
- Si excedes, necesitarás agregar una tarjeta

## 📊 Comparación: Local vs Railway

| Aspecto | Docker Local | Railway |
|---------|--------------|---------|
| **URL** | localhost:8080 | URL pública |
| **Base de datos** | MySQL local | MySQL en la nube |
| **Persistencia** | Volúmenes locales | Persistente en Railway |
| **Acceso** | Solo tu máquina | Acceso desde internet |
| **Costo** | Gratis | $5/mes gratis |

## 🎯 Estructura Final en Railway

```
Railway Project
├── blog-seguridad-web-docker (Servicio de aplicación)
│   ├── Variables: DB_HOST, DB_NAME, DB_USER, DB_PASS
│   └── Domain: https://tu-app.up.railway.app
│
└── MySQL (Servicio de base de datos)
    ├── Variables: MYSQL_URL, MYSQLHOST, MYSQLPASSWORD, etc.
    └── Datos: Importados desde mysql/init.sql
```

## ✅ Checklist de Despliegue

- [ ] Proyecto creado en Railway desde GitHub
- [ ] MySQL agregado como servicio
- [ ] Variables de entorno configuradas
- [ ] Datos iniciales importados (`init.sql`)
- [ ] Dominio público generado
- [ ] Aplicación accesible desde internet
- [ ] Posts visibles en la página principal

## 🔗 URLs Importantes

- **Railway Dashboard**: https://railway.app/dashboard
- **Documentación Railway**: https://docs.railway.app
- **Tu Repositorio GitHub**: https://github.com/RosaGironR/blog-seguridad-web-docker
- **Tu Imagen Docker Hub**: https://hub.docker.com/r/rosaisabel/blog-seguridad-web

---

**¡Tu aplicación está lista para producción en Railway!** 🚀

Si tienes problemas, revisa los logs en Railway o contacta su soporte.
