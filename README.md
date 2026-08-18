# Green Zone Guard (GZG)

<div align="center">

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![Status](https://img.shields.io/badge/Status-Active%20Development-success?style=for-the-badge)

<p align="center">
  <strong>Plataforma web para la gestión comunitaria de eventos ecológicos y gamificación de voluntariado ambiental.</strong>
</p>

[Explorar Funcionalidades](#-funcionalidades-principales) • [Arquitectura](#-arquitectura-del-software) • [Instalación](#-instalación-y-despliegue) • [Estructura del Proyecto](#-estructura-del-proyecto) • [Contacto](#-contacto--autor)

</div>

---

## Descripción del Proyecto

**Green Zone Guard (GZG)** es una solución web integral diseñada para fomentar la participación ciudadana en actividades de conservación ecológica (jornadas de limpieza, siembra de árboles, reciclaje y mantenimiento de áreas verdes).

A través de un **sistema de gamificación por puntos**, los usuarios se inscriben en eventos ambientales, registran su asistencia y canjean sus puntos acumulados por recompensas reales. La plataforma incluye un **Panel Administrativo completo** para la gestión de usuarios, auditoría de asistencia, control de inventario de recompensas y generación de reportes.

---

## Funcionalidades Principales

### Módulo de Voluntarios (Usuarios)
- **Registro y Autenticación Segura:** Manejo de sesiones, validación de contraseñas con hash criptográfico (`bcrypt`) y recuperación de acceso mediante códigos verificados vía correo con **PHPMailer**.
- **Exploración e Inscripción a Eventos:** Catálogo dinámico de eventos ecológicos con detalles de fecha, hora, ubicación y puntos otorgables.
- **Perfil Gamificado:** Visualización de historial de participaciones, puntos acumulados y avatar personalizable.
- **Tienda de Recompensas:** Catálogo de incentivos disponibles con canje validado en tiempo real según el balance de puntos.
- **Canal de Contacto y PQRS:** Formulario interactivo para retroalimentación y soporte con el equipo gestor.

### Módulo Administrativo (Backoffice)
- **Gestión Integral de Eventos (CRUD):** Creación, edición, programación y cierre de actividades ambientales.
- **Control y Auditoría de Participación:** Registro y confirmación de asistencia con asignación automática de puntos a los perfiles de voluntarios.
- **Administración de Recompensas:** Control de stock, carga multimedia y despacho de premios.
- **Gestión de Roles y Accesos:** Registro de nuevos administradores y supervisión de la base de usuarios.
- **Generación de Reportes e Información:** Publicación de noticias ecológicas y seguimiento de métricas clave de impacto ambiental.

---

## Stack Tecnológico

| Capa | Tecnologías / Herramientas |
| :--- | :--- |
| **Backend** | PHP 8.x (POO & Procedural), Arquitectura MVC |
| **Base de Datos** | MySQL / MariaDB (Relacional con claves foráneas e integridad referencial) |
| **Frontend** | HTML5 Semántico, CSS3 Modular (Flexbox / Grid), JavaScript Vanilla (ES6+) |
| **Librerías / Integraciones** | PHPMailer (Envío de correos transaccionales y tokens de seguridad vía SMTP) |
| **Servidor & Entorno** | Apache (XAMPP / WampServer / LAMP) |
| **Control de Versiones** | Git & GitHub |

---

## Arquitectura del Software

El proyecto implementa el patrón de arquitectura **Modelo-Vista-Controlador (MVC)**, garantizando una clara separación de responsabilidades:

```
Gzg/
├── App/
│   ├── controllers/            # Controladores para lógica de negocio de usuarios
│   │   └── admincontrollers/   # Controladores especializados para backoffice
│   ├── models/                 # Modelos de acceso y manipulación de datos (SQL)
│   │   └── adminmodels/        # Modelos administrativos
│   ├── view/                   # Vistas públicas y del usuario autenticado
│   │   ├── adminview/          # Vistas del dashboard administrativo
│   │   └── viewsesion/         # Vistas protegidas para usuarios con sesión activa
│   └── libs/                   # Dependencias externas (PHPMailer)
├── Iniciar/                    # Procesos de recuperación de credenciales
├── Perfil_GZG/                 # Componentes y recursos del módulo de perfil
├── Scripts/                    # Scripts de frontend para validación e interactividad
├── styles/                     # Hojas de estilo modulares organizadas por vistas
└── greenzoneguard.sql          # Script de inicialización de la base de datos
```


---

## Modelo de Base de Datos

La base de datos relacional `greenzoneguard` cuenta con un diseño normalizado que gestiona las siguientes entidades principales:

- **`usuario`**: Almacena datos personales, credenciales hasheadas, puntuación acumulada, foto de perfil y token de recuperación.
- **`administracion`**: Registro de usuarios con privilegios elevados y roles administrativos.
- **`eventos`**: Catálogo de actividades ecológicas con fecha, hora, ubicación y puntos a otorgar.
- **`participacion` & `historial_participacion`**: Registro de inscripciones y trazabilidad de asistencias para asignación de puntos.
- **`recompensas`**: Inventario de incentivos canjeables, stock disponible y entregas realizadas.
- **`contactos`**: Sistema de recepción y respuesta de mensajes/PQRS.
- **`informacion`**: Muro informativo y noticias sobre el cuidado ambiental.

---

## Instalación y Despliegue Local

Sigue estos pasos para ejecutar el proyecto en tu entorno de desarrollo local:

### 1. Prerrequisitos
- Tener instalado un servidor web local con soporte PHP y MySQL (ejemplo: [XAMPP](https://www.apachefriends.org/), WampServer o Laragon).
- Git instalado en el sistema.

### 2. Clonar el Repositorio
Ubica la carpeta `htdocs` (en XAMPP) o `www` y ejecuta:
```bash
git clone https://github.com/TU_USUARIO/green-zone-guard.git
cd green-zone-guard
```

### 3. Configurar la Base de Datos
1. Inicia los servicios de **Apache** y **MySQL** desde el panel de XAMPP.
2. Abre tu gestor de base de datos favorito (ej. phpMyAdmin en `http://localhost/phpmyadmin`).
3. Crea una nueva base de datos llamada `greenzoneguard`.
4. Importa el archivo `greenzoneguard.sql` ubicado en la raíz del proyecto.

### 4. Configurar la Conexión
Verifica o edita las credenciales en `App/models/conexion.php`:
```php
$host = "localhost";
$user = "root";
$password = "";
$database = "greenzoneguard";
```

### 5. Ejecutar la Aplicación
Abre tu navegador y accede a:
```
http://localhost/green-zone-guard/App/view/index.php
```

Para ingresar al panel administrativo:
```
http://localhost/green-zone-guard/App/view/adminview/Login_Admin.php
```


---

##  Seguridad y Buenas Prácticas

- **Cifrado de Contraseñas:** Uso de `password_hash()` con algoritmo `PASSWORD_BCRYPT` para proteger credenciales.
- **Manejo Seguro de Sesiones:** Control de estados de sesión en PHP para aislar vistas públicas, de usuario y administrativas.
- **Validación de Formularios:** Validación frontend interactiva (JavaScript) y validación backend (PHP) para garantizar integridad de datos.
- **Arquitectura Escalable:** Estructuración en capas (MVC) facilitando el mantenimiento y la extensión de nuevas funcionalidades.

---

##  Contacto & Autor

Desarrollado con pasión por el desarrollo de software y el impacto ambiental positivo.

- **Desarrollador:** Luis Contreras Paez
- **GitHub:** [Luis Contreras Paez](https://github.com/ContrerasG4)
- **LinkedIn:** [Luis Contreras Paez](www.linkedin.com/in/luis-contreras-256493320)
- **Email:** luisrodolfocontreraspaez123@gmail.com

---
<img width="1861" height="946" alt="image" src="https://github.com/user-attachments/assets/3d698c0f-13c9-4005-8bcc-3e96dc44e192" />
<img width="1875" height="950" alt="Screenshot 2026-08-18 182204" src="https://github.com/user-attachments/assets/9be7180b-69a5-4ff2-8d5b-20705ac7bd99" />
<img width="1860" height="948" alt="Screenshot 2026-08-18 182234" src="https://github.com/user-attachments/assets/49de6001-439c-4816-864b-eac376fd53ab" />
<img width="1864" height="949" alt="Screenshot 2026-08-18 182244" src="https://github.com/user-attachments/assets/2a788834-54fd-4d3d-b7d5-d4a1c9317e88" />
<img width="1862" height="950" alt="Screenshot 2026-08-18 182301" src="https://github.com/user-attachments/assets/678dc892-9171-4bbf-8acf-5de7e5319367" />
<img width="1880" height="940" alt="Screenshot 2026-08-18 182318" src="https://github.com/user-attachments/assets/a96ce200-3257-49b2-8276-91ac6865eae4" />



