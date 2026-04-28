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

## ⚠️ Solución de problemas comunes

### Error de permisos (`tempnam` o "Permission Denied")

Si al entrar en la web http://localhost:8080  ves un error relacionado con archivos temporales o permisos en `storage`, ejecuta:

```bash
sudo chmod -R 777 src/storage src/bootstrap/cache
```

### Error de conexión a la base de datos

Si el comando `migrate` falla, espera 10 segundos a que MariaDB termine de arrancar por completo y vuelve a intentarlo.
