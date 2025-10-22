"# 🚀 Skill.IA - Plataforma Inteligente de Desarrollo Profesional

> **Proyecto SenaSoft 2025 - Equipo 8: Tití Devs**

## 📋 Tabla de Contenidos

1. [Descripción del Proyecto](#-descripción-del-proyecto)
2. [Características Principales](#-características-principales)
3. [Requisitos Previos](#-requisitos-previos)
4. [Estructura del Proyecto](#-estructura-del-proyecto)
5. [Instalación Paso a Paso](#-instalación-paso-a-paso)
   - [1. Clonar el Repositorio](#1-clonar-el-repositorio)
   - [2. Configurar la Base de Datos](#2-configurar-la-base-de-datos)
   - [3. Configurar el Backend (API)](#3-configurar-el-backend-api)
   - [4. Configurar el Frontend (Web)](#4-configurar-el-frontend-web)
6. [Ejecutar el Proyecto](#-ejecutar-el-proyecto)
7. [Uso de la Aplicación](#-uso-de-la-aplicación)
8. [Documentación Adicional](#-documentación-adicional)
9. [Solución de Problemas](#-solución-de-problemas)
10. [Equipo de Desarrollo](#-equipo-de-desarrollo)

---

## 🎯 Descripción del Proyecto

**Skill.IA** es una plataforma inteligente diseñada para ayudar a profesionales a descubrir su verdadero potencial. El sistema:

- ✅ **Evalúa competencias técnicas, blandas y de idioma inglés** a través de evaluaciones breves y personalizadas
- ✅ **Genera un diagnóstico claro** de la situación actual del usuario
- ✅ **Crea roadmaps de desarrollo profesional adaptativos** organizados en orden lógico
- ✅ **Acompaña con un agente conversacional inteligente** que ofrece orientación, recomendaciones y soporte emocional

### 🎭 Caso de Uso

**Daniela**, analista de datos con 3 años de experiencia, domina Excel y SQL básico, pero se siente abrumada por las múltiples opciones de aprendizaje. **Skill.IA** le ayuda a:
1. Evaluar honestamente dónde está hoy
2. Visualizar un camino claro y estructurado
3. Recibir guía inteligente que evoluciona con su progreso

---

## ✨ Características Principales

### 🔍 Evaluación Inteligente
- Diagnóstico inicial de competencias técnicas, blandas e inglés
- Preguntas generadas dinámicamente con **Groq AI** (Llama 3.3)
- Evaluación adaptativa según respuestas del usuario

### 🗺️ Roadmap Personalizado
- Generación automática de ruta de aprendizaje
- Organización lógica de hitos por dificultad
- Seguimiento de progreso en tiempo real

### 🤖 Agente Conversacional
- Asistente inteligente que evoluciona con el usuario
- Recomendaciones personalizadas
- Soporte emocional y motivacional

### 📊 Gestión de Datos
- Base de datos estructurada con 11 tablas relacionales
- Almacenamiento de perfiles, evaluaciones, roadmaps y progreso
- Sistema de recomendaciones basado en histórico

---

## 📦 Requisitos Previos

Antes de comenzar, asegúrate de tener instalado lo siguiente en tu computadora:

### Software Necesario

| Software | Versión Mínima | Verificar Instalación | Descargar |
|----------|----------------|----------------------|-----------|
| **PHP** | 8.2.29 o superior | `php --version` | [php.net](https://www.php.net/downloads) |
| **Composer** | 2.x | `composer --version` | [getcomposer.org](https://getcomposer.org/download/) |
| **Node.js** | 22.20.0 o superior | `node --version` | [nodejs.org](https://nodejs.org/) |
| **npm** | 10.x | `npm --version` | (incluido con Node.js) |
| **MySQL** | 8.x | `mysql --version` | [mysql.com](https://dev.mysql.com/downloads/) |
| **Git** | 2.x | `git --version` | [git-scm.com](https://git-scm.com/) |

### API Keys Necesarias

- **Groq API Key** (Gratuita): Necesaria para la generación de preguntas con IA
  - Obtener en: [console.groq.com/keys](https://console.groq.com/keys)

### Verificar Instalaciones

Abre una terminal y ejecuta estos comandos:

```powershell
# Verificar PHP
php --version
# Debería mostrar: PHP 8.2.29 (o superior)

# Verificar Composer
composer --version
# Debería mostrar: Composer version 2.x

# Verificar Node.js
node --version
# Debería mostrar: v22.20.0 (o superior)

# Verificar npm
npm --version
# Debería mostrar: 10.x (o superior)

# Verificar MySQL
mysql --version
# Debería mostrar: mysql Ver 8.x
```

---

## 📁 Estructura del Proyecto

```
SenaSoft_2025_Skill.ia/
│
├── 📁 api/                    # Backend - Laravel 12 (PHP)
│   ├── app/                   # Lógica de la aplicación
│   │   ├── Http/              # Controladores y recursos
│   │   ├── Models/            # Modelos Eloquent (11 tablas)
│   │   └── Providers/         # Proveedores de servicios
│   ├── database/              # Base de datos
│   │   ├── csv/               # Datos CSV para seeders
│   │   ├── factories/         # Fábricas de datos de prueba
│   │   ├── migrations/        # Migraciones de tablas
│   │   └── seeders/           # Seeders para poblar BD
│   ├── routes/                # Rutas API y web
│   ├── .env.example           # Plantilla de configuración
│   └── composer.json          # Dependencias PHP
│
├── 📁 web/                    # Frontend - Astro + Vue 3
│   ├── src/
│   │   ├── components/        # Componentes Vue
│   │   │   ├── ChatAgent.vue          # Agente conversacional
│   │   │   ├── DiagnosticQuiz.vue     # Sistema de evaluación
│   │   │   ├── RoadmapView.vue        # Visualización de roadmap
│   │   │   └── LoginForm.vue          # Formulario de login
│   │   ├── lib/               # Servicios
│   │   │   └── ai-service.ts  # Integración con Groq AI
│   │   ├── pages/             # Páginas Astro
│   │   └── styles/            # Estilos globales
│   ├── .env.example           # Plantilla de configuración
│   └── package.json           # Dependencias JavaScript
│
├── 📁 Database/               # Esquemas y DDL
│   ├── Equipo 08 DDL.sql     # Script de creación de BD
│   └── Equipo 08 ERD.md      # Diagrama entidad-relación
│
├── 📁 Documentation/          # Documentación del proyecto
│   ├── SkillIA.md            # Documentación completa
│   ├── Diagrams/             # Diagramas técnicos
│   ├── Mockups/              # Diseños de interfaz
│   └── Technical_Resources/  # Recursos técnicos
│
└── README.md                  # Este archivo
```

---

## 🚀 Instalación Paso a Paso

### 1. Clonar el Repositorio

Abre una terminal (PowerShell en Windows) y ejecuta:

```powershell
# Navega a la carpeta donde quieres guardar el proyecto
cd C:\Users\TuUsuario\Documents

# Clona el repositorio
git clone https://github.com/JhonMendozaR/SenaSoft_2025_Skill.ia.git

# Entra a la carpeta del proyecto
cd SenaSoft_2025_Skill.ia
```

---

### 2. Configurar la Base de Datos

#### 2.1. Iniciar MySQL

1. **Abre MySQL Workbench** o tu cliente MySQL preferido
2. **Conéctate al servidor** MySQL con tu usuario y contraseña

#### 2.2. Crear la Base de Datos

Puedes usar el script DDL incluido o crear manualmente:

**Opción A - Usando el script DDL (Recomendado):**

```powershell
# En la terminal, desde la raíz del proyecto
cd Database

# Ejecutar el script (ajusta usuario y contraseña según tu configuración)
mysql -u root -p < "Equipo 08 DDL.sql"
# Cuando pida contraseña, ingresa tu contraseña de MySQL
```

**Opción B - Manualmente en MySQL Workbench:**

1. Abre el archivo `Database/Equipo 08 DDL.sql` en MySQL Workbench
2. Ejecuta el script completo (Ctrl + Shift + Enter)

#### 2.3. Verificar la Base de Datos

```sql
-- En MySQL Workbench o en la terminal MySQL
SHOW DATABASES;
-- Deberías ver 'Skillai' en la lista

USE Skillai;
SHOW TABLES;
-- Deberías ver 11 tablas:
-- usuarios, competencias, perfiles_objetivo, evaluaciones,
-- resultados_evaluacion, roadmaps, hitos, roadmap_hitos,
-- progreso_usuario, interacciones_agente, recomendaciones
```

---

### 3. Configurar el Backend (API)

#### 3.1. Navegar a la carpeta API

```powershell
cd api
```

#### 3.2. Instalar Dependencias PHP

```powershell
# Instalar dependencias con Composer
composer install
```

**Nota:** Este proceso puede tardar varios minutos. Composer descargará Laravel 12 y todas las dependencias necesarias.

#### 3.3. Instalar Dependencias JavaScript

```powershell
# Instalar dependencias con npm
npm install
```

#### 3.4. Configurar Variables de Entorno

```powershell
# Copiar el archivo de ejemplo
copy .env.example .env
```

Ahora abre el archivo `.env` con un editor de texto (Notepad, Visual Studio Code, etc.) y configura lo siguiente:

```env
# CONFIGURACIÓN DE LA APLICACIÓN
APP_NAME="Skill.IA"
APP_ENV=local
APP_KEY=                           # Se generará en el siguiente paso
APP_DEBUG=true
APP_URL=http://localhost:8000

# CONFIGURACIÓN DE BASE DE DATOS
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Skillai                # Nombre de la base de datos
DB_USERNAME=root                   # Tu usuario de MySQL
DB_PASSWORD=0000                   # Tu contraseña de MySQL

# NOTA: Ajusta DB_USERNAME y DB_PASSWORD según tu configuración local
```

**⚠️ IMPORTANTE:** Los valores de `DB_USERNAME` y `DB_PASSWORD` deben coincidir con tu configuración local de MySQL.

#### 3.5. Generar la Clave de Aplicación

```powershell
# Generar clave única para Laravel
php artisan key:generate
```

Este comando añadirá automáticamente la clave en tu archivo `.env`.

#### 3.6. Ejecutar Migraciones (Opcional)

Si no ejecutaste el script DDL o quieres recrear las tablas:

```powershell
# Ejecutar migraciones
php artisan migrate

# O si quieres recrear desde cero
php artisan migrate:fresh
```

#### 3.7. Poblar la Base de Datos con Datos de Prueba (Opcional)

```powershell
# Ejecutar seeders para agregar datos de ejemplo
php artisan db:seed
```

---

### 4. Configurar el Frontend (Web)

#### 4.1. Navegar a la carpeta Web

```powershell
# Desde la carpeta api, regresa a la raíz
cd ..

# Entra a la carpeta web
cd web
```

#### 4.2. Instalar Dependencias

```powershell
# Instalar todas las dependencias
npm install

# Instalar dependencias adicionales específicas
npm install --save @iconify/vue
npm install groq-sdk
```

**Nota:** El segundo `npm install` ya incluye las dependencias adicionales, pero se mencionan por separado para claridad.

#### 4.3. Obtener API Key de Groq

1. **Ve a** [console.groq.com](https://console.groq.com/keys)
2. **Inicia sesión** o crea una cuenta gratuita
3. **Crea una nueva API key** haciendo clic en "Create API Key"
4. **Copia la clave** generada (empieza con `gsk_...`)

#### 4.4. Configurar Variables de Entorno

```powershell
# Copiar el archivo de ejemplo
copy .env.example .env
```

Abre el archivo `.env` y pega tu API key de Groq:

```env
# Groq API Configuration
# Get your API key from: https://console.groq.com/keys
# IMPORTANTE: Usa PUBLIC_ para que esté disponible en el navegador
PUBLIC_GROQ_API_KEY=gsk_tu_clave_aqui
```

**⚠️ CRÍTICO:** 
- La variable **DEBE** llamarse `PUBLIC_GROQ_API_KEY` (con el prefijo `PUBLIC_`)
- Sin este prefijo, la clave NO estará disponible en el navegador
- Reemplaza `gsk_tu_clave_aqui` con tu clave real de Groq

#### 4.5. Verificar la Integración de Groq (Opcional)

```powershell
# Ejecutar test rápido
node test-groq.js
```

**Resultado esperado:**
```
✅ API Key encontrada: gsk_hE4AO2...
🤖 Probando generación de pregunta con Groq...
✅ Pregunta generada exitosamente:
Texto: ¿Cuál es el propósito de la cláusula 'WHERE' en una consulta SQL?
✨ ¡Todo funciona correctamente! Groq está listo para usar.
```

---

## ▶️ Ejecutar el Proyecto

Una vez completada la instalación, necesitas ejecutar dos servidores: el backend (API) y el frontend (Web).

### Paso 1: Iniciar el Backend (API)

Abre una **nueva terminal** (PowerShell):

```powershell
# Navega a la carpeta del proyecto
cd C:\Users\TuUsuario\Documents\SenaSoft_2025_Skill.ia

# Entra a la carpeta API
cd api

# Inicia el servidor Laravel
php artisan serve
```

**Resultado esperado:**
```
   INFO  Server running on [http://127.0.0.1:8000].

  Press Ctrl+C to stop the server
```

El backend ahora está corriendo en: **http://localhost:8000**

**⚠️ NO CIERRES ESTA TERMINAL** - Debe permanecer abierta mientras usas la aplicación.

---

### Paso 2: Iniciar el Frontend (Web)

Abre una **segunda terminal** (PowerShell):

```powershell
# Navega a la carpeta del proyecto
cd C:\Users\TuUsuario\Documents\SenaSoft_2025_Skill.ia

# Entra a la carpeta web
cd web

# Inicia el servidor Astro
npm run dev
```

**Resultado esperado:**
```
  🚀  astro  v5.14.8 started in 245ms

  ┃ Local    http://localhost:4321/
  ┃ Network  use --host to expose
```

El frontend ahora está corriendo en: **http://localhost:4321**

**⚠️ NO CIERRES ESTA TERMINAL** - Debe permanecer abierta mientras usas la aplicación.

---

### Paso 3: Acceder a la Aplicación

1. **Abre tu navegador web** (Chrome, Firefox, Edge, etc.)
2. **Ve a:** `http://localhost:4321`
3. **¡Listo!** La aplicación debería cargar correctamente

---

## 🎮 Uso de la Aplicación

### Páginas Disponibles

Una vez que la aplicación esté corriendo, puedes acceder a:

| Página | URL | Descripción |
|--------|-----|-------------|
| **Inicio** | `http://localhost:4321/` | Página principal |
| **Login** | `http://localhost:4321/login` | Inicio de sesión |
| **Diagnóstico** | `http://localhost:4321/diagnostic` | Evaluación de competencias |
| **Roadmap** | `http://localhost:4321/roadmap` | Visualización de ruta de aprendizaje |
| **Chat** | `http://localhost:4321/chat` | Agente conversacional IA |

### Flujo de Uso

1. **Registro/Login**
   - Accede a `/login`
   - Crea una cuenta o inicia sesión

2. **Evaluación Diagnóstica**
   - Accede a `/diagnostic`
   - Responde el cuestionario inteligente
   - Las preguntas se generan dinámicamente con Groq AI

3. **Ver tu Roadmap**
   - Accede a `/roadmap`
   - Visualiza tu ruta de aprendizaje personalizada
   - Marca hitos como completados

4. **Interactuar con el Agente IA**
   - Accede a `/chat`
   - Conversa con el asistente inteligente
   - Recibe recomendaciones personalizadas

### Verificar que Groq está Funcionando

1. Abre `/diagnostic`
2. **Abre la consola del navegador** (F12 → Console)
3. Haz clic en "Comenzar Evaluación"
4. En la consola deberías ver:
   ```
   ✅ Groq client initialized successfully
   🤖 Generating question...
   📡 Calling Groq API...
   ✅ Question generated by Groq: [texto único]
   ```
5. Las preguntas serán diferentes cada vez (generadas por IA)

---

## 📚 Documentación Adicional

### Archivos de Documentación

- **`Documentation/SkillIA.md`**: Documentación completa del proyecto con casos de uso detallados
- **`web/GROQ_SETUP.md`**: Guía detallada de configuración de Groq AI
- **`web/IMPLEMENTACION_GROQ.md`**: Detalles técnicos de la integración con Groq

### Diagramas y Recursos

- **`Documentation/Diagrams/`**: Contiene diagramas técnicos
  - `relational-model.png`: Modelo relacional de la base de datos
  - `tool-diagram.png`: Diagrama de herramientas
  - `workflow-ai.png`: Flujo de trabajo del sistema IA

- **`Documentation/Mockups/`**: Diseños de interfaz (5 mockups)

- **`Documentation/Technical_Resources/`**: Recursos técnicos adicionales

### Base de Datos

- **`Database/Equipo 08 DDL.sql`**: Script SQL completo para crear la base de datos
- **`Database/Equipo 08 ERD.md`**: Documentación del modelo entidad-relación con descripción de todas las tablas

### Modelos de Datos (11 Tablas)

1. **usuarios**: Información de usuarios profesionales
2. **competencias**: Catálogo de competencias (técnicas, blandas, idioma)
3. **perfiles_objetivo**: Perfiles profesionales meta
4. **evaluaciones**: Registro de evaluaciones realizadas
5. **resultados_evaluacion**: Resultados detallados por competencia
6. **roadmaps**: Roadmaps personalizados de aprendizaje
7. **hitos**: Catálogo de hitos/objetivos de aprendizaje
8. **roadmap_hitos**: Relación entre roadmaps y hitos
9. **progreso_usuario**: Seguimiento de progreso del usuario
10. **interacciones_agente**: Historial de conversaciones con IA
11. **recomendaciones**: Recomendaciones personalizadas

---

## 🔧 Solución de Problemas

### Problema: "php: command not found"

**Solución:**
- Verifica que PHP esté instalado: `php --version`
- Si no está instalado, descárgalo de [php.net](https://www.php.net/downloads)
- Asegúrate de que PHP esté en el PATH del sistema

---

### Problema: "composer: command not found"

**Solución:**
- Descarga Composer de [getcomposer.org](https://getcomposer.org/download/)
- Instálalo siguiendo las instrucciones para Windows
- Reinicia la terminal después de instalarlo

---

### Problema: Error de conexión a MySQL

**Error:**
```
SQLSTATE[HY000] [1045] Access denied for user 'root'@'localhost'
```

**Solución:**
1. Verifica que MySQL esté corriendo
2. Abre el archivo `api/.env`
3. Verifica que `DB_USERNAME` y `DB_PASSWORD` sean correctos
4. Prueba la conexión con:
   ```powershell
   mysql -u root -p
   # Ingresa tu contraseña
   ```

---

### Problema: "Base de datos 'Skillai' no encontrada"

**Solución:**
```powershell
# Conecta a MySQL
mysql -u root -p

# Crea la base de datos
CREATE DATABASE Skillai;

# O ejecuta el script DDL completo
mysql -u root -p < Database/Equipo\ 08\ DDL.sql
```

---

### Problema: "⚠️ Groq API key not found"

**Solución:**
1. Verifica que el archivo `web/.env` exista
2. Abre `web/.env` y verifica que la variable sea:
   ```env
   PUBLIC_GROQ_API_KEY=gsk_tu_clave_aqui
   ```
3. **IMPORTANTE:** Debe tener el prefijo `PUBLIC_`
4. **Reinicia el servidor** después de modificar el `.env`:
   ```powershell
   # Presiona Ctrl+C para detener el servidor
   npm run dev  # Inicia de nuevo
   ```

---

### Problema: Puerto 8000 u 4321 ya en uso

**Error:**
```
Error: Address already in use
```

**Solución:**

Para el backend (puerto 8000):
```powershell
# Usa un puerto diferente
php artisan serve --port=8001
```

Para el frontend (puerto 4321):
```powershell
# Astro usará automáticamente el siguiente puerto disponible (4322, 4323, etc.)
npm run dev
```

---

### Problema: Error al instalar dependencias

**Error:**
```
npm ERR! code ENOENT
```

**Solución:**
1. Asegúrate de estar en la carpeta correcta (`api` o `web`)
2. Elimina las carpetas de caché:
   ```powershell
   # Para el backend
   rm -r vendor/
   rm composer.lock
   composer install

   # Para el frontend
   rm -r node_modules/
   rm package-lock.json
   npm install
   ```

---

### Problema: Las preguntas no se generan con IA

**Síntomas:**
- La consola muestra: `⚠️ Using mock question generation`
- Las preguntas son siempre las mismas

**Solución:**
1. Verifica tu API key de Groq en `web/.env`
2. Prueba la conexión con:
   ```powershell
   node test-groq.js
   ```
3. Si el test falla:
   - Ve a [console.groq.com/keys](https://console.groq.com/keys)
   - Genera una nueva API key
   - Actualiza `PUBLIC_GROQ_API_KEY` en `web/.env`
   - Reinicia el servidor (`npm run dev`)

---

### Problema: Página en blanco o error 404

**Solución:**
1. Verifica que ambos servidores estén corriendo:
   - Backend: `http://localhost:8000`
   - Frontend: `http://localhost:4321`
2. Revisa la consola del navegador (F12) para ver errores
3. Verifica la terminal del frontend para mensajes de error

---

### Obtener Ayuda Adicional

Si encuentras un problema no listado aquí:

1. **Revisa los logs:**
   - Backend: `api/storage/logs/laravel.log`
   - Frontend: Consola del navegador (F12)

2. **Verifica la documentación:**
   - Laravel: [laravel.com/docs](https://laravel.com/docs)
   - Astro: [docs.astro.build](https://docs.astro.build)
   - Groq: [console.groq.com/docs](https://console.groq.com/docs)

3. **Contacta al equipo:** Ver sección [Equipo de Desarrollo](#-equipo-de-desarrollo)

---

## 👥 Equipo de Desarrollo

**Equipo 8: Tití Devs** - SenaSoft 2025

### José David Campo Márquez
**Business Analyst (BA)**
- Análisis de requerimientos
- Documentación funcional
- Validación de soluciones

### Jhon Alexis Mendoza Rojas
**Quality Assurance (QA)**
- Planificación de pruebas
- Ejecución de tests
- Gestión de incidencias
- GitHub: [@JhonMendozaR](https://github.com/JhonMendozaR)

### Igmar De Jesús Lozada Bolívar
**Developer (Dev)**
- Desarrollo de features
- Análisis técnico
- Integración de sistemas
- Documentación técnica

---

## 📝 Notas Importantes

### Configuración Local vs. Producción

Los valores de configuración incluidos en este README son para **entorno de desarrollo local**. Si vas a desplegar en producción, deberás:

- Usar credenciales seguras de base de datos
- Cambiar `APP_DEBUG=false` en `api/.env`
- Configurar HTTPS
- Usar variables de entorno seguras

### Privacidad y Datos

- **Cumplimiento**: Ley 1581 de 2012 (Habeas Data - Colombia)
- **Datos**: Codificación UTF-8
- **Fechas**: Formato YYYY-MM-DD HH:MM:SS
- **Contexto**: Colombia (COT, UTC-5)

### Tecnologías Utilizadas

**Backend:**
- Laravel 12 (PHP 8.2)
- MySQL 8.x
- Eloquent ORM
- Laravel Sanctum (autenticación)

**Frontend:**
- Astro 5.14.8
- Vue 3.5.22
- Tailwind CSS 4.1.15
- TypeScript

**IA:**
- Groq SDK 0.34.0
- Modelo: Llama 3.3 70B Versatile

---

## 📄 Licencia

Este proyecto fue desarrollado para SenaSoft 2025.

---

## 🎉 ¡Todo Listo!

Si seguiste todos los pasos, deberías tener **Skill.IA** funcionando completamente en tu computadora.

**Recuerda:**
- Mantén ambas terminales abiertas (backend y frontend)
- La API de Groq es esencial para el funcionamiento del diagnóstico
- Puedes modificar los datos de la base de datos según tus necesidades

**¿Problemas?** Revisa la sección [Solución de Problemas](#-solución-de-problemas)

---

**¡Gracias por usar Skill.IA! 🚀**" 
