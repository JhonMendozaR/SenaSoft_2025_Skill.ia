<template>
  <div class="login-container">
    <div class="login-card">
      <!-- Logo / Marca -->
      <div class="brand-section">
        <h1 class="brand-title">Skill.<span class="brand-highlight">IA</span></h1>
        <p class="brand-subtitle">Unlocking Potential</p>
      </div>

      <!-- Formulario de Login -->
      <form @submit.prevent="handleLogin" class="login-form">
        <h2 class="form-title">Iniciar Sesión</h2>
        
        <!-- Campo de Email -->
        <div class="form-group">
          <label for="email" class="form-label">Correo Electrónico</label>
          <div class="input-wrapper">
            <Icon icon="mdi:email-outline" class="input-icon" />
            <input
              id="email"
              v-model="formData.email"
              type="email"
              placeholder="tu@email.com"
              class="form-input"
              required
            />
          </div>
          <span v-if="errors.email" class="error-message">{{ errors.email }}</span>
        </div>

        <!-- Campo de Contraseña -->
        <div class="form-group">
          <label for="password" class="form-label">Contraseña</label>
          <div class="input-wrapper">
            <Icon icon="mdi:lock-outline" class="input-icon" />
            <input
              id="password"
              v-model="formData.password"
              :type="showPassword ? 'text' : 'password'"
              placeholder="••••••••"
              class="form-input"
              required
            />
            <button
              type="button"
              @click="togglePassword"
              class="password-toggle"
              aria-label="Toggle password visibility"
            >
              <Icon 
                :icon="showPassword ? 'mdi:eye-off-outline' : 'mdi:eye-outline'" 
                width="20" 
                height="20"
              />
            </button>
          </div>
          <span v-if="errors.password" class="error-message">{{ errors.password }}</span>
        </div>

        <!-- Recordar sesión / Olvidé contraseña -->
        <div class="form-options">
          <label class="remember-me">
            <input type="checkbox" v-model="formData.remember" class="checkbox">
            <span>Recordarme</span>
          </label>
          <a href="/forgot-password" class="forgot-link">¿Olvidaste tu contraseña?</a>
        </div>

        <!-- Botón de envío -->
        <button type="submit" class="submit-button" :disabled="isLoading">
          <span v-if="!isLoading">Iniciar Sesión</span>
          <span v-else class="loading-spinner">
            <Icon icon="mdi:loading" class="animate-spin" width="20" height="20" />
            Iniciando...
          </span>
        </button>

        <!-- Registro -->
        <div class="register-section">
          <p>¿No tienes una cuenta? <a href="/register" class="register-link">Regístrate aquí</a></p>
        </div>
      </form>

      <!-- Footer -->
      <div class="footer-text">
        <p>Desarrollado por <strong>Tití Devs</strong> | SenaSoft 2025</p>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, reactive } from 'vue';
import { Icon } from '@iconify/vue';

interface FormData {
  email: string;
  password: string;
  remember: boolean;
}

interface Errors {
  email?: string;
  password?: string;
}

const formData = reactive<FormData>({
  email: '',
  password: '',
  remember: false
});

const errors = reactive<Errors>({});
const showPassword = ref(false);
const isLoading = ref(false);

const togglePassword = () => {
  showPassword.value = !showPassword.value;
};

const validateForm = (): boolean => {
  errors.email = '';
  errors.password = '';

  // Validar email
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!formData.email) {
    errors.email = 'El correo electrónico es requerido';
    return false;
  } else if (!emailRegex.test(formData.email)) {
    errors.email = 'Ingresa un correo electrónico válido';
    return false;
  }

  // Validar contraseña
  if (!formData.password) {
    errors.password = 'La contraseña es requerida';
    return false;
  } else if (formData.password.length < 6) {
    errors.password = 'La contraseña debe tener al menos 6 caracteres';
    return false;
  }

  return true;
};

const handleLogin = async () => {
  if (!validateForm()) return;
  
  // Prevenir múltiples clicks
  if (isLoading.value) return;
  
  isLoading.value = true;

  try {
    const response = await fetch('http://10.0.0.45:8000/api/users/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
      body: JSON.stringify({
        email: formData.email,
        password: formData.password
      })
    });

    const data = await response.json();

    if (!response.ok) {
      errors.email = data.message || 'Credenciales inválidas. Por favor, intenta nuevamente.';
      return;
    }

    console.log('Login exitoso:', data);
    
    if (formData.remember && data.token) {
      localStorage.setItem('auth_token', data.token);
      localStorage.setItem('user', JSON.stringify(data.user));
    }

    window.location.href = '/diagnostic';
    
  } catch (error) {
    console.error('Error en login:', error);
    errors.email = 'Error de conexión. Por favor, intenta nuevamente.';
  } finally {
    isLoading.value = false;
  }
};
</script>

<style scoped>
.login-container {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 1rem;
  background: linear-gradient(135deg, #1E1940 0%, #262473 100%);
}

.login-card {
  width: 100%;
  max-width: 480px;
  background-color: #262473;
  border-radius: 24px;
  padding: 2.5rem;
  box-shadow: 0 20px 60px rgba(140, 26, 217, 0.15);
  border: 1px solid rgba(140, 26, 217, 0.2);
}

/* Brand Section */
.brand-section {
  text-align: center;
  margin-bottom: 2.5rem;
}

.brand-title {
  font-size: 3rem;
  font-weight: 700;
  color: white;
  margin-bottom: 0.5rem;
}

.brand-highlight {
  color: #8C1AD9;
}

.brand-subtitle {
  font-size: 1rem;
  color: #06D6A0;
  font-weight: 400;
  letter-spacing: 0.5px;
}

/* Form */
.login-form {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.form-title {
  font-size: 1.75rem;
  font-weight: 600;
  color: white;
  margin-bottom: 0.5rem;
  text-align: center;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.form-label {
  font-size: 0.875rem;
  font-weight: 500;
  color: #06D6A0;
}

.input-wrapper {
  position: relative;
  display: flex;
  align-items: center;
}

.input-icon {
  position: absolute;
  left: 1rem;
  width: 1.25rem;
  height: 1.25rem;
  color: #4B498C;
  pointer-events: none;
}

.form-input {
  width: 100%;
  padding: 0.875rem 1rem 0.875rem 3rem;
  background-color: #1E1940;
  border: 2px solid #4B498C;
  border-radius: 12px;
  color: white;
  font-size: 1rem;
  font-family: 'Work Sans', sans-serif;
  transition: all 0.3s ease;
}

.form-input:focus {
  outline: none;
  border-color: #8C1AD9;
  box-shadow: 0 0 0 3px rgba(140, 26, 217, 0.1);
}

.form-input::placeholder {
  color: #4B498C;
}

.password-toggle {
  position: absolute;
  right: 1rem;
  background: transparent;
  border: none;
  cursor: pointer;
  padding: 0.25rem;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #4B498C;
  transition: color 0.2s ease;
}

.password-toggle:hover {
  color: #8C1AD9;
}

.error-message {
  font-size: 0.75rem;
  color: #ff6b6b;
  margin-top: 0.25rem;
}

/* Form Options */
.form-options {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 1rem;
  margin-top: -0.5rem;
}

.remember-me {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.875rem;
  color: #4B498C;
  cursor: pointer;
}

.checkbox {
  width: 1rem;
  height: 1rem;
  cursor: pointer;
  accent-color: #8C1AD9;
}

.forgot-link {
  font-size: 0.875rem;
  color: #06D6A0;
  text-decoration: none;
  font-weight: 500;
  transition: color 0.2s ease;
}

.forgot-link:hover {
  color: #8C1AD9;
}

/* Submit Button */
.submit-button {
  width: 100%;
  padding: 1rem;
  background: linear-gradient(135deg, #8C1AD9 0%, #4945BF 100%);
  color: white;
  border: none;
  border-radius: 12px;
  font-size: 1rem;
  font-weight: 600;
  font-family: 'Work Sans', sans-serif;
  cursor: pointer;
  transition: all 0.3s ease;
  margin-top: 0.5rem;
}

.submit-button:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 10px 30px rgba(140, 26, 217, 0.3);
}

.submit-button:active:not(:disabled) {
  transform: translateY(0);
}

.submit-button:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

.loading-spinner {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
}

.animate-spin {
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

/* Register Section */
.register-section {
  text-align: center;
  padding-top: 1.5rem;
  border-top: 1px solid #4B498C;
}

.register-section p {
  font-size: 0.875rem;
  color: #4B498C;
}

.register-link {
  color: #06D6A0;
  font-weight: 600;
  text-decoration: none;
  transition: color 0.2s ease;
}

.register-link:hover {
  color: #8C1AD9;
}

/* Footer */
.footer-text {
  text-align: center;
  margin-top: 2rem;
  padding-top: 1.5rem;
  border-top: 1px solid #4B498C;
}

.footer-text p {
  font-size: 0.75rem;
  color: #4B498C;
}

.footer-text strong {
  color: #06D6A0;
}

/* Responsive */
@media (max-width: 640px) {
  .login-card {
    padding: 2rem 1.5rem;
  }

  .brand-title {
    font-size: 2.5rem;
  }

  .form-title {
    font-size: 1.5rem;
  }

  .form-options {
    flex-direction: column;
    align-items: flex-start;
  }
}

@media (max-width: 480px) {
  .login-card {
    padding: 1.5rem 1rem;
  }

  .brand-title {
    font-size: 2rem;
  }
}
</style>
