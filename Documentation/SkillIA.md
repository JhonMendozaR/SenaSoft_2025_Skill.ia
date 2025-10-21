# Skill.IA

## Desbloqueando el Potencial: Guía para el Desarrollo Profesional

**Proyecto desarrollado para SenaSoft 2025.**

**Skill.ia** es una plataforma inteligente diseñada para ayudar a los profesionales a descubrir su verdadero potencial. Evalúa de forma precisa las habilidades técnicas, blandas y de inglés del usuario mediante evaluaciones breves y personalizadas, generando un diagnóstico claro sobre su situación actual. Con base en esos resultados, crea una ruta de desarrollo profesional adaptativa que organiza metas y aprendizajes en orden lógico según el perfil y las aspiraciones de cada persona. A medida que el usuario avanza, un agente conversacional inteligente lo acompaña, ofreciendo orientación, recomendaciones y apoyo emocional que evolucionan junto a su progreso. Toda la información se gestiona en una base de datos estructurada que almacena su perfil, resultados, hitos alcanzados y nivel de avance, permitiendo que el sistema aprenda de su trayectoria y brinde siempre una guía relevante y personalizada hacia su crecimiento profesional.

---

## Conoce nuestro equipo

### José David Campo Marquez — **Business Analyst (BA)**

**Responsabilidades principales:**

- **Levantamiento de requerimientos**
- **Análisis funcional:** historias de usuario, casos de uso, requerimientos funcionales.
- **Documentación:** Mantener actualizados los documentos funcionales, diagramas de flujo o modelos de procesos.
- **Validación:** Asegurar que la solución final cumpla con los objetivos del negocio.


### Jhon Alexis Mendoza Rojas — **Quality Assurance (QA)**

**Responsabilidades principales:**

- **Planificación de pruebas:** Diseñar estrategias, planes y casos de prueba (manuales o automatizados).
- **Ejecución de pruebas:** Probar la aplicación para detectar errores o inconsistencias (funcionales, de usabilidad, de rendimiento, etc.).
- **Gestión de incidencias:** Registrar, priorizar y dar seguimiento a los bugs encontrados.
- **Verificación de entregas:** Validar que las correcciones cumplan con lo esperado sin afectar otras funcionalidades.
- **Mejora continua:** Proponer mejoras en la calidad del proceso de desarrollo.


### Igmar De Jesus Lozada Bolivar — **Developer (Dev)**

**Responsabilidades principales:**

- **Desarrollo de funcionalidades:** Escribir, probar y mantener el código del sistema.
- **Análisis técnico:** Evaluar la viabilidad de las soluciones propuestas y estimar tiempos.
- **Integración:** Conectar diferentes módulos, APIs o servicios según sea necesario.
- **Revisión de código:** Participar en code reviews para mantener la calidad del código.
- **Corrección de errores:** Solucionar defectos reportados por QA o usuarios.
- **Documentación técnica:** Registrar la arquitectura, dependencias y decisiones de diseño.

---

## Prototipo a construir

El prototipo de Skill.ia será una plataforma web funcional que integre las tres piezas fundamentales del sistema: diagnóstico de habilidades, generación de ruta personalizada (roadmap vivo) y acompañamiento inteligente. Su objetivo será demostrar cómo el sistema identifica el nivel actual de un usuario, construye una ruta de aprendizaje a medida y ofrece orientación dinámica a través de un agente conversacional que evoluciona según el progreso del usuario.

### Objetivo

Demostrar la viabilidad técnica y funcional de un sistema inteligente de desarrollo profesional, capaz de diagnosticar las habilidades actuales de un usuario, generar una ruta personalizada de aprendizaje (roadmap vivo) y ofrecer acompañamiento conversacional adaptativo que evoluciona con su progreso.

### Módulos principales del prototipo

**1. Módulo de registro y perfil del usuario**

- **Objetivo**: recopilar los datos personales y profesionales básicos del usuario.
- **Elementos clave**:
    - Formulario de registro con campos definidos en la tabla usuarios (nombre, sector, experiencia, aspiración, nivel de inglés, etc.).
    - Validación y almacenamiento de la información en la base de datos.
    - Panel de perfil donde el usuario puede actualizar su información.

**2. Módulo de diagnóstico inicial**

- **Objetivo**: evaluar las competencias técnicas, blandas e idiomáticas del usuario.
- **Funcionamiento**:
    - Cuestionarios cortos de tipo “quiz” (por ejemplo, selección múltiple o escala de autoevaluación).
    - Al finalizar, los resultados se guardan en evaluaciones y resultados_evaluacion.
    - El sistema genera un informe visual de diagnóstico que muestra fortalezas, brechas y un puntaje global.
    - Se calcula el nivel por competencia y se determina el perfil base del usuario (asociado a perfiles_objetivo).

**3. Generador de ruta de aprendizaje**

- **Objetivo**: crear una ruta de desarrollo personalizada con base en el diagnóstico.
- **Funcionamiento**:
    - El sistema analiza los resultados de las evaluaciones y selecciona hitos apropiados desde el catálogo hitos.
    - Crea un registro en roadmaps asociado al usuario y su perfil objetivo.
    - Organiza los hitos en orden lógico (por nivel de dificultad) dentro de roadmap_hitos.
    - Muestra al usuario una interfaz tipo “línea de progreso” con sus hitos, estado y porcentaje de avance.
    - Permite marcar hitos como “en progreso” o “completado”, actualizando la tabla progreso_usuario.

**4. Agente conversacional inteligente**

- **Objetivo**: acompañar al usuario durante su desarrollo, adaptando su tono y tipo de orientación según el avance.
- **Características**:
    - Interfaz tipo chat integrada en la plataforma (usando API de modelo de lenguaje).
    - Registro de cada interacción en interacciones_agente, incluyendo intención, tono, canal y nivel de satisfacción.
    - El agente:
        - Explica conceptos cuando el usuario inicia (modo tutor).
        - Motiva y ofrece recursos cuando hay progreso lento (modo coach).
        - Propone desafíos o reflexiones cuando el usuario avanza (modo mentor).
    - Capacidad de generar recomendaciones automáticas (guardadas en recomendaciones) sobre hábitos, recursos de aprendizaje o refuerzo en idiomas.

**5. Panel de progreso y visualización**

- **Objetivo**: ofrecer una vista clara del avance del usuario.
- **Funciones**:
    - Barra de progreso general y por competencia.
    - Historial de hitos completados con tiempo invertido y fecha de finalización.
    - Sección de “logros desbloqueados” o reconocimientos simbólicos (gamificación ligera).
    - Gráficos de evolución de puntaje entre evaluaciones (diagnóstico → seguimiento → final).


### Arquitectura del prototipo

| Componente        | Tecnología propuesta                                           | Descripción                                                                  |
| ----------------- | -------------------------------------------------------------- | ---------------------------------------------------------------------------- |
| **Frontend**      | HTML5, CSS3, JavaScript (framework: Astro y Vue.js)    | Interfaz moderna, responsiva y accesible.                                    |
| **Backend**       | PHP/Laravel                                            | Gestión de lógica de negocio, API REST y comunicación con BD.                |
| **Base de datos** | MySQL                               | Almacenamiento estructurado de usuarios, evaluaciones, roadmaps y progresos. |
| **Agente IA**     | API de modelo de lenguaje                 | Procesamiento de conversaciones y generación de respuestas adaptativas.      |
| **Autenticación** | Laravel Sanctum                                                | Para manejo de usuarios y acceso privado a información.                      |


### Flujo principal de usuario

- Registro / Inicio de sesión.
- Evaluación diagnóstica inicial.
- Visualización del diagnóstico con su perfil base.
- Generación automática del roadmap.
- Interacción con el agente inteligente para orientación.
- Actualización de progreso al completar hitos.
- Evaluación de seguimiento y ajustes automáticos del roadmap.


### Alcance del prototipo

El alcance incluye:

1. **Captura y gestión de información del usuario**

    - Registro y autenticación de usuarios.
    - Creación y almacenamiento del perfil profesional (datos personales, sector, aspiración, experiencia, nivel de inglés, etc.).
    - Asociación del usuario con un perfil objetivo dentro del sistema.

2. **Diagnóstico inicial de competencias**

    - Ejecución de una evaluación diagnóstica simplificada para medir habilidades técnicas, blandas y de idioma.
    - Registro de los resultados en las tablas evaluaciones y resultados_evaluacion.
    - Generación automática de un perfil de habilidades visual (fortalezas y brechas).

3. **Generación automática de la ruta de aprendizaje**

    - Creación dinámica de un roadmap personalizado en función de los resultados del diagnóstico.
    - Selección de hitos desde el catálogo (hitos) y organización secuencial dentro de roadmap_hitos.
    - Visualización del progreso del usuario y actualización del estado de los hitos (progreso_usuario).

4. **Acompañamiento inteligente**

    - Integración de un agente conversacional con respuestas generadas mediante IA o guiones predefinidos.
    - Registro de cada interacción en la tabla interacciones_agente, incluyendo intención y tono del mensaje.
    - Generación automática de recomendaciones personalizadas almacenadas en recomendaciones (por ejemplo, materiales de estudio o hábitos de aprendizaje).

5. **Visualización y seguimiento del progreso**

    - Panel de usuario con indicadores de avance por competencia y estado general del roadmap.
    - Historial de evaluaciones y comparativa entre puntajes iniciales y de seguimiento.
    - Representación gráfica del progreso para reforzar la percepción de logro y motivación.

**Fuera del alcance**

Para mantener el prototipo dentro de los límites de tiempo y complejidad razonables, no incluirá:

- Integraciones con plataformas externas de cursos (como Coursera o Udemy).
- Evaluaciones avanzadas con calificación automática de ejercicios prácticos.
- Personalización por voz o procesamiento de audio.
- Algoritmos de machine learning para predicción de desempeño (se simularán reglas base).

---

