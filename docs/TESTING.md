# Guía de pruebas automatizadas (PHPUnit)

Este documento describe **todos los tests** del proyecto Laravel en `src/tests/`, **cómo ejecutarlos** y qué valida cada clase. Los tests de aplicación usan **`RefreshDatabase`**: cada caso migra la BD de prueba y la deja limpia al terminar. La configuración por defecto está en [`phpunit.xml`](../src/phpunit.xml): **`DB_CONNECTION=sqlite`** y **`DB_DATABASE=:memory:`** (sin fichero en disco), más drivers en memoria para caché, sesión y correo.

---

## 1. Requisitos previos

| Entorno | Qué necesitas |
|---------|----------------|
| **Docker** (recomendado, alineado con el README) | Contenedores `deportivo-app` y BD en marcha; el código montado en `/var/www/html`. |
| **Local** | PHP 8.2+, extensiones Laravel, `composer install` en `src/`, archivo `.env.testing` o variables por defecto de `phpunit.xml`. |

La suite está pensada para ejecutarse **sin interacción** en CI o antes de un merge.

---

## 2. Cómo ejecutar los tests

### 2.1. Suite completa (desde Docker)

Desde la máquina anfitriona, con el contenedor de la app en ejecución:

```bash
docker exec -it deportivo-app php artisan test
```

Salida esperada al final: resumen con **28 tests** passed (el número puede subir si añadís más archivos).

### 2.2. Suite completa (sin Docker)

Desde la carpeta **`src/`** del proyecto Laravel:

```bash
cd src
php artisan test
```

Equivalente:

```bash
cd src && ./vendor/bin/phpunit
```

### 2.3. Filtrar por archivo o clase

Solo cancelación de reservas:

```bash
docker exec -it deportivo-app php artisan test tests/Feature/BookingCancellationTest.php
```

Solo autenticación:

```bash
docker exec -it deportivo-app php artisan test tests/Feature/Auth/AuthenticationTest.php
```

### 2.4. Filtrar por nombre de método

```bash
docker exec -it deportivo-app php artisan test --filter=test_user_can_cancel_own_booking_before_slot_starts
```

### 2.5. Opciones útiles

| Opción | Uso |
|--------|-----|
| `--parallel` | Paraleliza tests (cuando el proyecto lo soporta sin conflictos). |
| `--coverage` | Informe de cobertura (requiere Xdebug/PCOV configurado). |
| `php artisan test --help` | Lista completa de flags. |

---

## 3. Estructura de carpetas

```
src/tests/
├── TestCase.php              # Base para tests de aplicación (Laravel)
├── Unit/
│   └── ExampleTest.php       # Test unitario mínimo (no carga Laravel)
└── Feature/
    ├── ExampleTest.php       # GET / responde 200
    ├── BookingCancellationTest.php   # Negocio: cancelación de reservas
    ├── ProfileTest.php       # Perfil Breeze
    └── Auth/
        ├── AuthenticationTest.php
        ├── RegistrationTest.php
        ├── EmailVerificationTest.php
        ├── PasswordResetTest.php
        ├── PasswordConfirmationTest.php
        └── PasswordUpdateTest.php
```

---

## 4. Inventario de tests (28 en total)

### 4.1. `Tests\Unit\ExampleTest` (1 test)

| Método | Qué comprueba |
|--------|----------------|
| `test_that_true_is_true` | Ejemplo PHPUnit puro; no usa la aplicación Laravel. |

---

### 4.2. `Tests\Feature\ExampleTest` (1 test)

| Método | Qué comprueba |
|--------|----------------|
| `test_the_application_returns_a_successful_response` | `GET /` devuelve **200** (página de inicio pública). |

---

### 4.3. `Tests\Feature\Auth\AuthenticationTest` (4 tests)

| Método | Qué comprueba |
|--------|----------------|
| `test_login_screen_can_be_rendered` | `GET /login` → 200. |
| `test_users_can_authenticate_using_the_login_screen` | Login correcto → usuario autenticado y redirección al dashboard. |
| `test_users_can_not_authenticate_with_invalid_password` | Contraseña incorrecta → sigue invitado (`guest`). |
| `test_users_can_logout` | `POST /logout` → invitado y redirección a `/`. |

---

### 4.4. `Tests\Feature\Auth\RegistrationTest` (2 tests)

| Método | Qué comprueba |
|--------|----------------|
| `test_registration_screen_can_be_rendered` | `GET /register` → 200. |
| `test_new_users_can_register` | Registro con datos válidos → autenticado y redirección al dashboard. |

---

### 4.5. `Tests\Feature\Auth\EmailVerificationTest` (3 tests)

| Método | Qué comprueba |
|--------|----------------|
| `test_email_verification_screen_can_be_rendered` | Usuario sin verificar accede a `GET /verify-email` → 200. |
| `test_email_can_be_verified` | URL firmada de verificación → evento `Verified`, email marcado verificado, redirección. |
| `test_email_is_not_verified_with_invalid_hash` | Hash incorrecto → el email **no** queda verificado. |

---

### 4.6. `Tests\Feature\Auth\PasswordResetTest` (4 tests)

| Método | Qué comprueba |
|--------|----------------|
| `test_reset_password_link_screen_can_be_rendered` | `GET /forgot-password` → 200. |
| `test_reset_password_link_can_be_requested` | `POST /forgot-password` con email existente → notificación `ResetPassword` enviada. |
| `test_reset_password_screen_can_be_rendered` | Tras pedir enlace, `GET /reset-password/{token}` → 200. |
| `test_password_can_be_reset_with_valid_token` | `POST /reset-password` con token válido → sin errores de sesión y redirección a login. |

---

### 4.7. `Tests\Feature\Auth\PasswordConfirmationTest` (3 tests)

| Método | Qué comprueba |
|--------|----------------|
| `test_confirm_password_screen_can_be_rendered` | `GET /confirm-password` autenticado → 200. |
| `test_password_can_be_confirmed` | Contraseña correcta → redirección y sin errores de sesión. |
| `test_password_is_not_confirmed_with_invalid_password` | Contraseña incorrecta → sesión con errores. |

---

### 4.8. `Tests\Feature\Auth\PasswordUpdateTest` (2 tests)

| Método | Qué comprueba |
|--------|----------------|
| `test_password_can_be_updated` | `PUT /password` desde perfil con contraseña actual correcta → nueva contraseña hasheada en BD. |
| `test_correct_password_must_be_provided_to_update_password` | Contraseña actual incorrecta → error en bolsa `updatePassword` y redirección a perfil. |

---

### 4.9. `Tests\Feature\ProfileTest` (5 tests)

| Método | Qué comprueba |
|--------|----------------|
| `test_profile_page_is_displayed` | `GET /profile` autenticado → 200. |
| `test_profile_information_can_be_updated` | `PATCH /profile` (nombre y email nuevos) → sin errores; email de verificación se anula al cambiar email. |
| `test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged` | Si el email no cambia, `email_verified_at` se mantiene. |
| `test_user_can_delete_their_account` | `DELETE /profile` con contraseña correcta → invitado, usuario borrado, redirección a `/`. |
| `test_correct_password_must_be_provided_to_delete_account` | Borrado con contraseña incorrecta → error en `userDeletion` y usuario sigue existiendo. |

---

### 4.10. `Tests\Feature\BookingCancellationTest` (3 tests) — dominio Centro deportivo

| Método | Qué comprueba |
|--------|----------------|
| `test_user_cannot_delete_another_users_booking` | Otro usuario hace `DELETE` a `bookings.destroy` de una reserva ajena → **403**; la fila sigue en `bookings` (`BookingPolicy`). |
| `test_user_cannot_cancel_booking_when_slot_has_already_started` | Dueño cancela cuando `start_time` ya pasó → redirección a mis reservas, error de sesión en clave **`cancel`**, reserva no borrada. |
| `test_user_can_cancel_own_booking_before_slot_starts` | Dueño cancela con turno futuro → redirección, mensaje `status`, fila eliminada de `bookings`. |

Estos tests crean `Activity`, `TimeSlot` y `Booking` directamente en la BD de prueba (no dependen del seeder de producción).

---

## 5. Convenciones del equipo

1. **Antes de fusionar a `main`:** ejecutar `php artisan test` y dejar la suite en verde.
2. **Nueva lógica de negocio:** añadir tests `Feature` que reproduzcan el caso (ej. reservas con aforo lleno, solapes en `store`).
3. **Nombres de métodos:** en inglés, prefijo `test_` o atributo `#[Test]` si migráis a PHPUnit 10+ con estilo nuevo (opcional).

---

## 6. Cobertura no automatizada (huecos conocidos)

La suite **no** incluye aún tests que cubran de forma exhaustiva:

- `POST /reservas` (`bookings.store`): aforo máximo, solape de horarios entre reservas del mismo usuario, `lockForUpdate` / condiciones de carrera.
- Rutas **`/admin/*`**: middleware `role:admin` y CRUD de actividades / time slots.
- APIs o vistas adicionales que añadáis en el futuro.

Ampliar `tests/Feature/` con casos nuevos siguiendo el patrón de `BookingCancellationTest` (datos mínimos en BD + aserciones HTTP y de base de datos).

---

## 7. Referencias

- Especificación técnica del backend (reglas de cancelación, políticas, rutas): [`BACKEND_TECHNICAL_SPEC.md`](BACKEND_TECHNICAL_SPEC.md).
- Contrato de datos y rutas nombradas: [`campos-api.md`](campos-api.md).
- Puesta en marcha con Docker: [`README.md`](../README.md).
