# Unlocking Potential: Skill.IA

👥 **Group 8: Tití Devs**

Project developed for SenaSoft 2025

**Skill.ia** is an intelligent platform designed to help professionals discover their true potential. It accurately assesses the user's technical skills, soft skills, and English proficiency through brief and personalized evaluations, generating a clear diagnosis of their current situation. Based on these results, it creates an adaptive professional development roadmap that organizes goals and learning in logical order according to each person's profile and aspirations. As the user progresses, an intelligent conversational agent accompanies them, offering guidance, recommendations, and emotional support that evolve alongside their progress. All information is managed in a structured database that stores their profile, results, achieved milestones, and level of advancement, allowing the system to learn from their journey and always provide relevant and personalized guidance toward their professional growth.

## Use Case Scenario

### User

Daniela is a data analyst with three years of experience. She masters Excel and basic SQL, but feels she's falling behind when she hears her colleagues talk about machine learning and advanced visualization.

### Problem

Her English is functional but limited. She wants to grow professionally, but is overwhelmed by the number of options: Python first or perfect SQL? Invest in English or technical skills? Should she focus on leadership or deepen technical knowledge?

### Expected Solution

Daniela needs a system that honestly assesses where she stands today, shows her a clear and logical development path, and accompanies her with intelligent guidance at each phase. When she's starting out, she needs a tutor to explain basic concepts. As she progresses, she needs a mentor to challenge her and help her make strategic career decisions.

### Final Result

The current state is uncertainty and dispersed effort. The desired state is absolute clarity about her current position, a structured path forward, and an intelligent companion that evolves with her.

---

## Meet Our Team

### José David Campo Marquez — Business Analyst (BA)

**Main Responsibilities:**
- Requirements gathering
- Functional analysis: user stories, use cases, functional requirements
- Documentation: Keep functional documents, flowcharts, or process models updated
- Validation: Ensure the final solution meets business objectives

### Jhon Alexis Mendoza Rojas — Quality Assurance (QA)

**Main Responsibilities:**
- Test planning: Design strategies, plans, and test cases (manual or automated)
- Test execution: Test the application to detect errors or inconsistencies (functional, usability, performance, etc.)
- Incident management: Record, prioritize, and follow up on found bugs
- Delivery verification: Validate that corrections meet expectations without affecting other functionalities
- Continuous improvement: Propose improvements in the development process quality

### Igmar De Jesus Lozada Bolivar — Developer (Dev)

**Main Responsibilities:**
- Feature development: Write, test, and maintain system code
- Technical analysis: Evaluate the feasibility of proposed solutions and estimate timelines
- Integration: Connect different modules, APIs, or services as needed
- Code review: Participate in code reviews to maintain code quality
- Error correction: Solve defects reported by QA or users
- Technical documentation: Record architecture, dependencies, and design decisions

---

## Prototype to Build

The Skill.ia prototype will be a functional web platform that integrates the three fundamental pieces of the system: skills diagnosis, personalized roadmap generation, and intelligent accompaniment.

### Objective

Demonstrate the technical and functional viability of an intelligent professional development system, capable of diagnosing a user's current skills, generating a personalized learning roadmap, and offering adaptive conversational accompaniment that evolves with their progress.

---

## Main Prototype Modules

### 1. User Registration and Profile Module

**Objective:** Collect the user's basic personal and professional data.

**Key Elements:**
- Registration form with fields defined in the users table (name, sector, experience, aspiration, English level, etc.)
- Validation and storage of information in the database
- Profile panel where the user can update their information

### 2. Initial Diagnosis Module

**Objective:** Evaluate the user's technical, soft, and language competencies.

**Functioning:**
- Short quiz-type questionnaires (e.g., multiple choice or self-assessment scale)
- Upon completion, results are saved in evaluations and evaluation_results
- The system generates a visual diagnosis report showing strengths, gaps, and a global score
- Level per competency is calculated and the user's base profile is determined (associated with target_profiles)

### 3. Learning Roadmap Generator

**Objective:** Create a personalized development roadmap based on the diagnosis.

**Functioning:**
- The system analyzes evaluation results and selects appropriate milestones from the milestones catalog
- Creates a record in roadmaps associated with the user and their target profile
- Organizes milestones in logical order (by difficulty level) within roadmap_milestones
- Shows the user a "progress line" type interface with their milestones, status, and progress percentage
- Allows marking milestones as "in progress" or "completed", updating the user_progress table

### 4. Intelligent Conversational Agent

**Objective:** Accompany the user during their development, adapting tone and type of guidance according to progress.

**Features:**
- Chat-type interface integrated into the platform (using language model API)
- Record of each interaction in agent_interactions, including intention, tone, channel, and satisfaction level
- The agent:
  - Explains concepts when the user starts (tutor mode)
  - Motivates and offers resources when progress is slow (coach mode)
  - Proposes challenges or reflections when the user advances (mentor mode)
- Ability to generate automatic recommendations (saved in recommendations) about habits, learning resources, or language reinforcement

### 5. Progress and Visualization Panel

**Objective:** Offer a clear view of the user's progress.

**Functions:**
- General progress bar and by competency
- History of completed milestones with time invested and completion date
- Score evolution graphs between evaluations (diagnosis → follow-up → final)

---

## Prototype Architecture

| Component | Proposed Technology | Description |
|-----------|-------------------|-------------|
| Frontend | HTML5, CSS3, JavaScript (framework: Astro + Vue.js + TypeScript) | Modern, responsive, and accessible interface |
| Backend | PHP/Laravel | Business logic management, REST API, and BD communication |
| Database | MySQL | Structured storage of users, evaluations, roadmaps, and progress |
| AI Agent | TCL AI (TypeScript-AI Cognitive Layer) | Conversation processing and adaptive response generation |
| Authentication | Laravel Sanctum | For user management and private information access |

---

## Main User Flow

1. Registration / Login
2. Initial diagnostic evaluation
3. Diagnosis visualization with base profile
4. Automatic roadmap generation
5. Interaction with intelligent agent for guidance
6. Progress update upon completing milestones
7. Follow-up evaluation and automatic roadmap adjustments

---

## Prototype Scope

### The scope includes:

**User Information Capture and Management**
- User registration and authentication
- Creation and storage of professional profile (personal data, sector, aspiration, experience, English level, etc.)
- Association of user with a target profile within the system

**Initial Competency Diagnosis**
- Execution of a simplified diagnostic evaluation to measure technical, soft, and language skills
- Recording of results in evaluations and evaluation_results tables
- Automatic generation of a visual skills profile (strengths and gaps)

**Automatic Learning Roadmap Generation**
- Dynamic creation of a personalized roadmap based on diagnosis results
- Selection of milestones from the catalog (milestones) and sequential organization within roadmap_milestones
- Visualization of user progress and milestone status update (user_progress)

**Intelligent Accompaniment**
- Integration of a conversational agent with AI-generated responses or predefined scripts
- Recording of each interaction in the agent_interactions table, including intention and message tone
- Automatic generation of personalized recommendations stored in recommendations (e.g., study materials or learning habits)

**Progress Visualization and Tracking**
- User panel with progress indicators by competency and general roadmap status
- Evaluation history and comparison between initial and follow-up scores
- Graphical representation of progress to reinforce achievement perception and motivation

### Out of Scope

To keep the prototype within reasonable time and complexity limits, it will not include:

- Integrations with external course platforms (like Coursera or Udemy)
- Advanced evaluations with automatic grading of practical exercises
- Voice personalization or audio processing
- Machine learning algorithms for performance prediction (base rules will be simulated)

---

## Available Inputs

### User Data
- Responses to diagnostic evaluations on technical skills, soft skills, and English level
- Progress history and completed modules in the roadmap
- Previous interactions with the conversational agent
- Basic professional profile (experience, sector, aspirations)

### Technical Resources
- Advanced language model APIs for conversational processing
- Competency evaluation and categorization systems
- Adaptive learning roadmap generation frameworks
- Conversational context analysis tools

### Restrictions
- Initial diagnosis must be simple enough to complete in minutes, but deep enough to generate meaningful roadmaps
- Interaction with the agent must feel natural and not robotic
- The system must work with limited user information at the start

---

## Expected Results

Based on the idea, 3 transformative solutions are expected:

### Transparent Diagnosis

A clear and actionable profile that shows the user where they really stand in their technical, soft, and English communication skills. Not vague evaluations, but precise categorizations that the user can understand and validate.

### Living Roadmap

A personalized development path that is not a generic list of courses, but a logical and progressive sequence of milestones specific to the user's profile. The path must make sense for someone in their particular situation, not for "all professionals".

### Evolutionary Accompaniment

A conversational agent that genuinely changes its way of interacting according to the user's progress. When the user is starting out, it should explain, simplify, and guide with patience. When the user advances, it should challenge, question, and guide strategically. The agent must demonstrate that it understands the user's exact context in their journey.

---

## Functional and Non-Functional Requirements

The system evaluates, guides, and accompanies the user in their professional development through three fundamental components:

- **Transparent Diagnosis:** Initial and continuous skills evaluation
- **Living Roadmap:** Personalized learning path that is dynamically generated
- **Evolutionary Accompaniment:** Intelligent conversational agent that adapts its behavior according to user progress

The MVP must receive user data, process it, generate understandable results, and maintain a progress history that evolves over time with the user, allowing constant transformation of their knowledge (Technical skills, Soft skills) and exponential growth of their potential.

---

## Functional Requirements

### User Registration and Profile

**RF1.1 – User Registration and Profile**

- The system must allow user registration via email and password
- The system must allow the user to enter their basic information:
  - Name, work experience, professional sector, aspirations
  - English level (self-assessed)
  - Proficiency level in tools (Excel, SQL, Python, etc.)
- The system must store this information to generate an initial profile

**RF1.2 – Initial Diagnostic Evaluation**

- The system must present a short evaluation (5-10 minutes) on:
  - Technical skills: questions or cases about SQL, Excel, Python, etc.
  - Soft skills: decision-making, leadership, communication
  - Functional English: reading comprehension, writing, and glossary associated with their professional or work sector
- The test must adapt dynamically according to responses (more complex questions if the user succeeds, simpler if they fail)
- The evaluation must allow part of the diagnosis to be practical, not just theoretical
  - Example: execute a real SQL query, create an Excel formula, or interpret a visualization
- Practical responses must be automatically analyzed by the system (e.g., evaluating the result of a query)
- The system must allow the user to perform a confidence self-assessment ("How confident do you feel with SQL?") before and after the diagnosis
- The system must be able to detect differences between user perception and reality
  - Example: If the user says they are very advanced in SQL queries, but the agent detects a basic level, it should offer feedback on this discrepancy

**RF1.3 – Results Analysis**

- The system must process evaluation results and classify the user into levels:
  - Technical: Basic, Intermediate, Advanced
  - Soft: Emerging, Competent, Leader
  - English: A1-C1 (CEFR framework)
- The system must generate a visual and textual report with strengths, weaknesses, and improvement opportunities

**RF1.4 – Transparent Feedback**

- The system must offer a clear and accessible explanation of the result ("Your SQL level is intermediate because you successfully solved JOIN queries, but failed at nested subqueries.")

**RF1.5 – Learning Style Dimension**

- The diagnosis must include brief identification of the user's predominant learning style (visual, auditory, kinesthetic, reflective)
- This information must influence how subsequent recommendations are presented (e.g., suggest more videos for visual profiles)

**RF1.6 – Professional Maturity Analysis**

- The diagnosis must include a component that evaluates the level of professional maturity, based on:
  - Level of learning autonomy
  - Critical reflection capacity on one's own career
  - Intrinsic vs extrinsic motivation
- The system must classify the user into levels (Beginner, intermediate, advanced)
- Value: Allows offering different accompaniments: more guided for beginners, more strategic for experts

### Initial Diagnosis

**RF2.1 – Personalized Roadmap Generation**

- The system must create a progressive development path based on the initial diagnosis
- Each roadmap must include:
  - Stages or "maturity levels"
  - Learning modules or milestones (e.g., "Advanced SQL", "Python Automation", "Technical English Communication")
  - Resource recommendations (internal or external)
- The roadmap must update automatically as the user progresses

**RF2.2 – Progress Tracking**

- The system must record the user's progress in each module:
  - Status: "Pending", "In Progress", "Completed"
  - Start and completion date

**RF2.3 – Periodic Re-evaluation**

- The system must offer periodic or checkpoint evaluations to adjust the development path
- If the user improves their technical level, the roadmap must automatically modify

**RF2.4 – Intelligent Recommendations**

- The system must recommend next steps according to:
  - Available time
  - Mastered skills
  - User's previous preferences
- Example: "You've already completed Python fundamentals, I recommend starting basic Machine Learning."

### Evolutionary Accompaniment (Conversational Agent)

**RF3.1 – Natural Conversational Interaction**

- The user must be able to communicate with an intelligent assistant (AI Agent)
- The agent's tone must vary according to the user's level:
  - Beginner: explanatory and empathetic
  - Intermediate: guiding and practical
  - Advanced: challenging and strategic

**RF3.2 – Dynamic Contextualization**

- The agent must have access to the user's history (evaluations, progress, interests) to respond with context
- Example: "I see you've already completed the Advanced SQL module, do you want to practice with real cases?"

**RF3.3 – Conversational Recommendations**

- The agent must be able to suggest resources directly during the conversation:
  - Courses, articles, exercises, practical challenges
  - Personalized feedback on progress

**RF3.4 – Interaction Recording**

- The system must store relevant conversations to:
  - Learn from user behavior
  - Adjust future accompaniment

---

## Non-Functional Requirements

### Performance and Efficiency

**RNF1.1 – Response Time**

- The system must respond to user interactions (especially the conversational agent) in less than 3 seconds average, guaranteeing dialogue fluidity

**RNF1.2 – Diagnosis Processing**

- Generation of the initial diagnosis and roadmap must not exceed 10 seconds from submission of user responses

**RNF1.3 – Light MVP Load**

- The MVP must function correctly with limited resources (max. 2 GB RAM and standard CPU)

### Usability and User Experience

**RNF2.1 – Clear and Guided Interface**

- The use flow (diagnosis → roadmap → accompaniment) must be intuitive and linear, without need for external instructions

**RNF2.2 – Accessible Language**

- All system communication must use natural, clear, and empathetic language, adapting to each user's levels: beginner, intermediate, and advanced

**RNF2.3 – Quick and Understandable Evaluation**

- The diagnosis must be completable in less than 10 minutes, with feedback generated according to their professional sector or user level

**RNF2.4 – Visual Coherence**

- The MVP design must maintain a consistent palette and typography, avoiding cognitive overload or focal points and maintaining focus on results

**RNF2.5 – Conversational Level Adaptability**

- The agent's tone must vary perceptibly according to user level without generating confusion (more explanatory for beginners, more challenging for advanced)

### Security and Privacy

**RNF3.1 – Basic Data Protection**

- Personal data and user results must be stored locally or in a secure environment (without public exposure or unauthorized third parties)

**RNF3.2 – Minimum Guaranteed Confidentiality**

- The MVP must avoid showing or sharing sensitive user information with other profiles or tests

**RNF3.3 – Controlled Sessions**

- Access must require simple authentication (email and password or temporary token)

### Reliability and Availability

**RNF4.1 – Basic Fault Tolerance**

- If an error occurs (e.g., network or API failure), the system must show a clear message and allow retry without loss of immediate progress

**RNF4.2 – Minimum Data Persistence**

- User progress and diagnosis results must be temporarily stored (in database) to not lose information between sessions

**RNF4.3 – Operational Availability**

- The MVP must be able to run 100% in web or local environment (without complex deployment dependencies), guaranteeing stable demonstration during the hackathon

### Portability and Compatibility

**RNF5.1 – Web Accessibility**

- The MVP must work in modern browsers (Chrome, Edge, Firefox) without additional installation

**RNF5.2 – Language Compatibility**

- The system must allow quick language change (minimum support for Spanish and English) without altering business logic

**RNF5.3 – Simple Execution Environment**

- The application must be able to run in local environment (Node, Python, or lightweight web framework) without advanced configurations

---

## Roadmap: Product Vision

Skill.ia is an intelligent system that diagnoses skills through an exam, generating personalized learning roadmaps and offering evolutionary accompaniment through a conversational agent that adapts to each user's professional progress. Thus, the exponential development of this minimum viable product would allow different users a clear evolution in their skills.

### Skill.ia - 6-Month Horizon – "Cognitive and Empathetic Foundation"

**Strategic Objective:**

Validate the agent's value proposition as an intelligent and empathetic companion, capable of delivering immediate clarity to the user after their initial diagnosis.

**Key Focuses:**

**Cognitive Interaction Base Architecture:**
- Development of conversational core using language models (LLMs) that understand the user's professional profile and diagnosis responses

**Minimum Viable Contextualization:**
- The agent will be able to remember key elements of the user's profile (technical skills, soft skills, language, and aspirations) to offer coherent and personalized responses within the same session

**Adaptive Communicative Tone (version 1.0):**
- Implementation of three basic communication modes:
  - Patient guide (beginner)
  - Practical guide (intermediate)
  - Challenging mentor (advanced)

**Explanatory Feedback:**
- Generation of messages that explain the "why" behind each result or recommendation, strengthening the perception of transparency and trust

**Pilot Test with Real Users (Closed Beta):**
- Tests with a group of 20-50 analysts in professional growth stage to validate naturalness, perceived usefulness, and engagement

**Key Success Indicators (KPIs):**
- 80% of users rate the interaction as "natural" or "clear"
- Average useful conversation time > 5 minutes
- Post-evaluation satisfaction level ≥ 4/5
- Positive qualitative feedback on accompaniment and tone

### Horizon at 1 Year – "Intelligent Evolution and Scalable Personalization"

**Strategic Objective:**

Transform the agent into a real adaptive mentor, with continuous learning capability and large-scale personalization.

**Key Focuses:**

**Persistent Memory and Longitudinal Context:**
- The agent will retain progress history, achieved goals, and changes in user aspirations, allowing long-term contextual conversations
- Example: "Three months ago we were working on your SQL basics; now we could advance to predictive analysis with Python."

**Adaptive Learning Based on Behavior:**
- The agent will adjust its accompaniment according to frequency of use, advancement speed, and detected learning style (visual, auditory, reflective)

**Automated Dynamic Roadmap (version 2.0):**
- Direct integration between diagnosis, progress, and conversation. The agent will be able to rebuild or adjust the development path in real time

**Connected Resource Ecosystem:**
- Ability to suggest personalized materials (courses, articles, practical challenges) from external sources like Coursera, Educational YouTube, or GitHub repos

**Advanced Emotional and Empathetic Tone:**
- Use of semantic analysis and linguistic microexpressions to recognize frustration, doubt, or achievement and adapt communication style accordingly

**Key Success Indicators (KPIs):**
- Monthly user retention ≥ 60%
- Effective personalization validated in ≥ 75% of cases
- Average interaction time ≥ 10 min
- Roadmap abandonment reduction ≥ 30%

**Business Value:**

The agent consolidates as a digital professional mentor: it doesn't just respond, but guides, challenges, and celebrates achievements. The product goes from being a tool to an accompanied experience.

### Horizon at 5 Years – "Cognitive Ecosystem of Professional Growth with Autonomous AI"

**Strategic Objective:**

Convert the agent into an autonomous AI Mentor, with strategic thinking, emotional understanding, and predictive capacity to guide professional career evolution at large scale and make decisions that can help the continuous evolution and strategy of each user considering their initial diagnosis.

**Key Focuses:**

**Professional Development Cognitive Model (version 5.0):**
- The agent will use advanced AI and deep learning to identify growth patterns, emerging skill gaps, and future work development opportunities. This will allow generating new tools that will help the user in continuous skill development. The agent will have sufficient autonomy to generate new study strategies without needing to wait for an emergent user reaction

**Predictive Accompaniment:**
- Ability to anticipate learning needs or market trend changes
- Example: "Your current technical profile brings you closer to Data Science roles; you could specialize in visualization or technical leadership according to your strengths."

**Multimodal and Sensory Interaction:**
- Agent expansion to voice, video, and immersive VR/AR environments, transforming the experience into live and conversational mentorships. Thus allowing real immersion that permits unlocking the greatest potential

**Complete Work and Educational Integration:**
- The agent will connect with employment platforms, universities, and companies to link progress with work opportunities and automatic certifications

**Professional Digital Twin:**
- Creation of a digital model of the user ("Professional Digital Twin") that stores competencies, experiences, learning patterns, and career objectives, evolving with each interaction

**Ethics, Transparency, and Wellbeing:**
- Implementation of responsible AI policies and positive emotional accompaniment to avoid biases or artificial pressures

**Key Success Indicators (KPIs):**
- 1M active global users
- Average satisfaction ≥ 4.6/5
- Integrations with ≥ 20 educational and corporate institutions
- Proven impact on employability (25% improvement)

**Business Value:**

The agent consolidates as a global reference professional accompaniment platform, redefining the relationship between people, continuous learning, and their own work growth. From digital tutor to strategic career mentor.

---

## High-Level User Stories — MVP Skill.ia

**HU1. Registration and Intelligent Profile Creation**

As a professional who wants to improve my skills,
I want to register and enter my basic information (name, experience, sector, aspirations, and tool proficiency),
so that the system builds an initial profile that reflects my context and real development needs.

**HU2. Comprehensive Skills Diagnosis**

As a registered user,
I want to perform an initial evaluation that measures my technical, soft, and English skills in a practical and adaptive way,
to obtain an accurate and personalized diagnosis of my current level and knowledge gaps.

**HU3. Understandable and Transparent Feedback**

As a user who has completed the evaluation,
I want to receive a visual and textual report with my results, strengths, weaknesses, and differences between my self-perception and real performance,
to clearly understand what I should focus on and how to improve.

**HU4. Identification of My Learning Style**

As a diagnosed user,
I want the system to identify my predominant learning style (visual, kinesthetic, or reflective),
so that resource recommendations adapt to the way I learn best.

**HU5. Automatic Generation of My Development Path**

As a professional seeking to advance,
I want the system to generate a personalized learning roadmap based on my results, current level, and aspirations,
to follow a structured plan that guides me step by step toward my professional goals.

**HU6. Real-Time Progress Tracking**

As a user in the learning process,
I want to visualize my progress in the modules or milestones of my roadmap (pending, in progress, completed),
to stay motivated and understand my evolution.

**HU7. Re-evaluation and Automatic Roadmap Adjustment**

As a user advancing in their development,
I want to perform periodic evaluations that update my level and automatically adjust my roadmap,
to ensure my growth plan always reflects my progress and new goals.

**HU8. Personalized Conversational Accompaniment**

As a user in the learning process,
I want to interact with an intelligent conversational agent that knows my context, level, and progress,
to receive guidance, support, and practical recommendations in natural language according to my level perceived in the initial diagnosis.

**HU9. Intelligent Recommendations in Context**

As an active user on the platform,
I want the agent or system to recommend resources and next steps based on my progress, available time, and learning style,
to make the most of each stage of my professional development.

**HU10. Persistence and Security of My Data**

As a user who trusts their information to Skill.ia,
I want my results, conversations, and personal data to be stored securely and privately,
to guarantee confidentiality, avoid information loss, and maintain a reliable history of my professional evolution.

---

## Work Methodology

The prototype development will be carried out using the Scrum agile methodology, an iterative and incremental work framework that promotes collaboration, adaptability, and continuous value delivery. This methodology allows adjusting system functionalities flexibly, prioritizing constant feedback and continuous improvement throughout the development process.

---

## Autonomy and Integrated Interaction - AI

### General Philosophy

Our system starts from a centralized idea: a single type of user who converses with an assistant that provides information, advice, and help, and generates roadmaps thanks to the capacity an intelligent agent has to create them.

There are no hierarchies, no administration panels, no differentiated flows—everything simply revolves around the user's personal experience, who interacts with an agent capable of understanding them, remembering them, and guiding them in their professional development process.

Our project relies on three fundamental and defined layers, each with its own responsibility within the MVP's complete flow.

### Frontend (Astro + Vue + TypeScript)

This layer represents the system's voice and face, where its task is to make interaction with Artificial Intelligence feel natural, fluid, and emotionally coherent. Astro handles the platform's structure and performance, while Vue is used for interactive components: chat, diagnostic forms, and progress dashboard, and TypeScript becomes the interface's cognitive core, managing all artificial intelligence logic.

Within the frontend lives the IA Layer, a module responsible for:
- Connecting with language models (LLM)
- Coordinating agent-to-agent (A2A) communications
- Maintaining and updating conversational context through Model Context Protocol (MCP)

This converts the frontend into something more than just a simple interface; we're talking about a living environment, where AI processes user intentions, interprets their progress, and generates responses in real time before sending them to the backend for storage and analysis.

### Backend (Laravel API)

It's the system's logical and structured brain, where authentication, development paths, and conversation histories are managed. Its role is not to think, but to remember with order and purpose. Every message or significant action that arises from the client passes through Laravel, which validates, records, and preserves key information, but without participating in AI reasoning.

This way, it functions as the system's persistent memory: the guardian of historical context, while the AI handles dynamic interpretation and accompaniment.

### TCL AI (TypeScript-AI Cognitive Layer)

This component or layer lives and is born entirely in TypeScript; it's the system's intelligent engine. Through specialized modules, it coordinates three essential functions:

1. **LLM (Language Model Interface):** generates responses and analyzes user intentions
2. **A2A (Agent-to-Agent):** allows different internal subagents (subllms) to collaborate with each other to offer more precise responses and separate responsibilities
3. **MCP (Model Context Protocol):** maintains structured memory of what the system knows about the user, their progress, and their context

This module doesn't live within the backend, but alongside the frontend, allowing agile, asynchronous responses with context. The backend intervenes when recorded information is needed to generate new roadmaps and more appropriate responses for each user according to their history.

### Required Tools (AI)

- Stitch Gemini
- Claude
- ChatGPT OpenAI
- GitHub Copilot
- v0
- Groq
- Figma Make
- OpenRouter
- Warp.dev
- NotebookLLM
- Lovable
- Google AI Studio
- Sora
- NanoBanana
- Mostly.ai
- n8n

### Architectural Result

The system functions as a collaborative organism:

- **Frontend (Astro + Vue + TS)** speaks and reasons
- **Backend (Laravel + MySQL)** remembers and structures
- **TCL AI (TS + LLM + A2A + MCP)** interprets and evolves

Each maintains its respective autonomy, without disregarding the work of others, collaborating synchronously.

---

## Data Flow and Structure (In - Out)

### Relational Model

### Domain Model (Laravel - API - Backend)

#### USERS

**Description:** The absolute core of the system, i.e., the platform's user persons (professionals in Colombia/LATAM).

| FIELD | DATA TYPE | CONSTRAINTS |
|-------|-----------|-------------|
| id_usuario | INTEGER | PK, NN, AI |
| nombres | VARCHAR(120) | NN |
| apellidos | VARCHAR(120) | NN |
| cedula | VARCHAR(15) | UNIQUE, NN |
| telefono | VARCHAR(20) | NN |
| email | VARCHAR(150) | UNIQUE, NN |
| departamento | VARCHAR(80) | NN |
| ciudad | VARCHAR(80) | NN |
| barrio | VARCHAR(80) | NN |
| direccion | VARCHAR(120) | NN |
| experiencia_anos | INTEGER | DEFAULT 0, CHECK (experiencia_anos ≥ 0) |
| sector | VARCHAR(60) | NULL |
| aspiracion | VARCHAR(80) | NULL |
| nivel_ingles_autoreporte | VARCHAR(5) | NULL |
| seniority_autoreporte | VARCHAR(20) | NULL |
| regimen_vinculacion | VARCHAR(20) | NULL |
| perfil_objetivo_id | INTEGER | FK, NN |
| fecha_registro | TIMESTAMP | NN |

**Indexes:**
- idx_usuarios_email (email)
- idx_usuarios_ciudad (ciudad)
- idx_usuarios_perfil (perfil_objetivo_id)

#### COMPETENCIES

**Description:** Catalog of technical, soft, and language competencies.

| FIELD | DATA TYPE | CONSTRAINTS |
|-------|-----------|-------------|
| id_competencia | INTEGER | PK, NN, AI |
| nombre_competencia | VARCHAR(120) | UNIQUE, NN |
| tipo | VARCHAR(20) | NN |
| descripcion | VARCHAR(255) | NULL |

**Indexes:**
- idx_competencias_tipo (tipo)

#### TARGET_PROFILES

**Description:** Meta roles (Analyst, Data Engineer, etc.).

| FIELD | DATA TYPE | CONSTRAINTS |
|-------|-----------|-------------|
| id_perfil | INTEGER | PK, NN, AI |
| nombre_perfil | VARCHAR(120) | UNIQUE, NN |
| descripcion | VARCHAR(255) | NULL |

**Indexes:**
- idx_perfiles_nombre (nombre_perfil)

#### EVALUATIONS

**Description:** Diagnosis/follow-up applications per user.

| FIELD | DATA TYPE | CONSTRAINTS |
|-------|-----------|-------------|
| id_evaluacion | INTEGER | PK, NN, AI |
| id_usuario | INTEGER | FK, NN |
| tipo_evaluacion | VARCHAR(30) | NN |
| modalidad | VARCHAR(20) | NN |
| fecha_evaluacion | TIMESTAMP | NN |
| duracion_minutos | INTEGER | NN, CHECK (field BETWEEN 1 AND 120) |
| origen | VARCHAR(20) | NN |
| puntaje_global | DECIMAL(5, 2) | NN |

**Indexes:**
- idx_eval_usuario (id_usuario, fecha_evaluacion)
- idx_eval_modalidad (modalidad)

#### EVALUATION_RESULTS

**Description:** Results per competency within an evaluation.

| FIELD | DATA TYPE | CONSTRAINTS |
|-------|-----------|-------------|
| id_resultado | INTEGER | PK, NN, AI |
| id_evaluacion | INTEGER | FK, NN |
| id_competencia | INTEGER | FK, NN |
| nivel | INTEGER | NN |
| puntaje | DECIMAL(5, 2) | NN |
| brecha | VARCHAR(15) | NN |

**Indexes:**
- idx_res_eval (id_evaluacion)
- idx_res_comp (id_competencia)

#### ROADMAPS

**Description:** Living development path per user toward a target profile.

| FIELD | DATA TYPE | CONSTRAINTS |
|-------|-----------|-------------|
| id_roadmap | INTEGER | PK, NN, AI |
| id_usuario | INTEGER | FK, NN |
| id_perfil_objetivo | INTEGER | FK, NN |
| estado | VARCHAR(20) | NN |
| fecha_creacion | TIMESTAMP | NN |

**Indexes:**
- idx_roadmap_usuario (id_usuario)
- idx_roadmap_perfil (id_perfil_objetivo)

#### MILESTONES

**Description:** Catalog of milestones (technical, soft, language, mixed).

| FIELD | DATA TYPE | CONSTRAINTS |
|-------|-----------|-------------|
| id_hito | INTEGER | PK, NN, AI |
| nombre_hito | VARCHAR(150) | UNIQUE, NN |
| descripcion | VARCHAR(255) | NULL |
| tipo | VARCHAR(20) | NN |
| dificultad | VARCHAR(10) | NN |
| horas_estimadas | INTEGER | NN, CHECK (field BETWEEN 1 AND 80) |

**Indexes:**
- idx_hitos_tipo (tipo, dificultad)

#### ROADMAP_MILESTONES

**Description:** Ordered sequence of milestones within a roadmap (N:M).

| FIELD | DATA TYPE | CONSTRAINTS |
|-------|-----------|-------------|
| id_roadmap_hito | INTEGER | PK, NN, AI |
| id_roadmap | INTEGER | FK, NN |
| id_hito | INTEGER | FK, NN |
| orden | INTEGER | NN |

**Indexes:**
- idx_rmh_roadmap (id_roadmap, orden)
- idx_rmh_hito (id_hito)

#### USER_PROGRESS

**Description:** User progress per roadmap milestone.

| FIELD | DATA TYPE | CONSTRAINTS |
|-------|-----------|-------------|
| id_avance | INTEGER | PK, NN, AI |
| id_roadmap_hito | INTEGER | FK, NN |
| estado | VARCHAR(20) | NN |
| porcentaje_avance | INTEGER | NN, CHECK (field BETWEEN 0 AND 100) |
| fecha_inicio | TIMESTAMP | NULL |
| fecha_fin | TIMESTAMP | NULL |

**Indexes:**
- idx_prog_rmh (id_roadmap_hito)

#### AGENT_INTERACTIONS

**Description:** Record of agent conversations with the user.

| FIELD | DATA TYPE | CONSTRAINTS |
|-------|-----------|-------------|
| id_interaccion | INTEGER | PK, NN, AI |
| id_usuario | INTEGER | FK, NN |
| fecha_hora | TIMESTAMP | NN |
| intencion | VARCHAR(30) | NN |
| tono_agente | VARCHAR(20) | NN |
| canal | VARCHAR(20) | NN |
| duracion_segundos | INTEGER | NN, CHECK (field BETWEEN 1 AND 7200) |
| satisfaccion_usuario | INTEGER | NN, CHECK (field BETWEEN 1 AND 5) |
| texto_resumen | VARCHAR(255) | NULL |

**Indexes:**
- idx_int_usuario (id_usuario, fecha_hora)

#### RECOMMENDATIONS

**Description:** Actionable recommendations generated by the agent.

| FIELD | DATA TYPE | CONSTRAINTS |
|-------|-----------|-------------|
| id_recomendacion | INTEGER | PK, NN, AI |
| id_usuario | INTEGER | FK, NN |
| fecha_hora | TIMESTAMP | NN |
| categoria | VARCHAR(40) | NN |
| detalle | VARCHAR(255) | NN |
| justificacion | VARCHAR(255) | NULL |

**Indexes:**
- idx_rec_usuario (id_usuario, fecha_hora)

### RELATIONSHIP DIAGRAM

```
USERS 1──→ EVALUATIONS ──→ EVALUATION_RESULTS ──→ COMPETENCIES
│
└──→ ROADMAPS ──→ ROADMAP_MILESTONES ──→ MILESTONES
│
└──→ USER_PROGRESS

USERS 1──→ AGENT_INTERACTIONS

USERS 1──→ RECOMMENDATIONS

TARGET_PROFILES 1──→ ROADMAPS
```

---

## Input/Output Flows (Layer Exchange)

### Frontend → TCL AI

When the user interacts with the agent or completes exams to diagnose them.

```json
{
  "user_id": 1,
  "message": "I think I want to improve my English level before diving into Python.",
  "context": {
    "mode": "chat",
    "intent": "career_guidance"
  }
}
```

What we do with this is understand what the user is trying to ask, and this is achieved through a collection of intentions. If there's a match, then the LLM understands that the intention is actually an action, so it generates a result to what the user asks for. But in certain cases, it can generate useful roadmaps for them to work on improving and learning new things they're interested in.

### TCL AI → Backend

If the user requires it and the LLM understands it has that stored information, then it retrieves that saved data that may be useful to the user and returns it in JSON format, i.e., raw.

```json
{
  "user": {
    "id": 1,
    "profile_data": { "role": "data_analyst", "experience": 3 },
    "progress_state": {
      "skill_level": "intermediate",
      "english_level": "basic"
    }
  },
  "message": "I think I want to improve my English level before diving into Python.",
  "conversation_history": [
    { "sender": "user", "content": "..." },
    { "sender": "assistant", "content": "..." }
  ]
}
```

### Backend → TCL AI

The data is returned again to the LLM so it can format that data, clean it, and structure it in a way the user can understand in their natural language.

### TCL AI → Frontend

And finally, once this data is clean, with a good structure that can be read or understood, it's returned to the user visually and much more intuitively.

---

## Summary

The platform operates under a key principle: all AI interaction occurs in the frontend, while the backend only saves, queries, and returns structured data.

This ensures fluidity, low coupling, and agile response times.

### 1. Interaction Layer (User ↔ AI)

The user communicates directly with the AI through the frontend, where the intelligence modules (LLM, A2A, and MCP) process inputs, interpret context, and generate personalized responses. If the AI requires previous information (like evaluations or roadmaps), it queries the backend API.

The result is displayed immediately in the interface and can update the user's local context.

- **Input:** messages, diagnoses, user actions
- **Output:** conversational responses, recommendations, or progress updates

### 2. Persistence Layer (Frontend ↔ Backend)

The frontend sends to the backend only relevant data: interactions, results, progress, or new recommendations. Laravel validates, stores, and maintains record consistency.

At necessary moments, the frontend retrieves stored information from the backend to reconstruct user context or display statistics.

- **Input:** data generated by AI or user
- **Output:** persisted records and clean JSON structures for frontend consumption

### 3. Reasoning Layer (Internal AI)

The AI modules within the frontend handle all cognitive logic:
- **LLM** manages language and tone
- **A2A** coordinates specialized subagents
- **MCP** organizes memory and context

These components decide what to save, when to query the backend, and how to adapt responses according to user progress.

---

## Mockup Design

The ideal user experience will be fluid, personalized, and motivating. From the moment they enter the platform, the user finds an intuitive environment that invites them to discover their professional starting point through a brief and understandable evaluation.

Once they obtain their diagnosis, the system automatically generates a learning path adapted to their level and objectives, presented as a visual journey with clear and achievable milestones.

The user will be able to interact with an intelligent conversational agent that acts as their personal guide. Initially, the agent adopts a close and explanatory tone, helping them understand the results and prioritize their next steps. As the user progresses, the agent changes its role: it becomes more challenging, proposes new objectives, offers study recommendations, suggests productive habits, and celebrates achieved milestones.

This constant interaction makes the experience not feel like using a tool, but like conversing with a mentor who understands their professional evolution and accompanies them at each stage of their growth.

---

## MOCKUPS - DESIGN

[Visual mockups would be displayed here - these are referenced in the original document but not shown in the text]

---

## Technical Resources

**Prototype generated in Stitch:** https://stitch.withgoogle.com/projects/3181551718990986703

**GitHub Repository:** https://github.com/JhonMendozaR/SenaSoft_2025_Skill.ia

**Collaborative board in Asana for task management:**
https://app.asana.com/1/1210522679655340/project/1211708000893213/list/1211708018781147

---

## Contributors

- **José David Campo Marquez** - Business Analyst
- **Jhon Alexis Mendoza Rojas** - Quality Assurance
- **Igmar De Jesus Lozada Bolivar** - Developer

---

**Project developed for SenaSoft 2025**

**Group 8: Tití Devs**