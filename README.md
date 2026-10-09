# 🔐 CRUD de Productos con Login — Laravel + Vue 3 (MVC)

Aplicación web que implementa el patrón **MVC** con **Laravel** en el backend y **Vue 3** (vía Inertia.js) en las vistas. Incluye un sistema de **autenticación** (login/logout) que protege un **CRUD** de productos: ninguna URL del CRUD es accesible sin iniciar sesión.

🎥 **Video demostrativo:** [Ver en Youtube](https://youtu.be/O8Bo37Rpkuc)

---

## 📋 Tabla de contenidos
1. [Características](#-características)
2. [Tecnologías](#-tecnologías)
3. [Arquitectura MVC](#-arquitectura-mvc)
4. [Requisitos](#-requisitos)
5. [Instalación](#-instalación)
6. [Uso](#-uso)
7. [Rutas](#-rutas)
8. [Seguridad](#-seguridad)
9. [Estructura del proyecto](#-estructura-del-proyecto)
10. [Autor](#-autor)

---

## ✨ Características
- Inicio y cierre de sesión con usuario (correo) y contraseña.
- Contraseñas **encriptadas** con hash (bcrypt) en la base de datos.
- Rutas protegidas con el middleware `auth`: si no hay sesión, se redirige a `/login`.
- CRUD completo de productos: **Crear, Leer, Actualizar y Eliminar**.
- Validación de formularios en el servidor con mensajes de error.
- Mensajes de confirmación (flash) tras cada operación.

## 🛠 Tecnologías
| Capa | Tecnología |
|------|-----------|
| Backend | PHP 8.2+, Laravel 11/12 |
| Frontend | Vue 3, Inertia.js, Vite |
| Base de datos | MySQL / MariaDB |
| Herramientas | Composer, Node.js/npm, Git, Visual Studio Code |

## 🧱 Arquitectura MVC
| Componente | Archivo(s) | Responsabilidad |
|-----------|-----------|----------------|
| **Modelo** | `app/Models/Producto.php`, `app/Models/User.php` | Representan las tablas y la lógica de datos (Eloquent ORM). |
| **Vista** | `resources/js/Pages/**/*.vue` | Interfaz de usuario en Vue 3. |
| **Controlador** | `app/Http/Controllers/AuthController.php`, `ProductoController.php` | Reciben la petición, usan el modelo y devuelven la vista. |

Flujo: `Ruta (routes/web.php) → Middleware auth → Controlador → Modelo → Vista Vue`

## 📦 Requisitos
- PHP >= 8.2 con extensiones `pdo_mysql`, `mbstring`, `openssl`
- Composer
- Node.js >= 18 y npm
- MySQL o MariaDB (XAMPP / Laragon)
- Git

## 🚀 Instalación
```bash
# 1. Clonar el repositorio
git clone https://github.com/TU_USUARIO/crud-login-mvc.git
cd crud-login-mvc

# 2. Instalar dependencias
composer install
npm install

# 3. Configurar entorno
cp .env.example .env
php artisan key:generate
```

Crear la base de datos en MySQL:
```sql
CREATE DATABASE crud_login_mvc CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Editar `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crud_login_mvc
DB_USERNAME=root
DB_PASSWORD=
```

Crear tablas y usuario de prueba:
```bash
php artisan migrate --seed
```

Levantar la aplicación (dos terminales):
```bash
npm run dev
php artisan serve
```

Abrir: http://127.0.0.1:8000

## 👤 Uso
Credenciales de prueba:

| Correo | Contraseña |
|--------|-----------|
| admin@demo.com | admin123 |

1. Ingresa a `/login` con las credenciales.
2. Gestiona productos: crear, listar, editar y eliminar.
3. Cierra sesión con el botón **Cerrar sesión**.
4. Intenta abrir `/productos` sin sesión: serás redirigido al login.

## 🗺 Rutas
| Método | URL | Acción | Protegida |
|-------|-----|--------|:--------:|
| GET | `/login` | Formulario de login | ❌ (solo invitados) |
| POST | `/login` | Autenticar | ❌ |
| POST | `/logout` | Cerrar sesión | ✅ |
| GET | `/productos` | Listar | ✅ |
| GET | `/productos/create` | Formulario crear | ✅ |
| POST | `/productos` | Guardar | ✅ |
| GET | `/productos/{id}/edit` | Formulario editar | ✅ |
| PUT | `/productos/{id}` | Actualizar | ✅ |
| DELETE | `/productos/{id}` | Eliminar | ✅ |

## 🔒 Seguridad
- **Contraseñas:** se guardan con `Hash::make()` (algoritmo bcrypt). En la base de datos nunca se ve la contraseña en texto plano, sino un hash como `$2y$12$...`. Bcrypt es más seguro que MD5 porque incluye *salt* y es deliberadamente lento frente a ataques de fuerza bruta.
- **Middleware `auth`:** bloquea todas las rutas del CRUD sin sesión activa.
- **Protección CSRF** en todos los formularios.
- **Regeneración de sesión** al iniciar y cerrar sesión (evita *session fixation*).

## 📁 Estructura del proyecto
```
app/
 ├─ Http/Controllers/
 │   ├─ AuthController.php
 │   └─ ProductoController.php
 ├─ Http/Middleware/HandleInertiaRequests.php
 └─ Models/
     ├─ Producto.php
     └─ User.php
database/
 ├─ migrations/xxxx_create_productos_table.php
 └─ seeders/DatabaseSeeder.php
resources/
 ├─ css/app.css
 ├─ js/
 │   ├─ app.js
 │   ├─ Layouts/AppLayout.vue
 │   └─ Pages/
 │       ├─ Auth/Login.vue
 │       └─ Productos/Index.vue, Form.vue
 └─ views/app.blade.php
routes/web.php
```

## ✍️ Autor
**Kimberlly Ramos** — [GitHub](https://github.com/kim14ale/crud-login-mvc)

Proyecto académico — Desarrollo de aplicaciones con patrón MVC.
