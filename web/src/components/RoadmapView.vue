<template>
  <div class="roadmap-container">
    <!-- Header -->
    <header class="roadmap-header">
      <div class="header-content">
        <div class="header-brand">
          <div class="icon-wrapper">
            <Icon icon="mdi:map-marker-path" width="32" height="32" />
          </div>
          <div class="header-text">
            <h1 class="header-title">Tu Ruta de Desarrollo Profesional</h1>
            <p class="header-subtitle">Personalizada con IA según tus resultados</p>
          </div>
        </div>
        <button class="profile-button" @click="goToProfile">
          <Icon icon="mdi:account-circle" width="24" height="24" />
          <span>Mi Perfil</span>
        </button>
      </div>
    </header>

    <!-- Progress Summary -->
    <section class="progress-summary">
      <div class="summary-card">
        <div class="summary-header">
          <h2 class="summary-title">Progreso General</h2>
          <span class="summary-percentage">{{ overallProgress }}%</span>
        </div>
        <div class="progress-bar-large">
          <div class="progress-fill-large" :style="{ width: `${overallProgress}%` }"></div>
        </div>
        <div class="summary-stats">
          <div class="stat-item">
            <Icon icon="mdi:check-circle" class="stat-icon completed" />
            <span class="stat-value">{{ completedCount }}</span>
            <span class="stat-label">Completados</span>
          </div>
          <div class="stat-item">
            <Icon icon="mdi:clock-outline" class="stat-icon in-progress" />
            <span class="stat-value">{{ inProgressCount }}</span>
            <span class="stat-label">En Progreso</span>
          </div>
          <div class="stat-item">
            <Icon icon="mdi:chart-timeline-variant" class="stat-icon pending" />
            <span class="stat-value">{{ pendingCount }}</span>
            <span class="stat-label">Pendientes</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Roadmap Timeline -->
    <section class="roadmap-timeline">
      <div class="timeline-container">
        <div 
          v-for="(milestone, index) in milestones" 
          :key="milestone.id"
          class="milestone-wrapper"
        >
          <!-- Timeline Line -->
          <div class="timeline-line" v-if="index > 0"></div>
          
          <!-- Milestone Card -->
          <div 
            class="milestone-card" 
            :class="[`status-${milestone.status}`, { 'expanded': expandedMilestone === milestone.id }]"
            @click="toggleMilestone(milestone.id)"
          >
            <!-- Status Indicator -->
            <div class="milestone-indicator" :class="`indicator-${milestone.status}`">
              <Icon 
                :icon="getStatusIcon(milestone.status)" 
                width="24" 
                height="24" 
              />
            </div>

            <!-- Card Content -->
            <div class="milestone-content">
              <div class="milestone-header">
                <div class="milestone-main">
                  <h3 class="milestone-title">{{ milestone.title }}</h3>
                  <span class="milestone-status-badge" :class="`badge-${milestone.status}`">
                    {{ getStatusLabel(milestone.status) }}
                  </span>
                </div>
                <button 
                  class="expand-button"
                  @click.stop="toggleMilestone(milestone.id)"
                >
                  <Icon 
                    :icon="expandedMilestone === milestone.id ? 'mdi:chevron-up' : 'mdi:chevron-down'" 
                    width="24" 
                    height="24" 
                  />
                </button>
              </div>

              <p class="milestone-description">{{ milestone.description }}</p>

              <!-- Progress Bar for In-Progress milestones -->
              <div v-if="milestone.status === 'in-progress'" class="milestone-progress">
                <div class="progress-info">
                  <span class="progress-label">Progreso del módulo</span>
                  <span class="progress-percentage-small">{{ milestone.progress }}%</span>
                </div>
                <div class="progress-bar-small">
                  <div 
                    class="progress-fill-small" 
                    :style="{ width: `${milestone.progress}%` }"
                  ></div>
                </div>
              </div>

              <!-- Metadata -->
              <div class="milestone-metadata">
                <div class="metadata-item">
                  <Icon icon="mdi:clock-time-four-outline" width="16" height="16" />
                  <span>{{ milestone.estimatedTime }}</span>
                </div>
                <div class="metadata-item">
                  <Icon icon="mdi:signal" width="16" height="16" />
                  <span>{{ milestone.difficulty }}</span>
                </div>
                <div class="metadata-item">
                  <Icon icon="mdi:tag-outline" width="16" height="16" />
                  <span>{{ milestone.category }}</span>
                </div>
              </div>

              <!-- Expanded Details -->
              <Transition name="expand">
                <div v-if="expandedMilestone === milestone.id" class="milestone-details">
                  <div class="details-section">
                    <h4 class="details-title">
                      <Icon icon="mdi:bullseye-arrow" width="20" height="20" />
                      Objetivos de Aprendizaje
                    </h4>
                    <ul class="details-list">
                      <li v-for="(objective, idx) in milestone.objectives" :key="idx">
                        {{ objective }}
                      </li>
                    </ul>
                  </div>

                  <div class="details-section">
                    <h4 class="details-title">
                      <Icon icon="mdi:book-open-page-variant" width="20" height="20" />
                      Recursos Recomendados
                    </h4>
                    <div class="resources-list">
                      <a 
                        v-for="(resource, idx) in milestone.resources" 
                        :key="idx"
                        :href="resource.url"
                        target="_blank"
                        class="resource-link"
                      >
                        <Icon icon="mdi:open-in-new" width="16" height="16" />
                        {{ resource.title }}
                      </a>
                    </div>
                  </div>

                  <!-- Action Buttons -->
                  <div class="milestone-actions">
                    <button 
                      v-if="milestone.status === 'pending'"
                      @click.stop="startMilestone(milestone.id)"
                      class="action-button primary"
                    >
                      <Icon icon="mdi:play-circle" width="20" height="20" />
                      Comenzar Módulo
                    </button>
                    <button 
                      v-if="milestone.status === 'in-progress'"
                      @click.stop="completeMilestone(milestone.id)"
                      class="action-button success"
                    >
                      <Icon icon="mdi:check-circle" width="20" height="20" />
                      Marcar como Completado
                    </button>
                    <button 
                      v-if="milestone.status === 'completed'"
                      @click.stop="reviewMilestone(milestone.id)"
                      class="action-button secondary"
                    >
                      <Icon icon="mdi:refresh" width="20" height="20" />
                      Revisar Contenido
                    </button>
                  </div>
                </div>
              </Transition>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- AI Assistant FAB -->
    <button class="ai-assistant-fab" @click="openAIChat" title="Hablar con tu Asistente IA">
      <Icon icon="mdi:robot-excited" width="32" height="32" />
    </button>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import { Icon } from '@iconify/vue';
import { 
  useRoadmapAI, 
  type Milestone, 
  type RoadmapData,
  type UserProfile,
  type DiagnosticResult 
} from '../lib/ai-service';

// ============================================
// PROPS (opcional si viene de ruta anterior)
// ============================================

interface Props {
  diagnosticResults?: DiagnosticResult[];
  userProfile?: UserProfile;
}

const props = withDefaults(defineProps<Props>(), {
  diagnosticResults: () => [],
  userProfile: () => ({
    userId: 'user-demo',
    name: 'Usuario Demo',
    sector: 'Tecnología',
    experience: '1-3 años',
    aspiration: 'Convertirme en Senior Developer'
  })
});

// ============================================
// ESTADO DEL COMPONENTE
// ============================================

const expandedMilestone = ref<string | null>(null);
const milestones = ref<Milestone[]>([]);
const isLoading = ref(true);
const roadmapData = ref<RoadmapData | null>(null);

// Inicializar servicio de IA para roadmap
const roadmapAI = useRoadmapAI(props.userProfile, props.diagnosticResults);

// ============================================
// LIFECYCLE
// ============================================

onMounted(async () => {
  await loadRoadmap();
});

// ============================================
// COMPUTED PROPERTIES
// ============================================

const overallProgress = computed(() => {
  if (milestones.value.length === 0) return 0;
  
  const totalProgress = milestones.value.reduce((sum, m) => sum + m.progress, 0);
  return Math.round(totalProgress / milestones.value.length);
});

const completedCount = computed(() => {
  return milestones.value.filter(m => m.status === 'completed').length;
});

const inProgressCount = computed(() => {
  return milestones.value.filter(m => m.status === 'in-progress').length;
});

const pendingCount = computed(() => {
  return milestones.value.filter(m => m.status === 'pending').length;
});

// ============================================
// MÉTODOS
// ============================================

/**
 * Carga el roadmap (genera uno nuevo o carga existente)
 */
const loadRoadmap = async () => {
  isLoading.value = true;
  
  try {
    // TODO: Verificar si existe roadmap guardado en localStorage o backend
    const savedRoadmap = localStorage.getItem('skillIA-roadmap');
    
    if (savedRoadmap) {
      roadmapData.value = JSON.parse(savedRoadmap);
      milestones.value = roadmapData.value!.milestones;
    } else {
      // Generar nuevo roadmap con IA
      roadmapData.value = await roadmapAI.generateRoadmap();
      milestones.value = roadmapData.value.milestones;
      
      // Guardar en localStorage
      localStorage.setItem('skillIA-roadmap', JSON.stringify(roadmapData.value));
    }
  } catch (error) {
    console.error('Error loading roadmap:', error);
    // Cargar datos mock en caso de error
    loadMockRoadmap();
  } finally {
    isLoading.value = false;
  }
};

/**
 * Carga roadmap mock para desarrollo/demo
 */
const loadMockRoadmap = () => {
  milestones.value = [
    {
      id: '1',
      title: 'Fundamentos de Liderazgo',
      description: 'Desarrolla habilidades básicas de liderazgo y gestión de equipos.',
      status: 'completed',
      progress: 100,
      estimatedTime: '2 semanas',
      difficulty: 'Básico',
      category: 'Soft Skills',
      objectives: [
        'Comprender los principios fundamentales del liderazgo',
        'Identificar diferentes estilos de liderazgo',
        'Aplicar técnicas básicas de motivación de equipos'
      ],
      resources: [
        { title: 'Introducción al Liderazgo Efectivo', url: '#', type: 'article' },
        { title: 'Los 5 Niveles de Liderazgo', url: '#', type: 'video' },
        { title: 'Curso: Liderazgo para Principiantes', url: '#', type: 'course' }
      ],
      completedDate: new Date('2025-10-15')
    },
    {
      id: '2',
      title: 'Comunicación Efectiva',
      description: 'Mejora tus habilidades de comunicación verbal y escrita en entornos profesionales.',
      status: 'in-progress',
      progress: 65,
      estimatedTime: '3 semanas',
      difficulty: 'Intermedio',
      category: 'Soft Skills',
      objectives: [
        'Dominar técnicas de comunicación asertiva',
        'Mejorar la escucha activa',
        'Crear presentaciones impactantes'
      ],
      resources: [
        { title: 'El Arte de la Comunicación Asertiva', url: '#', type: 'article' },
        { title: 'Técnicas de Presentación Efectiva', url: '#', type: 'video' },
        { title: 'Workshop: Comunicación Profesional', url: '#', type: 'course' }
      ]
    },
    {
      id: '3',
      title: 'Análisis de Datos con Python',
      description: 'Aprende a manipular, analizar y visualizar datos usando Python y sus librerías principales.',
      status: 'pending',
      progress: 0,
      estimatedTime: '4 semanas',
      difficulty: 'Intermedio',
      category: 'Technical',
      objectives: [
        'Dominar Pandas para manipulación de datos',
        'Crear visualizaciones con Matplotlib y Seaborn',
        'Implementar análisis estadísticos básicos'
      ],
      resources: [
        { title: 'Python para Análisis de Datos', url: '#', type: 'course' },
        { title: 'Guía Completa de Pandas', url: '#', type: 'article' },
        { title: 'Visualización de Datos en Python', url: '#', type: 'video' }
      ]
    },
    {
      id: '4',
      title: 'Gestión de Proyectos Ágiles',
      description: 'Implementa metodologías ágiles como Scrum y Kanban en la gestión de proyectos.',
      status: 'pending',
      progress: 0,
      estimatedTime: '3 semanas',
      difficulty: 'Avanzado',
      category: 'Soft Skills',
      objectives: [
        'Comprender los principios del manifiesto ágil',
        'Facilitar ceremonias Scrum efectivas',
        'Gestionar backlogs y sprints'
      ],
      resources: [
        { title: 'Introducción a Scrum', url: '#', type: 'article' },
        { title: 'Certificación Scrum Master', url: '#', type: 'course' },
        { title: 'Casos de Estudio: Proyectos Ágiles', url: '#', type: 'video' }
      ]
    },
    {
      id: '5',
      title: 'Inglés Técnico Profesional',
      description: 'Desarrolla vocabulario técnico y fluidez en inglés para entornos profesionales.',
      status: 'pending',
      progress: 0,
      estimatedTime: '6 semanas',
      difficulty: 'Intermedio',
      category: 'English',
      objectives: [
        'Ampliar vocabulario técnico especializado',
        'Mejorar comprensión lectora de documentación técnica',
        'Practicar conversación en contextos profesionales'
      ],
      resources: [
        { title: 'Business English Essentials', url: '#', type: 'course' },
        { title: 'Technical Vocabulary Guide', url: '#', type: 'article' },
        { title: 'English Conversation Practice', url: '#', type: 'video' }
      ]
    }
  ];
};

const toggleMilestone = (id: string) => {
  expandedMilestone.value = expandedMilestone.value === id ? null : id;
};

const getStatusIcon = (status: Milestone['status']): string => {
  const icons = {
    'completed': 'mdi:check-circle',
    'in-progress': 'mdi:clock-outline',
    'pending': 'mdi:circle-outline'
  };
  return icons[status];
};

const getStatusLabel = (status: Milestone['status']): string => {
  const labels = {
    'completed': 'Completado',
    'in-progress': 'En Progreso',
    'pending': 'Pendiente'
  };
  return labels[status];
};

const startMilestone = async (id: string) => {
  const milestone = milestones.value.find(m => m.id === id);
  if (milestone) {
    milestone.status = 'in-progress';
    milestone.progress = 0;
    console.log(`Iniciando módulo: ${milestone.title}`);
    
    // Guardar cambios
    await saveRoadmap();
    
    // TODO: Llamar al servicio de IA para registrar inicio
  }
};

const completeMilestone = async (id: string) => {
  const milestone = milestones.value.find(m => m.id === id);
  if (milestone) {
    milestone.status = 'completed';
    milestone.progress = 100;
    milestone.completedDate = new Date();
    console.log(`Módulo completado: ${milestone.title}`);
    
    // Guardar cambios
    await saveRoadmap();
    
    // Actualizar roadmap con IA (generar nuevos hitos si es necesario)
    await updateRoadmapWithAI();
  }
};

const reviewMilestone = (id: string) => {
  const milestone = milestones.value.find(m => m.id === id);
  if (milestone) {
    console.log(`Revisando módulo: ${milestone.title}`);
    // TODO: Abrir vista detallada del módulo
  }
};

/**
 * Actualiza el roadmap usando IA después de completar hitos
 */
const updateRoadmapWithAI = async () => {
  if (!roadmapData.value) return;
  
  try {
    const completedIds = milestones.value
      .filter(m => m.status === 'completed')
      .map(m => m.id);
    
    const updatedRoadmap = await roadmapAI.updateRoadmap(roadmapData.value, completedIds);
    
    roadmapData.value = updatedRoadmap;
    milestones.value = updatedRoadmap.milestones;
    
    await saveRoadmap();
    
    console.log('Roadmap actualizado con IA');
  } catch (error) {
    console.error('Error actualizando roadmap:', error);
  }
};

/**
 * Guarda el roadmap en localStorage (temporal, luego será backend)
 */
const saveRoadmap = async () => {
  if (!roadmapData.value) return;
  
  roadmapData.value.milestones = milestones.value;
  roadmapData.value.lastUpdated = new Date();
  roadmapData.value.overallProgress = overallProgress.value;
  
  localStorage.setItem('skillIA-roadmap', JSON.stringify(roadmapData.value));
  
  // TODO: Guardar en backend
};

const goToProfile = () => {
  console.log('Ir a perfil de usuario');
  // TODO: Navegar a perfil
  window.location.href = '/';
};

const openAIChat = () => {
  console.log('Navegando al chat con asistente IA');
  window.location.href = '/chat';
};
</script>

<style scoped>
/* ============================================ */
/* VARIABLES Y CONFIGURACIÓN */
/* ============================================ */
.roadmap-container {
  min-height: 100vh;
  background: var(--color-bg-main);
  font-family: 'Work Sans', sans-serif;
  color: white;
  padding-bottom: 2rem;
}

/* ============================================ */
/* HEADER */
/* ============================================ */
.roadmap-header {
  background: var(--color-bg-secondary);
  border-bottom: 1px solid var(--color-complementary);
  padding: 1.5rem 2rem;
  position: sticky;
  top: 0;
  z-index: 100;
  backdrop-filter: blur(10px);
}

.header-content {
  max-width: 1400px;
  margin: 0 auto;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 2rem;
}

.header-brand {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.icon-wrapper {
  width: 3rem;
  height: 3rem;
  background: linear-gradient(135deg, var(--color-primary), var(--color-interaction));
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.header-text {
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}

.header-title {
  font-size: 1.5rem;
  font-weight: 700;
  color: white;
  margin: 0;
}

.header-subtitle {
  font-size: 0.875rem;
  color: var(--color-success);
  margin: 0;
}

.profile-button {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1.5rem;
  background: transparent;
  border: 2px solid var(--color-complementary);
  border-radius: 12px;
  color: white;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  font-family: 'Work Sans', sans-serif;
}

.profile-button:hover {
  background: var(--color-complementary);
  border-color: var(--color-primary);
  transform: translateY(-2px);
}

/* ============================================ */
/* PROGRESS SUMMARY */
/* ============================================ */
.progress-summary {
  max-width: 1400px;
  margin: 2rem auto;
  padding: 0 2rem;
}

.summary-card {
  background: var(--color-bg-secondary);
  border: 1px solid var(--color-complementary);
  border-radius: 20px;
  padding: 2rem;
}

.summary-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
}

.summary-title {
  font-size: 1.75rem;
  font-weight: 700;
  color: white;
  margin: 0;
}

.summary-percentage {
  font-size: 2.5rem;
  font-weight: 700;
  color: var(--color-success);
}

.progress-bar-large {
  height: 16px;
  background: var(--color-complementary);
  border-radius: 999px;
  overflow: hidden;
  margin-bottom: 2rem;
}

.progress-fill-large {
  height: 100%;
  background: linear-gradient(90deg, var(--color-success), var(--color-primary));
  border-radius: 999px;
  transition: width 0.8s ease;
}

.summary-stats {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2rem;
}

.stat-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.5rem;
  padding: 1rem;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 12px;
}

.stat-icon {
  width: 2rem;
  height: 2rem;
}

.stat-icon.completed {
  color: var(--color-success);
}

.stat-icon.in-progress {
  color: #ffc400;
}

.stat-icon.pending {
  color: var(--color-complementary);
}

.stat-value {
  font-size: 2rem;
  font-weight: 700;
  color: white;
}

.stat-label {
  font-size: 0.875rem;
  color: rgba(255, 255, 255, 0.7);
  text-align: center;
}

/* ============================================ */
/* ROADMAP TIMELINE */
/* ============================================ */
.roadmap-timeline {
  max-width: 1400px;
  margin: 3rem auto;
  padding: 0 2rem;
}

.timeline-container {
  position: relative;
  display: flex;
  flex-direction: column;
  gap: 2rem;
}

.milestone-wrapper {
  position: relative;
}

.timeline-line {
  position: absolute;
  left: 2rem;
  top: -2rem;
  width: 4px;
  height: 2rem;
  background: linear-gradient(180deg, var(--color-complementary), transparent);
}

/* ============================================ */
/* MILESTONE CARDS */
/* ============================================ */
.milestone-card {
  position: relative;
  display: flex;
  gap: 1.5rem;
  background: var(--color-bg-secondary);
  border: 2px solid var(--color-complementary);
  border-radius: 20px;
  padding: 1.5rem;
  cursor: pointer;
  transition: all 0.3s ease;
}

.milestone-card:hover {
  border-color: var(--color-primary);
  transform: translateX(8px);
  box-shadow: 0 8px 30px rgba(140, 26, 217, 0.2);
}

.milestone-card.status-completed {
  border-color: var(--color-success);
  background: rgba(6, 214, 160, 0.05);
}

.milestone-card.status-in-progress {
  border-color: #ffc400;
  background: rgba(255, 196, 0, 0.05);
}

/* Status Indicator */
.milestone-indicator {
  width: 4rem;
  height: 4rem;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  border: 3px solid;
  transition: all 0.3s ease;
}

.indicator-completed {
  background: var(--color-success);
  border-color: var(--color-success);
  color: white;
  box-shadow: 0 0 20px rgba(6, 214, 160, 0.4);
}

.indicator-in-progress {
  background: #ffc400;
  border-color: #ffc400;
  color: var(--color-bg-main);
  box-shadow: 0 0 20px rgba(255, 196, 0, 0.4);
  animation: pulse 2s ease-in-out infinite;
}

.indicator-pending {
  background: transparent;
  border-color: var(--color-complementary);
  color: var(--color-complementary);
}

@keyframes pulse {
  0%, 100% {
    transform: scale(1);
    box-shadow: 0 0 20px rgba(255, 196, 0, 0.4);
  }
  50% {
    transform: scale(1.05);
    box-shadow: 0 0 30px rgba(255, 196, 0, 0.6);
  }
}

/* Card Content */
.milestone-content {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.milestone-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 1rem;
}

.milestone-main {
  display: flex;
  align-items: center;
  gap: 1rem;
  flex-wrap: wrap;
}

.milestone-title {
  font-size: 1.5rem;
  font-weight: 600;
  color: white;
  margin: 0;
}

.milestone-status-badge {
  padding: 0.375rem 0.875rem;
  border-radius: 8px;
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.badge-completed {
  background: rgba(6, 214, 160, 0.2);
  color: var(--color-success);
}

.badge-in-progress {
  background: rgba(255, 196, 0, 0.2);
  color: #ffc400;
}

.badge-pending {
  background: rgba(75, 73, 140, 0.3);
  color: var(--color-complementary);
}

.expand-button {
  background: transparent;
  border: none;
  color: var(--color-complementary);
  cursor: pointer;
  padding: 0.25rem;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}

.expand-button:hover {
  color: var(--color-primary);
  transform: scale(1.1);
}

.milestone-description {
  font-size: 1rem;
  color: rgba(255, 255, 255, 0.8);
  line-height: 1.6;
  margin: 0;
}

/* Progress Bar for In-Progress */
.milestone-progress {
  margin-top: 0.5rem;
}

.progress-info {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 0.5rem;
}

.progress-label {
  font-size: 0.875rem;
  color: rgba(255, 255, 255, 0.7);
}

.progress-percentage-small {
  font-size: 0.875rem;
  font-weight: 600;
  color: #ffc400;
}

.progress-bar-small {
  height: 8px;
  background: var(--color-complementary);
  border-radius: 999px;
  overflow: hidden;
}

.progress-fill-small {
  height: 100%;
  background: linear-gradient(90deg, #ffc400, var(--color-primary));
  border-radius: 999px;
  transition: width 0.5s ease;
}

/* Metadata */
.milestone-metadata {
  display: flex;
  gap: 1.5rem;
  flex-wrap: wrap;
}

.metadata-item {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.875rem;
  color: rgba(255, 255, 255, 0.7);
}

.metadata-item svg {
  color: var(--color-success);
}

/* ============================================ */
/* EXPANDED DETAILS */
/* ============================================ */
.milestone-details {
  margin-top: 1rem;
  padding-top: 1.5rem;
  border-top: 1px solid var(--color-complementary);
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.details-section {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.details-title {
  font-size: 1.125rem;
  font-weight: 600;
  color: white;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  margin: 0;
}

.details-title svg {
  color: var(--color-success);
}

.details-list {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.details-list li {
  padding-left: 1.5rem;
  position: relative;
  color: rgba(255, 255, 255, 0.9);
  line-height: 1.6;
}

.details-list li::before {
  content: '→';
  position: absolute;
  left: 0;
  color: var(--color-success);
  font-weight: 700;
}

.resources-list {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.resource-link {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.75rem 1rem;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid var(--color-complementary);
  border-radius: 8px;
  color: white;
  text-decoration: none;
  transition: all 0.3s ease;
}

.resource-link:hover {
  background: rgba(140, 26, 217, 0.1);
  border-color: var(--color-primary);
  transform: translateX(4px);
}

.resource-link svg {
  color: var(--color-success);
}

/* Action Buttons */
.milestone-actions {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
  margin-top: 0.5rem;
}

.action-button {
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

.action-button.primary {
  background: linear-gradient(135deg, var(--color-primary), var(--color-interaction));
  color: white;
}

.action-button.primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(140, 26, 217, 0.3);
}

.action-button.success {
  background: var(--color-success);
  color: var(--color-bg-main);
}

.action-button.success:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(6, 214, 160, 0.3);
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

/* Expand Transition */
.expand-enter-active,
.expand-leave-active {
  transition: all 0.3s ease;
  overflow: hidden;
}

.expand-enter-from,
.expand-leave-to {
  opacity: 0;
  max-height: 0;
}

.expand-enter-to,
.expand-leave-from {
  opacity: 1;
  max-height: 1000px;
}

/* ============================================ */
/* AI ASSISTANT FAB */
/* ============================================ */
.ai-assistant-fab {
  position: fixed;
  bottom: 2rem;
  right: 2rem;
  width: 4rem;
  height: 4rem;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--color-primary), var(--color-interaction));
  border: none;
  color: white;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 8px 30px rgba(140, 26, 217, 0.4);
  transition: all 0.3s ease;
  z-index: 1000;
}

.ai-assistant-fab:hover {
  transform: translateY(-4px) scale(1.05);
  box-shadow: 0 12px 40px rgba(140, 26, 217, 0.6);
}

.ai-assistant-fab:active {
  transform: translateY(-2px) scale(1.02);
}

/* ============================================ */
/* RESPONSIVE */
/* ============================================ */
@media (max-width: 1024px) {
  .header-content {
    flex-direction: column;
    align-items: flex-start;
  }

  .summary-stats {
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
  }
}

@media (max-width: 768px) {
  .roadmap-header {
    padding: 1rem;
  }

  .header-title {
    font-size: 1.25rem;
  }

  .progress-summary,
  .roadmap-timeline {
    padding: 0 1rem;
  }

  .summary-card {
    padding: 1.5rem;
  }

  .summary-stats {
    grid-template-columns: 1fr;
    gap: 1rem;
  }

  .milestone-card {
    flex-direction: column;
    gap: 1rem;
  }

  .milestone-indicator {
    width: 3rem;
    height: 3rem;
  }

  .milestone-title {
    font-size: 1.25rem;
  }

  .milestone-metadata {
    flex-direction: column;
    gap: 0.75rem;
  }

  .milestone-actions {
    flex-direction: column;
  }

  .action-button {
    width: 100%;
    justify-content: center;
  }

  .ai-assistant-fab {
    bottom: 1.5rem;
    right: 1.5rem;
    width: 3.5rem;
    height: 3.5rem;
  }
}

@media (max-width: 480px) {
  .header-brand {
    flex-direction: column;
    align-items: flex-start;
  }

  .summary-title {
    font-size: 1.5rem;
  }

  .summary-percentage {
    font-size: 2rem;
  }

  .milestone-card:hover {
    transform: translateX(4px);
  }
}
</style>
