# Tech Solutions — Sistema de Gestión de Proyectos

Aplicación web desarrollada con **Laravel 11** para la Evaluación Sumativa Unidad 1 de la
asignatura *Desarrollo de Software Web I*. Implementa un CRUD de proyectos siguiendo el
patrón **MVC**, con un componente reutilizable que simula el consumo de un servicio externo
(valor de la UF del día).

## Stack tecnológico

| Componente | Versión / Tecnología |
|---|---|
| Lenguaje | PHP 8.2 |
| Framework | Laravel 11 |
| Base de datos | MySQL 8.0 |
| Servidor web | Nginx 1.27 (Alpine) |
| Contenerización | Docker + Docker Compose |

## Arquitectura del proyecto

```
tech-solutions-proyectos/
├── app/
│   ├── Http/Controllers/
│   │   └── ProyectoController.php   # Conecta rutas, modelo y servicio con las vistas
│   ├── Models/
│   │   └── Proyecto.php             # Datos estáticos (semilla) persistidos en sesión
│   └── Services/
│       └── UfService.php            # Componente reutilizable: simula un servicio externo
├── resources/views/
│   ├── layouts/app.blade.php        # Layout base (estilos y estructura HTML compartida)
│   └── proyectos/                   # 5 vistas: index, create, edit, show, delete
├── routes/web.php                   # 5 rutas RESTful del caso de estudio
├── docker/
│   ├── php/Dockerfile               # Imagen PHP 8.2-FPM + extensiones + Composer
│   └── nginx/default.conf           # Configuración de Nginx → PHP-FPM
└── docker-compose.yml               # Orquesta los 3 contenedores: app, nginx, db
\```

## Requisitos previos

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) instalado y corriendo.
- Git (para clonar el repositorio).

No es necesario tener PHP, Composer ni MySQL instalados en tu máquina: todo corre
dentro de los contenedores.

## Instalación y ejecución

**1. Clona el repositorio:**
```bash
git clone https://github.com/TU-USUARIO/tech-solutions-gestion-proyectos.git
cd tech-solutions-gestion-proyectos
```

**2. Crea el archivo de entorno a partir del ejemplo:**
```bash
cp .env.example .env
```

**3. Construye las imágenes y levanta los contenedores:**
```bash
docker compose build
docker compose up -d
```
La primera vez puede tardar algunos minutos, ya que descarga las imágenes base y
ejecuta `composer install` dentro del contenedor `app`.

**4. Instala las dependencias de PHP** (si el `vendor/` no quedó generado en el build,
por ejemplo, en el primer arranque):
```bash
docker compose exec app composer install
```

**5. Genera la clave de aplicación** (obligatoria para que Laravel cifre sesiones y cookies):
```bash
docker compose exec app php artisan key:generate
```

**6. Abre la aplicación en tu navegador:**
```
http://localhost:8080
```

## Comandos útiles

| Acción | Comando |
|---|---|
| Ver estado de los contenedores | `docker compose ps` |
| Ver logs de la app | `docker compose logs app` |
| Detener los contenedores | `docker compose down` |
| Reconstruir tras cambiar el Dockerfile | `docker compose build --no-cache` |
| Entrar a la terminal del contenedor app | `docker compose exec app bash` |
| Regenerar autoload de Composer | `docker compose exec app composer dump-autoload` |

## Notas de diseño

- **Datos estáticos vía sesión:** el modelo `Proyecto` no usa Eloquent ni MySQL, tal como
  exige el caso de estudio. Los datos parten de un arreglo estático "semilla" y los
  cambios (crear/editar/eliminar) se guardan en la sesión del navegador, ya que PHP-FPM
  reinicia cualquier variable estática en cada petición HTTP. Esto permite que el CRUD
  sea completamente demostrable en vivo sin depender de una base de datos real.
- **Servicio UF simulado:** `UfService` simula la respuesta de un servicio externo
  (por ejemplo, la API pública de mindicador.cl) generando un valor aleatorio realista,
  sin requerir conexión a internet.

## Autores

- Camilo Andrés Meriño Araya - Roberto Ignacio Amigo Sáez - Ezequiel Andrés Tobar Guerra — Asignatura Desarrollo de Software Web I — Instituto Profesional San Sebastián