<template>
  <div class="chat-agent-container">
    <!-- Header del Chat -->
    <div class="chat-header">
      <div class="agent-info">
        <div class="agent-avatar">
          <Icon icon="mdi:robot-outline" width="24" height="24" />
        </div>
        <div class="agent-details">
          <h3 class="agent-name">Asistente IA</h3>
          <span class="agent-status" :class="{ 'online': isOnline }">
            {{ isOnline ? 'Online' : 'Offline' }}
          </span>
        </div>
      </div>
      <div class="header-actions">
        <button 
          @click="toggleMinimize" 
          class="action-button"
          aria-label="Minimizar chat"
        >
          <Icon icon="mdi:window-minimize" width="20" height="20" />
        </button>
        <button 
          @click="clearChat" 
          class="action-button"
          aria-label="Limpiar conversación"
        >
          <Icon icon="mdi:delete-outline" width="20" height="20" />
        </button>
      </div>
    </div>

    <!-- Área de Mensajes -->
    <div class="chat-messages" ref="messagesContainer">
      <!-- Mensaje de Bienvenida -->
      <div v-if="messages.length === 0" class="welcome-message">
        <Icon icon="mdi:chat-processing-outline" width="48" height="48" class="welcome-icon" />
        <h4>¡Hola! Soy tu asistente de desarrollo profesional</h4>
        <p>¿En qué habilidad te gustaría enfocarte hoy?</p>
      </div>

      <!-- Mensajes de la conversación -->
      <div 
        v-for="(message, index) in messages" 
        :key="index"
        class="message-wrapper"
        :class="message.sender"
      >
        <div class="message-bubble" :class="message.sender">
          <!-- Avatar para mensajes de IA -->
          <div v-if="message.sender === 'ai'" class="message-avatar">
            <Icon icon="mdi:robot-outline" width="20" height="20" />
          </div>

          <!-- Contenido del mensaje -->
          <div class="message-content">
            <p v-html="formatMessage(message.text)"></p>
            <span class="message-time">{{ formatTime(message.timestamp) }}</span>
          </div>

          <!-- Avatar para mensajes de usuario -->
          <div v-if="message.sender === 'user'" class="message-avatar user">
            <Icon icon="mdi:account-circle" width="20" height="20" />
          </div>
        </div>

        <!-- Indicador de sugerencias rápidas (opcional) -->
        <div 
          v-if="message.sender === 'ai' && message.suggestions && message.suggestions.length > 0" 
          class="quick-suggestions"
        >
          <button 
            v-for="(suggestion, idx) in message.suggestions" 
            :key="idx"
            @click="sendQuickResponse(suggestion)"
            class="suggestion-chip"
          >
            {{ suggestion }}
          </button>
        </div>
      </div>

      <!-- Indicador de escritura (typing) -->
      <div v-if="isTyping" class="message-wrapper ai">
        <div class="message-bubble ai typing-indicator">
          <div class="message-avatar">
            <Icon icon="mdi:robot-outline" width="20" height="20" />
          </div>
          <div class="typing-dots">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
      </div>
    </div>

    <!-- Input de Mensaje -->
    <div class="chat-input-container">
      <!-- Sugerencias contextuales -->
      <div v-if="contextSuggestions.length > 0 && !currentMessage" class="context-suggestions">
        <button 
          v-for="(suggestion, index) in contextSuggestions" 
          :key="index"
          @click="sendQuickResponse(suggestion)"
          class="context-chip"
        >
          {{ suggestion }}
        </button>
      </div>

      <!-- Input principal -->
      <form @submit.prevent="sendMessage" class="input-form">
        <div class="input-wrapper">
          <input
            v-model="currentMessage"
            type="text"
            placeholder="Escribe tu mensaje..."
            class="message-input"
            :disabled="isTyping"
            @focus="handleInputFocus"
            @blur="handleInputBlur"
          />
          <button 
            type="submit" 
            class="send-button"
            :disabled="!currentMessage.trim() || isTyping"
            aria-label="Enviar mensaje"
          >
            <Icon 
              :icon="isTyping ? 'mdi:loading' : 'mdi:send'" 
              width="20" 
              height="20"
              :class="{ 'spinning': isTyping }"
            />
          </button>
        </div>
      </form>

      <!-- Footer Info -->
      <div class="chat-footer">
        <p class="footer-text">
          <Icon icon="mdi:shield-check-outline" width="14" height="14" />
          Tus conversaciones son privadas y seguras
        </p>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, reactive, onMounted, nextTick, watch } from 'vue';
import { Icon } from '@iconify/vue';

// Tipos de datos
interface Message {
  id: number;
  sender: 'user' | 'ai';
  text: string;
  timestamp: Date;
  suggestions?: string[];
}

interface Props {
  userProfile?: {
    name: string;
    currentLevel: string;
    goals: string[];
  };
}

const props = withDefaults(defineProps<Props>(), {
  userProfile: () => ({
    name: 'Usuario',
    currentLevel: 'Intermedio',
    goals: []
  })
});

// Estado del componente
const messages = ref<Message[]>([]);
const currentMessage = ref('');
const isTyping = ref(false);
const isOnline = ref(true);
const messagesContainer = ref<HTMLElement | null>(null);
const messageIdCounter = ref(0);

// Sugerencias contextuales basadas en el estado del usuario
const contextSuggestions = ref<string[]>([
  '¿Cómo puedo mejorar mi comunicación?',
  'Muéstrame ejercicios de liderazgo',
  'Evalúa mi progreso'
]);

// Función para enviar mensaje
const sendMessage = async () => {
  if (!currentMessage.value.trim() || isTyping.value) return;

  const userMessage: Message = {
    id: messageIdCounter.value++,
    sender: 'user',
    text: currentMessage.value.trim(),
    timestamp: new Date()
  };

  messages.value.push(userMessage);
  const userQuery = currentMessage.value.trim();
  currentMessage.value = '';

  // Scroll al final
  await nextTick();
  scrollToBottom();

  // Simular respuesta de IA
  await generateAIResponse(userQuery);
};

// Función para generar respuesta de IA
const generateAIResponse = async (userQuery: string) => {
  isTyping.value = true;

  try {
    // Aquí se integraría con el servicio de IA real
    // Por ahora simulamos una respuesta con delay
    await new Promise(resolve => setTimeout(resolve, 1500 + Math.random() * 1000));

    // Respuesta simulada contextual
    const aiResponse = generateContextualResponse(userQuery);

    const aiMessage: Message = {
      id: messageIdCounter.value++,
      sender: 'ai',
      text: aiResponse.text,
      timestamp: new Date(),
      suggestions: aiResponse.suggestions
    };

    messages.value.push(aiMessage);

    // Actualizar sugerencias contextuales
    if (aiResponse.nextSuggestions) {
      contextSuggestions.value = aiResponse.nextSuggestions;
    }

  } catch (error) {
    console.error('Error al generar respuesta:', error);
    
    const errorMessage: Message = {
      id: messageIdCounter.value++,
      sender: 'ai',
      text: 'Lo siento, hubo un error al procesar tu mensaje. Por favor, intenta de nuevo.',
      timestamp: new Date()
    };

    messages.value.push(errorMessage);
  } finally {
    isTyping.value = false;
    await nextTick();
    scrollToBottom();
  }
};

// Generar respuesta contextual (simulación)
const generateContextualResponse = (query: string) => {
  const lowerQuery = query.toLowerCase();

  // Respuestas contextuales basadas en palabras clave
  if (lowerQuery.includes('comunicación') || lowerQuery.includes('comunicacion')) {
    return {
      text: '¡Excelente elección! Te recomiendo empezar por el módulo de "Escucha Activa". ¿Quieres que te muestre los detalles?',
      suggestions: ['Sí, muéstrame los detalles', 'Prefiero otro módulo', '¿Qué otros temas hay?'],
      nextSuggestions: ['Evalúa mi progreso', '¿Cómo practico esto?', 'Siguiente habilidad']
    };
  }

  if (lowerQuery.includes('liderazgo')) {
    return {
      text: 'El liderazgo es una habilidad clave. Según tu perfil, estás en nivel intermedio. Te sugiero comenzar con técnicas de delegación efectiva. ¿Te gustaría un ejercicio práctico?',
      suggestions: ['Sí, dame un ejercicio', 'Prefiero teoría primero', '¿Qué nivel tengo?'],
      nextSuggestions: ['Muéstrame mi roadmap', 'Más sobre liderazgo', 'Cambiar de tema']
    };
  }

  if (lowerQuery.includes('progreso') || lowerQuery.includes('avance')) {
    return {
      text: `Hola ${props.userProfile.name}, llevas un progreso del 65% en tu roadmap actual. Has completado 3 módulos este mes. ¡Vas muy bien! 🎯`,
      suggestions: ['Ver detalles completos', '¿Qué sigue?', 'Estadísticas'],
      nextSuggestions: ['Continuar aprendiendo', 'Ver logros', 'Cambiar objetivo']
    };
  }

  if (lowerQuery.includes('ejercicio') || lowerQuery.includes('práctica') || lowerQuery.includes('practica')) {
    return {
      text: 'Perfecto, te propongo este ejercicio: Durante tu próxima reunión, practica la técnica de "parafraseo". Repite con tus palabras lo que otros dicen antes de responder. ¿Listo para el desafío?',
      suggestions: ['Acepto el desafío', 'Explícame más', 'Otro ejercicio'],
      nextSuggestions: ['¿Cómo evalúo esto?', 'Siguiente ejercicio', 'Ver mi progreso']
    };
  }

  // Respuesta genérica adaptativa
  return {
    text: 'Entiendo tu consulta. Basándome en tu perfil y objetivos actuales, puedo ayudarte con estrategias personalizadas. ¿En qué área específica quieres enfocarte?',
    suggestions: ['Habilidades técnicas', 'Soft skills', 'Inglés profesional'],
    nextSuggestions: ['Ver mi roadmap', 'Evaluación rápida', 'Recomendaciones']
  };
};

// Enviar respuesta rápida
const sendQuickResponse = async (suggestion: string) => {
  currentMessage.value = suggestion;
  await sendMessage();
};

// Formatear mensaje (soporte básico para markdown)
const formatMessage = (text: string): string => {
  // Convertir **texto** a negrita
  let formatted = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
  
  // Convertir *texto* a cursiva
  formatted = formatted.replace(/\*(.*?)\*/g, '<em>$1</em>');
  
  // Convertir emojis comunes
  formatted = formatted.replace(/:\)/g, '😊');
  formatted = formatted.replace(/:\(/g, '😞');
  
  // Convertir saltos de línea
  formatted = formatted.replace(/\n/g, '<br>');
  
  return formatted;
};

// Formatear tiempo
const formatTime = (date: Date): string => {
  const hours = date.getHours().toString().padStart(2, '0');
  const minutes = date.getMinutes().toString().padStart(2, '0');
  return `${hours}:${minutes}`;
};

// Scroll al final del chat
const scrollToBottom = () => {
  if (messagesContainer.value) {
    messagesContainer.value.scrollTop = messagesContainer.value.scrollHeight;
  }
};

// Limpiar chat
const clearChat = () => {
  if (confirm('¿Estás seguro de que quieres limpiar la conversación?')) {
    messages.value = [];
    contextSuggestions.value = [
      '¿Cómo puedo mejorar mi comunicación?',
      'Muéstrame ejercicios de liderazgo',
      'Evalúa mi progreso'
    ];
  }
};

// Toggle minimize - Regresar al roadmap
const toggleMinimize = () => {
  console.log('Regresando al roadmap');
  window.location.href = '/roadmap';
};

// Handlers de input
const handleInputFocus = () => {
  // Lógica cuando el input recibe foco
};

const handleInputBlur = () => {
  // Lógica cuando el input pierde foco
};

// Mensaje de bienvenida inicial
onMounted(async () => {
  await new Promise(resolve => setTimeout(resolve, 500));
  
  const welcomeMessage: Message = {
    id: messageIdCounter.value++,
    sender: 'ai',
    text: `¡Hola! Soy tu asistente de desarrollo profesional. ¿En qué habilidad te gustaría enfocarte hoy?`,
    timestamp: new Date(),
    suggestions: ['Mejorar mi comunicación', 'Desarrollar liderazgo', 'Evaluar mi progreso']
  };

  messages.value.push(welcomeMessage);
  await nextTick();
  scrollToBottom();
});

// Watch para auto-scroll cuando llegan nuevos mensajes
watch(() => messages.value.length, () => {
  nextTick(() => scrollToBottom());
});
</script>

<style scoped>
.chat-agent-container {
  display: flex;
  flex-direction: column;
  height: 100vh;
  max-height: 100vh;
  background: var(--color-bg-main);
  font-family: 'Work Sans', sans-serif;
  color: white;
  overflow: hidden;
}

/* === Header === */
.chat-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.25rem 1.5rem;
  background: var(--color-bg-secondary);
  border-bottom: 1px solid var(--color-complementary);
  flex-shrink: 0;
}

.agent-info {
  display: flex;
  align-items: center;
  gap: 0.875rem;
}

.agent-avatar {
  width: 2.5rem;
  height: 2.5rem;
  background: linear-gradient(135deg, var(--color-primary), var(--color-interaction));
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
}

.agent-details {
  display: flex;
  flex-direction: column;
  gap: 0.125rem;
}

.agent-name {
  font-size: 1rem;
  font-weight: 600;
  color: white;
  margin: 0;
}

.agent-status {
  font-size: 0.75rem;
  color: var(--color-complementary);
  font-weight: 400;
}

.agent-status.online {
  color: var(--color-success);
}

.header-actions {
  display: flex;
  gap: 0.5rem;
}

.action-button {
  width: 2rem;
  height: 2rem;
  background: transparent;
  border: 1px solid var(--color-complementary);
  border-radius: 8px;
  color: var(--color-complementary);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
  padding: 0;
}

.action-button:hover {
  background: var(--color-complementary);
  border-color: var(--color-primary);
  color: white;
}

/* === Área de Mensajes === */
.chat-messages {
  flex: 1;
  overflow-y: auto;
  padding: 1.5rem;
  display: flex;
  flex-direction: column;
  gap: 1rem;
  scroll-behavior: smooth;
}

/* Scrollbar personalizada */
.chat-messages::-webkit-scrollbar {
  width: 6px;
}

.chat-messages::-webkit-scrollbar-track {
  background: var(--color-bg-secondary);
}

.chat-messages::-webkit-scrollbar-thumb {
  background: var(--color-complementary);
  border-radius: 3px;
}

.chat-messages::-webkit-scrollbar-thumb:hover {
  background: var(--color-primary);
}

/* Mensaje de Bienvenida */
.welcome-message {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 3rem 2rem;
  gap: 1rem;
}

.welcome-icon {
  color: var(--color-primary);
  opacity: 0.6;
  margin-bottom: 0.5rem;
}

.welcome-message h4 {
  font-size: 1.25rem;
  font-weight: 600;
  color: white;
  margin: 0;
}

.welcome-message p {
  font-size: 0.875rem;
  color: rgba(255, 255, 255, 0.7);
  margin: 0;
}

/* Wrapper de Mensajes */
.message-wrapper {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
  animation: fadeInUp 0.3s ease;
}

.message-wrapper.user {
  align-items: flex-end;
}

.message-wrapper.ai {
  align-items: flex-start;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Burbuja de Mensaje */
.message-bubble {
  display: flex;
  gap: 0.75rem;
  max-width: 75%;
  align-items: flex-end;
}

.message-bubble.user {
  flex-direction: row-reverse;
}

.message-avatar {
  width: 2rem;
  height: 2rem;
  background: linear-gradient(135deg, var(--color-primary), var(--color-interaction));
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  flex-shrink: 0;
}

.message-avatar.user {
  background: linear-gradient(135deg, var(--color-success), var(--color-interaction));
}

.message-content {
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
  background: var(--color-bg-secondary);
  padding: 0.875rem 1.125rem;
  border-radius: 16px;
  border: 1px solid var(--color-complementary);
}

.message-bubble.user .message-content {
  background: linear-gradient(135deg, var(--color-primary), var(--color-interaction));
  border: none;
}

.message-content p {
  margin: 0;
  font-size: 0.9375rem;
  line-height: 1.5;
  color: white;
  word-wrap: break-word;
}

.message-time {
  font-size: 0.6875rem;
  color: rgba(255, 255, 255, 0.5);
  align-self: flex-end;
  margin-top: 0.25rem;
}

/* Indicador de Escritura */
.typing-indicator {
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.typing-dots {
  display: flex;
  gap: 0.375rem;
  padding: 0.875rem 1.125rem;
  background: var(--color-bg-secondary);
  border-radius: 16px;
  border: 1px solid var(--color-complementary);
}

.typing-dots span {
  width: 8px;
  height: 8px;
  background: var(--color-primary);
  border-radius: 50%;
  animation: typing 1.4s infinite;
}

.typing-dots span:nth-child(2) {
  animation-delay: 0.2s;
}

.typing-dots span:nth-child(3) {
  animation-delay: 0.4s;
}

@keyframes typing {
  0%, 60%, 100% {
    transform: translateY(0);
    opacity: 0.5;
  }
  30% {
    transform: translateY(-10px);
    opacity: 1;
  }
}

/* Sugerencias Rápidas */
.quick-suggestions {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  padding-left: 2.75rem;
}

.suggestion-chip {
  padding: 0.5rem 1rem;
  background: transparent;
  border: 1px solid var(--color-primary);
  border-radius: 20px;
  color: var(--color-primary);
  font-size: 0.8125rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
  font-family: 'Work Sans', sans-serif;
}

.suggestion-chip:hover {
  background: var(--color-primary);
  color: white;
  transform: translateY(-2px);
}

/* === Input Container === */
.chat-input-container {
  flex-shrink: 0;
  background: var(--color-bg-secondary);
  border-top: 1px solid var(--color-complementary);
  padding: 1rem 1.5rem;
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

/* Sugerencias Contextuales */
.context-suggestions {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
}

.context-chip {
  padding: 0.5rem 0.875rem;
  background: var(--color-complementary);
  border: none;
  border-radius: 16px;
  color: white;
  font-size: 0.8125rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
  font-family: 'Work Sans', sans-serif;
}

.context-chip:hover {
  background: var(--color-primary);
  transform: translateY(-2px);
}

/* Input Form */
.input-form {
  width: 100%;
}

.input-wrapper {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  background: var(--color-bg-main);
  border: 2px solid var(--color-complementary);
  border-radius: 24px;
  padding: 0.5rem 0.75rem;
  transition: all 0.3s ease;
}

.input-wrapper:focus-within {
  border-color: var(--color-primary);
  box-shadow: 0 0 0 3px rgba(140, 26, 217, 0.1);
}

.message-input {
  flex: 1;
  background: transparent;
  border: none;
  outline: none;
  color: white;
  font-size: 0.9375rem;
  font-family: 'Work Sans', sans-serif;
  padding: 0.5rem 0.75rem;
}

.message-input::placeholder {
  color: var(--color-complementary);
}

.message-input:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.send-button {
  width: 2.5rem;
  height: 2.5rem;
  background: linear-gradient(135deg, var(--color-primary), var(--color-interaction));
  border: none;
  border-radius: 50%;
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
  flex-shrink: 0;
}

.send-button:hover:not(:disabled) {
  transform: scale(1.1);
  box-shadow: 0 4px 12px rgba(140, 26, 217, 0.3);
}

.send-button:disabled {
  opacity: 0.4;
  cursor: not-allowed;
}

.spinning {
  animation: spin 1s linear infinite;
}

@keyframes spin {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}

/* Chat Footer */
.chat-footer {
  text-align: center;
}

.footer-text {
  font-size: 0.75rem;
  color: rgba(255, 255, 255, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.375rem;
  margin: 0;
}

.footer-text svg {
  color: var(--color-success);
}

/* === Responsive === */
@media (max-width: 768px) {
  .chat-header {
    padding: 1rem;
  }

  .chat-messages {
    padding: 1rem;
  }

  .message-bubble {
    max-width: 85%;
  }

  .chat-input-container {
    padding: 0.875rem 1rem;
  }

  .context-suggestions {
    overflow-x: auto;
    flex-wrap: nowrap;
    padding-bottom: 0.25rem;
  }

  .context-chip {
    white-space: nowrap;
  }
}

@media (max-width: 480px) {
  .agent-name {
    font-size: 0.875rem;
  }

  .message-bubble {
    max-width: 90%;
  }

  .message-content p {
    font-size: 0.875rem;
  }

  .quick-suggestions {
    padding-left: 0;
  }
}
</style>
