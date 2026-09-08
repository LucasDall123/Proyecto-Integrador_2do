# Proyecto-Integrador_2do
# 🛠️ FixTech - Sistema Web de Gestión de Taller y Seguimiento de Reparaciones

**FixTech** es una plataforma web desarrollada en **Laravel 12** diseñada para digitalizar y optimizar la gestión integral de talleres de servicio técnico. El sistema permite controlar el ciclo de vida completo de cada reparación, automatizar la comunicación de repuestos entre técnicos y administración, y brindar transparencia a los clientes mediante un portal público de consulta de estado.

---

## 🚀 Características Principales

* **🔐 Control de Acceso por Roles:** Entorno seguro adaptado para Técnicos y Administradores.
* **📋 Gestión de Órdenes y Diagnósticos:** Registro de ingreso de equipos, asociación con clientes por DNI e informe técnico de fallas.
* **🧱 Solicitud de Repuestos Interna:** Módulo para que el técnico solicite piezas al área de compras y el administrador gestione su adquisición.
* **🔎 Portal Público de Consulta de Estado:** Módulo externo accesible para clientes donde pueden verificar la evolución de su equipo ingresando un **Código de Seguimiento** único (ej. `TRK-98231X`).
* **👥 Directorio de Clientes:** Base de datos centralizada con historial de intervenciones y equipos asociados.
* **🌙 Interfaz Moderna (Dark Mode):** Diseño adaptativo (*responsive*) pensado para uso en tablets de taller y PCs fijas.

---

## 🛠️ Stack Tecnológico

* **Backend:** PHP 8.3 | Laravel 12
* **Frontend:** Tailwind CSS | JavaScript / Alpine.js
* **Base de Datos:** MySQL 8
* **Infraestructura:** Docker Compose / Laravel Sail

---

## 💻 Instalación y Configuración Local

1. **Clonar el repositorio:**
   ```bash
   git clone [https://github.com/tu-usuario/fixtech.git](https://github.com/tu-usuario/fixtech.git)
   cd fixtech
