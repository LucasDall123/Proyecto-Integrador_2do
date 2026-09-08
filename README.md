# FixTech - Sistema de Gestión de Taller y Rastreo de Reparaciones

Sistema web completo para la gestión de talleres de reparación y seguimiento de equipos, construido con Laravel 12.

## Características

- **Gestión de Clientes**: CRUD completo para registrar y administrar propietarios de dispositivos
- **Inventario de Equipos**: Registro de dispositivos (celulares, laptops, tablets) con información de serie/IMEI
- **Órdenes de Reparación**: Sistema de tickets con códigos de rastreo únicos (ej: TRK-XXXXXX)
- **Diagnóstico Técnico**: Actualización de reportes técnicos y estados de reparación
- **Gestión de Repuestos**: Control de solicitudes de piezas con estados (Pendiente, Comprado, Recibido)
- **Panel de Control**: Métricas en tiempo real (órdenes activas, en diagnóstico, esperando repuestos, listas)
- **Portal Público de Rastreo**: Página pública para que los clientes consulten el estado de sus equipos
- **Control de Acceso**: Sistema RBAC con roles de Admin y Técnico
- **Modo Oscuro**: Interfaz moderna con paleta de colores oscura

## Stack Tecnológico

- **Framework**: Laravel 12 (PHP 8.3+)
- **Base de Datos**: SQLite (desarrollo) / MySQL 8.x (producción)
- **Frontend**: Tailwind CSS v3 + Blade
- **Autenticación**: Laravel Breeze
- **Containerización**: Laravel Sail (Docker)

## Instalación

### Requisitos Previos

- PHP 8.3 o superior
- Composer
- Node.js y NPM
- SQLite (para desarrollo local)

### Pasos de Instalación

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/LucasDall123/Proyecto-Integrador_2do.git
   cd Proyecto-Integrador_2do
   ```

2. **Instalar dependencias de PHP**
   ```bash
   composer install
   ```

3. **Instalar dependencias de Node**
   ```bash
   npm install
   ```

4. **Configurar el archivo .env**
   - El proyecto ya está configurado para usar SQLite
   - No se requiere configuración adicional para desarrollo local

5. **Ejecutar migraciones y seeders**
   ```bash
   php artisan migrate --seed
   ```

6. **Compilar assets**
   ```bash
   npm run build
   ```

7. **Iniciar el servidor de desarrollo**
   ```bash
   php artisan serve
   ```

8. **Acceder a la aplicación**
   - URL: http://localhost:8000
   - Portal de rastreo: http://localhost:8000/tracking

## Credenciales de Acceso

El sistema incluye dos usuarios preconfigurados:

### Administrador
- **Email**: admin@fixtech.com
- **Password**: password
- **Permisos**: Acceso completo a todas las funcionalidades, incluyendo gestión de repuestos

### Técnico
- **Email**: tecnico@fixtech.com
- **Password**: password
- **Permisos**: Gestión de clientes, equipos, y órdenes de reparación

## Estructura del Proyecto

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── DashboardController.php
│   │   ├── ClienteController.php
│   │   ├── EquipoController.php
│   │   ├── OrdenController.php
│   │   ├── RepuestoController.php
│   │   └── PublicTrackingController.php
│   └── Middleware/
│       ├── IsAdmin.php
│       └── IsTecnico.php
├── Models/
│   ├── User.php
│   ├── Cliente.php
│   ├── Equipo.php
│   ├── Orden.php
│   └── Repuesto.php
database/
├── migrations/
│   ├── 2026_09_08_185041_add_role_to_users_table.php
│   ├── 2026_09_08_185044_create_clientes_table.php
│   ├── 2026_09_08_185045_create_equipos_table.php
│   ├── 2026_09_08_185047_create_ordenes_table.php
│   └── 2026_09_08_185048_create_repuestos_table.php
└── seeders/
    └── UserSeeder.php
resources/views/
├── clientes/
├── equipos/
├── ordenes/
├── repuestos/
├── tracking/
└── layouts/
```

## Rutas Principales

| Ruta | Descripción | Middleware |
|------|-------------|------------|
| `/` | Redirección al portal de rastreo | Público |
| `/tracking` | Portal público de rastreo | Público |
| `/dashboard` | Panel de control | auth, tecnico |
| `/clientes` | Gestión de clientes | auth, tecnico |
| `/equipos` | Gestión de equipos | auth, tecnico |
| `/ordenes` | Gestión de órdenes | auth, tecnico |
| `/repuestos` | Gestión de repuestos | auth, admin |

## Estados de Órdenes

- **Ingresado**: Equipo recibido en el taller
- **En Diagnóstico**: Técnico evaluando el problema
- **Esperando Repuesto**: Esperando llegada de piezas
- **Listo p/ Retirar**: Reparación completada

## Estados de Repuestos

- **Pendiente**: Solicitud creada, pendiente de aprobación
- **Comprado**: Pieza adquirida
- **Recibido**: Pieza recibida en el taller

## Docker (Opcional)

Para usar Laravel Sail con Docker:

1. **Instalar Sail**
   ```bash
   php artisan sail:install
   ```

2. **Iniciar contenedores**
   ```bash
   ./vendor/bin/sail up
   ```

3. **Ejecutar comandos dentro de Sail**
   ```bash
   ./vendor/bin/sail artisan migrate --seed
   ./vendor/bin/sail npm run build
   ```

## Desarrollo

### Ejecutar tests
```bash
php artisan test
```

### Formatear código
```bash
./vendor/bin/pint
```

## Licencia

Este proyecto es de código abierto y está licenciado bajo el [MIT license](https://opensource.org/licenses/MIT).
