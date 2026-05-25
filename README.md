# 🏟️ Plataforma de Reservas - Centro Deportivo (Grupo 5)

Este proyecto es una aplicación web integral para la gestión de instalaciones y actividades deportivas. Está construida sobre **Laravel 12** y desplegada en un entorno de microservicios con **Docker**.

---

## 🚀 Guía de puesta en marcha (Fast-Track)

Sigue estos pasos exactamente en este orden para sincronizar tu entorno local con el del equipo.

### 1. Clonar el repositorio

Repositorio: https://github.com/Petaka41/TW-Grupo-5

```bash
git clone https://github.com/Petaka41/TW-Grupo-5.git
cd TW-Grupo-5
```

### 2. Levantar la infraestructura (Docker)

Este comando descargará las imágenes necesarias y levantará los contenedores de la aplicación y la base de datos.

```bash
docker compose up -d --build
```

### 3. Instalar dependencias de Laravel

La carpeta `vendor` está ignorada en Git. Debes generarla dentro de tu contenedor:

```bash
docker exec -it deportivo-app composer install
```

### 4. Configurar permisos (CRÍTICO para usuarios Linux)

Si trabajas en Linux (como en el ThinkPad), ejecuta esto en tu terminal local para evitar errores de "Permission Denied":

```bash
# Reclamar propiedad de los archivos
sudo chown -R $USER:$USER .

# Dar permisos de escritura al servidor web dentro de Laravel
docker exec -it deportivo-app chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 777 src/storage src/bootstrap/cache
```

### 5. Generar la clave de la aplicación

Indispensable para que Laravel pueda arrancar y cifrar sesiones:

```bash
docker exec -it deportivo-app php artisan key:generate
```

### 6. Sincronizar la base de datos

Crea las tablas y la estructura necesaria en MariaDB:

```bash
docker exec -it deportivo-app php artisan migrate
```

Para **recrear todo** e insertar datos de demo (admin, socio, 5 actividades y turnos):

```bash
docker exec -it deportivo-app php artisan migrate:fresh --seed
```

**Comando de salvación:** si un compañero deja la base local incoherente (migraciones a medias, datos rotos), lo habitual es ejecutar de nuevo `migrate:fresh --seed` **solo en entorno local** (borra todas las tablas y vuelve al estado demo).

### Credenciales de demo (entrega / pruebas)

| Rol | Email | Contraseña |
|-----|-------|------------|
| Administrador | `admin@deportivo.test` | `password` |
| Socio | `socio@deportivo.test` | `password` |

Tras `migrate:fresh --seed` siempre existirán estos dos usuarios. Más detalle de campos y rutas: [docs/campos-api.md](docs/campos-api.md).

### 7. Enlace de almacenamiento (imágenes de actividades)

```bash
docker exec -it deportivo-app php artisan storage:link
```

### 8. Front-end (Vite / Laravel Breeze)

Las vistas de autenticación usan Vite. **En tu máquina** (no hace falta que el contenedor tenga Node), dentro de `src/`:

```bash
cd src
npm install
npm run build
```

En desarrollo local puedes usar `npm run dev` si tienes Node 20+.

**Sin Node instalado:** el contenedor Docker de la app no incluye Node. Tras que alguien del equipo ejecute `npm run build` una vez, los CSS/JS compilados quedan en `src/public/build` en su copia local y la aplicación sirve esos assets sin necesidad de volver a compilar. Esa carpeta suele **no** subirse a Git (está en `.gitignore`); si clonas el repo y no ves estilos, o bien generas `public/build` con Node 20+, o te pasan esa carpeta desde quien ya haya hecho el build.

### 9. Contrato de datos para el equipo

- Campos Eloquent, rutas nombradas y usuarios de prueba: [docs/campos-api.md](docs/campos-api.md).

---

## Pruebas automatizadas

Con los contenedores en marcha:

```bash
docker exec -it deportivo-app php artisan test
```

La suite actual valida sobre todo **autenticación y perfil (Breeze)**, la página de inicio y **cancelación de reservas** (dueño, regla `start_time`, 403 entre usuarios). Convención del equipo: ejecutar tests antes de fusionar a `main`.

---

## 🌐 Detalles del entorno

Una vez completados los pasos, podrás acceder en:

**URL de la aplicación:** http://localhost:8080

**Gestión de datos (MariaDB):**

- **Host:** `db` (interno) / `localhost` (externo)
- **Puerto:** `3306`
- **Base de datos:** `deportivo_db`
- **Usuario:** `grupo5`
- **Contraseña:** `mi_password`

---


### Error de conexión a la base de datos

Si el comando `migrate` falla, espera 10 segundos a que MariaDB termine de arrancar por completo y vuelve a intentarlo.
