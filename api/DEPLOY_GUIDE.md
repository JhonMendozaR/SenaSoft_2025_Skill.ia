# 🚀 Guía de Despliegue - Backend Laravel en Render

## 📋 Resumen

Este backend Laravel está configurado para desplegarse automáticamente en Render usando el archivo `render.yaml`.

## ✅ Archivos Preparados

- ✅ `api/build.sh` - Script de build para Render
- ✅ `api/public/.htaccess` - Configuración Apache (ya existente)
- ✅ `render.yaml` - Configuración automática con servicio backend
- ✅ `api/.env.example` - Template de variables de entorno

## 🚀 Pasos para Desplegar

### Opción A: Blueprint Automático (RECOMENDADO)

1. **Sube los cambios a GitHub**
   ```bash
   git add .
   git commit -m "feat: configure Laravel backend for Render deployment"
   git push origin main
   ```

2. **En Render Dashboard** (https://dashboard.render.com)
   - Click en **New +** → **Blueprint**
   - Selecciona tu repositorio: `JhonMendozaR/SenaSoft_2025_Skill.ia`
   - Render detectará automáticamente el `render.yaml`
   - Click en **Apply**

3. **Configura las Variables de Entorno Manualmente**
   
   Una vez creado el servicio `skillai-api`, ve a:
   - **Dashboard** → **skillai-api** → **Environment**
   
   Configura estas variables (las de la DB que ya tienes):
   ```
   DB_HOST = tu_host_de_base_de_datos
   DB_DATABASE = nombre_de_tu_base_de_datos
   DB_USERNAME = tu_usuario
   DB_PASSWORD = tu_contraseña
   ```
   
   **Nota:** `APP_KEY` se generará automáticamente.

4. **¡Listo!** Tu API estará en: `https://skillai-api.onrender.com`

### Opción B: Manual

1. **Sube los cambios a GitHub** (mismo comando de arriba)

2. **En Render Dashboard**
   - New + → Web Service
   - Conecta el repositorio

3. **Configuración del Servicio**
   ```
   Name: skillai-api
   Region: Oregon (o la que prefieras)
   Root Directory: api
   Runtime: PHP
   Build Command: bash build.sh
   Start Command: php-fpm
   Plan: Free
   ```

4. **Variables de Entorno**
   
   Configura estas en la sección Environment:
   ```
   APP_NAME=SkillIA
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://skillai-api.onrender.com
   LOG_CHANNEL=errorlog
   LOG_LEVEL=error
   
   # Base de datos (tus valores)
   DB_CONNECTION=mysql
   DB_HOST=tu_host
   DB_PORT=3306
   DB_DATABASE=tu_database
   DB_USERNAME=tu_usuario
   DB_PASSWORD=tu_password
   
   # Sesiones y cache
   SESSION_DRIVER=file
   CACHE_STORE=file
   QUEUE_CONNECTION=sync
   ```
   
   **Importante:** Genera `APP_KEY` ejecutando en tu local:
   ```bash
   cd api
   php artisan key:generate --show
   ```
   Y copia el valor que te dé.

5. **Create Web Service**

## 🔑 Generar APP_KEY (si no se genera automáticamente)

```bash
cd api
php artisan key:generate --show
```

Copia el resultado (ejemplo: `base64:abc123...`) y agrégalo como variable de entorno en Render.

## 📋 Verificación Post-Despliegue

Una vez desplegado, verifica:

- [ ] El servicio está "Live" (verde) en Render Dashboard
- [ ] Puedes acceder a: `https://skillai-api.onrender.com`
- [ ] Revisa los logs en Render (debería mostrar "Build completado exitosamente!")
- [ ] Prueba un endpoint de tu API

### Probar endpoints:

```bash
# Endpoint raíz
curl https://skillai-api.onrender.com/api

# O desde el navegador
https://skillai-api.onrender.com/api
```

## 🔧 Si algo sale mal

### El build falla

1. Ve a **Logs** en el dashboard del servicio
2. Busca errores en el output
3. Verifica que `build.sh` tenga permisos de ejecución

### La aplicación no responde

1. Verifica que `APP_KEY` esté configurado
2. Revisa los logs de runtime
3. Asegúrate de que todas las variables de entorno estén correctas

### Errores de base de datos

1. Verifica que las credenciales de DB sean correctas
2. Asegúrate de que tu base de datos permita conexiones desde Render
3. Revisa que `DB_HOST` y `DB_PORT` estén bien configurados

## 🗄️ Migraciones (cuando la DB esté lista)

Cuando quieras ejecutar migraciones:

1. Edita `api/build.sh`
2. Descomenta estas líneas:
   ```bash
   # echo "🗄️ Ejecutando migraciones..."
   # php artisan migrate --force
   ```
3. Commit y push los cambios
4. Render hará redeploy automáticamente

O puedes ejecutarlas manualmente desde el Shell de Render:
- Dashboard → skillai-api → Shell
- Ejecuta: `php artisan migrate --force`

## 📝 Configuración Actual

```yaml
Framework: Laravel 12
PHP: 8.2+
Root Directory: api/
Build Script: api/build.sh
Variables Configuradas en render.yaml:
  - APP_NAME, APP_ENV, APP_DEBUG, APP_URL
  - LOG_CHANNEL, LOG_LEVEL
  - DB_* (requiere configuración manual)
  - SESSION_DRIVER, CACHE_STORE, QUEUE_CONNECTION
```

## 🎯 URLs Importantes

- **Dashboard Render**: https://dashboard.render.com
- **Documentación Render PHP**: https://docs.render.com/deploy-php
- **Tu API (después del deploy)**: https://skillai-api.onrender.com

## 💡 Notas Importantes

1. **Plan Free**: El servicio se dormirá después de 15 minutos de inactividad. La primera petición después de dormir tomará ~30 segundos.

2. **Base de Datos**: No toques la configuración de DB por ahora, solo agrega las variables cuando estés listo.

3. **Auto Deploy**: Cada push a `main` triggereará un nuevo deploy automáticamente.

4. **Logs**: Siempre revisa los logs si algo no funciona.

## 🔄 Próximos Pasos

1. Desplegar el backend siguiendo esta guía
2. Probar que la API responda
3. Cuando la DB esté lista, agregar las credenciales
4. Ejecutar migraciones
5. Conectar el frontend con el backend

---

¿Necesitas ayuda? Revisa los logs en Render Dashboard o consulta la documentación oficial.
