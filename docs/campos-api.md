# Contrato de datos (Eloquent / vistas Blade)

Rutas útiles (nombres Laravel):

| Nombre | Descripción |
|--------|-------------|
| `home` | Inicio |
| `activities.index` | Listado de actividades |
| `activities.show` | Detalle de una actividad (`{activity}` = id) |
| `contact` | Contacto |
| `bookings.index` | Historial del usuario logueado |
| `bookings.store` | POST crear reserva (`time_slot_id`) |
| `bookings.destroy` | DELETE cancelar reserva propia (`{booking}` = id) |
| `admin.activities.*` | CRUD actividades (solo `role` = `admin`) |
| `admin.activities.time-slots.*` | CRUD turnos anidados a una actividad |

## `User`

| Campo / acceso | Tipo / notas |
|----------------|---------------|
| `id` | bigint |
| `name` | string |
| `email` | string |
| `role` | `normal` \| `admin` |
| `isAdmin()` | método: `true` si administrador |

## `Activity` (`$activity`)

| Atributo | Descripción |
|----------|-------------|
| `id` | Identificador |
| `name` | Nombre de la actividad |
| `description` | Texto (puede ser null) |
| `max_capacity` | Plazas máximas por turno |
| `image_path` | Ruta en disco `public` (puede ser null), p.ej. `activities/xxx.jpg` |
| URL pública imagen | `Storage::url($activity->image_path)` cuando `image_path` no es null |

Relación: `timeSlots()` → colección de `TimeSlot`.

## `TimeSlot` (`$timeSlot`)

| Atributo | Descripción |
|----------|-------------|
| `id` | Identificador |
| `activity_id` | FK a `activities` |
| `start_time` | `Carbon` (inicio) |
| `end_time` | `Carbon` (fin) |

Relaciones: `activity()`, `bookings()`.

Consulta con hueco (scope): `TimeSlot::query()->withAvailability()` — solo turnos donde el número de reservas es menor que `max_capacity` de la actividad.

## `Booking` (`$booking`)

| Atributo | Descripción |
|----------|-------------|
| `id` | Identificador |
| `user_id` | FK a `users` |
| `time_slot_id` | FK a `time_slots` |
| `created_at` | Fecha de la reserva |

Relaciones: `user()`, `timeSlot()`.

## Usuarios de prueba (tras `php artisan migrate:fresh --seed`)

| Rol | Email | Contraseña |
|-----|-------|------------|
| Admin | `admin@deportivo.test` | `password` |
| Socio | `socio@deportivo.test` | `password` |

El seeder crea además **5 actividades** y **3 turnos** por actividad en fechas próximas a `now()`.
