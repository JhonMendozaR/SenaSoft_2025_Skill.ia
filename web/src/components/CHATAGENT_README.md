# 🤖 ChatAgent.vue - Agente Conversacional Evolutivo con IA

## Descripción

Componente de chat inteligente que integra un agente conversacional con respuestas generadas mediante IA. Diseñado para proporcionar acompañamiento personalizado durante el desarrollo profesional del usuario.

## Características Principales

### ✨ Funcionalidades

- **Chat en tiempo real** con interfaz limpia y minimalista
- **Respuestas contextuales** basadas en el perfil y progreso del usuario
- **Indicador de escritura** con animación sutil cuando la IA está procesando
- **Sugerencias rápidas** que se adaptan al contexto de la conversación
- **Historial de mensajes** con timestamps
- **Auto-scroll** automático al recibir nuevos mensajes
- **Formato de texto** con soporte básico para Markdown (**negrita**, *cursiva*)

### 🎨 Diseño

- Panel lateral derecho (full height)
- Paleta de colores Skill.IA coherente
- Avatares distintivos para usuario y IA
- Burbujas de mensaje diferenciadas
- Animaciones sutiles y profesionales
- Diseño responsive para móviles

### 🧠 IA Evolutiva

El agente adapta sus respuestas según:
- **Perfil del usuario** (nivel, experiencia, objetivos)
- **Contexto de la conversación** (preguntas previas)
- **Progreso actual** en el roadmap
- **Área de enfoque** (técnicas, soft skills, inglés)

## Props

```typescript
interface Props {
  userProfile?: {
    name: string;           // Nombre del usuario
    currentLevel: string;   // Nivel actual (Básico, Intermedio, Avanzado)
    goals: string[];        // Objetivos de aprendizaje
  };
}
```

## Uso

### Importación básica

```vue
<script setup>
import ChatAgent from '@/components/ChatAgent.vue';
</script>

<template>
  <ChatAgent />
</template>
```

### Con perfil de usuario

```vue
<script setup>
import ChatAgent from '@/components/ChatAgent.vue';

const userProfile = {
  name: 'Carlos',
  currentLevel: 'Intermedio',
  goals: ['Mejorar liderazgo', 'Comunicación efectiva']
};
</script>

<template>
  <ChatAgent :userProfile="userProfile" />
</template>
```

### En página Astro

```astro
---
import BaseLayout from '../layouts/BaseLayout.astro';
import ChatAgent from '../components/ChatAgent.vue';
---

<BaseLayout title="Chat IA">
  <ChatAgent client:load />
</BaseLayout>
```

## Estructura del Mensaje

```typescript
interface Message {
  id: number;
  sender: 'user' | 'ai';
  text: string;
  timestamp: Date;
  suggestions?: string[];  // Sugerencias rápidas opcionales
}
```

## Funcionalidades Detalladas

### 1. Envío de Mensajes

- **Input de texto** con validación
- **Botón de envío** que se desactiva durante el procesamiento
- **Atajos de teclado** (Enter para enviar)
- **Prevención de envíos vacíos**

### 2. Respuestas Contextuales

El sistema detecta palabras clave y genera respuestas personalizadas:

- **"comunicación"** → Sugiere módulos de escucha activa
- **"liderazgo"** → Ofrece ejercicios de delegación
- **"progreso"** → Muestra estadísticas del usuario
- **"ejercicio"** → Propone desafíos prácticos

### 3. Sugerencias Inteligentes

- **Sugerencias contextuales** en la parte inferior del chat
- **Sugerencias rápidas** después de mensajes de IA
- **Chips clicables** que envían respuestas predefinidas

### 4. Indicadores Visuales

- **Estado online/offline** del agente
- **Typing indicator** con 3 puntos animados
- **Timestamps** en cada mensaje
- **Avatares diferenciados** para usuario y IA

### 5. Acciones del Header

- **Minimizar** chat (preparado para implementación futura)
- **Limpiar conversación** con confirmación
- **Info del agente** (nombre y estado)

## Integración con IA Real

Para conectar con un servicio de IA real, modifica la función `generateAIResponse`:

```typescript
const generateAIResponse = async (userQuery: string) => {
  isTyping.value = true;

  try {
    // Llamada a tu servicio de IA
    const response = await fetch('/api/chat', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        message: userQuery,
        userProfile: props.userProfile,
        conversationHistory: messages.value
      })
    });

    const data = await response.json();

    const aiMessage: Message = {
      id: messageIdCounter.value++,
      sender: 'ai',
      text: data.response,
      timestamp: new Date(),
      suggestions: data.suggestions
    };

    messages.value.push(aiMessage);

  } catch (error) {
    console.error('Error:', error);
  } finally {
    isTyping.value = false;
  }
};
```

## Estilos y Paleta de Colores

Utiliza las variables CSS de `global.css`:

```css
--color-primary: #8C1AD9      /* Morado principal */
--color-bg-main: #1E1940      /* Fondo oscuro */
--color-bg-secondary: #262473 /* Fondo secundario */
--color-interaction: #4945BF  /* Azul interacción */
--color-complementary: #4B498C /* Gris complementario */
--color-success: #06D6A0      /* Verde éxito */
```

## Responsive

El componente es completamente responsive con breakpoints:

- **Desktop** (>768px): Panel lateral completo
- **Tablet** (768px): Ajustes de padding y tamaños
- **Mobile** (<480px): Optimización de burbujas y fuentes

## Animaciones

- **fadeInUp**: Aparición de mensajes
- **typing**: Puntos de "escribiendo..."
- **spin**: Icono de carga
- **hover effects**: Botones y chips

## Mejoras Futuras

- [ ] Soporte para archivos adjuntos
- [ ] Mensajes de voz
- [ ] Historial persistente en localStorage/backend
- [ ] Modo minimizado/flotante
- [ ] Notificaciones de nuevos mensajes
- [ ] Temas (claro/oscuro)
- [ ] Búsqueda en el historial
- [ ] Exportar conversación

## Dependencias

- Vue 3 (Composition API)
- @iconify/vue (iconos)
- TypeScript

## Accesibilidad

- Labels ARIA en botones
- Navegación por teclado
- Contraste de colores WCAG AA
- Indicadores visuales claros

## Ejemplo de Conversación

```
Usuario: ¿Cómo puedo mejorar mi comunicación?
IA: ¡Excelente elección! Te recomiendo empezar por el módulo de 
    "Escucha Activa". ¿Quieres que te muestre los detalles?
    [Sí, muéstrame] [Prefiero otro módulo] [¿Qué otros temas hay?]

Usuario: [Click en "Sí, muéstrame"]
IA: Perfecto, te propongo este ejercicio: Durante tu próxima reunión,
    practica la técnica de "parafraseo"...
```

---

**Desarrollado por:** Tití Devs - Equipo 8  
**Proyecto:** SenaSoft 2025 - Skill.IA  
**Versión:** 1.0.0
