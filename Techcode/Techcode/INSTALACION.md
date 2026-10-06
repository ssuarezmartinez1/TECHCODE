# TechCode — Instrucciones de instalación (XAMPP)

## 1. Copiar el proyecto
Copia la carpeta `Tech_Code` completa dentro de `htdocs` de tu XAMPP, de forma
que quede así:

```
C:/xampp/htdocs/Tech_Code/
    CONTROLADOR/
    MODELO/
    VISTA/
    index.php
```

⚠️ El nombre de la carpeta debe ser exactamente `Tech_Code` (con esa
mayúscula/minúscula), porque `MODELO/auth_guard.php` redirige a
`/Tech_Code/VISTA/login/login.php` cuando alguien intenta entrar a un panel
sin sesión. Si usas otro nombre de carpeta, ajusta esa ruta en
`MODELO/auth_guard.php`.

## 2. Iniciar Apache y MySQL
Desde el panel de XAMPP, inicia **Apache** y **MySQL**.

## 3. Crear la base de datos
Abre phpMyAdmin (`http://localhost/phpmyadmin`) y en la pestaña **SQL**
pega y ejecuta el contenido de `MODELO/database.sql`.

Esto crea la base de datos `techcode` y la tabla `usuarios` (con la columna
`rol` tipo `ENUM('administrador','cliente')`).

Si tu MySQL de XAMPP tiene usuario/contraseña distintos a los de por
defecto (`root` sin contraseña), edítalos en `MODELO/config.php`.

## 4. Crear los usuarios de prueba
En el navegador, visita **una sola vez**:

```
http://localhost/Tech_Code/MODELO/seed_usuarios.php
```

Esto crea dos cuentas con contraseñas hasheadas de verdad con
`password_hash()` de PHP (no un hash inventado a mano):

| Rol            | Correo                | Contraseña   |
|----------------|------------------------|--------------|
| Administrador  | admin@techcode.com     | Admin123!    |
| Cliente        | cliente@techcode.com   | Cliente123!  |

Después de crearlas, por seguridad borra o renombra ese archivo.

## 5. Probar el sitio
```
http://localhost/Tech_Code/
```

- Navega por Inicio, Nosotros, Servicios, Proyectos, Resultados y Contacto:
  cada una es su propia página PHP.
- Entra en **Iniciar sesión**, elige la pestaña Administrador o Cliente e
  inicia sesión con las cuentas de prueba de arriba.
- El acceso correcto te lleva a `VISTA/admin/panel.php` o
  `VISTA/cliente/panel.php` según el rol. Cada panel está protegido por
  `MODELO/auth_guard.php`: si entras a esas URLs sin sesión, te redirige
  al login.
- El botón de la navbar cambia de "Iniciar sesión" a tu nombre cuando la
  sesión está activa, y "Cerrar sesión" destruye la sesión real de PHP
  (`CONTROLADOR/logout.php`).

## Qué se verificó y qué no (honestidad del entorno de desarrollo)

Este proyecto se construyó en un entorno sin PHP ni MySQL instalados,
así que **no fue posible ejecutar el sitio ni correr las consultas en
vivo**. Lo que sí se hizo:

- Se revisó cada archivo PHP a mano para balancear etiquetas, comillas y
  la lógica de sesión/roles.
- No se inventó ningún hash de contraseña: `seed_usuarios.php` genera los
  hashes reales con `password_hash()` al momento de instalar, en tu propio
  servidor.
- Las consultas SQL usan sentencias preparadas con PDO (`?`/`:parametro`),
  no concatenación de strings, para evitar inyección SQL.

Lo que falta validar en tu máquina (con XAMPP real):
- Que el login efectivamente autentique y redirija por rol.
- Que `auth_guard.php` bloquee el acceso directo a los paneles sin sesión.
- Revisión visual final en distintos anchos de pantalla (el menú móvil y
  el layout responsive se probaron por lectura de CSS, no en un navegador
  real).

## Estructura del proyecto (resumen)

```
CONTROLADOR/
    auth_controlador.php   Procesa el login (password_verify + sesión real)
    logout.php              Destruye la sesión
    ui.js                    Toast + menú móvil (reemplaza al viejo session.js simulado)
    script.js, piano.js, mini-juego.js   (sin cambios)

MODELO/
    config.php               Datos de conexión a MySQL
    conexion.php             Conexión PDO
    database.sql             Script de creación de la base de datos
    seed_usuarios.php        Crea usuarios de prueba (ejecutar una vez)
    usuario_modelo.php       Consultas a la tabla usuarios
    auth_guard.php           Protege páginas privadas por rol
    navbar_sesion.php        Dibuja el botón de sesión en la navbar

VISTA/
    theme-light.css          Tema claro morado/violeta + azul + naranja (global)
    shared.css                Menú móvil, toasts, mensajes de formulario (global)
    login/login.php           Login con pestañas Administrador/Cliente
    admin/panel.php           Panel protegido de administrador
    cliente/panel.php         Panel protegido de cliente
    resultados/resultados.php Página nueva de Resultados
    index.php, nosotros/, servicios/, proyectos/, contacto/   Páginas públicas
```

## Diseño

El tema claro (`VISTA/theme-light.css`) reutiliza las variables CSS que ya
compartían todas las páginas (`--black`, `--orange`, `--white`, `--gray`,
`--border`, etc.) y las redefine con la paleta pedida: fondos claros,
morado/violeta como color principal, azul tecnológico en degradados y
hover, y naranja reservado para detalles puntuales (puntos de estado,
etiquetas pequeñas). Esto da una base coherente en todo el sitio sin
reescribir cada página línea por línea. Si más adelante compartes
imágenes de referencia concretas, se pueden afinar secciones específicas
sobre esta misma base.
