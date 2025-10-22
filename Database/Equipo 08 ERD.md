PLATAFORMA DE DESARROLLO DE PERFILES (PROGRES-A) — ERD / DICCIONARIO DE DATOS (TXT)
Contexto: Colombia (COT, UTC-5). Cumplimiento: Ley 1581 de 2012 (Habeas Data), SARLAFT (cuando aplique a pagos), buenas prácticas DAMA-DMBOK.
Codificación: UTF-8. Fechas: YYYY-MM-DD HH:MM:SS. Booleanos: 0/1 o 'true'/'false' según motor.

═══════════════════════════════════════════════════════════════════════════════
ENTIDAD 1: USUARIOS
═══════════════════════════════════════════════════════════════════════════════
Descripción: Personas usuarias de la plataforma (profesionales en Colombia/LATAM).
Columnas
───────────────────────────────────────────────────────────────────────────────
id_usuario               INTEGER          PK, NOT NULL, AUTOINCREMENT
nombres                  VARCHAR(120)     NOT NULL
apellidos                VARCHAR(120)     NOT NULL
cedula                   VARCHAR(15)      UNIQUE, NOT NULL      -- Cédula CO ficticia
telefono                 VARCHAR(20)      NOT NULL              -- Celular CO (3XX...)
email                    VARCHAR(150)     UNIQUE, NULL
departamento             VARCHAR(80)      NOT NULL
ciudad                   VARCHAR(80)      NOT NULL
barrio                   VARCHAR(80)      NOT NULL
direccion                VARCHAR(120)     NOT NULL              -- Calle/Carrera/Transversal/Diagonal # N-M
experiencia_anos         INTEGER          DEFAULT 0, CHECK (experiencia_anos >= 0)
sector                   VARCHAR(60)      NULL                  -- Retail, Finanzas, etc.
aspiracion               VARCHAR(80)      NULL                  -- Meta profesional
nivel_ingles_autoreporte VARCHAR(5)       NULL                  -- A2/B1/B2/C1
seniority_autoreporte    VARCHAR(20)      NULL                  -- Junior/Semisenior/Senior
regimen_vinculacion      VARCHAR(20)      NULL                  -- Empleado/Contratista/Freelancer
perfil_objetivo_id       INTEGER          FK -> PERFILES_OBJETIVO.id_perfil
fecha_registro           TIMESTAMP        NOT NULL

Índices:
  - idx_usuarios_email (email)
  - idx_usuarios_ciudad (ciudad)
  - idx_usuarios_perfil (perfil_objetivo_id)

═══════════════════════════════════════════════════════════════════════════════
ENTIDAD 2: COMPETENCIAS
═══════════════════════════════════════════════════════════════════════════════
Descripción: Catálogo de competencias técnicas, blandas e idioma.
Columnas
───────────────────────────────────────────────────────────────────────────────
id_competencia           INTEGER          PK, NOT NULL, AUTOINCREMENT
nombre_competencia       VARCHAR(120)     UNIQUE, NOT NULL
tipo                     VARCHAR(20)      NOT NULL              -- tecnica | blanda | idioma
descripcion              VARCHAR(255)     NULL

Índices:
  - idx_competencias_tipo (tipo)

═══════════════════════════════════════════════════════════════════════════════
ENTIDAD 3: PERFILES_OBJETIVO
═══════════════════════════════════════════════════════════════════════════════
Descripción: Roles meta (Analista, Ingeniero de Datos, etc.).
Columnas
───────────────────────────────────────────────────────────────────────────────
id_perfil                INTEGER          PK, NOT NULL, AUTOINCREMENT
nombre_perfil            VARCHAR(120)     UNIQUE, NOT NULL
descripcion              VARCHAR(255)     NULL

Índices:
  - idx_perfiles_nombre (nombre_perfil)

═══════════════════════════════════════════════════════════════════════════════
ENTIDAD 4: EVALUACIONES
═══════════════════════════════════════════════════════════════════════════════
Descripción: Aplicaciones de diagnóstico/seguimiento por usuario.
Columnas
───────────────────────────────────────────────────────────────────────────────
id_evaluacion            INTEGER          PK, NOT NULL, AUTOINCREMENT
id_usuario               INTEGER          FK -> USUARIOS.id_usuario, NOT NULL
tipo_evaluacion          VARCHAR(30)      NOT NULL              -- diagnostico_inicial | seguimiento | final
modalidad                VARCHAR(20)      NOT NULL              -- tecnico | blando | ingles
fecha_evaluacion         TIMESTAMP        NOT NULL
duracion_minutos         INTEGER          NOT NULL, CHECK (duracion_minutos BETWEEN 1 AND 120)
origen                   VARCHAR(20)      NOT NULL              -- web | movil | chat_agente
puntaje_global           DECIMAL(5,2)     NOT NULL              -- 0.00-100.00

Índices:
  - idx_eval_usuario (id_usuario, fecha_evaluacion)
  - idx_eval_modalidad (modalidad)

═══════════════════════════════════════════════════════════════════════════════
ENTIDAD 5: RESULTADOS_EVALUACION
═══════════════════════════════════════════════════════════════════════════════
Descripción: Resultados por competencia dentro de una evaluación.
Columnas
───────────────────────────────────────────────────────────────────────────────
id_resultado             INTEGER          PK, NOT NULL, AUTOINCREMENT
id_evaluacion            INTEGER          FK -> EVALUACIONES.id_evaluacion, NOT NULL
id_competencia           INTEGER          FK -> COMPETENCIAS.id_competencia, NOT NULL
nivel                    INTEGER          NOT NULL, CHECK (nivel BETWEEN 1 AND 5)
puntaje                  DECIMAL(5,2)     NOT NULL              -- 0.00-100.00
brecha                   VARCHAR(15)      NOT NULL              -- alta | media | baja | sin_brecha

Índices:
  - idx_res_eval (id_evaluacion)
  - idx_res_comp (id_competencia)

═══════════════════════════════════════════════════════════════════════════════
ENTIDAD 6: ROADMAPS
═══════════════════════════════════════════════════════════════════════════════
Descripción: Ruta de desarrollo viva por usuario hacia un perfil objetivo.
Columnas
───────────────────────────────────────────────────────────────────────────────
id_roadmap               INTEGER          PK, NOT NULL, AUTOINCREMENT
id_usuario               INTEGER          FK -> USUARIOS.id_usuario, NOT NULL
id_perfil_objetivo       INTEGER          FK -> PERFILES_OBJETIVO.id_perfil, NOT NULL
estado                   VARCHAR(20)      NOT NULL              -- activo | en_revision | completado
fecha_creacion           TIMESTAMP        NOT NULL

Índices:
  - idx_roadmap_usuario (id_usuario)
  - idx_roadmap_perfil (id_perfil_objetivo)

═══════════════════════════════════════════════════════════════════════════════
ENTIDAD 7: HITOS
═══════════════════════════════════════════════════════════════════════════════
Descripción: Catálogo de hitos (técnicos, blandos, idioma, mixtos).
Columnas
───────────────────────────────────────────────────────────────────────────────
id_hito                  INTEGER          PK, NOT NULL, AUTOINCREMENT
nombre_hito              VARCHAR(150)     UNIQUE, NOT NULL
descripcion              VARCHAR(255)     NULL
tipo                     VARCHAR(20)      NOT NULL              -- tecnico | blando | idioma | mixto
dificultad               VARCHAR(10)      NOT NULL              -- baja | media | alta
horas_estimadas          INTEGER          NOT NULL, CHECK (horas_estimadas BETWEEN 1 AND 80)

Índices:
  - idx_hitos_tipo (tipo, dificultad)

═══════════════════════════════════════════════════════════════════════════════
ENTIDAD 8: ROADMAP_HITOS
═══════════════════════════════════════════════════════════════════════════════
Descripción: Secuencia ordenada de hitos dentro de un roadmap (N:M).
Columnas
───────────────────────────────────────────────────────────────────────────────
id_roadmap_hito          INTEGER          PK, NOT NULL, AUTOINCREMENT
id_roadmap               INTEGER          FK -> ROADMAPS.id_roadmap, NOT NULL
id_hito                  INTEGER          FK -> HITOS.id_hito, NOT NULL
orden                    INTEGER          NOT NULL              -- orden de ejecución

Índices:
  - idx_rmh_roadmap (id_roadmap, orden)
  - idx_rmh_hito (id_hito)

═══════════════════════════════════════════════════════════════════════════════
ENTIDAD 9: PROGRESO_USUARIO
═══════════════════════════════════════════════════════════════════════════════
Descripción: Avance del usuario por hito del roadmap.
Columnas
───────────────────────────────────────────────────────────────────────────────
id_avance                INTEGER          PK, NOT NULL, AUTOINCREMENT
id_roadmap_hito          INTEGER          FK -> ROADMAP_HITOS.id_roadmap_hito, NOT NULL
estado                   VARCHAR(20)      NOT NULL              -- pendiente | en_progreso | completado
porcentaje_avance        INTEGER          NOT NULL, CHECK (porcentaje_avance BETWEEN 0 AND 100)
fecha_inicio             TIMESTAMP        NULL
fecha_fin                TIMESTAMP        NULL

Índices:
  - idx_prog_rmh (id_roadmap_hito)

═══════════════════════════════════════════════════════════════════════════════
ENTIDAD 10: INTERACCIONES_AGENTE
═══════════════════════════════════════════════════════════════════════════════
Descripción: Registro de conversaciones del agente con la persona usuaria.
Columnas
───────────────────────────────────────────────────────────────────────────────
id_interaccion           INTEGER          PK, NOT NULL, AUTOINCREMENT
id_usuario               INTEGER          FK -> USUARIOS.id_usuario, NOT NULL
fecha_hora               TIMESTAMP        NOT NULL
intencion                VARCHAR(30)      NOT NULL              -- diagnostico | consulta_hito | recomendacion | seguimiento | motivacion
tono_agente              VARCHAR(20)      NOT NULL          -- empatico | directo | estrategico | didactico
canal                    VARCHAR(20)      NOT NULL              -- web | movil | whatsapp | email
duracion_segundos        INTEGER          NOT NULL, CHECK (duracion_segundos BETWEEN 1 AND 7200)
satisfaccion_usuario     INTEGER          NULL, CHECK (satisfaccion_usuario BETWEEN 1 AND 5)
texto_resumen            VARCHAR(255)     NULL

Índices:
  - idx_int_usuario (id_usuario, fecha_hora)

═══════════════════════════════════════════════════════════════════════════════
ENTIDAD 11: RECOMENDACIONES
═══════════════════════════════════════════════════════════════════════════════
Descripción: Recomendaciones accionables generadas por el agente.
Columnas
───────────────────────────────────────────────────────────────────────────────
id_recomendacion         INTEGER          PK, NOT NULL, AUTOINCREMENT
id_usuario               INTEGER          FK -> USUARIOS.id_usuario, NOT NULL
fecha_hora               TIMESTAMP        NOT NULL
categoria                VARCHAR(40)      NOT NULL              -- prioridad_aprendizaje | material_estudio | habito | idioma
detalle                  VARCHAR(255)     NOT NULL
justificacion            VARCHAR(255)     NULL

Índices:
  - idx_rec_usuario (id_usuario, fecha_hora)

═══════════════════════════════════════════════════════════════════════════════
RELACIONES ENTRE ENTIDADES
═══════════════════════════════════════════════════════════════════════════════
(Ver sección con enumeración de relaciones en el archivo DDL y el resumen ASCII más abajo.)

───────────────────────────────────────────────────────────────────────────────
DIAGRAMA ASCII (RESUMEN)
───────────────────────────────────────────────────────────────────────────────
USUARIOS (1) ──< EVALUACIONES >── RESULTADOS_EVALUACION >── COMPETENCIAS
    │
    └──< ROADMAPS >──< ROADMAP_HITOS >── HITOS
            │
            └──< PROGRESO_USUARIO

USUARIOS (1) ──< INTERACCIONES_AGENTE
USUARIOS (1) ──< RECOMENDACIONES
PERFILES_OBJETIVO (1) ──< ROADMAPS

───────────────────────────────────────────────────────────────────────────────
REGLAS DE NEGOCIO
───────────────────────────────────────────────────────────────────────────────
1. Cada roadmap debe apuntar a un perfil objetivo definido y tener un estado (activo/en revisión/completado).
2. Un diagnóstico inicial (tipo_evaluacion='diagnostico_inicial') debe existir antes de un roadmap 'activo' (validación de aplicación).
3. Las recomendaciones deben vincularse a necesidades detectadas en evaluaciones o brechas (trazabilidad).
4. El agente varía el tono según el progreso: mayor exigencia cuando porcentaje_avance ≥ 60%.
5. Se respeta el principio de minimización: datos personales limitados al propósito; no se almacenan datos sensibles innecesarios.

───────────────────────────────────────────────────────────────────────────────
NOTAS TÉCNICAS
───────────────────────────────────────────────────────────────────────────────
- Encoding: UTF-8. Timezone COT (UTC-5).
- Formatos: TIMESTAMP 'YYYY-MM-DD HH:MM:SS'.
- Identificadores: AUTOINCREMENT/IDENTITY según motor (SERIAL en PostgreSQL, IDENTITY en SQL Server, AUTO_INCREMENT en MySQL).
- Privacidad: Ley 1581/2012 (Habeas Data) y principios ARCO (Acceso, Rectificación, Cancelación, Oposición). Aviso de privacidad y autorización informada requeridos.
- Seguridad: cifrado en tránsito (TLS), control de acceso por rol (RBAC), mascaramiento de cédulas en vistas analíticas.
- Calidad de datos: validar teléfonos CO, emails, y rangos de puntaje (0–100).
- Nulos: se permiten nulos en campos no críticos para reflejar datos incompletos del usuario.
