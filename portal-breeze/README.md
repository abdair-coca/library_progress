<div align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">

  # Portal Breeze

  **Portal académico** con autenticación y control de acceso basado en roles.

  <p>
    <img src="https://img.shields.io/badge/PHP-8.5-777BB4?style=flat&logo=php&logoColor=white" alt="PHP">
    <img src="https://img.shields.io/badge/Laravel-13-FF2D20?style=flat&logo=laravel&logoColor=white" alt="Laravel">
    <img src="https://img.shields.io/badge/Tailwind_CSS-3.4-06B6D4?style=flat&logo=tailwindcss&logoColor=white" alt="Tailwind CSS">
    <img src="https://img.shields.io/badge/PostgreSQL-14-4169E1?style=flat&logo=postgresql&logoColor=white" alt="PostgreSQL">
    <img src="https://img.shields.io/badge/license-MIT-green" alt="License">
  </p>
</div>

## 📋 Descripción

Portal Breeze es una aplicación web desarrollada con **Laravel 13** y **Laravel Breeze** (Blade) que implementa un sistema de autenticación completo con tres roles de usuario: **admin**, **docente** y **estudiante**. Cada rol tiene acceso a su propio panel personalizado, con redirección automática post-login y una barra de navegación adaptada dinámicamente.

## ✨ Características

- 🔐 **Autenticación completa**: login, registro, recuperación de contraseña y verificación de correo electrónico
- 👥 **Roles de usuario**: admin, docente y estudiante
- 🧭 **Redirección inteligente**: cada usuario es dirigido a su panel según su rol
- 🛡️ **Middleware de rol**: protección de rutas con `EnsureUserHasRole`
- 📱 **Navbar dinámico**: menú de navegación adaptado al rol (escritorio y responsive)
- 🌐 **Localización**: interfaz completamente traducida al español
- 🎨 **Marca personalizada**: colores corporativos con Tailwind CSS (`brand`)
- ⚡ **Responsive**: diseño adaptable gracias a Tailwind CSS

## 🛠️ Stack tecnológico

| Capa | Tecnología |
|---|---|
| **Backend** | PHP 8.5 / Laravel 13 |
| **Frontend** | Blade + Alpine.js 3 + Tailwind CSS 3 |
| **Base de datos** | PostgreSQL 14+ |
| **Autenticación** | Laravel Breeze (Blade stack) |
| **Assets** | Vite + PostCSS |

## ⚙️ Requisitos

- PHP 8.3+
- Composer 2.x
- Node.js 20 LTS+ / npm
- PostgreSQL 14+

## 🚀 Instalación

### 1. Clonar e instalar dependencias

```bash
git clone <repo-url> portal-breeze
cd portal-breeze

composer install
npm install
```

### 2. Configurar entorno

```bash
cp .env.example .env
php artisan key:generate
```

Edita `.env` con tus credenciales:

```env
APP_LOCALE=es
APP_FALLBACK_LOCALE=en

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=portal_breeze
DB_USERNAME=postgres
DB_PASSWORD=tu_password
```

### 3. Migrar y poblar

```bash
php artisan migrate
php artisan db:seed
```

Esto crea el usuario administrador por defecto:

| Email | Contraseña | Rol |
|---|---|---|
| `admin@uatf.edu.bo` | `password` | admin |

### 4. Compilar assets y servir

```bash
npm run build      # producción
# o
npm run dev        # desarrollo (con hot reload)

php artisan serve
```

Abre [http://localhost:8000](http://localhost:8000) en tu navegador.

## 🧪 Tests

```bash
php artisan test --compact
```

## 👥 Roles y permisos

| Ruta | Roles permitidos | Descripción |
|---|---|---|
| `/dashboard` | autenticado + verificado | Redirige al panel según el rol |
| `/admin` | admin | Panel de administración |
| `/docente` | admin, docente | Panel de docencia |
| `/estudiante` | admin, docente, estudiante | Panel de estudiantes |

### Jerarquía de acceso

- **admin** → acceso a todos los paneles
- **docente** → acceso a docente y estudiante
- **estudiante** → acceso solo a su panel

### Registro de usuarios

Al registrarse, el usuario puede elegir entre **docente** o **estudiante**. El rol **admin** solo puede asignarse mediante el seeder por seguridad.

## 📁 Estructura del proyecto

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/                  # Controladores de autenticación (Breeze)
│   │   │   ├── DashboardController.php # Redirección por rol
│   │   │   └── ProfileController.php
│   │   └── Middleware/
│   │       └── EnsureUserHasRole.php   # Middleware de verificación de rol
│   └── Models/
│       └── User.php                    # isAdmin(), hasRole(), ROLES, SELF_ROLES
├── bootstrap/
│   └── app.php                         # Registro del alias 'role'
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
│       └── DatabaseSeeder.php          # Crea usuario admin por defecto
├── lang/
│   ├── es/                             # Traducciones del framework
│   └── es.json                         # Traducciones de la interfaz
├── resources/views/
│   ├── auth/                           # Vistas de autenticación
│   ├── layouts/                        # app.blade.php, guest.blade.php
│   ├── panels/                         # admin.blade.php, docente.blade.php, estudiante.blade.php
│   ├── components/                     # Componentes Blade reutilizables
│   └── dashboard.blade.php
├── routes/
│   ├── web.php                         # Rutas principales
│   └── auth.php                        # Rutas de autenticación Breeze
└── tailwind.config.js                  # Colores de marca personalizados
```

## 📄 Licencia

Este proyecto está licenciado bajo **MIT**. Consulta el archivo `LICENSE` para más detalles.
