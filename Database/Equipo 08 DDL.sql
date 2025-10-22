CREATE DATABASE Skillai;
USE Skillai;

-- PROGRES-A — DDL (PostgreSQL / MySQL / SQL Server compatible)
-- Comentarios en español; ajustar tipos de autoincremento según motor.
-- PostgreSQL: usar SERIAL/BIGSERIAL o IDENTITY.
-- MySQL: usar AUTO_INCREMENT.
-- SQL Server: usar IDENTITY(1,1).

-- Limpieza previa (ajustar a su motor antes de ejecutar)
DROP TABLE IF EXISTS recomendaciones;
DROP TABLE IF EXISTS interacciones_agente;
DROP TABLE IF EXISTS progreso_usuario;
DROP TABLE IF EXISTS roadmap_hitos;
DROP TABLE IF EXISTS hitos;
DROP TABLE IF EXISTS roadmaps;
DROP TABLE IF EXISTS resultados_evaluacion;
DROP TABLE IF EXISTS evaluaciones;
DROP TABLE IF EXISTS perfiles_objetivo;
DROP TABLE IF EXISTS competencias;
DROP TABLE IF EXISTS usuarios;

-- =====================================================
-- Tabla: usuarios
-- =====================================================
CREATE TABLE usuarios (
    id_usuario           INTEGER PRIMARY KEY,
    nombres              VARCHAR(120) NOT NULL,
    apellidos            VARCHAR(120) NOT NULL,
    cedula               VARCHAR(15)  NOT NULL UNIQUE,
    telefono             VARCHAR(20)  NOT NULL,
    email                VARCHAR(150) UNIQUE,
    departamento         VARCHAR(80)  NOT NULL,
    ciudad               VARCHAR(80)  NOT NULL,
    barrio               VARCHAR(80)  NOT NULL,
    direccion            VARCHAR(120) NOT NULL,
    experiencia_anos     INTEGER      DEFAULT 0,
    sector               VARCHAR(60),
    aspiracion           VARCHAR(80),
    nivel_ingles_autoreporte VARCHAR(5),
    seniority_autoreporte    VARCHAR(20),
    regimen_vinculacion      VARCHAR(20),
    perfil_objetivo_id   INTEGER,
    fecha_registro       TIMESTAMP    NOT NULL
);
-- IDX
CREATE INDEX idx_usuarios_ciudad ON usuarios (ciudad);
CREATE INDEX idx_usuarios_perfil ON usuarios (perfil_objetivo_id);

-- =====================================================
-- Tabla: competencias (catálogo)
-- =====================================================
CREATE TABLE competencias (
    id_competencia       INTEGER PRIMARY KEY,
    nombre_competencia   VARCHAR(120) NOT NULL UNIQUE,
    tipo                 VARCHAR(20)  NOT NULL,   -- tecnica | blanda | idioma
    descripcion          VARCHAR(255)
);
CREATE INDEX idx_competencias_tipo ON competencias (tipo);

-- =====================================================
-- Tabla: perfiles_objetivo
-- =====================================================
CREATE TABLE perfiles_objetivo (
    id_perfil            INTEGER PRIMARY KEY,
    nombre_perfil        VARCHAR(120) NOT NULL UNIQUE,
    descripcion          VARCHAR(255)
);
CREATE INDEX idx_perfiles_nombre ON perfiles_objetivo (nombre_perfil);

-- =====================================================
-- Tabla: evaluaciones
-- =====================================================
CREATE TABLE evaluaciones (
    id_evaluacion        INTEGER PRIMARY KEY,
    id_usuario           INTEGER NOT NULL,
    tipo_evaluacion      VARCHAR(30) NOT NULL,  -- diagnostico_inicial | seguimiento | final
    modalidad            VARCHAR(20) NOT NULL,  -- tecnico | blando | ingles
    fecha_evaluacion     TIMESTAMP   NOT NULL,
    duracion_minutos     INTEGER     NOT NULL,
    origen               VARCHAR(20) NOT NULL,  -- web | movil | chat_agente
    puntaje_global       DECIMAL(5,2) NOT NULL,
    CONSTRAINT fk_eval_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);
CREATE INDEX idx_eval_usuario ON evaluaciones (id_usuario, fecha_evaluacion);
CREATE INDEX idx_eval_modalidad ON evaluaciones (modalidad);

-- =====================================================
-- Tabla: resultados_evaluacion (N:M evaluaciones-competencias)
-- =====================================================
CREATE TABLE resultados_evaluacion (
    id_resultado         INTEGER PRIMARY KEY,
    id_evaluacion        INTEGER NOT NULL,
    id_competencia       INTEGER NOT NULL,
    nivel                INTEGER NOT NULL,
    puntaje              DECIMAL(5,2) NOT NULL,
    brecha               VARCHAR(15) NOT NULL,
    CONSTRAINT fk_res_eval FOREIGN KEY (id_evaluacion) REFERENCES evaluaciones(id_evaluacion),
    CONSTRAINT fk_res_comp FOREIGN KEY (id_competencia) REFERENCES competencias(id_competencia)
);
CREATE INDEX idx_res_eval ON resultados_evaluacion (id_evaluacion);
CREATE INDEX idx_res_comp ON resultados_evaluacion (id_competencia);

-- =====================================================
-- Tabla: roadmaps
-- =====================================================
CREATE TABLE roadmaps (
    id_roadmap           INTEGER PRIMARY KEY,
    id_usuario           INTEGER NOT NULL,
    id_perfil_objetivo   INTEGER NOT NULL,
    estado               VARCHAR(20) NOT NULL,   -- activo | en_revision | completado
    fecha_creacion       TIMESTAMP   NOT NULL,
    CONSTRAINT fk_rm_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    CONSTRAINT fk_rm_perfil  FOREIGN KEY (id_perfil_objetivo) REFERENCES perfiles_objetivo(id_perfil)
);
CREATE INDEX idx_roadmap_usuario ON roadmaps (id_usuario);
CREATE INDEX idx_roadmap_perfil ON roadmaps (id_perfil_objetivo);

-- =====================================================
-- Tabla: hitos (catálogo)
-- =====================================================
CREATE TABLE hitos (
    id_hito              INTEGER PRIMARY KEY,
    nombre_hito          VARCHAR(150) NOT NULL UNIQUE,
    descripcion          VARCHAR(255),
    tipo                 VARCHAR(20)  NOT NULL,   -- tecnico | blando | idioma | mixto
    dificultad           VARCHAR(10)  NOT NULL,   -- baja | media | alta
    horas_estimadas      INTEGER      NOT NULL
);
CREATE INDEX idx_hitos_tipo ON hitos (tipo, dificultad);

-- =====================================================
-- Tabla: roadmap_hitos (N:M con orden)
-- =====================================================
CREATE TABLE roadmap_hitos (
    id_roadmap_hito      INTEGER PRIMARY KEY,
    id_roadmap           INTEGER NOT NULL,
    id_hito              INTEGER NOT NULL,
    orden                INTEGER NOT NULL,
    CONSTRAINT fk_rmh_rm   FOREIGN KEY (id_roadmap) REFERENCES roadmaps(id_roadmap),
    CONSTRAINT fk_rmh_hito FOREIGN KEY (id_hito) REFERENCES hitos(id_hito)
);
CREATE INDEX idx_rmh_roadmap ON roadmap_hitos (id_roadmap, orden);
CREATE INDEX idx_rmh_hito ON roadmap_hitos (id_hito);

-- =====================================================
-- Tabla: progreso_usuario
-- =====================================================
CREATE TABLE progreso_usuario (
    id_avance            INTEGER PRIMARY KEY,
    id_roadmap_hito      INTEGER NOT NULL,
    estado               VARCHAR(20) NOT NULL,    -- pendiente | en_progreso | completado
    porcentaje_avance    INTEGER NOT NULL,
    fecha_inicio         TIMESTAMP,
    fecha_fin            TIMESTAMP,
    CONSTRAINT fk_prog_rmh FOREIGN KEY (id_roadmap_hito) REFERENCES roadmap_hitos(id_roadmap_hito)
);
CREATE INDEX idx_prog_rmh ON progreso_usuario (id_roadmap_hito);

-- =====================================================
-- Tabla: interacciones_agente
-- =====================================================
CREATE TABLE interacciones_agente (
    id_interaccion       INTEGER PRIMARY KEY,
    id_usuario           INTEGER NOT NULL,
    fecha_hora           TIMESTAMP NOT NULL,
    intencion            VARCHAR(30) NOT NULL,
    tono_agente          VARCHAR(20) NOT NULL,
    canal                VARCHAR(20) NOT NULL,
    duracion_segundos    INTEGER NOT NULL,
    satisfaccion_usuario INTEGER,
    texto_resumen        VARCHAR(255),
    CONSTRAINT fk_int_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);
CREATE INDEX idx_int_usuario ON interacciones_agente (id_usuario, fecha_hora);

-- =====================================================
-- Tabla: recomendaciones
-- =====================================================
CREATE TABLE recomendaciones (
    id_recomendacion     INTEGER PRIMARY KEY,
    id_usuario           INTEGER NOT NULL,
    fecha_hora           TIMESTAMP NOT NULL,
    categoria            VARCHAR(40) NOT NULL,   -- prioridad_aprendizaje | material_estudio | habito | idioma
    detalle              VARCHAR(255) NOT NULL,
    justificacion        VARCHAR(255),
    CONSTRAINT fk_rec_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);
CREATE INDEX idx_rec_usuario ON recomendaciones (id_usuario, fecha_hora);

-- =====================================================
-- Comentarios generales
-- =====================================================
-- 1) Asegurar zonas horarias (COT, UTC-5) en la capa de aplicación.
-- 2) Añadir restricciones CHECK según soporte del motor.
-- 3) Considerar enmascaramiento/Tokenización de cédula para analítica.
-- 4) Implementar retención y anonimización conforme a Ley 1581/2012 (Habeas Data).
