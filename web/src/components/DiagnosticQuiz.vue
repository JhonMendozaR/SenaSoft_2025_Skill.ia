<script setup lang="ts">
import { ref, computed } from 'vue';
import { Icon } from '@iconify/vue';
import { 
  useDiagnosticAI, 
  type Question, 
  type DiagnosticResult,
  type Answer,
  type UserProfile 
} from '../lib/ai-service';

// Props (opcional: recibir perfil de usuario desde ruta anterior)
interface Props {
  userProfile?: UserProfile;
}

const props = withDefaults(defineProps<Props>(), {
  userProfile: () => ({
    name: 'Usuario',
    sector: 'Tecnología',
    experience: '1-3 años',
  })
});

// Inicializar servicio de IA
const aiService = useDiagnosticAI(props.userProfile);

// Estado del componente
const currentStep = ref<'intro' | 'quiz' | 'results'>('intro');
const currentQuestion = ref<Question | null>(null);
const selectedAnswer = ref<string | null>(null);
const answeredQuestions = ref<Answer[]>([]);
const totalQuestions = ref(10);
const isLoading = ref(false);
const results = ref<DiagnosticResult[]>([]);

// Progreso calculado
const progress = computed(() => {
  return Math.round((answeredQuestions.value.length / totalQuestions.value) * 100);
});

// Función para obtener la siguiente pregunta de la IA
const fetchNextQuestion = async () => {
  isLoading.value = true;
  
  try {
    // Integración con TCL AI Layer
    const question = await aiService.generateNextQuestion();
    currentQuestion.value = question;
  } catch (error) {
    console.error('Error fetching question:', error);
    
    // Fallback: pregunta de ejemplo si falla la IA
    currentQuestion.value = {
      id: `q-${answeredQuestions.value.length + 1}`,
      text: '¿Con qué frecuencia buscas activamente nuevas oportunidades de aprendizaje para mejorar tus habilidades?',
      type: 'multiple-choice',
      category: 'soft-skills',
      options: [
        { id: 'opt-1', text: 'Siempre', value: 5 },
        { id: 'opt-2', text: 'A menudo', value: 4 },
        { id: 'opt-3', text: 'A veces', value: 3 },
        { id: 'opt-4', text: 'Raramente', value: 2 },
        { id: 'opt-5', text: 'Nunca', value: 1 }
      ]
    };
  } finally {
    isLoading.value = false;
  }
};

// Manejar respuesta del usuario
const handleAnswer = async (optionId: string, value: number) => {
  if (!currentQuestion.value || isLoading.value) return;
  
  selectedAnswer.value = optionId;
  
  // Crear objeto de respuesta
  const answer: Answer = {
    questionId: currentQuestion.value.id,
    answer: optionId,
    value: value,
    timestamp: new Date()
  };
  
  // Guardar respuesta
  answeredQuestions.value.push(answer);
  
  // Analizar con IA
  await aiService.analyzeAnswer(answer);
  
  // Esperar animación
  await new Promise(resolve => setTimeout(resolve, 300));
  
  // Verificar si terminó el quiz
  if (answeredQuestions.value.length >= totalQuestions.value) {
    await generateResults();
    currentStep.value = 'results';
  } else {
    selectedAnswer.value = null;
    await fetchNextQuestion();
  }
};

// Generar resultados del diagnóstico
const generateResults = async () => {
  isLoading.value = true;
  
  try {
    // Generar diagnóstico con IA
    const diagnosticResults = await aiService.generateDiagnostic();
    results.value = diagnosticResults;
  } catch (error) {
    console.error('Error generating results:', error);
  } finally {
    isLoading.value = false;
  }
};

// Iniciar el quiz
const startQuiz = async () => {
  currentStep.value = 'quiz';
  await fetchNextQuestion();
};

// Ir a anterior pregunta
const goToPrevious = () => {
  if (answeredQuestions.value.length > 0) {
    answeredQuestions.value.pop();
    selectedAnswer.value = null;
    fetchNextQuestion();
  }
};

// Reiniciar diagnóstico
const restartDiagnostic = () => {
  currentStep.value = 'intro';
  currentQuestion.value = null;
  selectedAnswer.value = null;
  answeredQuestions.value = [];
  results.value = [];
};

// Finalizar y continuar
const finishDiagnostic = () => {
  // TODO: Guardar resultados en backend y redirigir a dashboard
  console.log('Resultados finales:', results.value);
  window.location.href = '/';
};
</script>

<template>
  <div class="diagnostic-container">
    <!-- Pantalla de Introducción -->
    <div v-if="currentStep === 'intro'" class="intro-screen">
      <div class="intro-content">
        <h1 class="intro-title">Diagnóstico de Habilidades Profesionales</h1>
        <p class="intro-description">
          Evalúa tu potencial. Este examen tomará aproximadamente 15 minutos en completarse.
        </p>
        <div class="intro-details">
          <div class="detail-item">
            <Icon icon="pajamas:work-item-objective" class="detail-icon" width="24" height="24" />
            <span class="detail-text">{{ totalQuestions }} preguntas personalizadas</span>
          </div>
          <div class="detail-item">
            <Icon icon="fa7-solid:brain" class="detail-icon" width="24" height="24" />
            <span class="detail-text">Evaluación adaptativa con IA</span>
          </div>
          <div class="detail-item">
            <Icon icon="bx:stats" class="detail-icon" width="24" height="24" />
            <span class="detail-text">Diagnóstico detallado al finalizar</span>
          </div>
        </div>
        <button @click="startQuiz" class="start-button">
          Comenzar Evaluación
          <Icon icon="mdi:arrow-right" width="20" height="20" />
        </button>
      </div>
    </div>

    <!-- Pantalla de Quiz -->
    <div v-else-if="currentStep === 'quiz'" class="quiz-screen">
      <div class="quiz-content">
        <!-- Barra de Progreso -->
        <div class="progress-section">
          <div class="progress-label">
            <span>Progreso</span>
            <span class="progress-percentage">{{ progress }}%</span>
          </div>
          <div class="progress-bar">
            <div class="progress-fill" :style="{ width: `${progress}%` }"></div>
          </div>
        </div>

        <!-- Pregunta Actual -->
        <div v-if="!isLoading && currentQuestion" class="question-section">
          <h2 class="question-text">{{ currentQuestion.text }}</h2>
          
          <!-- Opciones de respuesta -->
          <div class="options-container">
            <button
              v-for="option in currentQuestion.options"
              :key="option.id"
              @click="handleAnswer(option.id, option.value)"
              class="option-card"
              :class="{ 'selected': selectedAnswer === option.id }"
            >
              <div class="option-indicator"></div>
              <span class="option-text">{{ option.text }}</span>
            </button>
          </div>

          <!-- Navegación -->
          <div class="navigation-buttons">
            <button 
              @click="goToPrevious" 
              class="nav-button secondary"
              :disabled="answeredQuestions.length === 0"
            >
              <Icon icon="mdi:arrow-left" width="20" height="20" />
              Anterior
            </button>
          </div>
        </div>

        <!-- Loading -->
        <div v-if="isLoading" class="loading-state">
          <div class="spinner"></div>
          <p>Generando siguiente pregunta...</p>
        </div>
      </div>

      <!-- Footer links -->
      <div class="footer-links">
        <a href="#">Términos de Servicio</a>
        <span class="separator">|</span>
        <a href="#">Política de Privacidad</a>
      </div>
    </div>

    <!-- Pantalla de Resultados -->
    <div v-else-if="currentStep === 'results'" class="results-screen">
      <div class="results-content">
        <h1 class="results-title">Tu Diagnóstico Profesional</h1>
        <p class="results-subtitle">Estos son los resultados de tu evaluación</p>

        <!-- Resultados por Categoría -->
        <div class="results-categories">
          <div 
            v-for="result in results" 
            :key="result.category"
            class="category-result"
          >
            <div class="category-header">
              <h3 class="category-name">{{ result.category }}</h3>
              <span class="category-level" :class="`level-${result.level.toLowerCase()}`">
                {{ result.level }}
              </span>
            </div>
            
            <div class="performance-bar-container">
              <div class="performance-bar">
                <div 
                  class="performance-fill" 
                  :style="{ width: `${result.score}%` }"
                ></div>
              </div>
              <span class="performance-score">{{ result.score }}%</span>
            </div>

            <p class="category-feedback">{{ result.feedback }}</p>

            <!-- Fortalezas y Debilidades -->
            <div class="insights">
              <div class="insight-section">
                <h4 class="insight-title">
                  <Icon icon="mdi:check-circle-outline" width="16" height="16" />
                  Fortalezas
                </h4>
                <ul class="insight-list">
                  <li v-for="strength in result.strengths" :key="strength">{{ strength }}</li>
                </ul>
              </div>

              <div class="insight-section">
                <h4 class="insight-title">
                  <Icon icon="mdi:alert-circle-outline" width="16" height="16" />
                  Áreas de mejora
                </h4>
                <ul class="insight-list">
                  <li v-for="gap in result.gaps" :key="gap">{{ gap }}</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Acciones finales -->
        <div class="results-actions">
          <button @click="restartDiagnostic" class="action-button secondary">
            <Icon icon="mdi:refresh" width="20" height="20" />
            Reiniciar Evaluación
          </button>
          <button @click="finishDiagnostic" class="action-button primary">
            Continuar al Roadmap
            <Icon icon="mdi:arrow-right" width="20" height="20" />
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* === Container Principal === */
.diagnostic-container {
  min-height: 100vh;
  background: var(--color-bg-main);
  font-family: 'Work Sans', sans-serif;
  color: white;
  display: flex;
  flex-direction: column;
}

/* === Header === */
.diagnostic-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.5rem 2rem;
  background: var(--color-bg-secondary);
  border-bottom: 1px solid var(--color-complementary);
}

.header-brand {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.icon-wrapper {
  width: 2.5rem;
  height: 2.5rem;
  background: linear-gradient(135deg, var(--color-primary), var(--color-interaction));
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.icon-wrapper svg {
  color: white;
}

.header-title {
  font-size: 1.25rem;
  font-weight: 600;
  color: white;
}

.profile-button {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.625rem 1.25rem;
  background: transparent;
  border: 1px solid var(--color-complementary);
  border-radius: 8px;
  color: white;
  font-size: 0.875rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s ease;
  font-family: 'Work Sans', sans-serif;
}

.profile-button:hover {
  background: var(--color-complementary);
  border-color: var(--color-primary);
}

.profile-button svg {
  color: var(--color-success);
}

/* === Pantalla de Introducción === */
.intro-screen {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem;
}

.intro-content {
  max-width: 600px;
  text-align: center;
}

.intro-title {
  font-size: 2.5rem;
  font-weight: 700;
  color: white;
  margin-bottom: 1rem;
  line-height: 1.2;
}

.intro-description {
  font-size: 1.125rem;
  color: rgba(255, 255, 255, 0.8);
  margin-bottom: 3rem;
  line-height: 1.6;
}

.intro-details {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
  margin-bottom: 3rem;
}

.detail-item {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 1rem 1.5rem;
  background: var(--color-bg-secondary);
  border-radius: 12px;
  border: 1px solid var(--color-complementary);
}

.detail-icon {
  color: var(--color-success);
  flex-shrink: 0;
}

.detail-text {
  font-size: 1rem;
  color: white;
  font-weight: 500;
}

.start-button {
  display: inline-flex;
  align-items: center;
  gap: 0.75rem;
  padding: 1rem 2rem;
  background: linear-gradient(135deg, var(--color-primary), var(--color-interaction));
  color: white;
  border: none;
  border-radius: 12px;
  font-size: 1.125rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  font-family: 'Work Sans', sans-serif;
}

.start-button:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 30px rgba(140, 26, 217, 0.3);
}

/* === Pantalla de Quiz === */
.quiz-screen {
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding: 2rem;
}

.quiz-content {
  max-width: 900px;
  width: 100%;
  margin: 0 auto;
  flex: 1;
  display: flex;
  flex-direction: column;
}

/* Barra de Progreso */
.progress-section {
  margin-bottom: 3rem;
}

.progress-label {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 0.75rem;
  font-size: 0.875rem;
  color: rgba(255, 255, 255, 0.8);
}

.progress-percentage {
  font-weight: 600;
  color: var(--color-success);
  font-size: 1rem;
}

.progress-bar {
  height: 8px;
  background: var(--color-complementary);
  border-radius: 999px;
  overflow: hidden;
}

.progress-fill {
  height: 100%;
  background: linear-gradient(90deg, var(--color-success), var(--color-primary));
  border-radius: 999px;
  transition: width 0.5s ease;
}

/* Sección de Pregunta */
.question-section {
  flex: 1;
  display: flex;
  flex-direction: column;
}

.question-text {
  font-size: 1.75rem;
  font-weight: 600;
  color: white;
  margin-bottom: 2.5rem;
  line-height: 1.4;
}

/* Contenedor de Opciones */
.options-container {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  margin-bottom: 2.5rem;
  flex: 1;
}

.option-card {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 1.25rem 1.5rem;
  background: var(--color-bg-secondary);
  border: 2px solid var(--color-complementary);
  border-radius: 16px;
  cursor: pointer;
  transition: all 0.3s ease;
  font-family: 'Work Sans', sans-serif;
  text-align: left;
}

.option-card:hover {
  border-color: var(--color-primary);
  background: rgba(140, 26, 217, 0.1);
  transform: translateX(4px);
}

.option-card.selected {
  border-color: var(--color-success);
  background: rgba(6, 214, 160, 0.15);
}

.option-indicator {
  width: 20px;
  height: 20px;
  border-radius: 50%;
  border: 2px solid var(--color-complementary);
  flex-shrink: 0;
  transition: all 0.3s ease;
}

.option-card:hover .option-indicator {
  border-color: var(--color-primary);
}

.option-card.selected .option-indicator {
  border-color: var(--color-success);
  background: var(--color-success);
  box-shadow: 0 0 0 4px rgba(6, 214, 160, 0.2);
}

.option-text {
  font-size: 1rem;
  font-weight: 500;
  color: white;
}

/* Botones de Navegación */
.navigation-buttons {
  display: flex;
  justify-content: space-between;
  gap: 1rem;
  margin-top: auto;
}

.nav-button {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.875rem 1.5rem;
  border-radius: 12px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  font-family: 'Work Sans', sans-serif;
  border: none;
}

.nav-button.secondary {
  background: transparent;
  border: 2px solid var(--color-complementary);
  color: white;
}

.nav-button.secondary:hover:not(:disabled) {
  background: var(--color-complementary);
  border-color: var(--color-primary);
}

.nav-button.primary {
  background: linear-gradient(135deg, var(--color-primary), var(--color-interaction));
  color: white;
}

.nav-button.primary:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(140, 26, 217, 0.3);
}

.nav-button:disabled {
  opacity: 0.4;
  cursor: not-allowed;
}

/* Loading State */
.loading-state {
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 1.5rem;
}

.spinner {
  width: 48px;
  height: 48px;
  border: 4px solid var(--color-complementary);
  border-top-color: var(--color-primary);
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

.loading-state p {
  font-size: 1rem;
  color: rgba(255, 255, 255, 0.8);
}

/* Footer Links */
.footer-links {
  text-align: center;
  padding-top: 2rem;
  font-size: 0.875rem;
  color: rgba(255, 255, 255, 0.6);
}

.footer-links a {
  color: rgba(255, 255, 255, 0.6);
  text-decoration: none;
  transition: color 0.2s ease;
}

.footer-links a:hover {
  color: var(--color-success);
}

.separator {
  margin: 0 0.75rem;
}

/* === Pantalla de Resultados === */
.results-screen {
  flex: 1;
  padding: 3rem 2rem;
  overflow-y: auto;
}

.results-content {
  max-width: 1000px;
  margin: 0 auto;
}

.results-title {
  font-size: 2.5rem;
  font-weight: 700;
  color: white;
  text-align: center;
  margin-bottom: 0.5rem;
}

.results-subtitle {
  font-size: 1.125rem;
  color: rgba(255, 255, 255, 0.8);
  text-align: center;
  margin-bottom: 3rem;
}

/* Categorías de Resultados */
.results-categories {
  display: flex;
  flex-direction: column;
  gap: 2rem;
  margin-bottom: 3rem;
}

.category-result {
  padding: 2rem;
  background: var(--color-bg-secondary);
  border: 1px solid var(--color-complementary);
  border-radius: 16px;
}

.category-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
}

.category-name {
  font-size: 1.5rem;
  font-weight: 600;
  color: white;
}

.category-level {
  padding: 0.5rem 1rem;
  border-radius: 8px;
  font-size: 0.875rem;
  font-weight: 600;
}

.level-básico {
  background: rgba(255, 107, 107, 0.2);
  color: #ff6b6b;
}

.level-intermedio {
  background: rgba(255, 196, 0, 0.2);
  color: #ffc400;
}

.level-avanzado {
  background: rgba(6, 214, 160, 0.2);
  color: var(--color-success);
}

/* Barra de Desempeño */
.performance-bar-container {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 1.5rem;
}

.performance-bar {
  flex: 1;
  height: 12px;
  background: var(--color-complementary);
  border-radius: 999px;
  overflow: hidden;
}

.performance-fill {
  height: 100%;
  background: linear-gradient(90deg, var(--color-success), var(--color-primary));
  border-radius: 999px;
  transition: width 0.8s ease;
}

.performance-score {
  font-size: 1.25rem;
  font-weight: 700;
  color: var(--color-success);
  min-width: 4rem;
  text-align: right;
}

.category-feedback {
  font-size: 1rem;
  line-height: 1.6;
  color: rgba(255, 255, 255, 0.9);
  margin-bottom: 1.5rem;
}

/* Insights (Fortalezas y Debilidades) */
.insights {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.5rem;
}

.insight-section {
  padding: 1.25rem;
  background: rgba(30, 25, 64, 0.5);
  border-radius: 12px;
  border: 1px solid var(--color-complementary);
}

.insight-title {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 1rem;
  font-weight: 600;
  color: var(--color-success);
  margin-bottom: 1rem;
}

.insight-list {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.insight-list li {
  font-size: 0.875rem;
  color: rgba(255, 255, 255, 0.9);
  padding-left: 1.5rem;
  position: relative;
}

.insight-list li::before {
  content: "•";
  position: absolute;
  left: 0.5rem;
  color: var(--color-success);
}

/* Acciones Finales */
.results-actions {
  display: flex;
  justify-content: center;
  gap: 1rem;
  flex-wrap: wrap;
}

.action-button {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 1rem 2rem;
  border-radius: 12px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  font-family: 'Work Sans', sans-serif;
  border: none;
}

.action-button.secondary {
  background: transparent;
  border: 2px solid var(--color-complementary);
  color: white;
}

.action-button.secondary:hover {
  background: var(--color-complementary);
  border-color: var(--color-primary);
}

.action-button.primary {
  background: linear-gradient(135deg, var(--color-primary), var(--color-interaction));
  color: white;
}

.action-button.primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 30px rgba(140, 26, 217, 0.3);
}

/* === Responsive === */
@media (max-width: 768px) {
  .diagnostic-header {
    flex-direction: column;
    gap: 1rem;
    padding: 1rem;
  }

  .intro-title {
    font-size: 2rem;
  }

  .question-text {
    font-size: 1.5rem;
  }

  .insights {
    grid-template-columns: 1fr;
  }

  .results-actions {
    flex-direction: column;
  }

  .action-button {
    width: 100%;
    justify-content: center;
  }

  .navigation-buttons {
    flex-direction: column;
  }

  .nav-button {
    width: 100%;
    justify-content: center;
  }
}

@media (max-width: 480px) {
  .quiz-screen,
  .results-screen {
    padding: 1rem;
  }

  .intro-content {
    padding: 1rem;
  }

  .category-result {
    padding: 1.5rem;
  }
}
</style>
