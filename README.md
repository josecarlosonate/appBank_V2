# AppBank

Aplicación de banca digital simulada construida en **PHP nativo** con arquitectura MVC.

AppBank permite a los clientes autenticarse, administrar múltiples cuentas e inscribir cuentas de terceros, aplicando reglas de negocio y una arquitectura orientada a mantener separadas las responsabilidades de la aplicación.

---

## ¿Qué problema resuelve?

Modela las operaciones básicas de un banco digital:

- AppBank centraliza la gestión básica de productos bancarios de un cliente en una sola aplicación.
- un cliente puede tener varias cuentas
- puede activar o desactivar sus cuentas
- puede inscribir cuentas de otros clientes como destinatarios
- el sistema valida propiedad, estado y reglas de negocio antes de operar

El objetivo del proyecto es demostrar diseño limpio, separación de responsabilidades y control de acceso sobre recursos en una aplicación PHP real.

---

## Funcionalidades actuales

### Autenticación

- Login con documento y contraseña
- Passwords hasheados (`password_verify`)
- Regeneración de sesión al autenticarse
- Logout seguro
- Protección de rutas con middleware

### Cuentas propias

- Listado de cuentas del cliente
- Creación de cuentas (ahorros / corriente)
- Generación de número de cuenta único
- Activación / desactivación con validación de ownership

### Cuentas inscritas (destinatarios)

- Inscripción de cuentas de terceros
- Validación por número de cuenta + documento del titular
- Prevención de:
  - inscribir una cuenta propia
  - inscribir la misma cuenta dos veces
  - inscribir una cuenta inexistente
- Eliminación de inscripción

---

## Stack

- **PHP 8.x** (Nativo)
- **MySQL 8**
- **PDO**
- **Composer**
- **Dotenv**
- **Bootstrap 5**
- **Docker**
- **Docker Compose**
- **Apache**

---

## Arquitectura

```text
public/index.php          → Front controller
app/
  Core/                   → Router + Container (DI)
  Middleware/             → AuthMiddleware
  Controllers/            → Orquestación de casos de uso
  Models/                 → Acceso a datos
  Enums/                  → Resultados de dominio
  views/                  → Capas de presentación
routes/web.php            → Definición de rutas
config/                   → Base de datos
database/                 → Schema + seeds
```

---

## Decisiones técnicas

- **Router** propio con soporte para vistas, controllers y middleware.
- **Contenedor de dependencias** con resolución por **reflection**.
- **Middleware de autenticación** para rutas protegidas.
- **Ownership checks** en operaciones sobre cuentas
- Constraints en base de datos (CHECK, UNIQUE, FOREIGN KEY)

---

## Modelo de datos

Tablas

| Tabla               | Descripción                   |
| ------------------- | ----------------------------- |
| customers           | Clientes del banco            |
| accounts            | Cuentas bancarias             |
| registered_accounts | Cuentas de terceros inscritas |
| transactions        | Transferencias                |

---

## Reglas importantes

- Un cliente puede tener múltiples cuentas.
- Una cuenta pertenece a un único cliente.
- Una cuenta de terceros debe existir antes de poder ser inscrita.
- Un cliente no puede inscribir una cuenta propia como cuenta de terceros.
- Una misma cuenta de terceros no puede inscribirse más de una vez.
- El saldo de una cuenta no puede ser negativo.
- Solo el propietario de una cuenta puede modificar su estado.
- Una transferencia no puede tener la misma cuenta como origen y destino.
- El monto de una transferencia debe ser mayor a 0.
- Un cliente no puede inscribir una de sus propias cuentas como cuenta de terceros.
- No se puede cambiar el estado de una cuenta que pertenece a otro cliente.

---

## Cómo ejecutar el proyecto

AppBank puede ejecutarse de dos formas:

1. **Con Docker** — opción recomendada.
2. **Instalación manual** — utilizando PHP, Composer y MySQL instalados localmente.

---

### Opción 1: Docker

#### Requisitos

- Docker
- Docker Compose
- Git

No es necesario instalar PHP, Composer, Apache ni MySQL localmente.

#### Instalación

1. Clona el repositorio:

```bash
git clone https://github.com/josecarlosonate/appBank_V2.git
cd appBank_V2
```

2. Crea el archivo de configuración .env:

```bash
cp .env.example .env
```

3. Configura las variables de la base de datos en .env.

4. Construye e inicia los contenedores:

```bash
docker compose up -d --build
```

5. Abre la aplicación en:

```text
   http://localhost:8080
```

Adminer está disponible en:

```text
   http://localhost:8081
```

La base de datos se inicializa automáticamente durante la primera ejecución utilizando:

```text
- database/schema.sql
- database/seed.sql
```

Credenciales de prueba

Puedes iniciar sesión con:

```text
- Documento: 123456789
- Contraseña: Test123
```

Detener el proyecto con

```bash
docker compose down
```

### Opción 2: Instalación manual

#### Requisitos

- Git
- PHP 8.3
- Composer
- MySQL 8.4
- Apache con mod_rewrite habilitado

PHP debe tener habilitada la extensión:

```text
   pdo_mysql
```

#### Instalación

1. Clona el repositorio:

```bash
git clone https://github.com/josecarlosonate/appBank_V2.git
cd appBank_V2
```

2. Instala las dependencias de PHP:

```bash
composer install
```

3. Crea el archivo de configuración .env:

```bash
cp .env.example .env
```

4. Configura las variables de tu base de datos en .env.

```env
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=appbank
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
MYSQL_ROOT_PASSWORD=
```

5. Crea la base de datos:

```sql
CREATE DATABASE appbank
CHARACTER SET utf8mb4
COLLATE utf8mb4_0900_ai_ci;
```

6. Importa el esquema:

```bash
mysql -u tu_usuario -p appbank < database/schema.sql
```

7. Importa los datos de prueba:

```bash
mysql -u tu_usuario -p appbank < database/seed.sql
```

8. Inicia el servidor de desarrollo de PHP.

```bash
php -S localhost:8000 -t public
```

o tambien puedes configurar Apache para utilizar como DocumentRoot y apuntar
el virtual host al directorio **public/**

9. Abre la aplicación en:

```text
   http://localhost:8080
```

10. Abre la URL configurada en tu servidor local para el proyecto en el navegador:
    Credenciales de prueba

```text
Documento: 123456789
Contraseña: Test123
```

---

## Autor

- Jose Carlos Oñate Rodríguez

- Proyecto de portafolio — PHP (Nativo) / MySQL / Arquitectura MVC
