# Diagnóstico de Habilidades Profesionales - Integración con IA

## Descripción General

Este módulo implementa la interfaz de diagnóstico inicial de Skill.IA, un sistema adaptativo que evalúa habilidades técnicas, soft skills y dominio de inglés mediante un quiz interactivo potenciado por IA.

## Características Implementadas

### Componentes Desarrollados

1. **DiagnosticQuiz.vue** - Componente principal de Vue
   - Pantalla de introducción con detalles del diagnóstico
   - Sistema de quiz interactivo con barra de progreso
   - Pantalla de resultados con análisis visual
   - Integración completa con servicio de IA

2. **diagnostic.astro** - Página de Astro
   - Integra el componente Vue con hidratación client-side
   - Layout responsive y accesible

3. **ai-service.ts** - Capa de Inteligencia Artificial (TCL AI)
   - Servicio de generación de preguntas adaptativas
   - Análisis de respuestas en tiempo real
   - Generación de diagnóstico personalizado
   - Sistema de detección de patrones de aprendizaje

## Arquitectura de Inteligencia Artificial

### Estructura del Servicio

```typescript
DiagnosticAIService
├── generateNextQuestion() - Genera preguntas adaptativas
├── analyzeAnswer() - Analiza respuestas del usuario
├── generateDiagnostic() - Crea informe final
└── detectLearningPatterns() - Identifica estilos de aprendizaje
```

### Tipos de Preguntas

- **Multiple Choice**: Preguntas con opciones predefinidas
- **Confidence Scale**: Escalas de confianza/frecuencia (1-5)
- **Practical** (futuro): Ejercicios prácticos evaluables

### Categorías Evaluadas

1. **Habilidades Técnicas**: SQL, Python, Excel, ML, Visualización
2. **Soft Skills**: Trabajo en equipo, comunicación, liderazgo
3. **Dominio de Inglés**: Comprensión, escritura técnica, conversacional

## Flujo de Usuario

```
1. Introducción
   ↓
2. Iniciar Quiz
   ↓
3. Pregunta Adaptativa (Generada por IA)
   ↓
4. Usuario Responde
   ↓
5. IA Analiza Respuesta
   ↓
6. ¿Más preguntas? → Sí: Volver a 3 | No: Siguiente
   ↓
7. Generar Diagnóstico Final
   ↓
8. Mostrar Resultados con Feedback
```

## Características de UI/UX

### Diseño Visual

- **Tema**: Dark mode con gradientes cyan/purple
- **Animaciones**: Transiciones suaves entre estados
- **Responsive**: Diseño adaptable mobile-first
- **Accesibilidad**: Contraste WCAG AA, navegación por teclado

### Componentes Interactivos

1. **Barra de Progreso**
   - Actualización en tiempo real
   - Indicador porcentual
   - Animación de transición fluida

2. **Tarjetas de Opciones**
   - Hover states con feedback visual
   - Selección con indicador circular
   - Animación de confirmación

3. **Pantalla de Resultados**
   - Barras de desempeño por categoría
   - Clasificación por niveles (Básico/Intermedio/Avanzado)
   - Código de colores semántico
   - Feedback personalizado

## Integración con IA

### Estado Actual: Simulación Local

El sistema actualmente funciona con **datos mockeados** para demostración. Las funciones están preparadas para integración real con LLMs.

### Próximos Pasos para Integración Real

1. **Configurar API Keys**
   ```typescript
   const config: AgentConfig = {
     questionGenerator: {
       provider: 'openai',
       model: 'gpt-4',
       apiKey: process.env.OPENAI_API_KEY
     }
   }
   ```

2. **Implementar Llamadas HTTP**
   - Reemplazar funciones mock por llamadas reales
   - Agregar manejo de errores y reintentos
   - Implementar caché de respuestas

3. **Conectar con Backend Laravel**
   - Guardar respuestas en base de datos
   - Persistir resultados del diagnóstico
   - Crear registros de evaluación

## Modelo de Datos

### Respuesta del Usuario

```typescript
interface Answer {
  questionId: string;
  answer: string;
  value: number;
  timestamp: Date;
}
```

### Resultado del Diagnóstico

```typescript
interface DiagnosticResult {
  category: string;          // "Habilidades Técnicas"
  score: number;             // 0-100
  level: string;             // Básico | Intermedio | Avanzado
  feedback: string;          // Retroalimentación personalizada
  recommendations?: string[]; // Lista de recomendaciones
}
```

## Uso

### Acceder a la Página

```
http://localhost:4321/diagnostic
```

### Integrar en Otra Página

```astro
---
import DiagnosticQuiz from '../components/DiagnosticQuiz.vue';

const userProfile = {
  name: 'Juan Pérez',
  sector: 'Tecnología',
  experience: '3-5 años'
};
---

<DiagnosticQuiz client:load userProfile={userProfile} />
```

### Usar el Servicio de IA Directamente

```typescript
import { useDiagnosticAI } from '../lib/ai-service';

const aiService = useDiagnosticAI({
  name: 'Test User',
  sector: 'Tech'
});

const question = await aiService.generateNextQuestion();
```

## Testing

### Escenarios de Prueba

1. Usuario completa diagnóstico normalmente
2. Usuario retrocede a pregunta anterior
3. Sistema adapta dificultad según respuestas
4. Generación correcta de resultados por categoría
5. Manejo de errores de red
6. Recuperación de sesión interrumpida

## Notas Técnicas

### Dependencias

- Vue 3 Composition API
- TypeScript 5+
- Astro 4+

### Consideraciones de Performance

- Componente con `client:load` para interactividad inmediata
- Lazy loading de datos de IA
- Debouncing en análisis de respuestas
- Caché de preguntas generadas

### Mejoras Futuras

- [ ] Persistencia local con IndexedDB
- [ ] Modo offline con service workers
- [ ] Exportación de resultados en PDF
- [ ] Compartir resultados en redes sociales
- [ ] Dashboard de progreso histórico
- [ ] Comparación con benchmarks de la industria

## Seguridad y Privacidad

- Sin envío de datos personales sensibles sin consentimiento
- Almacenamiento local encriptado (futuro)
- Cumplimiento con GDPR y políticas de privacidad
- API keys en variables de entorno

## Soporte

Para dudas sobre la implementación, consultar:
- Documentación técnica en `Documentation/SkillIA.md`
- Issues en el repositorio
- Equipo Tití Devs - SenaSoft 2025

---

**Desarrollado por Equipo 08: Tití Devs**
*SenaSoft 2025 - Unlocking Potential: Skill.IA*
