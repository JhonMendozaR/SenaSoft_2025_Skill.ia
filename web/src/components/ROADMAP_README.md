# RoadmapView Component

Componente Vue para la visualización y gestión del roadmap personalizado de desarrollo profesional generado con IA.

## Descripción

`RoadmapView.vue` es el componente principal que muestra la ruta de aprendizaje personalizada del usuario. Integra inteligencia artificial para generar y adaptar dinámicamente los hitos de aprendizaje según el progreso del usuario.

## Características Principales

### 1. **Dashboard de Progreso General**
- Visualización del progreso total con barra animada
- Estadísticas de hitos: Completados, En Progreso, Pendientes
- Indicadores visuales con iconos de Material Design

### 2. **Timeline Interactivo de Hitos**
- Línea de tiempo visual que conecta los hitos
- Tarjetas expandibles con información detallada
- Estados visuales diferenciados:
  - **Completado**: Verde con efecto de éxito
  - **En Progreso**: Amarillo con animación pulsante
  - **Pendiente**: Gris transparente

### 3. **Información Detallada de Hitos**
- **Objetivos de Aprendizaje**: Lista clara de metas
- **Recursos Recomendados**: Enlaces a artículos, videos, cursos
- **Metadata**: Tiempo estimado, dificultad, categoría
- **Barra de Progreso**: Para hitos en curso

### 4. **Acciones Interactivas**
- Comenzar módulo (Pendiente → En Progreso)
- Marcar como completado (En Progreso → Completado)
- Revisar contenido (Completados)

### 5. **Integración con IA**
- Generación dinámica de roadmap basado en diagnóstico
- Actualización automática al completar hitos
- Generación de nuevos hitos adaptativos
- Persistencia en localStorage

### 6. **Asistente IA (FAB)**
- Botón flotante para acceder al chat conversacional
- Diseño Material Design
- Animaciones suaves

## Diseño

### Paleta de Colores
```css
--color-primary: #8C1AD9        /* Púrpura principal */
--color-bg-main: #1E1940        /* Fondo oscuro */
--color-bg-secondary: #262473   /* Fondo secundario */
--color-interaction: #4945BF    /* Interacción */
--color-complementary: #4B498C  /* Complementario */
--color-success: #06D6A0        /* Verde éxito */
```

### Tipografía
- **Fuente**: Work Sans (300, 400, 500, 600, 700)
- **Títulos**: 1.5rem - 2.5rem, font-weight: 600-700
- **Cuerpo**: 1rem, font-weight: 400-500
- **Metadatos**: 0.875rem

## Estructura de Datos

### Milestone
```typescript
interface Milestone {
  id: string;
  title: string;
  description: string;
  status: 'pending' | 'in-progress' | 'completed';
  progress: number;                    // 0-100
  estimatedTime: string;               // "2 semanas"
  difficulty: 'Básico' | 'Intermedio' | 'Avanzado';
  category: 'Technical' | 'Soft Skills' | 'English';
  objectives: string[];
  resources: Resource[];
  completedDate?: Date;
  aiGenerated?: boolean;
}
```

### Resource
```typescript
interface Resource {
  title: string;
  url: string;
  type: 'article' | 'video' | 'course' | 'exercise';
}
```

### RoadmapData
```typescript
interface RoadmapData {
  userId: string;
  milestones: Milestone[];
  overallProgress: number;
  generatedDate: Date;
  lastUpdated: Date;
}
```

## Props

```typescript
interface Props {
  diagnosticResults?: DiagnosticResult[];
  userProfile?: UserProfile;
}
```

- `diagnosticResults`: Resultados del diagnóstico previo (opcional)
- `userProfile`: Perfil del usuario (opcional)

## Uso

### Básico
```vue
<template>
  <RoadmapView />
</template>

<script setup>
import RoadmapView from '@/components/RoadmapView.vue';
</script>
```

### Con Props
```vue
<template>
  <RoadmapView 
    :diagnosticResults="results" 
    :userProfile="profile"
  />
</template>

<script setup>
import RoadmapView from '@/components/RoadmapView.vue';

const results = [
  { category: 'Technical', score: 65, level: 'Intermedio', ... }
];

const profile = {
  userId: 'user-123',
  name: 'María García',
  sector: 'Tecnología',
  experience: '3-5 años',
  aspiration: 'Lead Developer'
};
</script>
```

### En Astro
```astro
---
import RoadmapView from '../components/RoadmapView.vue';
---

<RoadmapView client:load />
```

## Integración con IA

El componente utiliza el servicio `useRoadmapAI` de `ai-service.ts`:

```typescript
import { useRoadmapAI } from '../lib/ai-service';

const roadmapAI = useRoadmapAI(userProfile, diagnosticResults);

// Generar roadmap inicial
const roadmap = await roadmapAI.generateRoadmap();

// Actualizar tras completar hitos
const updated = await roadmapAI.updateRoadmap(roadmap, completedIds);

// Generar hito adaptativo
const newMilestone = await roadmapAI.generateAdaptiveMilestone(roadmap);
```

## Responsive

### Desktop (>1024px)
- Layout completo con sidebar de estadísticas
- Timeline vertical con espaciado amplio
- Tarjetas expandibles con animaciones

### Tablet (768px - 1024px)
- Stack de elementos en columna
- Estadísticas en grid 3x1
- Timeline compacta

### Mobile (<768px)
- Layout vertical completo
- Estadísticas en columna única
- Tarjetas de ancho completo
- FAB más pequeño

## Funcionalidades Futuras

- [ ] Integración con backend Laravel
- [ ] Chat con asistente IA en tiempo real
- [ ] Gamificación (badges, puntos, logros)
- [ ] Compartir progreso en redes sociales
- [ ] Exportar roadmap a PDF
- [ ] Notificaciones de hitos próximos
- [ ] Calendario de aprendizaje
- [ ] Comunidad y colaboración entre usuarios

## Flujo de Usuario

1. **Carga Inicial**: Se verifica si existe roadmap guardado
2. **Generación**: Si no existe, la IA genera uno basado en diagnóstico
3. **Visualización**: Usuario ve timeline con hitos personalizados
4. **Interacción**: Puede expandir tarjetas y ver detalles
5. **Progreso**: Al completar hitos, se actualiza el roadmap
6. **Adaptación**: La IA genera nuevos hitos según el avance
7. **Persistencia**: Cambios se guardan en localStorage/backend

## Desarrollo

### Instalar Dependencias
```bash
npm install @iconify/vue
```

### Ejecutar en Dev
```bash
npm run dev
```

### Acceder a la Ruta
```
http://localhost:4321/roadmap
```

## Notas Técnicas

### LocalStorage
El componente guarda temporalmente el roadmap en localStorage:
```javascript
localStorage.setItem('skillIA-roadmap', JSON.stringify(roadmapData));
```

### Animaciones CSS
- Transición `expand` para detalles de hitos
- Animación `pulse` para indicador en progreso
- Hover effects con `transform` y `box-shadow`

### Iconos
Todos los iconos provienen de `@iconify/vue` con el set de Material Design Icons:
- `mdi:map-marker-path`
- `mdi:check-circle`
- `mdi:clock-outline`
- `mdi:robot-excited`

## Contribuir

Este componente es parte del proyecto Skill.IA desarrollado por **Tití Devs** para SenaSoft 2025.

---

**Desarrollado por Tití Devs | SenaSoft 2025**
