# ✅ Checklist de Despliegue - Skill.IA Frontend en Render

## 📦 Archivos Preparados

- ✅ `render.yaml` - Configuración automática de Render (en raíz del proyecto)
- ✅ `web/.node-version` - Versión de Node.js (22.20.0)
- ✅ `web/astro.config.mjs` - Configuración de build estático
- ✅ `web/package.json` - Scripts de build optimizados
- ✅ `web/DEPLOYMENT.md` - Guía completa de despliegue

## 🚀 Pasos Rápidos para Desplegar

### Opción A: Blueprint Automático (MÁS FÁCIL)

1. **Sube los cambios a GitHub**
   ```bash
   git add .
   git commit -m "chore: prepare frontend for Render deployment"
   git push origin main
   ```

2. **En Render Dashboard**
   - New + → Blueprint
   - Selecciona el repositorio: `JhonMendozaR/SenaSoft_2025_Skill.ia`
   - Render detectará automáticamente `render.yaml`

3. **Configura la Variable de Entorno**
   - En el servicio creado → Environment
   - Agrega: `PUBLIC_GROQ_API_KEY = tu_clave_groq`
   - Save Changes

4. **¡Listo!** Tu app estará en: `https://skillai-frontend.onrender.com`

### Opción B: Manual

1. **Sube los cambios a GitHub** (mismo comando de arriba)

2. **En Render Dashboard**
   - New + → Static Site
   - Conecta el repositorio

3. **Configuración**
   ```
   Name: skillai-frontend
   Root Directory: web
   Build Command: npm install && npm run build
   Publish Directory: web/dist
   Auto-Deploy: Yes
   Branch: main
   ```

4. **Variables de Entorno**
   - `PUBLIC_GROQ_API_KEY` = tu clave de Groq
   - `NODE_VERSION` = 22.20.0

5. **Create Static Site**

## 🔑 Obtener Groq API Key

1. Ve a [console.groq.com/keys](https://console.groq.com/keys)
2. Inicia sesión o crea cuenta
3. "Create API Key"
4. Copia la clave (empieza con `gsk_`)

## 📋 Verificación Post-Despliegue

Una vez desplegado, verifica:

- [ ] La URL funciona
- [ ] Puedes acceder a todas las páginas:
  - [ ] `/` (redirige a `/login`)
  - [ ] `/login`
  - [ ] `/diagnostic`
  - [ ] `/roadmap`
  - [ ] `/chat`
- [ ] Los estilos se ven correctos
- [ ] Groq API funciona (prueba en `/diagnostic`)
- [ ] No hay errores en la consola del navegador (F12)

## 🔧 Si algo sale mal

1. **Revisa los logs** en Render Dashboard
2. **Verifica las variables de entorno** (debe tener prefijo `PUBLIC_`)
3. **Consulta** `web/DEPLOYMENT.md` para solución de problemas detallada

## 📝 Configuración Actual

```yaml
Framework: Astro 5.14.8 (modo estático)
Node.js: 22.20.0
Build Output: web/dist/
Root Directory: web/
Variables de Entorno Requeridas:
  - PUBLIC_GROQ_API_KEY
```

## 🎯 URLs Importantes

- **Dashboard Render**: https://dashboard.render.com
- **Groq Console**: https://console.groq.com
- **Documentación Completa**: Ver `web/DEPLOYMENT.md`

---

**Nota**: Este despliegue es SOLO del frontend. El backend Laravel se desplegará por separado más adelante.
