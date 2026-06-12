# Portal Breeze

Portal académico con autenticación y control de acceso basado en roles, construido con **Laravel 13** y **Laravel Breeze** (Blade + Tailwind CSS).

## Características

- Autenticación completa (login, registro, recuperación de contraseña, verificación de correo)
- Roles de usuario: **admin**, **docente** y **estudiante**
- Redirección post-login según el rol del usuario
- Middleware de verificación de roles para proteger rutas
- Barra de navegación adaptada al rol del usuario autenticado
- Interfaz localizada al español
- Marca personalizada con colores corporativos
- Diseño responsive con Tailwind CSS

## Requisitos

- PHP 8.3+
- Composer 2.x
- Node.js 20 LTS+ / npm
- PostgreSQL 14+

## Instalación

```bash
# Clonar el repositorio
git clone <repo-url> portal-breeze
cd portal-breeze

# Instalar dependencias de PHP
composer install

# Instalar dependencias de Node
npm install

# Copiar y configurar variables de entorno
cp .env.example .env
php artisan key:generate
```

### Configurar base de datos

Crea la base de datos en PostgreSQL y ajusta las credenciales en `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=portal_breeze
DB_USERNAME=postgres
DB_PASSWORD=tu_password
```

### Migrar y poblar

```bash
php artisan migrate
php artisan db:seed
```

El seeder crea un usuario administrador por defecto:

| Email | Contraseña | Rol |
|---|---|---|
| admin@uatf.edu.bo | password | admin |

### Compilar assets

```bash
npm run build
# o para desarrollo:
npm run dev
```

### Iniciar servidor

```bash
php artisan serve
```

## Roles y permisos

| Ruta | Rol requerido | Descripción |
|---|---|---|
| `/dashboard` | autenticado + verificado | Redirige al panel según el rol |
| `/admin` | admin | Panel de administración |
| `/docente` | admin, docente | Panel de docencia |
| `/estudiante` | admin, docente, estudiante | Panel de estudiantes |

## Registro de usuarios

Al registrarse, el usuario puede elegir entre los roles **docente** o **estudiante**. El rol **admin** solo puede ser asignado mediante el seeder.

## Estructura del proyecto

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/          # Controladores de autenticación
│   │   │   ├── DashboardController.php
│   │   │   └── ProfileController.php
│   │   └── Middleware/
│   │       └── EnsureUserHasRole.php
│   └── Models/
│       └── User.php
├── bootstrap/app.php
├── resources/views/
│   ├── auth/                  # Vistas de autenticación
│   ├── layouts/               # Layouts app y guest
│   ├── panels/                # Paneles por rol
│   ├── components/            # Componentes Blade
│   └── dashboard.blade.php
├── routes/
│   ├── web.php                # Rutas de la aplicación
│   └── auth.php               # Rutas de autenticación
└── tailwind.config.js         # Configuración de marca (colores brand)
```

## Licencia

Este proyecto es software de código abierto licenciado bajo [MIT](https://opensource.org/licenses/MIT).
