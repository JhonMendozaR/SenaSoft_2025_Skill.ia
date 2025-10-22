// Script de prueba rápida para verificar que Groq funciona
// Ejecutar con: node test-groq.js

import Groq from "groq-sdk";

// Lee la API key del .env
import { readFileSync } from 'fs';
import { fileURLToPath } from 'url';
import { dirname, join } from 'path';

const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);

try {
  const envContent = readFileSync(join(__dirname, '.env'), 'utf-8');
  const match = envContent.match(/PUBLIC_GROQ_API_KEY=(.+)/);
  
  if (!match) {
    console.error('❌ No se encontró PUBLIC_GROQ_API_KEY en .env');
    process.exit(1);
  }

  const apiKey = match[1].trim();
  console.log('✅ API Key encontrada:', apiKey.substring(0, 10) + '...');

  const groq = new Groq({ apiKey });

  console.log('\n🤖 Probando generación de pregunta con Groq...\n');

  const completion = await groq.chat.completions.create({
    messages: [
      {
        role: "system",
        content: `Eres un experto en evaluación de habilidades profesionales. Genera una pregunta de diagnóstico en formato JSON.

Formato requerido:
{
  "id": "q-test-1",
  "text": "texto de la pregunta",
  "type": "multiple-choice",
  "category": "technical",
  "options": [
    {"id": "opt-1", "text": "opción 1", "value": 5},
    {"id": "opt-2", "text": "opción 2", "value": 4},
    {"id": "opt-3", "text": "opción 3", "value": 3},
    {"id": "opt-4", "text": "opción 4", "value": 2}
  ],
  "metadata": {
    "difficulty": "medium"
  }
}`
      },
      {
        role: "user",
        content: "Genera una pregunta para evaluar conocimientos básicos de SQL para un usuario con 1-3 años de experiencia en tecnología."
      }
    ],
    model: "llama-3.3-70b-versatile", // Modelo actualizado
    temperature: 0.7,
    max_tokens: 1024,
    response_format: { type: "json_object" }
  });

  const content = completion.choices[0]?.message?.content;
  const question = JSON.parse(content);

  console.log('✅ Pregunta generada exitosamente:\n');
  console.log('Texto:', question.text);
  console.log('Categoría:', question.category);
  console.log('Tipo:', question.type);
  console.log('Opciones:', question.options.length);
  console.log('\nOpciones:');
  question.options.forEach(opt => {
    console.log(`  - ${opt.text} (valor: ${opt.value})`);
  });

  console.log('\n✨ ¡Todo funciona correctamente! Groq está listo para usar.');

} catch (error) {
  console.error('❌ Error:', error.message);
  if (error.code === 'ENOENT') {
    console.error('\n💡 El archivo .env no existe. Créalo con:');
    console.error('   cp .env.example .env');
    console.error('   # Luego edita .env y agrega tu PUBLIC_GROQ_API_KEY');
  }
}
